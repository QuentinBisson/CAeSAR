<?php

namespace Caesar\ResourceBundle\Controller;

use Caesar\ResourceBundle\Entity\Resource;
use Caesar\UserBundle\Entity\Borrowing;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller {

  public function consultAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else if (filter_input(INPUT_GET, $code, FILTER_VALIDATE_INT) !== false) {
      $clean = $code;
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->find($clean);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    return $this->render('CaesarResourceBundle:Resource:consultation.html.twig', array('resource' => $resource));
  }

  public function ajaxGetAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    $request = $this->get('request');
    if ($request->isXmlHttpRequest()) {
      return new Response(json_encode($resource->getJsonData()));
    }
    throw $this->createNotFoundException($translator->trans('form.invalid'));
  }

  public function borrowAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    $q = $resource->getQuantity();
    $borrowingsQuantity = count($resource->getBorrowings());

    //if at least one available
    if ($q > $borrowingsQuantity) {
      $reservedQuantity = count($resource->getReservations());
      $available = $q - $borrowingsQuantity - $reservedQuantity;

      if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($available > 0) { //Si pas de réservation bloquante
          $borrow = new Borrowing();
          $borrow->setResource($resource);
          $borrow->setUser($user);
          $em->persist($borrow);
          $em->flush();
          $message = "La ressource a bien été empruntée.";
        } else {
          $reservedAvailable = $q - $borrowingsQuantity;
          $acceptedReservations = array();
          $reservations = $resource->getReservations();
          $i = 0;
          array_push($acceptedReservations, $reservations->first());
          while ($i < $reservedAvailable - 1) {
            array_push($acceptedReservations, $reservations->next());
            $i++;
          }

          $reservation = null;
          foreach ($acceptedReservations as $r) {
            if ($r->getUser()->isEqualTo($user)) {
              $reservation = $r;
            }
          }
          //Si je suis le premier reservateur (sort by date)
          if ($reservation != null) {
            $em->remove($reservation);
            $borrow = new Borrowing();
            $borrow->setResource($resource);
            $borrow->setUser($user);
            $em->persist($borrow);
            $em->flush();
            $message = "La ressource que vous avez réservée est empruntée.";
          } else {
            $isInList = false;
            foreach ($resource->getReservations()->toArray() as $reservation) {
              if ($reservation->getUser()->isEqualTo($user)) {
                $isInList = true;
              }
            }
            if ($isInList) {
              $message = "Malheureusement, des utilisateurs ont réservé cette ressource avant vous.";
              //Pas le premier sur la liste de réservation
            } else {
              $message = "Malheureusement, tous les exemplaires de cette ressource ont été emprunté ou réservé. Il vous est impossible d'emprunter cette ressource.";
              //Ressource non réservée.
            }
          }
        }
      } else {
        $message = "Veuillez vous connecter avant d'emprunter la ressource.";
        //Je dois me connecter
      }
    } else {
      $message = "Malheureusement, La ressource que vous souhaitez emprunter n'est plus disponible.";
      //Plus de ressources disponibles
    }
    return $this->render('CaesarResourceBundle:Resource:borrow.html.twig', array('resource' => $resource, 'message' => $message));
  }

  public function returnAction($code) {
    $translator = $this->get('translator');
    $em = $this->getDoctrine()->getManager();
    if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
      $resource = $em->getRepository('CaesarResourceBundle:Resource')
        ->findOneByCode($code);
    } else {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }
    if (!$resource) {
      throw $this->createNotFoundException($translator->trans('client.borrow.exception', array('%code%' => $code)));
    }

    $q = $resource->getQuantity();
    $borrowingsQuantity = count($resource->getBorrowings());

    if ($borrowingsQuantity <= 0) {
      throw $this->createNotFoundException('Cette ressource ne peut être rendue car elle n\'a pas été emprunté.');
    }

    //if only one borrowed
    if ($borrowingsQuantity == 1) {
      return new Response('Resource rendu.');
    } else if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
      //Rendre
      $reservedAvailable = $q - $borrowingsQuantity;
      $acceptedReservations = array();
      $reservations = $resource->getReservations();
      $i = 0;
      array_push($acceptedReservations, $reservations->first());
      while ($i < $reservedAvailable - 1) {
        array_push($acceptedReservations, $reservations->next());
        $i++;
      }
      //send email au reservateurs acceptés
    } else {
      //Je dois me connecter
    }

    return $this->render('CaesarResourceBundle:Resource:return.html.twig', array('resource' => $resource));
  }

}

