<?php

/* CaesarAdminBundle:Resource:update.html.twig */
class __TwigTemplate_b6f8c5fcfdcc1b9e31777c3b793471a8 extends Twig_Template
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

    // line 4
    public function block_breadCrumb($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayParentBlock("breadCrumb", $context, $blocks);
        echo "
    <li data-header=\"0\">
        <a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_homepage"), "html", null, true);
        echo "\">Ressources</a>
        <span class=\"divider\">></span>
    </li>
    <li class=\"active\"><span>Mise à jour</span></li>
";
    }

    // line 13
    public function block_contentTitle($context, array $blocks = array())
    {
        // line 14
        echo "Modifier une ressource
";
    }

    // line 17
    public function block_contentBody($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "CaesarAdminBundle:Resource:update.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 35,  86 => 6,  65 => 33,  56 => 17,  113 => 35,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 36,  38 => 6,  144 => 47,  141 => 51,  135 => 47,  126 => 45,  109 => 33,  103 => 18,  67 => 15,  61 => 13,  47 => 7,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 59,  147 => 55,  132 => 37,  127 => 36,  121 => 45,  118 => 38,  114 => 32,  104 => 30,  100 => 17,  78 => 21,  75 => 23,  71 => 19,  34 => 11,  28 => 3,  105 => 24,  93 => 28,  76 => 16,  72 => 35,  68 => 34,  58 => 22,  27 => 4,  24 => 3,  94 => 8,  88 => 6,  79 => 20,  59 => 22,  91 => 20,  84 => 28,  44 => 12,  31 => 5,  21 => 2,  25 => 1,  26 => 6,  19 => 1,  70 => 20,  63 => 32,  46 => 7,  22 => 2,  163 => 59,  155 => 58,  152 => 51,  149 => 50,  145 => 46,  139 => 46,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 32,  96 => 21,  83 => 21,  80 => 5,  74 => 39,  66 => 15,  55 => 11,  52 => 15,  50 => 24,  43 => 6,  41 => 4,  37 => 10,  35 => 6,  32 => 4,  29 => 3,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 53,  143 => 54,  138 => 51,  136 => 50,  133 => 43,  130 => 46,  122 => 43,  119 => 34,  116 => 35,  111 => 37,  108 => 37,  102 => 30,  98 => 27,  95 => 34,  92 => 33,  89 => 7,  85 => 25,  81 => 40,  73 => 19,  64 => 14,  60 => 13,  57 => 11,  54 => 10,  51 => 14,  48 => 13,  45 => 8,  42 => 7,  39 => 7,  36 => 3,  33 => 5,  30 => 4,);
    }
}
