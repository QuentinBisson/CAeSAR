<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * appprodUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        'caesar_web_mining_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'Caesar\\WebMiningBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),),
        'caesar_location_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'Caesar\\LocationBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),),
        'caesar_tag_homepage' => array (  0 =>   array (    0 => 'name',  ),  1 =>   array (    '_controller' => 'Caesar\\TagBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'name',    ),    1 =>     array (      0 => 'text',      1 => '/hello',    ),  ),),
        'caesar_admin_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\AdminBundle\\Controller\\AdminController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/',    ),  ),),
        'caesar_resource_homepage' => array (  0 =>   array (    0 => 'page',  ),  1 =>   array (    '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::listAction',    'page' => '1',  ),  2 =>   array (    'page' => '\\d+',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '\\d+',      3 => 'page',    ),    1 =>     array (      0 => 'text',      1 => '/admin/resource',    ),  ),),
        'caesar_resource_add' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::addAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/admin/resource/add',    ),  ),),
        'caesar_resource_update' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::updateAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/admin/resource/update',    ),  ),),
        'caesar_resource_delete' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Caesar\\AdminBundle\\Controller\\ResourceController::deleteAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]+',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/admin/resource/delete',    ),  ),),
        'caesar_client_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),),
        'caesar_client_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),),
        'caesar_client_register' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::registerAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/register',    ),  ),),
        'caesar_client_profile' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::profileAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/profile',    ),  ),),
        'caesar_client_resetting' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Caesar\\UserBundle\\Controller\\UserController::resettingAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/resetting',    ),  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }
}
