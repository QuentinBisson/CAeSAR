<?php

/* WebProfilerBundle:Profiler:toolbar_style.html.twig */
class __TwigTemplate_3e9d0fc95c8c0e8ff3afa34914ba2cbc extends Twig_Template
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
        echo "<style type=\"text/css\">
    .sf-toolbarreset {
        position: fixed;
        background-color: #f7f7f7;
        left: 0;
        right: 0;
        height: 38px;
        margin: 0;
        padding: 0 40px 0 0;
        z-index: 6000000;
        font: 11px Verdana, Arial, sans-serif;
        text-align: left;
        color: #2f2f2f;

        background-image: -moz-linear-gradient(-90deg, #e4e4e4, #ffffff);
        background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
        bottom: 0;
        border-top: 1px solid #bbb;
    }
    .sf-toolbarreset span,
    .sf-toolbarreset div {
        font-size: 11px;
    }
    .sf-toolbarreset img {
        width: auto;
        display: inline;
    }

    .sf-toolbarreset .hide-button {
        display: block;
        position: absolute;
        top: 12px;
        right: 10px;
        width: 15px;
        height: 15px;
        cursor: pointer;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAllBMVEXDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PExMTPz8/Q0NDR0dHT09Pb29vc3Nzf39/h4eHi4uLj4+P6+vr7+/v8/Pz9/f3///+Nh2QuAAAAIXRSTlMABgwPGBswMzk8QktRV4SKjZOWmaKlq7TAxszb3urt+fy1vNEpAAAAiklEQVQIHUXBBxKCQBREwRFzDqjoGh+C2YV//8u5Sll2S0E/dof1tKdKM6GyqCto7PjZRJIS/mbSELgXOSd/BzpKIH1ZefVWpDDTHsi8mZVnwImPi5ndCLbaAZk3M58Bay0h9VbeSvMpjDUAHj4jL55AW1rxN5fU2PLjIgVRzNdxVFOlGzvnJi0Fb1XNGBHA9uQOAAAAAElFTkSuQmCC');
    }

    .sf-toolbar-block {
        white-space: nowrap;
        color: #2f2f2f;
        display: block;
        min-height: 28px;
        border-right: 1px solid #e4e4e4;
        padding: 0;
        float: left;
        cursor: default;
    }

    .sf-toolbar-block span {
        display: inline-block;
    }

    .sf-toolbar-block .sf-toolbar-info-piece {
        padding-bottom: 5px;
    }

    .sf-toolbar-block .sf-toolbar-info-piece:last-child {
        padding-bottom: 0;
    }

    .sf-toolbar-block .sf-toolbar-info-piece a,
    .sf-toolbar-block .sf-toolbar-info-piece abbr {
        color: #2f2f2f;
    }

    .sf-toolbar-block .sf-toolbar-info-piece b {
        display: inline-block;
        width: 110px;
    }

    .sf-toolbar-block .sf-toolbar-info-with-next-pointer:after {
        content: ' :: ';
        color: #999;
    }

    .sf-toolbar-block .sf-toolbar-info-with-delimiter {
        border-right: 1px solid #999;
        padding-right: 5px;
        margin-right: 5px;
    }

    .sf-toolbar-block .sf-toolbar-info {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #bbb;
        padding: 10px 8px;
        margin-left: -1px;

        bottom: 38px;
        border-bottom-width: 0;
    }

    .sf-toolbar-block .sf-toolbar-info:empty {
        visibility: hidden;
    }

    .sf-toolbar-block .sf-toolbar-status {
        display: inline-block;
        color: #fff;
        background-color: #666;
        padding: 3px 6px;
        border-radius: 3px;
        margin-bottom: 2px;
        vertical-align: middle;
        min-width: 6px;
        min-height: 13px;
    }

    .sf-toolbar-block .sf-toolbar-status abbr {
        color: #fff;
        border-bottom: 1px dotted black;
    }

    .sf-toolbar-block .sf-toolbar-status-green {
        background-color: #759e1a;
    }

    .sf-toolbar-block .sf-toolbar-status-red {
        background-color: #a33;
    }

    .sf-toolbar-block .sf-toolbar-status-yellow {
        background-color: #ffcc00;
        color: #000;
    }

    .sf-toolbar-block .sf-toolbar-status-black {
        background-color: #000;
    }

    .sf-toolbar-block .sf-toolbar-icon {
        display: block;
    }

    .sf-toolbar-block .sf-toolbar-icon > a,
    .sf-toolbar-block .sf-toolbar-icon > span {
        display: block;
        text-decoration: none;
        margin: 0;
        padding: 5px 8px;
        min-width: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .sf-toolbar-block .sf-toolbar-icon > a,
    .sf-toolbar-block .sf-toolbar-icon > a:link
    .sf-toolbar-block .sf-toolbar-icon > a:hover {
        color: black !important;
    }

    .sf-toolbar-block .sf-toolbar-icon img {
        border-width: 0;
        vertical-align: middle;
    }

    .sf-toolbar-block .sf-toolbar-icon img + span {
        margin-left: 5px;
        margin-top: 2px;
    }

    .sf-toolbar-block .sf-toolbar-icon .sf-toolbar-status {
        border-radius: 12px;
        border-bottom-left-radius: 0px;
        margin-top: 0;
    }

    .sf-toolbar-block .sf-toolbar-info-method {
        border-bottom: 1px dashed #ccc;
        cursor: help;
    }

    .sf-toolbar-block .sf-toolbar-info-method[onclick=\"\"] {
        border-bottom: none;
        cursor: inherit;
    }

    .sf-toolbar-info-php {}
    .sf-toolbar-info-php-ext {}

    .sf-toolbar-info-php-ext .sf-toolbar-status {
        margin-left: 2px;
    }

    .sf-toolbar-info-php-ext .sf-toolbar-status:first-child {
        margin-left: 0;
    }

    .sf-toolbar-block a .sf-toolbar-info-piece-additional,
    .sf-toolbar-block a .sf-toolbar-info-piece-additional-detail {
        display: inline-block;
    }

    .sf-toolbar-block a .sf-toolbar-info-piece-additional:empty,
    .sf-toolbar-block a .sf-toolbar-info-piece-additional-detail:empty {
        display: none;
    }

    .sf-toolbarreset:hover {
        box-shadow: rgba(0, 0, 0, 0.3) 0 0 50px;
    }

    .sf-toolbar-block:hover {
        box-shadow: rgba(0, 0, 0, 0.3) 0 0 5px;
    }

    .sf-toolbar-block:hover .sf-toolbar-icon {
        background-color: #fff;
    }
    .sf-toolbar-block:hover .sf-toolbar-info {
        display: block;
    }

    /***** Override the setting when the toolbar is on the top *****/
    ";
        // line 218
        if (((isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")) == "top")) {
            // line 219
            echo "        .sf-toolbarreset {
            background-image: -moz-linear-gradient(-90deg, #ffffff, #e4e4e4);
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#e4e4e4));
            top: 0;
            bottom: auto;
            border-bottom: 1px solid #bbb;
        }

        .sf-toolbar-block .sf-toolbar-info {
            top: 39px;
            bottom: auto;
            border-top-width: 0;
            border-bottom: 1px solid #bbb;
        }
    ";
        }
        // line 234
        echo "
    ";
        // line 235
        if ((!(isset($context["floatable"]) ? $context["floatable"] : $this->getContext($context, "floatable")))) {
            // line 236
            echo "        .sf-toolbarreset {
            position: static;
            background: #cbcbcb;
            background-image: -moz-linear-gradient(-90deg, #e8e8e8, #cbcbcb) !important;
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e8e8e8), to(#cbcbcb)) !important;
        }

        .sf-toolbarreset abbr {
            border-bottom: 1px dotted #000000;
            cursor: help;
        }
    ";
        }
        // line 248
        echo "
    /***** Media query *****/
    @media screen and (max-width: 779px) {
        .sf-toolbar-block .sf-toolbar-icon > * > :first-child ~ * {
            display: none;
        }

        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional,
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
            display: none !important;
        }
    }

    @media screen and (min-width: 880px) {
        .sf-toolbar-block .sf-toolbar-icon a[href\$=\"config\"] .sf-toolbar-info-piece-additional {
            display: inline-block;
        }
    }

    @media screen and (min-width: 980px) {
        .sf-toolbar-block .sf-toolbar-icon a[href\$=\"security\"] .sf-toolbar-info-piece-additional {
            display: inline-block;
        }
    }

    @media screen and (max-width: 1179px) {
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional {
            display: none;
        }
    }

    @media screen and (max-width: 1439px) {
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
            display: none;
        }
    }
</style>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar_style.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  276 => 248,  262 => 236,  260 => 235,  238 => 218,  20 => 1,  40 => 8,  97 => 46,  86 => 40,  53 => 17,  23 => 3,  148 => 50,  134 => 44,  129 => 43,  117 => 35,  112 => 32,  99 => 47,  90 => 20,  69 => 9,  56 => 15,  479 => 162,  473 => 161,  468 => 158,  460 => 155,  456 => 153,  452 => 151,  443 => 149,  439 => 148,  436 => 147,  434 => 146,  429 => 144,  426 => 143,  422 => 142,  412 => 134,  408 => 132,  406 => 131,  401 => 130,  397 => 129,  392 => 126,  386 => 122,  383 => 121,  380 => 120,  378 => 119,  373 => 116,  367 => 112,  364 => 111,  361 => 110,  359 => 109,  354 => 106,  340 => 105,  336 => 103,  321 => 101,  313 => 99,  311 => 98,  308 => 97,  304 => 95,  297 => 91,  293 => 90,  284 => 89,  282 => 88,  277 => 86,  267 => 85,  263 => 84,  257 => 234,  251 => 80,  246 => 78,  240 => 219,  234 => 74,  228 => 73,  223 => 71,  219 => 70,  213 => 69,  207 => 68,  198 => 67,  181 => 66,  176 => 65,  170 => 61,  168 => 60,  146 => 58,  142 => 56,  128 => 50,  125 => 44,  107 => 36,  38 => 4,  144 => 53,  141 => 51,  135 => 47,  126 => 46,  109 => 41,  103 => 27,  67 => 21,  61 => 18,  47 => 9,  225 => 96,  216 => 90,  212 => 88,  205 => 84,  201 => 83,  196 => 80,  194 => 79,  191 => 78,  189 => 77,  186 => 76,  180 => 72,  172 => 67,  159 => 61,  154 => 59,  147 => 55,  132 => 48,  127 => 46,  121 => 43,  118 => 44,  114 => 42,  104 => 36,  100 => 34,  78 => 26,  75 => 24,  71 => 23,  34 => 8,  28 => 3,  105 => 5,  93 => 44,  76 => 34,  72 => 5,  68 => 12,  58 => 19,  27 => 4,  24 => 3,  94 => 22,  88 => 23,  79 => 14,  59 => 21,  91 => 43,  84 => 27,  44 => 12,  31 => 4,  21 => 2,  25 => 3,  26 => 3,  19 => 1,  70 => 20,  63 => 21,  46 => 14,  22 => 2,  163 => 59,  155 => 58,  152 => 49,  149 => 48,  145 => 46,  139 => 55,  131 => 51,  123 => 41,  120 => 40,  115 => 39,  106 => 36,  101 => 27,  96 => 26,  83 => 18,  80 => 24,  74 => 25,  66 => 29,  55 => 15,  52 => 19,  50 => 15,  43 => 6,  41 => 12,  37 => 7,  35 => 6,  32 => 6,  29 => 6,  184 => 70,  178 => 71,  171 => 62,  165 => 58,  162 => 57,  157 => 60,  153 => 54,  151 => 51,  143 => 44,  138 => 43,  136 => 50,  133 => 43,  130 => 47,  122 => 43,  119 => 42,  116 => 39,  111 => 6,  108 => 30,  102 => 30,  98 => 31,  95 => 34,  92 => 33,  89 => 28,  85 => 17,  81 => 7,  73 => 19,  64 => 25,  60 => 23,  57 => 20,  54 => 19,  51 => 16,  48 => 6,  45 => 13,  42 => 12,  39 => 10,  36 => 7,  33 => 6,  30 => 5,);
    }
}
