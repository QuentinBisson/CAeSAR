<?php

/* CaesarAdminBundle::layout.html.twig */
class __TwigTemplate_d7355213111ec949108bcbfd72a920ce extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::admin.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'menu' => array($this, 'block_menu'),
            'content' => array($this, 'block_content'),
            'contentTitle' => array($this, 'block_contentTitle'),
            'contentBody' => array($this, 'block_contentBody'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
<link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/caesaradmin/css/layout.css"), "html", null, true);
        echo "\" />
";
    }

    // line 7
    public function block_menu($context, array $blocks = array())
    {
        // line 8
        echo "<aside class=\"sidebar\">
    <nav>
        <ul class=\"accordion\">
            <li><a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_homepage"), "html", null, true);
        echo "\">Ressources</a>
                <ul>
                    <li><a href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_add"), "html", null, true);
        echo "\">Ajouter une ressource</a></li>
                    <li><a href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_homepage"), "html", null, true);
        echo "\">Voir les ressources</a></li>
                    <li><a href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_resource_skeleton"), "html", null, true);
        echo "\">Modifier le squelette</a></li>
                </ul>
            </li>
            <li><a href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_user_homepage"), "html", null, true);
        echo "\">Utilisateurs</a>
                <ul>
                   <li><a href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_user_add"), "html", null, true);
        echo "\">Ajouter un utilisateur</a></li>
                    <li><a href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_user_homepage"), "html", null, true);
        echo "\">Voir les ressources</a></li>
                </ul>
            </li>
                <li><a href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_location_homepage"), "html", null, true);
        echo "\">Emplacements</a>
                    <ul>
                        <li><a href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_location_add"), "html", null, true);
        echo "\">Ajouter un emplacement</a></li>
                        <li><a href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("caesar_admin_location_homepage"), "html", null, true);
        echo "\">Voir les emplacements</a></li>
                    </ul>
                    </li>
                    <li><a href=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("#loan"), "html", null, true);
        echo "\">Emprunts</a>
                        <ul>
                    ";
        // line 33
        echo "                            </ul>
                        </li>
                        <li><a href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("#tag"), "html", null, true);
        echo "\">Etiquettes</a>
                            <ul>
                    ";
        // line 38
        echo "                                </ul>
                            </li>
                        </ul>
                    </nav>
                </aside>
";
    }

    // line 45
    public function block_content($context, array $blocks = array())
    {
        // line 46
        echo "    <h2>";
        $this->displayBlock('contentTitle', $context, $blocks);
        echo "</h2>
    ";
        // line 47
        $this->displayBlock('contentBody', $context, $blocks);
    }

    // line 46
    public function block_contentTitle($context, array $blocks = array())
    {
    }

    // line 47
    public function block_contentBody($context, array $blocks = array())
    {
    }

    // line 50
    public function block_javascripts($context, array $blocks = array())
    {
        // line 51
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
<script type=\"text/javascript\">
\$(document).ready(function() {
    \$( \".accordion\" ).accordion({
        heightStyle: \"content\",
        autoHeight: false,
        navigation: true,
        collapsible: true,
        active: getActiveIndex()
    });
});

function getActiveIndex() {
    var ul = document.getElementById('breadcrumb');
    var lis = ul.getElementsByTagName('li');
    if (lis.length > 1) {
        var li = lis[1];
        if (li.dataset.header === undefined) {
            return false;
        }
        var i = parseInt(li.dataset.header);
        return i;
    }
    return false;
}
var ul = document.getElementById('breadcrumb');
var lis = ul.getElementsByTagName('li');
if (lis.length == 1) {
    var spans = lis[0].getElementsByTagName(\"span\");
    for (var i = 0; i < spans.length; i++) {
        if ('divider' === spans[i].className) {
            spans[i].style.display = 'none';
        }
    }
}

\$('.accordion a').each(function(){
    var href= \$(this).attr('href');
    var url = document.location.toString();
    if(url.match(href+\"\$\") == href) {
        \$(this).addClass('active');
    }
});

</script>
";
    }

    public function getTemplateName()
    {
        return "CaesarAdminBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 51,  149 => 50,  144 => 47,  139 => 46,  135 => 47,  130 => 46,  127 => 45,  118 => 38,  113 => 35,  109 => 33,  104 => 30,  98 => 27,  94 => 26,  89 => 24,  83 => 21,  79 => 20,  74 => 18,  68 => 15,  64 => 14,  60 => 13,  55 => 11,  50 => 8,  47 => 7,  41 => 4,  36 => 3,  33 => 2,  34 => 6,  29 => 3,);
    }
}
