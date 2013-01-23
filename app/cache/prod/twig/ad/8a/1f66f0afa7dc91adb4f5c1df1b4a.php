<?php

/* TwigBundle:Exception:traces.xml.twig */
class __TwigTemplate_ad8a1f66f0afa7dc91adb4f5c1df1b4a extends Twig_Template
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
        echo "        <traces>
";
        // line 2
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "trace"));
        foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
            // line 3
            echo "            <trace>
";
            // line 4
            $this->env->loadTemplate("TwigBundle:Exception:trace.txt.twig")->display(array("trace" => (isset($context["trace"]) ? $context["trace"] : null)));
            // line 5
            echo "
            </trace>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 8
        echo "        </traces>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:traces.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 24,  96 => 21,  93 => 20,  83 => 18,  76 => 16,  72 => 14,  68 => 12,  58 => 9,  50 => 8,  27 => 4,  24 => 3,  94 => 39,  88 => 6,  79 => 17,  59 => 22,  43 => 7,  32 => 9,  29 => 4,  91 => 20,  84 => 19,  74 => 16,  66 => 15,  55 => 13,  44 => 7,  41 => 7,  31 => 5,  21 => 2,  25 => 3,  46 => 8,  35 => 5,  26 => 3,  22 => 2,  19 => 1,  184 => 70,  178 => 66,  171 => 62,  165 => 58,  162 => 57,  157 => 56,  153 => 54,  151 => 53,  143 => 48,  138 => 45,  136 => 44,  133 => 43,  130 => 42,  122 => 37,  119 => 36,  116 => 35,  111 => 32,  108 => 31,  102 => 30,  98 => 22,  95 => 28,  92 => 27,  89 => 19,  85 => 24,  81 => 40,  73 => 19,  64 => 15,  60 => 13,  57 => 14,  54 => 11,  51 => 9,  48 => 14,  45 => 8,  42 => 6,  39 => 8,  36 => 7,  33 => 5,  30 => 3,);
    }
}
