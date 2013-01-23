<?php

/* WebProfilerBundle:Collector:request.html.twig */
class __TwigTemplate_e9550d1c32f48c8a1bb2a7b0bb932576 extends Twig_Template
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
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        ";
        if ($this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "controller", array(), "any", false, true), "class", array(), "any", true, true)) {
            // line 6
            echo "            ";
            $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "controller"), "file"), $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "controller"), "line"));
            // line 7
            echo "            <span class=\"sf-toolbar-info-class sf-toolbar-info-with-next-pointer\">";
            echo $this->env->getExtension('code')->abbrClass($this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "controller"), "class"));
            echo "</span>
            <span class=\"sf-toolbar-info-method\" onclick=\"";
            // line 8
            if ((isset($context["link"]) ? $context["link"] : $this->getContext($context, "link"))) {
                echo "window.location='";
                echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : $this->getContext($context, "link")), "html", null, true);
                echo "';window.event.stopPropagation();return false;";
            }
            echo "\">
                ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "controller"), "method"), "html", null, true);
            echo "
            </span>
        ";
        } else {
            // line 12
            echo "            <span class=\"sf-toolbar-info-class sf-toolbar-info-with-next-pointer\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "controller"), "html", null, true);
            echo "</span>
        ";
        }
        // line 14
        echo "    ";
        $context["request_handler"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 15
        echo "    ";
        $context["request_status_code_color"] = (((400 > $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "statuscode"))) ? ((((200 == $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "statuscode"))) ? ("green") : ("yellow"))) : ("red"));
        // line 16
        echo "    ";
        $context["request_route"] = (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "route")) ? ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "route")) : ("NONE"));
        // line 17
        echo "    ";
        ob_start();
        // line 18
        echo "        <img width=\"28\" height=\"28\" alt=\"Request\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABwAAAAcCAQAAADYBBcfAAACvElEQVR42tVTbUhTYRTerDCnKVoUUr/KCZmypA9Koet0bXNLJ5XazDJ/WFaCUY0pExRZXxYiJgsxWWjkaL+yK+po1gjyR2QfmqWxtBmaBtqWGnabT++c11Fu4l/P4VzOPc95zoHznsNZodIbLDdRcKnc1Bu8DAK45ZsOnykQNMopsNooLxCknb0cDq5vml9FtHiIgpBR0R6iihYyFMTDt2Lg56ObPkI6TMGXSof1EV67IqCwisJSWliFAG/E0CfFIiebdNypcxi/1zgyFiIiZ3sJQr0RQx5frLa6k7SOKRo3oMFNR5t62h2rttKXEOKFqDCxtXNmmBokO2KKTlp3IdWuT2dYRNGKwEXEBCcL172G5FG0aIxC0kR9PBTVH1kkwQn+IqJnCE33EalVzT9GJQS1tAdD3CKicJYFrxqx7W2ejCEdZy1FiC5tZxHhLJKOZaRdQJAyV/YAvDliySALHxmxR4Hqe2iwvaOR/CEuZYJFSgYhVbZRkA8KGdEktrqnqra90NndCdkt77fjIHIhexOrfO6O3bbbOj/rqu5IptgyR3sU93QbOYhquZK4MCDp0Ina/PLsu5JvbCTRaapUdUmIV/RzoMdsk/0hWRNdAvKOmvqlN0drsJbJf1P4YsQ5lGrJeuosiOUgbOC8cto3LfOXTdVd7BqZsQKbse+0jUL6WPcesqs4MNSUTQAxGjwFiC8m3yzmqwHJBWYKBJ9WNqW/dHkpU/osch1Yj5RJfXPfSEe/2UPsN490NPfZG5CKyJmcV5ayHyzy7BMqsXfuHhGK/cjAIeSpR92gehR55D8TcQhDEKJwytBJ4fr4NULvrEM8NszfJPyxDoHYAQ1oPCWmIX4gifmDS/DV2DKeb25FHWr76yEG7/9L4YFPeiQQ4/8LkgJ8Et+NncTCsYqzXAEXa7CWdPZzGWdlyV+vST0JanfPvwAAAABJRU5ErkJggg==\"/>
        <span class=\"sf-toolbar-status sf-toolbar-status-";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["request_status_code_color"]) ? $context["request_status_code_color"] : $this->getContext($context, "request_status_code_color")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "statuscode"), "html", null, true);
        echo "</span>
        <span class=\"sf-toolbar-status sf-toolbar-info-piece-additional\">";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["request_handler"]) ? $context["request_handler"] : $this->getContext($context, "request_handler")), "html", null, true);
        echo "</span>
        <span class=\"sf-toolbar-info-piece-additional-detail\">on <i>";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["request_route"]) ? $context["request_route"] : $this->getContext($context, "request_route")), "html", null, true);
        echo "</i></span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 23
        echo "    ";
        ob_start();
        // line 24
        echo "        ";
        ob_start();
        // line 25
        echo "            <div class=\"sf-toolbar-info-piece\">
                <b>Status Code</b>
                <span class=\"sf-toolbar-status sf-toolbar-status-";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["request_status_code_color"]) ? $context["request_status_code_color"] : $this->getContext($context, "request_status_code_color")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "statuscode"), "html", null, true);
        echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Controller</b>
                ";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["request_handler"]) ? $context["request_handler"] : $this->getContext($context, "request_handler")), "html", null, true);
        echo "
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Route name</b>
                <span>";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["request_route"]) ? $context["request_route"] : $this->getContext($context, "request_route")), "html", null, true);
        echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Has session</b>
                <span>";
        // line 39
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "sessionmetadata"))) {
            echo "yes";
        } else {
            echo "no";
        }
        echo "</span>
            </div>
        ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 42
        echo "    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 43
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
    }

    // line 46
    public function block_menu($context, array $blocks = array())
    {
        // line 47
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/request.png"), "html", null, true);
        echo "\" alt=\"Request\" /></span>
    <strong>Request</strong>
</span>
";
    }

    // line 53
    public function block_panel($context, array $blocks = array())
    {
        // line 54
        echo "    <h2>Request GET Parameters</h2>

    ";
        // line 56
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestquery"), "all"))) {
            // line 57
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestquery")));
            // line 58
            echo "    ";
        } else {
            // line 59
            echo "        <p>
            <em>No GET parameters</em>
        </p>
    ";
        }
        // line 63
        echo "
    <h2>Request POST Parameters</h2>

    ";
        // line 66
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestrequest"), "all"))) {
            // line 67
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestrequest")));
            // line 68
            echo "    ";
        } else {
            // line 69
            echo "        <p>
            <em>No POST parameters</em>
        </p>
    ";
        }
        // line 73
        echo "
    <h2>Request Attributes</h2>

    ";
        // line 76
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestattributes"), "all"))) {
            // line 77
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestattributes")));
            // line 78
            echo "    ";
        } else {
            // line 79
            echo "        <p>
            <em>No attributes</em>
        </p>
    ";
        }
        // line 83
        echo "
    <h2>Request Cookies</h2>

    ";
        // line 86
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestcookies"), "all"))) {
            // line 87
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestcookies")));
            // line 88
            echo "    ";
        } else {
            // line 89
            echo "        <p>
            <em>No cookies</em>
        </p>
    ";
        }
        // line 93
        echo "
    <h2>Request Headers</h2>

    ";
        // line 96
        $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestheaders")));
        // line 97
        echo "
    <h2>Request Content</h2>

    ";
        // line 100
        if (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "content") == false)) {
            // line 101
            echo "        <p><em>Request content not available (it was retrieved as a resource).</em></p>
    ";
        } elseif ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "content")) {
            // line 103
            echo "        <pre>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "content"), "html", null, true);
            echo "</pre>
    ";
        } else {
            // line 105
            echo "        <p><em>No content</em></p>
    ";
        }
        // line 107
        echo "
    <h2>Request Server Parameters</h2>

    ";
        // line 110
        $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "requestserver")));
        // line 111
        echo "
    <h2>Response Headers</h2>

    ";
        // line 114
        $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "responseheaders")));
        // line 115
        echo "
    <h2>Session Metadata</h2>

    ";
        // line 118
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "sessionmetadata"))) {
            // line 119
            echo "    ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "sessionmetadata")));
            // line 120
            echo "    ";
        } else {
            // line 121
            echo "    <p>
        <em>No session metadata</em>
    </p>
    ";
        }
        // line 125
        echo "
    <h2>Session Attributes</h2>

    ";
        // line 128
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "sessionattributes"))) {
            // line 129
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "sessionattributes")));
            // line 130
            echo "    ";
        } else {
            // line 131
            echo "        <p>
            <em>No session attributes</em>
        </p>
    ";
        }
        // line 135
        echo "
    <h2>Flashes</h2>

    ";
        // line 138
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "flashes"))) {
            // line 139
            echo "        ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "flashes")));
            // line 140
            echo "    ";
        } else {
            // line 141
            echo "        <p>
            <em>No flashes</em>
        </p>
    ";
        }
        // line 145
        echo "
    ";
        // line 146
        if ($this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "parent")) {
            // line 147
            echo "        <h2><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => $this->getAttribute($this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "parent"), "token"))), "html", null, true);
            echo "\">Parent request: ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "parent"), "token"), "html", null, true);
            echo "</a></h2>

        ";
            // line 149
            $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "parent"), "getcollector", array(0 => "request"), "method"), "requestattributes")));
            // line 150
            echo "    ";
        }
        // line 151
        echo "
    ";
        // line 152
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "children"))) {
            // line 153
            echo "        <h2>Sub requests</h2>

        ";
            // line 155
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["profile"]) ? $context["profile"] : $this->getContext($context, "profile")), "children"));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 156
                echo "            <h3><a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => $this->getAttribute((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), "token"))), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), "token"), "html", null, true);
                echo "</a></h3>
            ";
                // line 157
                $this->env->loadTemplate("WebProfilerBundle:Profiler:bag.html.twig")->display(array("bag" => $this->getAttribute($this->getAttribute((isset($context["child"]) ? $context["child"] : $this->getContext($context, "child")), "getcollector", array(0 => "request"), "method"), "requestattributes")));
                // line 158
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 159
            echo "    ";
        }
        // line 160
        echo "
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:request.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  388 => 160,  385 => 159,  379 => 158,  377 => 157,  370 => 156,  366 => 155,  362 => 153,  360 => 152,  357 => 151,  352 => 149,  344 => 147,  342 => 146,  339 => 145,  333 => 141,  330 => 140,  327 => 139,  325 => 138,  320 => 135,  314 => 131,  306 => 128,  301 => 125,  295 => 121,  292 => 120,  289 => 119,  287 => 118,  280 => 114,  275 => 111,  273 => 110,  268 => 107,  264 => 105,  258 => 103,  254 => 101,  252 => 100,  247 => 97,  245 => 96,  231 => 88,  226 => 86,  221 => 83,  215 => 79,  209 => 77,  202 => 73,  193 => 68,  190 => 67,  188 => 66,  183 => 63,  177 => 59,  174 => 58,  169 => 56,  140 => 42,  82 => 19,  77 => 18,  62 => 25,  49 => 17,  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  40 => 8,  97 => 23,  86 => 40,  53 => 38,  23 => 3,  148 => 46,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 39,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 150,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 130,  308 => 129,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 115,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 93,  234 => 89,  228 => 87,  223 => 71,  219 => 70,  213 => 69,  207 => 76,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 27,  38 => 6,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 25,  67 => 14,  61 => 12,  47 => 8,  225 => 96,  216 => 90,  212 => 78,  205 => 84,  201 => 83,  196 => 69,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 48,  147 => 55,  132 => 48,  127 => 46,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 24,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 44,  76 => 17,  72 => 5,  68 => 12,  58 => 19,  27 => 4,  24 => 3,  94 => 22,  88 => 20,  79 => 18,  59 => 21,  91 => 28,  84 => 23,  44 => 11,  31 => 6,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 15,  63 => 21,  46 => 34,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 35,  120 => 40,  115 => 39,  106 => 36,  101 => 33,  96 => 26,  83 => 18,  80 => 24,  74 => 25,  66 => 29,  55 => 9,  52 => 18,  50 => 15,  43 => 6,  41 => 12,  37 => 6,  35 => 5,  32 => 4,  29 => 3,  184 => 70,  178 => 71,  171 => 57,  165 => 54,  162 => 53,  157 => 60,  153 => 54,  151 => 47,  143 => 43,  138 => 43,  136 => 50,  133 => 43,  130 => 39,  122 => 43,  119 => 42,  116 => 31,  111 => 6,  108 => 30,  102 => 30,  98 => 31,  95 => 30,  92 => 21,  89 => 28,  85 => 17,  81 => 7,  73 => 16,  64 => 11,  60 => 23,  57 => 20,  54 => 19,  51 => 37,  48 => 6,  45 => 13,  42 => 7,  39 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
