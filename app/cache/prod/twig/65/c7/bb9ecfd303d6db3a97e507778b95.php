<?php

/* TwigBundle:Exception:exception.html.twig */
class __TwigTemplate_65c7bb9ecfd303d6db3a97e507778b95 extends Twig_Template
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
        echo "<div class=\"sf-exceptionreset\">

    <div class=\"block_exception\">
        <div class=\"block_exception_detected clear_fix\">
            <div class=\"illustration_exception\">
                <img alt=\"Exception detected!\" src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/exception_detected.png"), "html", null, true);
        echo "\"/>
            </div>
            <div class=\"text_exception\">

                <div class=\"open_quote\">
                    <img alt=\"\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/open_quote.gif"), "html", null, true);
        echo "\"/>
                </div>

                <h1>
                    ";
        // line 15
        echo $this->env->getExtension('code')->formatFileFromText(nl2br(twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "message"), "html", null, true)));
        echo "
                </h1>

                <div>
                    <strong>";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : null), "html", null, true);
        echo "</strong> ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : null), "html", null, true);
        echo " - ";
        echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "class"));
        echo "
                </div>

                ";
        // line 22
        $context["previous_count"] = twig_length_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "allPrevious"));
        // line 23
        echo "                ";
        if ((isset($context["previous_count"]) ? $context["previous_count"] : null)) {
            // line 24
            echo "                    <div class=\"linked\"><span><strong>";
            echo twig_escape_filter($this->env, (isset($context["previous_count"]) ? $context["previous_count"] : null), "html", null, true);
            echo "</strong> linked Exception";
            echo ((((isset($context["previous_count"]) ? $context["previous_count"] : null) > 1)) ? ("s") : (""));
            echo ":</span>
                        <ul>
                            ";
            // line 26
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "allPrevious"));
            foreach ($context['_seq'] as $context["i"] => $context["previous"]) {
                // line 27
                echo "                                <li>
                                    ";
                // line 28
                echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["previous"]) ? $context["previous"] : null), "class"));
                echo " <a href=\"#traces_link_";
                echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                echo "\" onclick=\"toggle('traces_";
                echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                echo "', 'traces'); switchIcons('icon_traces_";
                echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                echo "_open', 'icon_traces_";
                echo twig_escape_filter($this->env, ((isset($context["i"]) ? $context["i"] : null) + 1), "html", null, true);
                echo "_close');\">&#187;</a>
                                </li>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['previous'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 31
            echo "                        </ul>
                    </div>
                ";
        }
        // line 34
        echo "
                <div class=\"close_quote\">
                    <img alt=\"\" src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/close_quote.gif"), "html", null, true);
        echo "\"/>
                </div>

            </div>
        </div>
    </div>

    ";
        // line 43
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "toarray"));
        foreach ($context['_seq'] as $context["position"] => $context["e"]) {
            // line 44
            echo "        ";
            $this->env->loadTemplate("TwigBundle:Exception:traces.html.twig")->display(array("exception" => (isset($context["e"]) ? $context["e"] : null), "position" => (isset($context["position"]) ? $context["position"] : null), "count" => (isset($context["previous_count"]) ? $context["previous_count"] : null)));
            // line 45
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['position'], $context['e'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 46
        echo "
    ";
        // line 47
        if ((isset($context["logger"]) ? $context["logger"] : null)) {
            // line 48
            echo "        <div class=\"block\">
            <div class=\"logs clear_fix\">
                ";
            // line 50
            ob_start();
            // line 51
            echo "                <h2>
                    Logs&nbsp;
                    <a href=\"#\" onclick=\"toggle('logs'); switchIcons('icon_logs_open', 'icon_logs_close'); return false;\">
                        <img class=\"toggle\" id=\"icon_logs_open\" alt=\"+\" src=\"";
            // line 54
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: hidden\" />
                        <img class=\"toggle\" id=\"icon_logs_close\" alt=\"-\" src=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: visible; margin-left: -18px\" />
                    </a>
                </h2>
                ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 59
            echo "
                ";
            // line 60
            if ($this->getAttribute((isset($context["logger"]) ? $context["logger"] : null), "counterrors")) {
                // line 61
                echo "                    <div class=\"error_count\">
                        <span>
                            ";
                // line 63
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["logger"]) ? $context["logger"] : null), "counterrors"), "html", null, true);
                echo " error";
                echo ((($this->getAttribute((isset($context["logger"]) ? $context["logger"] : null), "counterrors") > 1)) ? ("s") : (""));
                echo "
                        </span>
                    </div>
                ";
            }
            // line 67
            echo "
            </div>

            <div id=\"logs\">
                ";
            // line 71
            $this->env->loadTemplate("TwigBundle:Exception:logs.html.twig")->display(array("logs" => $this->getAttribute((isset($context["logger"]) ? $context["logger"] : null), "logs")));
            // line 72
            echo "            </div>

        </div>
    ";
        }
        // line 76
        echo "
    ";
        // line 77
        if ((isset($context["currentContent"]) ? $context["currentContent"] : null)) {
            // line 78
            echo "        <div class=\"block\">
            ";
            // line 79
            ob_start();
            // line 80
            echo "            <h2>
                Content of the Output&nbsp;
                <a href=\"#\" onclick=\"toggle('output_content'); switchIcons('icon_content_open', 'icon_content_close'); return false;\">
                    <img class=\"toggle\" id=\"icon_content_close\" alt=\"-\" src=\"";
            // line 83
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: hidden\" />
                    <img class=\"toggle\" id=\"icon_content_open\" alt=\"+\" src=\"";
            // line 84
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: visible; margin-left: -18px\" />
                </a>
            </h2>
            ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 88
            echo "
            <div id=\"output_content\" style=\"display: none\">
                ";
            // line 90
            echo twig_escape_filter($this->env, (isset($context["currentContent"]) ? $context["currentContent"] : null), "html", null, true);
            echo "
            </div>

            <div style=\"clear: both\"></div>
        </div>
    ";
        }
        // line 96
        echo "
