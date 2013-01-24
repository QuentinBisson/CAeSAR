<?php

/* ::admin.html.twig */
class __TwigTemplate_a139d645ac669e2267f37f849763d626 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'breadCrumb' => array($this, 'block_breadCrumb'),
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 10
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <header class=\"header\">
                    
            <section class=\"left\">
            <ul id=\"breadcrumb\" class=\"breadcrumb\">
                ";
        // line 17
        $this->displayBlock('breadCrumb', $context, $blocks);
        // line 24
        echo "            </ul>
            </section>
                    
            <section class=\"right\">
                <a class=\"link-button-deconnexion\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_logout"), "html", null, true);
        echo "\">Deconnexion</a>
            </section>
        </header>
        
        ";
        // line 32
        $this->displayBlock('menu', $context, $blocks);
        // line 33
        echo "            
        <section>";
        // line 34
        $this->displayBlock('content', $context, $blocks);
        echo "</section>
        ";
        // line 35
        $this->displayBlock('javascripts', $context, $blocks);
        // line 39
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 7
        echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/main.css"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/icons.css"), "html", null, true);
        echo "\" />
        ";
    }

    // line 17
    public function block_breadCrumb($context, array $blocks = array())
    {
        // line 18
        echo "                    <li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">
                            <i class=\"icon-home\"></i>
                        </a>
                        <span class=\"divider\">></span>
                    </li>
                ";
    }

    // line 32
    public function block_menu($context, array $blocks = array())
    {
    }

    // line 34
    public function block_content($context, array $blocks = array())
    {
    }

    // line 35
    public function block_javascripts($context, array $blocks = array())
    {
        // line 36
        echo "        <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-1.9.0.min.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-ui-1.10.0.custom.min.js"), "html", null, true);
        echo "\" ></script>
        ";
    }

    public function getTemplateName()
    {
        return "::admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 37,  127 => 36,  124 => 35,  119 => 34,  114 => 32,  103 => 18,  100 => 17,  94 => 8,  89 => 7,  86 => 6,  80 => 5,  74 => 39,  72 => 35,  68 => 34,  65 => 33,  63 => 32,  56 => 28,  50 => 24,  48 => 17,  37 => 10,  35 => 6,  31 => 5,  25 => 1,);
    }
}
