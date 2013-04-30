<?php

namespace Caesar\UserBundle\Controller;

use Caesar\ResourceBundle\Form\ResourceSearchType;
use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\PasswordType;
use Caesar\UserBundle\Form\UserHandler;
use Caesar\UserBundle\Form\UserType;
use Caesar\UserBundle\Form\UserUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller {

    public function indexAction() {
        $_locale = substr($this->get('request')->getPreferredLanguage(), 0, 2);
        if ($_locale != 'en' && $_locale != 'fr') {
            $_locale = 'en';
        }
        return $this->redirect($this->generateUrl('caesar_client_homepage', array('_locale' => $_locale)));
    }

    public function homeAction() {
        return $this->render('CaesarUserBundle:User:index.html.twig');
    }

    public function searchAction($page = 1, $sort = 'code', $direction = 'asc') {
        $nb_per_page = 10; // Nombre d'éléments affichés par page (pour la pagination)
        $searchForm = $this->createForm(new ResourceSearchType());
        $keywords = null;
        $em = $this->getDoctrine()->getManager();

        $repository_resource = $em->getRepository('CaesarResourceBundle:Resource');

        $request = $this->get('request');
        if ($request->isMethod('POST')) {
            $searchForm->bind($request);
            if ($searchForm->isValid()) {
                $data = $searchForm->getData();
                $keywords = $data['keywords'];
            }
        }
        if (!empty($keywords)) {
            $keywords = explode(" ", $keywords);
        }

        $resources = $repository_resource->getResourceFromToSortBy($page, $sort, $direction, $keywords);
        $count = $repository_resource->count($keywords);

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'resources' => $resources,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarUserBundle:User:resourcesSearchList.html.twig", $array);
        }

        $array['searchForm'] = $searchForm->createView();

        return $this->render('CaesarUserBundle:User:search.html.twig', $array);
    }

    public function loginAction() {
        $request = $this->getRequest();
        $translator = $this->get('translator');
        $session = $request->getSession();

        $security = $this->get('security.context');

        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            if ($security->isGranted('ROLE_ADMIN')) {
                return $this->redirect($this->generateUrl('caesar_admin_homepage'));
            } elseif ($security->isGranted('ROLE_USER_IDENTIFIED') || $security->isGranted('ROLE_USER_AUTHENTIFIED')) {
                return $this->redirect($this->generateUrl('caesar_client_homepage'));
            }
        }

        // get the login error if there is one
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
                    'login_page_title' => $translator->trans('user.login.title', array(), 'CaesarUserBundle'),
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                        )
        );
    }

    public function modifyProfileAction() {
        $translator = $this->get('translator');
        $security = $this->get('security.context');
        $user = $security->getToken()->getUser();
        if ($security->isGranted('ROLE_USER_AUTHENTIFIED')) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository('CaesarUserBundle:User');
            $u = $repo->loadUserByUsername($user->getUsername());
            $form = $this->createForm(new UserUpdateType(), $u);
            $request = $this->get('request');
            if ($request->isMethod('POST')) {
                $form->bind($request);
                if ($form->isValid()) {
                    $u = $form->getData();
                    $password = $u->getPassword();
                    if (!empty($password)) {
                        $plainPassword = $u->getPlainPassword();
                        if (!empty($plainPassword)) {
                            $encoder = $this->get('security.encoder_factory')->getEncoder($u);
                            $u->setPassword($encoder->encodePassword($plainPassword, $u->getSalt()));
                        }
                    }
                    $em->flush();

                    $u->setAuthentified(true);
                    $u->setIdentified(true);
                    $token = new UsernamePasswordToken(
                            $u->getUsername(), $u->getPassword(), "caesar", $u->getRoles());
                    $token->setUser($u);
                    $this->get('security.context')->setToken($token);
                    $token->setAuthenticated(false);
                    $this->get('session')->setFlash('notice', $translator->trans('user.update_profile.successfull', array(), 'CaesarUserBundle'));
                    return $this->redirect($this->generateUrl('caesar_client_profile'));
                }
            }
            return $this->render('CaesarUserBundle:User:modifyProfile.html.twig', array('form' => $form->createView()));
        }
        $this->get('session')->set('authenticate_referer_url', $this->get('request')->getUri());
        return $this->redirect($this->generateUrl('caesar_client_authenticate'));
    }

    private function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }

    public function authenticateAction() {
        $translator = $this->get('translator');
        $user = $this->get('security.context')->getToken()->getUser();
        $form = $this->createForm(new PasswordType());
        $request = $this->get('request');
        $security = $this->get('security.context');
        $session = $request->getSession();
        $url = $session->get('authenticate_referer_url');
        if ($security->isGranted('ROLE_USER_AUTHENTIFIED')) {
            return new RedirectResponse($url);
        }
        if ($request->isMethod('POST')) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encoded = $encoder->encodePassword($data['plainPassword'], $user->getSalt());
                if ($encoded === $user->getPassword()) {
                    $user->setAuthentified(true);
                    $user->setIdentified(true);
                    $token = new UsernamePasswordToken(
                            $user->getUsername(), $encoded, "caesar", $user->getRoles());
                    $token->setUser($user);
                    $this->get('security.context')->setToken($token);
                    $token->setAuthenticated(false);
                    return new RedirectResponse($url);
                } else {
                    $this->get('session')->getFlashBag()->add(
                            'error', $translator->trans('fail.password', array(), 'CaesarUserBundle')
                    );
                }
            }
        }
        return $this->render('CaesarUserBundle:User:authenticate.html.twig', array('form' => $form->createView(),
                    'authenticate_page_title' => $translator->trans('user.authenticate.title', array(), 'CaesarUserBundle')));
    }

    public function registerAction() {
        $user = new User();
        $translator = $this->get('translator');
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $this->get('doctrine')->getEntityManager(), $this->get('security.encoder_factory')->getEncoder($user));
        if ($formHandler->process()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $repository_user = $em->getRepository('CaesarUserBundle:User');
            $u = $repository_user->loadUserByUsername($data->getUsername());
            $u->setIdentified(true);
            $token = new UsernamePasswordToken(
                    $u->getUsername(), '', "caesar", $u->getRoles());
            $this->get('security.context')->setToken($token);
            $token->setAuthenticated(false);
            $this->get('session')->setFlash('notice', $translator->trans('user.register.successfull', array(), 'CaesarUserBundle'));
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
        }
        return $this->render('CaesarUserBundle:User:register.html.twig', array('form' => $form->createView()));
    }

    public function profileAction() {
        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('CaesarUserBundle:User:profile.html.twig', array('user' => $user));
    }

    public function borrowingAction($page, $sort, $direction) {
        $nb_per_page = 10;
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $repository_borrowing = $em->getRepository('CaesarUserBundle:Borrowing');

        $borrowings = $repository_borrowing->getAllBorrowingsFromToSortBy($page, $sort, $direction, $user);
        $repository_archived_borrowing = $em->getRepository('CaesarUserBundle:BorrowingArchive');

        $c1 = $repository_borrowing->count($user);
        $c2 = $repository_archived_borrowing->count($user);
        $count = $c1 + $c2;

        /* Pagination */
        $total = $count;
        $pagination = array(
            'cur' => $page,
            'max' => floor($total / $nb_per_page),
        );

        $array = array(
            'borrowings' => $borrowings,
            'page' => $page,
            'sort' => $sort,
            'direction' => $direction,
            'count' => $count,
            'pagination' => $pagination);

        $request = $this->get('request');
        if ($request->isXmlHttpRequest()) {
            return $this->render("CaesarUserBundle:User:borrowingList.html.twig", $array);
        }

        return $this->render("CaesarUserBundle:User:borrowing.html.twig", $array);
    }

    public function reservationAction($page, $sort, $direction) {
        $nb_per_page = 10;
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $repository_reservation = $em->getRepository('CaesarUserBundle:Reservation');

        $reservations = $repository_reservation->getReservationsFromToSortBy($page, $sort, $direction, $user);

        $count = $repository_reservation->count($user);

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
            return $this->render("CaesarUserBundle:User:reservationList.html.twig", $array);
        }

        return $this->render("CaesarUserBundle:User:reservation.html.twig", $array);
    }

    public function cancelReservationAction($id) {
        $translator = $this->get('translator');
        if (filter_input(INPUT_GET, $id, FILTER_VALIDATE_INT) !== false) {
            $clean = $id;
        } else {
            throw $this->createNotFoundException($translator->trans('client.reservations.exception', array('%reservation%' => $id)));
        }

        $em = $this->getDoctrine()->getManager();
        if (isset($clean)) {
            $reservation = $em->getRepository('CaesarUserBundle:Reservation')
                    ->find($clean);
        }

        if (!$reservation) {
            throw $this->createNotFoundException($translator->trans('client.reservations.exception', array('%reservation%' => $id)));
        }
        $em->remove($reservation);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
                'notice', $translator->trans('client.reservations.notice.cancel', array('%reservation%' => $reservation->getId()))
        );

        return $this->redirect($this->generateUrl('caesar_client_reservation'));
    }

}
