<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // caesar_web_mining_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\WebMiningBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'caesar_web_mining_homepage'));
        }

        // caesar_location_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\LocationBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'caesar_location_homepage'));
        }

        // caesar_tag_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\TagBundle\\Controller\\DefaultController::indexAction',)), array('_route' => 'caesar_tag_homepage'));
        }

        if (0 === strpos($pathinfo, '/admin')) {
            // caesar_admin_homepage
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'caesar_admin_homepage');
                }

                return array (  '_controller' => 'Caesar\\AdminBundle\\Controller\\AdminController::indexAction',  '_route' => 'caesar_admin_homepage',);
            }

            // caesar_resource_homepage
            if (0 === strpos($pathinfo, '/admin/resource') && preg_match('#^/admin/resource(?:/(?P<page>\\d+))?$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::listAction',  'page' => '1',)), array('_route' => 'caesar_resource_homepage'));
            }

            // caesar_resource_add
            if ($pathinfo === '/admin/resource/add') {
                return array (  '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::addAction',  '_route' => 'caesar_resource_add',);
            }

            // caesar_resource_update
            if (0 === strpos($pathinfo, '/admin/resource/update') && preg_match('#^/admin/resource/update/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::updateAction',)), array('_route' => 'caesar_resource_update'));
            }

            // caesar_resource_delete
            if (0 === strpos($pathinfo, '/admin/resource/delete') && preg_match('#^/admin/resource/delete/(?P<id>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::deleteAction',)), array('_route' => 'caesar_resource_delete'));
            }

        }

        // caesar_client_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'caesar_client_homepage');
            }

            return array (  '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::indexAction',  '_route' => 'caesar_client_homepage',);
        }

        // caesar_client_login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::loginAction',  '_route' => 'caesar_client_login',);
        }

        // caesar_client_register
        if ($pathinfo === '/register') {
            return array (  '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::registerAction',  '_route' => 'caesar_client_register',);
        }

        // caesar_client_profile
        if ($pathinfo === '/profile') {
            return array (  '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::profileAction',  '_route' => 'caesar_client_profile',);
        }

        // caesar_client_resetting
        if ($pathinfo === '/resetting') {
            return array (  '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::resettingAction',  '_route' => 'caesar_client_resetting',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
