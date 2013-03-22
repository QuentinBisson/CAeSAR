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
    $borrowedQuantity = count($resource->getBorrowings());

    //if at least one available
    if ($q > $borrowedQuantity) {
      $reservedQuantity = count($resource->getReservations());
      $available = $q - $borrowedQuantity - $reservedQuantity;

      if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
        $user = $this->get('security.context')->getToken()->getUser();

        if ($available > 0) { //Si pas de réservation bloquante
          $borrow = new Borrowing();
          $borrow->setResource($resource);
          $borrow->setUser($user);
          $em->persist($borrow);
          $em->flush();
          $this->get('session')->getFlashBag()->add(
            'notice', $translator->trans('client.borrowing.resource.borrowed', array('%resource%' => $resource->getDescription()))
          );
          return $this->redirect($this->generateUrl('caesar_client_homepage'));
        } else {
          $reservedAvailable = $q - $borrowedQuantity;
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
          //Si user parmi les premiers à réserver
          if ($reservation != null) {
            $em->remove($reservation);
            $borrow = new Borrowing();
            $borrow->setResource($resource);
            $borrow->setUser($user);
            $em->persist($borrow);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
              'notice', $translator->trans('client.borrowing.resource.reservation.borrowed', array('%resource%' => $resource->getDescription()))
            );
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
          } else {
            $isInList = false;
            foreach ($resource->getReservations()->toArray() as $reservation) {
              if ($reservation->getUser()->isEqualTo($user)) {
                $isInList = true;
              }
            }
            //Pas le premier sur la liste de réservation
            if ($isInList) {
              $this->get('session')->getFlashBag()->add(
                'error', $translator->trans('client.borrowing.resource.reservation.error', array('%resource%' => $resource->getDescription()))
              );
              return $this->redirect($this->generateUrl('caesar_client_homepage'));
            } else { //Ressource non réservée.
              $this->get('session')->getFlashBag()->add(
                'error', $translator->trans('client.borrowing.resource.reservation.none', array('%resource%' => $resource->getDescription()))
              );
              return $this->redirect($this->generateUrl('caesar_client_homepage'));
            }
          }
        }
      } else {//Je dois me connecter
        /* $message = "Veuillez vous connecter avant d'emprunter la ressource.";
          $this->get('session')->getFlashBag()->add(
          'info', $translator->trans('client.borrowing.resource.unavailable', array('%resource%' => $resource->getDescription()))
          );
          return $this->render('CaesarResourceBundle:Resource:borrow.html.twig', array('resource' => $resource, 'message' => $message)); */
      }
    }
    //Plus de ressources disponibles
    $this->get('session')->getFlashBag()->add(
      'error', $translator->trans('client.borrowing.resource.unavailable', array('%resource%' => $resource->getDescription()))
    );
    return $this->redirect($this->generateUrl('caesar_client_homepage'));
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
    $borrowedQuantity = count($resource->getBorrowings());

    if ($borrowedQuantity <= 0) {
      throw $this->createNotFoundException($translator->trans('client.return.impossible.exception', array('%resource%' => $resource->getDescription())));
    }

    if ($borrowedQuantity == 1) { //if only one borrowed
      $this->get('session')->getFlashBag()->add(
        'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
      );
      return $this->redirect($this->generateUrl('caesar_client_homepage'));
    } else if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) { //Rendre
      $reservedAvailable = $q - $borrowedQuantity;
      $reservationsToNotify = array();
      $reservations = $resource->getReservations();
      $i = 0;
      array_push($reservationsToNotify, $reservations->first());
      while ($i < $reservedAvailable - 1) {
        array_push($reservationsToNotify, $reservations->next());
        $i++;
      }
      //TODO send email to $acceptedReservations
      $this->get('session')->getFlashBag()->add(
        'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
      );
    }

    /* $message = "Veuillez vous connecter avant d'emprunter la ressource.";
      $this->get('session')->getFlashBag()->add(
      'info', $translator->trans('client.borrowing.resource.unavailable', array('%resource%' => $resource->getDescription()))
      );
      return $this->render('CaesarResourceBundle:Resource:return.html.twig', array('resource' => $resource)); */
  }

}

