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
            'body' => array($this, 'block_body'),
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
        // line 9
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <header class=\"header\">
                    
            <section class=\"left\">
            <h1><a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("admin/"), "html", null, true);
        echo "\">Administration</a></h1>
            </section>
                    
            <section class=\"right\">
                <a class=\"link-button-deconnexion\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("logout"), "html", null, true);
        echo "\">Deconnexion</a>
            </section>
        </header>
        <section class=\"content\">
            ";
        // line 23
        $this->displayBlock('body', $context, $blocks);
        // line 24
        echo "        </section>
        ";
        // line 25
        $this->displayBlock('javascripts', $context, $blocks);
        // line 29
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
        ";
    }

    // line 23
    public function block_body($context, array $blocks = array())
    {
    }

    // line 25
    public function block_javascripts($context, array $blocks = array())
    {
        // line 26
        echo "        <script language=\"JavaScript\" type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-1.9.0.min.js"), "html", null, true);
        echo "\"></script>
        <script language=\"JavaScript\" type=\"text/javascript\" src=\"";
        // line 27
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
        return array (  52 => 19,  23 => 1,  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 25,  90 => 20,  69 => 9,  56 => 41,  37 => 3,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  131 => 51,  128 => 50,  125 => 44,  107 => 36,  38 => 6,  155 => 58,  144 => 53,  141 => 51,  139 => 55,  135 => 47,  126 => 42,  109 => 41,  103 => 27,  101 => 27,  70 => 20,  67 => 15,  61 => 24,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  163 => 59,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 45,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 6,  75 => 23,  71 => 19,  63 => 24,  34 => 2,  28 => 3,  105 => 24,  96 => 26,  93 => 25,  83 => 18,  76 => 16,  72 => 5,  68 => 12,  58 => 22,  50 => 10,  27 => 4,  24 => 3,  94 => 22,  88 => 23,  79 => 14,  59 => 23,  43 => 6,  32 => 4,  29 => 5,  91 => 20,  84 => 28,  74 => 12,  66 => 29,  55 => 15,  44 => 12,  41 => 15,  31 => 5,  21 => 2,  25 => 3,  46 => 7,  35 => 9,  26 => 6,  22 => 2,  19 => 1,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 35,  111 => 37,  108 => 30,  102 => 30,  98 => 31,  95 => 34,  92 => 33,  89 => 19,  85 => 17,  81 => 7,  73 => 19,  64 => 25,  60 => 23,  57 => 11,  54 => 8,  51 => 7,  48 => 6,  45 => 15,  42 => 4,  39 => 9,  36 => 5,  33 => 6,  30 => 7,);
    }
}
