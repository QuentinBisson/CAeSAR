<?php

/* CaesarAdminBundle::layout.html.twig */
class __TwigTemplate_d7355213111ec949108bcbfd72a920ce extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::admin.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'contentTitle' => array($this, 'block_contentTitle'),
            'contentBody' => array($this, 'block_contentBody'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/caesaradmin/css/layout.css"), "html", null, true);
        echo "\" />
";
    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        // line 7
        echo "
";
        // line 8
        $this->displayBlock('menu', $context, $blocks);
        // line 41
        echo "
";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 46
        echo "
";
    }

    // line 8
    public function block_menu($context, array $blocks = array())
    {
        // line 9
        echo "<aside class=\"sidebar\">
    <nav>
        <ul id=\"accordion\">
            <li><a href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">Ressources</a>
                <ul>
                <li><a href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_add"), "html", null, true);
        echo "\">Ajouter</a></li>
                </ul>
            </li>
            <li><a href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">Utilisateurs</a>
                <ul>
                   ";
        // line 20
        echo "                </ul>
            </li>
            <li><a href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">Emplacements</a>
                <ul>
                    ";
        // line 25
        echo "                </ul>
            </li>
            <li><a href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">Emprunts</a>
                <ul>
                    ";
        // line 30
        echo "                </ul>
            </li>
            <li><a href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_homepage"), "html", null, true);
        echo "\">Etiquettes</a>
                <ul>
                    ";
        // line 35
        echo "                </ul>
            </li>
        </ul>
    </nav>
</aside>
";
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        // line 43
        echo "<h2>";
        $this->displayBlock('contentTitle', $context, $blocks);
        echo "</h2>
";
        // line 44
        $this->displayBlock('contentBody', $context, $blocks);
    }

    // line 43
    public function block_contentTitle($context, array $blocks = array())
    {
    }

    // line 44
    public function block_contentBody($context, array $blocks = array())
    {
    }

    // line 50
    public function block_javascripts($context, array $blocks = array())
    {
        // line 51
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
<script type=\"text/javascript\">
  \$(document).ready(function() {
                \$( \"#accordion\" ).accordion({
                    heightStyle: \"content\",
                    autoHeight: false,
                    navigation: true
                });
            });
</script>
";
    }

    public function getTemplateName()
    {
        return "CaesarAdminBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 25,  90 => 20,  69 => 9,  56 => 41,  37 => 3,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 81,  251 => 80,  246 => 78,  240 => 77,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  131 => 51,  128 => 50,  125 => 44,  107 => 36,  38 => 6,  155 => 58,  144 => 53,  141 => 51,  139 => 55,  135 => 47,  126 => 42,  109 => 41,  103 => 27,  101 => 32,  70 => 20,  67 => 15,  61 => 46,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  163 => 59,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 45,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 21,  75 => 23,  71 => 19,  63 => 24,  34 => 2,  28 => 3,  105 => 24,  96 => 21,  93 => 28,  83 => 18,  76 => 16,  72 => 14,  68 => 12,  58 => 22,  50 => 10,  27 => 4,  24 => 3,  94 => 22,  88 => 6,  79 => 14,  59 => 42,  43 => 6,  32 => 4,  29 => 3,  91 => 20,  84 => 28,  74 => 12,  66 => 8,  55 => 15,  44 => 12,  41 => 15,  31 => 5,  21 => 2,  25 => 3,  46 => 7,  35 => 5,  26 => 6,  22 => 2,  19 => 1,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 35,  111 => 37,  108 => 30,  102 => 30,  98 => 31,  95 => 34,  92 => 33,  89 => 19,  85 => 17,  81 => 40,  73 => 19,  64 => 17,  60 => 23,  57 => 11,  54 => 8,  51 => 7,  48 => 6,  45 => 8,  42 => 4,  39 => 9,  36 => 5,  33 => 4,  30 => 7,);
    }
}
