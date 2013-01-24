<?php

/* WebProfilerBundle:Profiler:header.html.twig */
class __TwigTemplate_5964420b72f4fce8e1e27712d05d6346 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"header\" class=\"clear_fix\">
    <h1>
        <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/logo_symfony_profiler.png"), "html", null, true);
        echo "\" alt=\"Symfony profiler\"/>
    </h1>

    <div class=\"search\">
        <form method=\"get\" action=\"http://symfony.com/search\">
            <div class=\"form_row\">
                <label for=\"search_id\">
                    <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/grey_magnifier.png"), "html", null, true);
        echo "\" alt=\"Search on Symfony website\"/>
                </label>

                <input name=\"q\" id=\"search_id\" type=\"search\" placeholder=\"Search on Symfony website\"/>

                <button type=\"submit\">
                    <span class=\"border_l\">
                        <span class=\"border_r\">
                            <span class=\"btn_bg\">OK</span>
                        </span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 17,  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  23 => 3,  62 => 25,  40 => 8,  99 => 47,  97 => 46,  53 => 17,  150 => 30,  129 => 26,  117 => 23,  110 => 22,  82 => 17,  124 => 35,  86 => 27,  65 => 20,  56 => 15,  113 => 35,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 219,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 25,  107 => 36,  38 => 10,  144 => 47,  141 => 51,  135 => 47,  126 => 46,  109 => 33,  103 => 34,  67 => 21,  61 => 18,  47 => 10,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 32,  147 => 55,  132 => 37,  127 => 36,  121 => 43,  118 => 38,  114 => 39,  104 => 30,  100 => 33,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 35,  93 => 44,  76 => 34,  72 => 35,  68 => 34,  58 => 19,  27 => 4,  24 => 3,  94 => 30,  88 => 6,  79 => 25,  59 => 21,  91 => 29,  84 => 27,  44 => 12,  31 => 6,  21 => 2,  25 => 1,  26 => 3,  19 => 1,  70 => 20,  63 => 21,  46 => 14,  22 => 2,  163 => 59,  155 => 58,  152 => 51,  149 => 50,  145 => 46,  139 => 46,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 32,  96 => 21,  83 => 21,  80 => 5,  74 => 25,  66 => 15,  55 => 15,  52 => 18,  50 => 15,  43 => 12,  41 => 12,  37 => 7,  35 => 8,  32 => 6,  29 => 6,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 53,  143 => 54,  138 => 51,  136 => 50,  133 => 27,  130 => 46,  122 => 43,  119 => 34,  116 => 39,  111 => 6,  108 => 36,  102 => 30,  98 => 27,  95 => 34,  92 => 21,  89 => 28,  85 => 25,  81 => 40,  73 => 23,  64 => 14,  60 => 13,  57 => 20,  54 => 19,  51 => 16,  48 => 11,  45 => 13,  42 => 15,  39 => 9,  36 => 7,  33 => 10,  30 => 5,);
    }
}
