<?php

/* CaesarAdminBundle:Admin:index.html.twig */
class __TwigTemplate_af54e23aea595da3e5b786ca938fe77b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("CaesarAdminBundle::layout.html.twig");

        $this->blocks = array(
            'contentTitle' => array($this, 'block_contentTitle'),
            'contentBody' => array($this, 'block_contentBody'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "CaesarAdminBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_contentTitle($context, array $blocks = array())
    {
    }

    // line 6
    public function block_contentBody($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "CaesarAdminBundle:Admin:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 6,  29 => 3,);
    }
}