</div>

<script type=\"text/javascript\">//<![CDATA[
    function toggle(id, clazz) {
        var el = document.getElementById(id),
            current = el.style.display,
            i;

        if (clazz) {
            var tags = document.getElementsByTagName('*');
            for (i = tags.length - 1; i >= 0 ; i--) {
                if (tags[i].className === clazz) {
                    tags[i].style.display = 'none';
                }
            }
        }

        el.style.display = current === 'none' ? 'block' : 'none';
    }

    function switchIcons(id1, id2) {
        var icon1, icon2, visibility1, visibility2;

        icon1 = document.getElementById(id1);
        icon2 = document.getElementById(id2);

        visibility1 = icon1.style.visibility;
        visibility2 = icon2.style.visibility;

        icon1.style.visibility = visibility2;
        icon2.style.visibility = visibility1;
    }
//]]></script>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  163 => 63,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 45,  118 => 44,  114 => 43,  104 => 36,  100 => 34,  78 => 28,  75 => 27,  71 => 26,  63 => 24,  34 => 11,  28 => 3,  105 => 24,  96 => 21,  93 => 20,  83 => 18,  76 => 16,  72 => 14,  68 => 12,  58 => 22,  50 => 8,  27 => 4,  24 => 3,  94 => 39,  88 => 6,  79 => 17,  59 => 22,  43 => 6,  32 => 4,  29 => 4,  91 => 20,  84 => 19,  74 => 16,  66 => 15,  55 => 13,  44 => 7,  41 => 15,  31 => 5,  21 => 2,  25 => 3,  46 => 8,  35 => 5,  26 => 6,  22 => 2,  19 => 1,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 53,  143 => 54,  138 => 51,  136 => 50,  133 => 43,  130 => 47,  122 => 37,  119 => 36,  116 => 35,  111 => 32,  108 => 31,  102 => 30,  98 => 22,  95 => 31,  92 => 27,  89 => 19,  85 => 24,  81 => 40,  73 => 19,  64 => 15,  60 => 23,  57 => 14,  54 => 11,  51 => 9,  48 => 19,  45 => 8,  42 => 6,  39 => 8,  36 => 7,  33 => 5,  30 => 3,);
    }
}
