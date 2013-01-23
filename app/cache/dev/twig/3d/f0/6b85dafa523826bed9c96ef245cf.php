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
        return array (  97 => 46,  86 => 40,  53 => 17,  23 => 1,  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 41,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 36,  38 => 4,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 27,  67 => 15,  61 => 24,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 6,  75 => 23,  71 => 19,  34 => 6,  28 => 3,  105 => 5,  93 => 44,  76 => 34,  72 => 5,  68 => 12,  58 => 19,  27 => 4,  24 => 1,  94 => 22,  88 => 23,  79 => 14,  59 => 23,  91 => 43,  84 => 39,  44 => 12,  31 => 5,  21 => 2,  25 => 3,  26 => 6,  19 => 1,  70 => 20,  63 => 24,  46 => 7,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 27,  96 => 26,  83 => 18,  80 => 24,  74 => 12,  66 => 29,  55 => 15,  52 => 19,  50 => 10,  43 => 6,  41 => 15,  37 => 6,  35 => 5,  32 => 3,  29 => 2,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 39,  111 => 6,  108 => 30,  102 => 30,  98 => 31,  95 => 34,  92 => 33,  89 => 19,  85 => 17,  81 => 7,  73 => 19,  64 => 25,  60 => 23,  57 => 11,  54 => 8,  51 => 7,  48 => 6,  45 => 12,  42 => 4,  39 => 9,  36 => 7,  33 => 6,  30 => 5,);
    }
}
