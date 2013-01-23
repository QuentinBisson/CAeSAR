<?php

/* WebProfilerBundle:Profiler:toolbar.html.twig */
class __TwigTemplate_e1160cbb0ff8681435653e4e64849361 extends Twig_Template
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
        echo "<!-- START of Symfony2 Web Debug Toolbar -->
";
        // line 2
        if (("normal" != (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")))) {
            // line 3
            echo "    ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_style.html.twig")->display(array_merge($context, array("position" => (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")), "floatable" => true)));
            // line 4
            echo "    <div style=\"clear: both; height: 38px;\"></div>
";
        }
        // line 6
        echo "
<div class=\"sf-toolbarreset\">
    ";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["templates"]) ? $context["templates"] : $this->getContext($context, "templates")));
        foreach ($context['_seq'] as $context["name"] => $context["template"]) {
            // line 9
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "renderblock", array(0 => "toolbar", 1 => array("collector" => $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "getcollector", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))), "method"), "profiler_url" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")), "token" => $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "token"), "name" => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")))), "method"), "html", null, true);
            // line 15
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['template'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 17
        echo "
    ";
        // line 18
        if (("normal" != (isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")))) {
            // line 19
            echo "        <a class=\"hide-button\" title=\"Close Toolbar\" onclick=\"
            var p = this.parentNode;
            p.style.display = 'none';
            (p.previousElementSibling || p.previousSibling).style.display = 'none';
        \"></a>
    ";
        }
        // line 25
        echo "</div>
<!-- END of Symfony2 Web Debug Toolbar -->
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 25,  49 => 17,  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  40 => 8,  97 => 46,  86 => 40,  53 => 17,  23 => 3,  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 15,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 219,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 36,  38 => 4,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 27,  67 => 21,  61 => 18,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 44,  76 => 34,  72 => 5,  68 => 12,  58 => 19,  27 => 4,  24 => 3,  94 => 22,  88 => 23,  79 => 14,  59 => 21,  91 => 43,  84 => 27,  44 => 12,  31 => 6,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 20,  63 => 21,  46 => 14,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 27,  96 => 26,  83 => 18,  80 => 24,  74 => 25,  66 => 29,  55 => 15,  52 => 18,  50 => 15,  43 => 6,  41 => 12,  37 => 7,  35 => 8,  32 => 6,  29 => 6,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 39,  111 => 6,  108 => 30,  102 => 30,  98 => 31,  95 => 34,  92 => 33,  89 => 28,  85 => 17,  81 => 7,  73 => 19,  64 => 25,  60 => 23,  57 => 20,  54 => 19,  51 => 16,  48 => 6,  45 => 13,  42 => 15,  39 => 9,  36 => 7,  33 => 6,  30 => 5,);
    }
}
