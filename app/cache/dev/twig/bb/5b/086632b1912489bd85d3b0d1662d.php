<?php

/* WebProfilerBundle:Profiler:layout.html.twig */
class __TwigTemplate_bb5b086632b1912489bd85d3b0d1662d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
    ";
        // line 5
        echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Profiler:toolbar", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "position" => "normal"), array());
        // line 6
        echo "
    <div id=\"content\">
        ";
        // line 8
        $this->env->loadTemplate("WebProfilerBundle:Profiler:header.html.twig")->display(array());
        // line 9
        echo "
        <div id=\"main\">

            <div class=\"clear_fix\">
                <div id=\"collector_wrapper\">
                    ";
        // line 14
        if ((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile"))) {
            // line 15
            echo "                        <div id=\"resume\">
                            <a id=\"resume-view-all\" href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler_search", array("limit" => 10)), "html", null, true);
            echo "\">View all</a>
                            <strong>Profile for:</strong>
                            ";
            // line 18
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "method")), "html", null, true);
            echo "
                            ";
            // line 19
            if (twig_in_filter(twig_upper_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "method")), array(0 => "GET", 1 => "HEAD"))) {
                // line 20
                echo "                                <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "url"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "url"), "html", null, true);
                echo "</a>
                            ";
            } else {
                // line 22
                echo "                                ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "url"), "html", null, true);
                echo "
                            ";
            }
            // line 24
            echo "                            <span class=\"date\">
                                <em>by ";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "ip"), "html", null, true);
            echo "</em> at <em>";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "time"), "r"), "html", null, true);
            echo "</em>
                            </span>
                        </div>
                    ";
        }
        // line 29
        echo "
                    <div id=\"collector_content\">
                        ";
        // line 31
        $this->env->loadTemplate("WebProfilerBundle:Profiler:base_js.html.twig")->display($context);
        // line 32
        echo "                        ";
        $this->displayBlock('panel', $context, $blocks);
        // line 33
        echo "                    </div>
                </div>
                <div id=\"navigation\">
                    ";
        // line 36
        if (array_key_exists("templates", $context)) {
            // line 37
            echo "                        <ul id=\"menu_profiler\">
                            ";
            // line 38
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["templates"]) ? $context["templates"] : $this->getContext($context, "templates")));
            foreach ($context['_seq'] as $context["name"] => $context["template"]) {
                // line 39
                echo "                                ";
                ob_start();
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["template"]) ? $context["template"] : $this->getContext($context, "template")), "renderBlock", array(0 => "menu", 1 => array("collector" => $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "getcollector", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))), "method"))), "method"), "html", null, true);
                $context["menu"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
                // line 40
                echo "                                ";
                if (((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")) != "")) {
                    // line 41
                    echo "                                    <li class=\"";
                    echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
                    if (((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")) == (isset($context["panel"]) ? $context["panel"] : $this->getContext($context, "panel")))) {
                        echo " selected";
                    }
                    echo "\">
                                        <a href=\"";
                    // line 42
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")), "panel" => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")))), "html", null, true);
                    echo "\">";
                    echo (isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu"));
                    echo "</a>
                                    </li>
                                ";
                }
                // line 45
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['template'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 46
            echo "                        </ul>
                    ";
        }
        // line 48
        echo "                    ";
        echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Profiler:searchBar", array(), array());
        // line 49
        echo "                    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:admin.html.twig")->display(array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token"))));
        // line 50
        echo "                </div>
            </div>
        </div>
    </div>
";
    }

    // line 32
    public function block_panel($context, array $blocks = array())
    {
        echo "";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 32,  155 => 50,  152 => 49,  149 => 48,  145 => 46,  139 => 45,  131 => 42,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 33,  96 => 31,  83 => 25,  80 => 24,  74 => 22,  66 => 20,  55 => 16,  52 => 15,  50 => 14,  43 => 9,  41 => 8,  37 => 6,  35 => 5,  32 => 4,  29 => 3,  184 => 70,  178 => 66,  171 => 62,  165 => 58,  162 => 57,  157 => 56,  153 => 54,  151 => 53,  143 => 48,  138 => 45,  136 => 44,  133 => 43,  130 => 42,  122 => 37,  119 => 36,  116 => 35,  111 => 38,  108 => 37,  102 => 30,  98 => 32,  95 => 28,  92 => 29,  89 => 26,  85 => 24,  81 => 22,  73 => 19,  64 => 19,  60 => 18,  57 => 12,  54 => 11,  51 => 10,  48 => 9,  45 => 8,  42 => 7,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
