$(document).ready(function() {

    // <editor-fold defaultstate="collapsed" desc="Fonctions globales">
    function addAjaxLoading(element, id) {
        var loadingImage = $('#loading-image-path').attr('value');
        element.parent('div').append('<img id="' + id + '" src="' + loadingImage + '" alt="loading" />');
    }

    function eraseLocal() {
        document.getElementById("caesar_resourceBundle_resourceType_local").value = "";
    }
    function eraseURL() {
        document.getElementById("caesar_resourceBundle_resourceType_url").value = "";
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Chargement de l'image">
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; i < files.length; i++) {
            f = files[i];
            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var img = document.getElementById('resource-img');
                    img.src = e.target.result;
                    document.getElementById('caesar_resourceBundle_resourceType_path').value = e.target.result;
                    img.title = escape(theFile.name);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('caesar_resourceBundle_resourceType_local').addEventListener('change', handleFileSelect, false);
    document.getElementById("caesar_resourceBundle_resourceType_url").addEventListener('click', eraseURL);
    document.getElementById('apply-image').addEventListener('click', function() {
        var a = document.getElementById('caesar_resourceBundle_resourceType_url');
        eraseLocal();
        var img = document.getElementById('resource-img');
        img.src = a.value;
        document.getElementById('caesar_resourceBundle_resourceType_path').value = a.value;
    }, false);
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Webmining">
    var webmining = false;
    var disabled = false;

    function isWebminingPossible() {
        var code = $('.resource-code').val();
        if (code === "" || !isValidIsbn(code)) {
            disabled = true;
            $("a.web-mining-button").removeClass("bubble-button");
            $("a.web-mining-button").addClass("disabled-webmining-button");
        } else {
            $("a.web-mining-button").addClass("bubble-button");
            $("a.web-mining-button").removeClass("disabled-webmining-button");
            disabled = false;
        }
    }
    $('.resource-code').keyup(isWebminingPossible);
    isWebminingPossible();

    //On cache la fenêtre modale si on appuie sur le bouton close.
    $(".btn").click(function(e) {
        $("#modal").removeClass("modal-visible");
        e.preventDefault();
        return false;
    });

    $('.web-mining-button').hover(function() {
        if (!$('a.web-mining-button').hasClass('disabled-webmining-button')) {
            $(".web-mining-to-color").addClass('notify-web-mining');
            $(".web-mining-to-color").removeClass('unnotify-web-mining');
        }
    }, function() {
        $(".web-mining-to-color").removeClass('notify-web-mining');
        $(".web-mining-to-color").addClass('unnotify-web-mining');
    });

    $("a.web-mining-button").on('click.webmining', function(e) {
        if (webmining || disabled) {
            return;
        }
        webmining = true;
        addAjaxLoading($('a.web-mining-button'), 'loading-webmining');
        $("a.web-mining-button").addClass("disabled-webmining-button");
        $("a.web-mining-button").removeClass("bubble-button");
        var url = $('.webmining-url').attr('value');
        url += '/' + $('.resource-code').val();
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(json) {
                var resource = JSON && JSON.parse(json) || $.parseJSON(json);
                if (resource.description.length === 0) {
                    $(".web-mining-image-url").attr('value', "");
                    $(".web-mining-description").val("");
                    $("#modal").addClass("modal-visible");
                } else {
                    $(".web-mining-image-url").attr('value', resource.image);
                    $(".web-mining-description").val(resource.description);
                }
                $(".web-mining-long-description").text(resource.longDescription.replace(/\\r\\n/g, '\r\n'));

                $("a.web-mining-button").removeClass("disabled-webmining-button");
                $("a.web-mining-button").addClass("bubble-button");
                if ($('#apply-image').attr('value') !== "") {
                    $('#apply-image').click();
                } else {
                    document.getElementById('caesar_resourceBundle_resourceType_path').value = "";
                }
                $('#loading-webmining').remove();
                webmining = false;
            },
            error: function() {
                $("a.web-mining-button").removeClass("disabled-webmining-button");
                $("a.web-mining-button").addClass("bubble-button");
                $('#loading-webmining').remove();
                webmining = false;
            }
        });

        e.preventDefault();
        return false;
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Skeleton">
    $("#clearSkeleton").on('click', function(e) {
        var url = $('.empty-skeleton-url').attr('value');
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(skeleton) {
                $(".web-mining-long-description").text(skeleton.replace(/\\r\\n/g, '\r\n'));
            }
        });

        e.preventDefault();
        return false;
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Chargement description emplacement">
    var onChange = false;
    $("select.shelf-selection").change(function(e) {
        if (!onChange) {
            onChange = true;
            addAjaxLoading($('.shelf-selection'), 'loading-description');
            var url = $('.shelf-description-url').attr('value');
            url += '/' + $(this).find(":selected").attr('value');
            $.ajax({
                type: "POST",
                url: url,
                cache: false,
                success: function(data) {
                    $('.shelf-description').html(data);
                    $('.shelf-description').css('display', 'block');
                    $('#loading-description').remove();
                    onChange = false;
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.shelf-description').css('display', 'none');
                    $('#loading-description').remove();
                    onChange = false;
                }
            });
        }
        e.preventDefault();
        return false;
    });

    // </editor-fold>
});