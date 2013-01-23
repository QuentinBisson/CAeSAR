<?php

/* WebProfilerBundle:Collector:events.html.twig */
class __TwigTemplate_e274457e66cdb4609302faf9ab7fbe7f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
            'panelContent' => array($this, 'block_panelContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["__internal_e55e7c528f1164cdaad830eb67d88d9f18fd183e"] = $this;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/events.png"), "html", null, true);
        echo "\" alt=\"Events\" /></span>
    <strong>Events</strong>
</span>
";
    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "calledlisteners"))) {
            // line 14
            echo "        ";
            $this->displayBlock("panelContent", $context, $blocks);
            echo "
    ";
        } else {
            // line 16
            echo "        <h2>Events</h2>
        <p>
            <em>No events have been recorded. Are you sure that debugging is enabled in the kernel?</em>
        </p>
    ";
        }
    }

    // line 23
    public function block_panelContent($context, array $blocks = array())
    {
        // line 24
        echo "    <h2>Called Listeners</h2>

    <table>
        <tr>
            <th>Event name</th>
            <th>Priority</th>
            <th>Listener</th>
        </tr>
        ";
        // line 32
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "calledlisteners"));
        foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
            // line 33
            echo "            <tr>
                <td><code>";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "event"), "html", null, true);
            echo "</code></td>
                <td><code>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "priority"), "html", null, true);
            echo "</code></td>
                <td><code>";
            // line 36
            echo $context["__internal_e55e7c528f1164cdaad830eb67d88d9f18fd183e"]->getdisplay_listener((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")));
            echo "</code></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 39
        echo "    </table>

    ";
        // line 41
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "notcalledlisteners")) {
            // line 42
            echo "        <h2>Not Called Listeners</h2>

        <table>
            <tr>
                <th>Event name</th>
                <th>Priority</th>
                <th>Listener</th>
            </tr>
            ";
            // line 50
            $context["listeners"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "notcalledlisteners");
            // line 51
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_sort_filter(twig_get_array_keys_filter((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")))));
            foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
                // line 52
                echo "                <tr>
                    <td><code>";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")), (isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), array(), "array"), "event"), "html", null, true);
                echo "</code></td>
                    <td><code>";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")), (isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), array(), "array"), "priority"), "html", null, true);
                echo "</code></td>
                    <td><code>";
                // line 55
                echo $context["__internal_e55e7c528f1164cdaad830eb67d88d9f18fd183e"]->getdisplay_listener($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : $this->getContext($context, "listeners")), (isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), array(), "array"));
                echo "</code></td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 58
            echo "        </table>
    ";
        }
    }

    // line 62
    public function getdisplay_listener($_listener = null)
    {
        $context = $this->env->mergeGlobals(array(
            "listener" => $_listener,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 63
            echo "    ";
            if (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Closure")) {
                // line 64
                echo "        Closure
    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Function")) {
                // line 66
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "line"));
                // line 67
                echo "        ";
                if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "function"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "function"), "html", null, true);
                }
                // line 68
                echo "    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "type") == "Method")) {
                // line 69
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "line"));
                // line 70
                echo "        ";
                echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "class"));
                echo "::";
                if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "method"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : $this->getContext($context, "listener")), "method"), "html", null, true);
                }
                // line 71
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:events.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 71,  185 => 68,  167 => 64,  164 => 63,  110 => 42,  87 => 34,  388 => 160,  385 => 159,  379 => 158,  377 => 157,  370 => 156,  366 => 155,  362 => 153,  360 => 152,  357 => 151,  352 => 149,  344 => 147,  342 => 146,  339 => 145,  333 => 141,  330 => 140,  327 => 139,  325 => 138,  320 => 135,  314 => 131,  306 => 128,  301 => 125,  295 => 121,  292 => 120,  289 => 119,  287 => 118,  280 => 114,  275 => 111,  273 => 110,  268 => 107,  264 => 105,  258 => 103,  254 => 101,  252 => 100,  247 => 97,  245 => 96,  231 => 88,  226 => 86,  221 => 83,  215 => 79,  209 => 77,  202 => 73,  193 => 68,  190 => 67,  188 => 69,  183 => 63,  177 => 59,  174 => 67,  169 => 56,  140 => 42,  82 => 19,  77 => 18,  62 => 25,  49 => 13,  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  40 => 8,  97 => 23,  86 => 40,  53 => 38,  23 => 3,  148 => 46,  134 => 54,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 39,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 150,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 130,  308 => 129,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 115,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 93,  234 => 89,  228 => 87,  223 => 71,  219 => 70,  213 => 69,  207 => 76,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 27,  38 => 7,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 25,  67 => 23,  61 => 12,  47 => 8,  225 => 96,  216 => 90,  212 => 78,  205 => 84,  201 => 83,  196 => 69,  194 => 79,  191 => 70,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 48,  147 => 58,  132 => 48,  127 => 52,  121 => 43,  118 => 44,  114 => 42,  104 => 39,  100 => 24,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 44,  76 => 17,  72 => 5,  68 => 12,  58 => 16,  27 => 3,  24 => 3,  94 => 22,  88 => 20,  79 => 18,  59 => 21,  91 => 35,  84 => 33,  44 => 11,  31 => 6,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 24,  63 => 21,  46 => 12,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 35,  120 => 50,  115 => 39,  106 => 36,  101 => 33,  96 => 26,  83 => 18,  80 => 32,  74 => 25,  66 => 29,  55 => 9,  52 => 14,  50 => 15,  43 => 6,  41 => 12,  37 => 6,  35 => 6,  32 => 5,  29 => 3,  184 => 70,  178 => 71,  171 => 66,  165 => 54,  162 => 53,  157 => 60,  153 => 62,  151 => 47,  143 => 43,  138 => 55,  136 => 50,  133 => 43,  130 => 53,  122 => 51,  119 => 42,  116 => 31,  111 => 6,  108 => 41,  102 => 30,  98 => 31,  95 => 36,  92 => 21,  89 => 28,  85 => 17,  81 => 7,  73 => 16,  64 => 11,  60 => 23,  57 => 20,  54 => 19,  51 => 37,  48 => 6,  45 => 13,  42 => 7,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
