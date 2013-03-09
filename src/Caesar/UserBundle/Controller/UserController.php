<?php

namespace Caesar\UserBundle\Controller;

use Caesar\ResourceBundle\Form\ResourceSearchType;
use Caesar\UserBundle\Entity\User;
use Caesar\UserBundle\Form\UserHandler;
use Caesar\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller {

    public function indexAction() {
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
        $count = $repository_resource->count();

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
        $session = $request->getSession();
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
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error' => $error,
                        )
        );
    }

    public function registerAction() {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $this->get('doctrine')->getEntityManager(), $this->get('security.encoder_factory')->getEncoder($user));
        if ($formHandler->process()) {
            $this->get('session')->setFlash('success', 'Inscription réussie');
            return $this->redirect($this->generateUrl('caesar_client_homepage'));
        }
        return $this->render('CaesarUserBundle:User:register.html.twig', array('form' => $form->createView()));
    }

    public function profileAction() {
        return $this->render('CaesarUserBundle:User:profile.html.twig');
    }

}
