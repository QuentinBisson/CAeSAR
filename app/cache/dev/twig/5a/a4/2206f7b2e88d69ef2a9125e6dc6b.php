<?php

/* WebProfilerBundle:Profiler:toolbar_redirect.html.twig */
class __TwigTemplate_5aa42206f7b2e88d69ef2a9125e6dc6b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Redirection Intercepted";
    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"sf-exceptionreset\">
        <div class=\"block_exception\">
            <h1>This request redirects to <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), "html", null, true);
        echo "</a>.</h1>

            <p>
                <small>
                    The redirect was intercepted by the web debug toolbar to help debugging.
                    For more information, see the \"intercept-redirects\" option of the Profiler.
                </small>
            </p>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar_redirect.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 18,  62 => 25,  49 => 17,  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  40 => 8,  97 => 46,  86 => 40,  53 => 38,  23 => 3,  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 39,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 219,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 36,  38 => 6,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 27,  67 => 12,  61 => 18,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 44,  76 => 34,  72 => 5,  68 => 12,  58 => 19,  27 => 4,  24 => 3,  94 => 22,  88 => 23,  79 => 14,  59 => 21,  91 => 28,  84 => 23,  44 => 11,  31 => 6,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 13,  63 => 21,  46 => 34,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 33,  96 => 26,  83 => 18,  80 => 24,  74 => 25,  66 => 29,  55 => 15,  52 => 18,  50 => 15,  43 => 6,  41 => 12,  37 => 6,  35 => 5,  32 => 4,  29 => 3,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 39,  111 => 6,  108 => 30,  102 => 30,  98 => 31,  95 => 30,  92 => 33,  89 => 28,  85 => 17,  81 => 7,  73 => 19,  64 => 11,  60 => 23,  57 => 20,  54 => 19,  51 => 37,  48 => 6,  45 => 13,  42 => 8,  39 => 9,  36 => 7,  33 => 10,  30 => 5,);
    }
}
