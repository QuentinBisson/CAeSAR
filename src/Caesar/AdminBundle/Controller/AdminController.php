<?php

namespace Caesar\AdminBundle\Controller;

use Caesar\AdminBundle\Form\ReservationDeleteType;
use Caesar\UserBundle\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {

    public function indexAction() {
        return $this->render('CaesarAdminBundle:Admin:index.html.twig');
    }

    public function passwordAction() {
        $translator = $this->get('translator');
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new ChangePasswordType());

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();

                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encoded = $encoder->encodePassword($data['currentPassword'], $user->getSalt());
                if ($encoded === $user->getPassword()) {
                    if ($data['newPassword'] === $data['confirmPassword']) {
                        //handle data
                        $newPassword = $encoder->encodePassword($data['newPassword'], $user->getSalt());
                        $em = $this->getDoctrine()->getManager();
                        $userInDB = $em->getRepository('CaesarUserBundle:User')->find($user->getId());
                        $user->setPassword($newPassword);
                        $userInDB->setPassword($newPassword);
                        $em->flush();
                        $this->get('session')->getFlashBag()->add(
                                'notice', $translator->trans('admin.form.users.notice.password.changed')
                        );
                        return $this->redirect($this->generateUrl('caesar_admin_homepage'));
                    } else {
                        $this->get('session')->getFlashBag()->add(
                                'error', $translator->trans('admin.form.users.password.not_same')
                        );
                    }
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'error', $translator->trans('admin.form.users.password.no_match')
                    );
                }
            }
        }

        return $this->render('CaesarAdminBundle:Admin:password.html.twig', array('form' => $form->createView()));
    }

    public function listReservationsAction($page = 1, $sort = 'id', $direction = 'asc') {
        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $em = $this->getDoctrine()->getManager();

        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $reservations = $repository_reservation->getReservationsFromToSortBy($page, $sort, $direction);
        $count = $repository_reservation->count();

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'reservations' => $reservations,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarAdminBundle:Admin:listReservations.html.twig", $array);
        }

        return $this->render("CaesarAdminBundle:Admin:reservations.html.twig", $array);
    }

    public function deleteReservationAction($id) {
        $translator = $this->get('translator');
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException($translator->trans('admin.form.reservations.exception', array('%reservation%' => $id)));
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $reservation = $em->getRepository('CaesarUserBundle:Reservation')
                    ->find($clean);
        }

        if (!$reservation) {
            throw $this->createNotFoundException($translator->trans('admin.form.reservations.exception', array('%reservation%' => $id)));
        }
        $em->remove($reservation);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', $translator->trans('admin.form.reservations.notice.delete', array('%reservation%' => $reservation->getId()))
        );

        return $this->redirect($this->generateUrl('caesar_admin_general_reservation_homepage'));
    }

    public function purgeAction() {
        $translator = $this->get('translator');
        $form = $this->createForm(new ReservationDeleteType());

        $em = $this->getDoctrine()->getManager();
        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $reservations = $repository_reservation->getOldFromToSortBy($data['reservationDate']);
                foreach ($reservations as $r) {
                    $em->remove($r);
                }
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                        'notice', $translator->trans('admin.form.reservations.delete', array("%count%" => count($reservations), "%date%" => $data['reservationDate']->format('d/m/Y')))
                );
            }
        }
        return $this->render('CaesarAdminBundle:Admin:purge.html.twig', array('form' => $form->createView()));
    }

    public function webminingAction() {
        return $this->render('CaesarAdminBundle:Admin:webmining.html.twig');
    }

    public function createBackupAction() {
        return $this->render('CaesarAdminBundle:Admin:createBackup.html.twig');
    }

    public function loadBackupAction() {
        return $this->render('CaesarAdminBundle:Admin:loadBackup.html.twig');
    }

}