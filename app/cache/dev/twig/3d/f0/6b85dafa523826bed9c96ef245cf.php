<?php

/* ::user.html.twig */
class __TwigTemplate_3df06b85dafa523826bed9c96ef245cf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'bodyTitle' => array($this, 'block_bodyTitle'),
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
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        <header>
            <section>
                <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("home"), "html", null, true);
        echo "\">Accueil</a>
                <input type=\"text\" placeholder=\"Mots-clés\"/>
            </section>

            <section>
                <a href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("register"), "html", null, true);
        echo "\">Inscription</a>
                <p>
                    <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("profile"), "html", null, true);
        echo "\">
                        Bonjour
                    </a>
                </p>

                <nav>
                    <ul>
                        <li>
                            Mon profil
                        </li>
                        <li>
                            Mes emprunts
                        </li>
                    </ul>
                </nav>
                <a href=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("register"), "html", null, true);
        echo "\">Connexion</a>
            </section>
        </header>
        <section>
            <header>
                ";
        // line 39
        $this->displayBlock('bodyTitle', $context, $blocks);
        // line 40
        echo "                </header>

                <section>
                ";
        // line 43
        $this->displayBlock('body', $context, $blocks);
        // line 44
        echo "                    </section>
                </section>
        ";
        // line 46
        $this->displayBlock('javascripts', $context, $blocks);
        // line 47
        echo "            </body>
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
    }

    // line 39
    public function block_bodyTitle($context, array $blocks = array())
    {
    }

    // line 43
    public function block_body($context, array $blocks = array())
    {
    }

    // line 46
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::user.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 47,  97 => 46,  53 => 17,  150 => 30,  129 => 26,  117 => 23,  110 => 22,  82 => 17,  124 => 35,  86 => 40,  65 => 33,  56 => 15,  113 => 35,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 25,  107 => 36,  38 => 4,  144 => 47,  141 => 51,  135 => 47,  126 => 46,  109 => 33,  103 => 18,  67 => 15,  61 => 13,  47 => 10,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 32,  147 => 55,  132 => 37,  127 => 36,  121 => 43,  118 => 38,  114 => 32,  104 => 30,  100 => 17,  78 => 21,  75 => 23,  71 => 19,  34 => 6,  28 => 3,  105 => 5,  93 => 44,  76 => 34,  72 => 35,  68 => 34,  58 => 19,  27 => 4,  24 => 1,  94 => 8,  88 => 6,  79 => 20,  59 => 22,  91 => 43,  84 => 39,  44 => 12,  31 => 5,  21 => 2,  25 => 1,  26 => 6,  19 => 1,  70 => 20,  63 => 32,  46 => 7,  22 => 2,  163 => 59,  155 => 58,  152 => 51,  149 => 50,  145 => 46,  139 => 46,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 32,  96 => 21,  83 => 21,  80 => 5,  74 => 16,  66 => 15,  55 => 11,  52 => 15,  50 => 11,  43 => 6,  41 => 8,  37 => 10,  35 => 6,  32 => 3,  29 => 2,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 53,  143 => 54,  138 => 51,  136 => 50,  133 => 27,  130 => 46,  122 => 43,  119 => 34,  116 => 39,  111 => 6,  108 => 37,  102 => 30,  98 => 27,  95 => 34,  92 => 21,  89 => 7,  85 => 25,  81 => 40,  73 => 19,  64 => 14,  60 => 13,  57 => 11,  54 => 13,  51 => 12,  48 => 11,  45 => 12,  42 => 7,  39 => 6,  36 => 7,  33 => 4,  30 => 5,);
    }
}
