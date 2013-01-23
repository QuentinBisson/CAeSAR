<?php

/* TwigBundle:Exception:exception.json.twig */
class __TwigTemplate_c6c70888d9655b5717ba10f1dd5101a7 extends Twig_Template
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
        echo twig_jsonencode_filter($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "toarray"));
        echo "
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.json.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  94 => 39,  88 => 6,  79 => 39,  59 => 22,  43 => 7,  32 => 9,  29 => 3,  91 => 20,  84 => 19,  74 => 16,  66 => 15,  55 => 13,  44 => 10,  41 => 9,  31 => 6,  21 => 1,  25 => 5,  46 => 8,  35 => 7,  26 => 4,  22 => 2,  19 => 1,  184 => 70,  178 => 66,  171 => 62,  165 => 58,  162 => 57,  157 => 56,  153 => 54,  151 => 53,  143 => 48,  138 => 45,  136 => 44,  133 => 43,  130 => 42,  122 => 37,  119 => 36,  116 => 35,  111 => 32,  108 => 31,  102 => 30,  98 => 29,  95 => 28,  92 => 27,  89 => 26,  85 => 24,  81 => 40,  73 => 19,  64 => 15,  60 => 13,  57 => 14,  54 => 11,  51 => 12,  48 => 14,  45 => 8,  42 => 7,  39 => 8,  36 => 7,  33 => 6,  30 => 3,);
    }
}
