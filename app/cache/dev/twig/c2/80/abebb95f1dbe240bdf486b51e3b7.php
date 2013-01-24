<?php

/* CaesarAdminBundle:User:add.html.twig */
class __TwigTemplate_c280abebb95f1dbe240bdf486b51e3b7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("CaesarAdminBundle::layout.html.twig");

        $this->blocks = array(
            'breadCrumb' => array($this, 'block_breadCrumb'),
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
    public function block_breadCrumb($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("breadCrumb", $context, $blocks);
        echo "
    <li data-header=\"1\">
        <a href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_user_homepage"), "html", null, true);
        echo "\">Utilisateurs</a>
        <span class=\"divider\">></span>
    </li>
    <li class=\"active\"><span>Ajout</span></li>
";
    }

    // line 12
    public function block_contentTitle($context, array $blocks = array())
    {
        // line 13
        echo "Ajouter un utilisateur
";
    }

    // line 16
    public function block_contentBody($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "CaesarAdminBundle:User:add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 16,  51 => 13,  48 => 12,  39 => 6,  33 => 4,  30 => 3,);
    }
}
