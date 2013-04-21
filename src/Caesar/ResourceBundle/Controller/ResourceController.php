<?php

namespace Caesar\ResourceBundle\Controller;

use Caesar\ResourceBundle\Entity\Resource;
use Caesar\UserBundle\Entity\Borrowing;
use Caesar\UserBundle\Entity\Subscription;
use Caesar\UserBundle\Entity\BorrowingArchive;
use Swift_Encoding;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;

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

    public function borrowAction($code = '') {
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
                   
                    $array = $resource->getReservations()->toArray();
                    foreach ($array as $r) {
                        if ($r->getUser()->isEqualTo($user)) {
                            $em->remove($r);
                        }
                    }
                    
                    $em->flush();
                    $this->get('session')->getFlashBag()->add(
                            'notice', $translator->trans('client.borrowing.resource.borrowed', array('%resource%' => $resource->getDescription()))
                    );
                    return $this->redirect($this->generateUrl('caesar_client_homepage'));
                } else {
                    $reservedAvailable = $q - $borrowedQuantity;
                    $acceptedReservations = array();
                    $i = 0;
                    $array = $resource->getReservations()->toArray();
                    $sizeOfArray = count($array);
                   
                    while ($i < $reservedAvailable && $i < $sizeOfArray) {
                        array_push($acceptedReservations, $array[$i]);
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
                        $params = array();
                        if ($isInList) {
                            $text = $translator->trans('client.borrowing.resource.reservation.error', array('%resource%' => $resource->getDescription()));
                            $params['user'] = $user->getId();
                            $params['resource'] = $resource->getId();
                        } else { //Ressource non réservée.
                            $text = $translator->trans('client.borrowing.resource.reservation.none', array('%resource%' => $resource->getDescription()));
                            $params['resource'] = $resource->getId();
                        }

                        $this->get('session')->getFlashBag()->add(
                                'error', $text
                        );
                        return $this->redirect($this->generateUrl('caesar_blocking_reservations', $params));
                    }
                }
            } else {//Je dois me connecter
                $this->get('session')->getFlashBag()->add(
                        'info', $translator->trans('client.borrowing.resource.connect', array('%resource%' => $resource->getDescription()))
                );

                $request = $this->getRequest();
                $session = $request->getSession();

                if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                    $error = $request->attributes->get(
                            SecurityContext::AUTHENTICATION_ERROR
                    );
                } else {
                    $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                    $session->remove(SecurityContext::AUTHENTICATION_ERROR);
                }

                return $this->render(
                                'CaesarUserBundle:User:login.html.twig', array(
                            'login_page_title' => $translator->trans('borrow.title'),
                            'resource' => $resource,
                            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                            'error' => $error)
                );
            }
        } else {
            //Plus de ressources disponibles
            $this->get('session')->getFlashBag()->add(
                    'error', $translator->trans('client.borrowing.resource.unavailable', array('%resource%' => $resource->getDescription()))
            );
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
        }
    }

    public function returnAction($code = '') {
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

        $shelf = $resource->getShelf();
        if ($borrowedQuantity == 1) { //if only one borrowed
            $borrowing = $resource->getBorrowings()->first();
            $archivedBorrowing = new BorrowingArchive();
            $archivedBorrowing->setBorrowingDate($borrowing->getBorrowingDate());
            $archivedBorrowing->setResource($borrowing->getResource());
            $archivedBorrowing->setUser($borrowing->getUser());
            $em->remove($borrowing);
            $em->persist($archivedBorrowing);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
            );
            $this->get('session')->getFlashBag()->add(
                    'info', $translator->trans('client.return.shelf', array('%resource%' => $resource->getDescription(),
                        '%shelf_name%' => $shelf->getName(), '%shelf_description%' => $shelf->getDescription()))
            );

            $this->notify($resource, $q - $borrowedQuantity);

            return $this->redirect($this->generateUrl('caesar_client_homepage'));
        } else if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->get('request');

            //retourer à la place de
            /* $form = $this->createForm(new ReturnAsType($resource));
              if ($request->isMethod('POST')) {
              $form->bind($request);
              if ($form->isValid()) {

              $data = $form->getData();
              $user = $data['user'];
              }
              } */
            $borrowing = $em->getRepository('CaesarUserBundle:Borrowing')->findOneByUser($user);

            if ($borrowing != null) { //je suis ou je remplace un emprunteur Rendre
                $archivedBorrowing = new BorrowingArchive();
                $archivedBorrowing->setBorrowingDate($borrowing->getBorrowingDate());
                $archivedBorrowing->setResource($borrowing->getResource());
                $archivedBorrowing->setUser($borrowing->getUser());
                $em->remove($borrowing);
                $em->persist($archivedBorrowing);
                $em->flush();

                $this->notify($resource, $q - $borrowedQuantity + 1);

                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('client.return.accepted', array('%resource%' => $resource->getDescription()))
                );
                $this->get('session')->getFlashBag()->add(
                        'info', $translator->trans('client.return.shelf', array('%resource%' => $resource->getDescription(),
                            '%shelf_name%' => $shelf->getName(), '%shelf_description%' => $shelf->getDescription()))
                );
                return $this->redirect($this->generateUrl('caesar_client_homepage'));
            } else { //message
                $this->get('session')->getFlashBag()->add(
                        'info', $translator->trans('client.return.refused', array('%resource%' => $resource->getDescription()))
                );
                /* $count = count($resource->getBorrowings());

                  return $this->render(
                  'CaesarResourceBundle:Resource:returnInsteadOf.html.twig', array(
                  'count' => $count, 'form' => $form->createView(), 'code' => $code)
                  ); */
                return $this->redirect($this->generateUrl('caesar_client_homepage'));
            }
        } else { //connexion
            $this->get('session')->getFlashBag()->add(
                    'info', $translator->trans('client.return.connect', array('%resource%' => $resource->getDescription()))
            );

            $request = $this->getRequest();
            $session = $request->getSession();

            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(
                        SecurityContext::AUTHENTICATION_ERROR
                );
            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }

            return $this->render(
                            'CaesarUserBundle:User:login.html.twig', array(
                        'login_page_title' => $translator->trans('return.title'),
                        'resource' => $resource,
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                        'error' => $error)
            );
        }
    }

    public function blockingReservationsAction($page, $resource = -1, $user = null) {
        $nb_per_page = 10;
        $em = $this->getDoctrine()->getManager();

        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $request = $this->get('request');
        if ($user != null) {
            $user = $em->getRepository('CaesarUserBundle:User')->findOneById($user);
        }

        $reservations = $repository_reservation->getPreviousReservations($page, $resource, $user);
        $count = $repository_reservation->countPreviousReservations($resource, $user);
        /* Pagination */
        $pagination = array(
            'cur' => $page,
            'max' => floor($count / $nb_per_page),
        );

        $array = array(
            'reservations' => $reservations,
            'page' => $page,
            'count' => $count,
            'pagination' => $pagination);

        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarResourceBundle:Resource:reservationList.html.twig", $array);
        }
        return $this->render("CaesarResourceBundle:Resource:reservations.html.twig", $array);
    }

    private function notify($resource, $availableReservations) {
        $userToNotify = array();
        $i = 0;
        $array = $resource->getReservations()->toArray();
        $sizeOfArray = count($array);
        while ($i < $availableReservations && $i < $sizeOfArray) {
            array_push($userToNotify, $array[$i]->getUser());
            $i++;
        }

        $to = array();

        foreach ($userToNotify as $u) {
            array_push($to, $u->getEmail());
        }
        $translator = $this->get('translator');
        $subject = $translator->trans('resource.reservation.available', array('%date%' => date('d/m/T H:i:s')));
        $body = $this->renderView(
                        'CaesarResourceBundle:Resource:mail.html.twig', array('resource' => $resource));
        $this->sendMail($to, 'noreply@caesar.com', $body, $subject);
       
    }

    public function sendMail($to, $from, $response, $subject) {
        $transport = Swift_SmtpTransport::newInstance();
        $message = Swift_Message::newInstance($transport)
                ->setSubject($subject)
                ->setFrom($from)
                ->setTo($to)
                ->setBody($response, 'text/html');
        $message->setEncoder(Swift_Encoding::get64BitEncoding());
        $this->get('mailer')->send($message);
    }

    public function subscribeAction($code = '') {
        $translator = $this->get('translator');
        $em = $this->getDoctrine()->getManager();
        if (Resource::isCAeSARCode($code) || Resource::checkISBN($code)) {
            $resource = $em->getRepository('CaesarResourceBundle:Resource')
                    ->findOneByCode($code);
        } else {
            throw $this->createNotFoundException($translator->trans('client.subscription.exception', array('%code%' => $code)));
        }
        if (!$resource) {
            throw $this->createNotFoundException($translator->trans('client.subscription.exception', array('%code%' => $code)));
        }

        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            //TODO test if has already subscribed to the resource
            $user = $this->get('security.context')->getToken()->getUser();
            $subscription = new Subscription();
            $subscription->setResource($resource);
            $subscription->setUser($user);
            $em->persist($subscription);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', $translator->trans('client.subscription.resource.subscribed', array('%resource%' => $resource->getDescription()))
            );
            return $this->redirect($this->generateUrl('caesar_resource_homepage', array('code' => $code)));
        } else {//Je dois me connecter
            $this->get('session')->getFlashBag()->add(
                    'info', $translator->trans('client.subscription.resource.connect', array('%resource%' => $resource->getDescription()))
            );

            $request = $this->getRequest();
            $session = $request->getSession();

            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(
                        SecurityContext::AUTHENTICATION_ERROR
                );
            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }

            return $this->render(
                            'CaesarUserBundle:User:login.html.twig', array(
                        'login_page_title' => $translator->trans('subscription.title'),
                        'resource' => $resource,
                        'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                        'error' => $error)
            );
        }
    }

}
