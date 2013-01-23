<?php

/* WebProfilerBundle:Collector:router.html.twig */
class __TwigTemplate_f4218eb18ff811d6ae1a5198579e4e63 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
    }

    // line 6
    public function block_menu($context, array $blocks = array())
    {
        // line 7
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/routing.png"), "html", null, true);
        echo "\" alt=\"Routing\" /></span>
    <strong>Routing</strong>
</span>
";
    }

    // line 13
    public function block_panel($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Router:panel", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token"))), array());
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  356 => 163,  347 => 160,  343 => 159,  335 => 157,  323 => 149,  316 => 145,  309 => 141,  302 => 137,  288 => 129,  281 => 125,  274 => 121,  259 => 109,  217 => 83,  214 => 82,  211 => 81,  206 => 78,  203 => 77,  192 => 72,  182 => 69,  158 => 56,  113 => 40,  204 => 71,  185 => 68,  167 => 64,  164 => 63,  110 => 39,  87 => 34,  388 => 160,  385 => 159,  379 => 158,  377 => 157,  370 => 156,  366 => 155,  362 => 153,  360 => 152,  357 => 151,  352 => 149,  344 => 147,  342 => 146,  339 => 145,  333 => 156,  330 => 140,  327 => 139,  325 => 150,  320 => 135,  314 => 131,  306 => 128,  301 => 125,  295 => 133,  292 => 120,  289 => 119,  287 => 118,  280 => 114,  275 => 111,  273 => 110,  268 => 107,  264 => 105,  258 => 103,  254 => 101,  252 => 105,  247 => 97,  245 => 101,  231 => 88,  226 => 86,  221 => 83,  215 => 79,  209 => 77,  202 => 73,  193 => 68,  190 => 67,  188 => 69,  183 => 63,  177 => 59,  174 => 67,  169 => 56,  140 => 49,  82 => 19,  77 => 18,  62 => 25,  49 => 13,  276 => 248,  262 => 236,  260 => 235,  238 => 97,  20 => 1,  40 => 8,  97 => 23,  86 => 28,  53 => 38,  23 => 3,  148 => 52,  134 => 54,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 20,  56 => 39,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 150,  340 => 158,  336 => 103,  321 => 101,  313 => 99,  311 => 130,  308 => 129,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 115,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 93,  234 => 89,  228 => 89,  223 => 71,  219 => 70,  213 => 69,  207 => 76,  198 => 74,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 45,  125 => 44,  107 => 27,  38 => 7,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 25,  67 => 23,  61 => 12,  47 => 8,  225 => 88,  216 => 90,  212 => 78,  205 => 84,  201 => 83,  196 => 69,  194 => 79,  191 => 70,  189 => 77,  186 => 76,  180 => 72,  172 => 64,  159 => 61,  154 => 54,  147 => 58,  132 => 48,  127 => 52,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 35,  78 => 26,  75 => 23,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 31,  76 => 17,  72 => 22,  68 => 12,  58 => 16,  27 => 3,  24 => 3,  94 => 22,  88 => 20,  79 => 18,  59 => 21,  91 => 35,  84 => 33,  44 => 11,  31 => 6,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 24,  63 => 21,  46 => 12,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 46,  123 => 35,  120 => 50,  115 => 39,  106 => 36,  101 => 33,  96 => 26,  83 => 27,  80 => 32,  74 => 25,  66 => 19,  55 => 9,  52 => 14,  50 => 15,  43 => 6,  41 => 8,  37 => 6,  35 => 6,  32 => 5,  29 => 3,  184 => 70,  178 => 71,  171 => 66,  165 => 60,  162 => 53,  157 => 60,  153 => 62,  151 => 53,  143 => 43,  138 => 55,  136 => 50,  133 => 43,  130 => 53,  122 => 51,  119 => 43,  116 => 41,  111 => 6,  108 => 41,  102 => 30,  98 => 31,  95 => 36,  92 => 21,  89 => 29,  85 => 17,  81 => 7,  73 => 16,  64 => 11,  60 => 16,  57 => 20,  54 => 13,  51 => 12,  48 => 11,  45 => 13,  42 => 8,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
