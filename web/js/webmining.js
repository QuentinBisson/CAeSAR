$(document).ready(function() {
    function webmining(e) {
        $("a.web-mining-button").click(function(e) {
            e.preventDefault();
        });
        $("a.web-mining-button").off('click.webmining', webmining);
        $("a.web-mining-button").addClass("disabled-webmining-button");
        var url = $('.webmining-url').attr('value');
        url += '/' + $('.resource-code').val();
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(json) {
                var resource = JSON && JSON.parse(json) || $.parseJSON(json);
                //TODO afficher message si aucun contenu
                $(".web-mining-image-url").attr('value', resource.image);
                $(".web-mining-description").val(resource.description);
                $(".web-mining-long-description").text(resource.longDescription.replace(/\\r\\n/g, '\r\n'));
                $("a.web-mining-button").on('click.webmining', webmining);
                $("a.web-mining-button").removeClass("disabled-webmining-button");
                if ($('#apply-image').attr('value') !== "") {
                    $('#apply-image').click();
                }
            },
            error: function() {
                $("a.web-mining-button").on('click.webmining', webmining);
                $("a.web-mining-button").removeClass("disabled-webmining-button");
            }
        });

        e.preventDefault();
        return false; // Empêche la redirection normale
    }

    function disableWebminingButton() {
        var code = $('.resource-code').val();
        if (code === "" || !isValidIsbn(code)) {
            $("a.web-mining-button").click(function(e) {
                e.preventDefault();
            });
            $("a.web-mining-button").addClass("disabled-webmining-button");
            $("a.web-mining-button").off('click.webmining', webmining);
        } else {
            $("a.web-mining-button").removeClass("disabled-webmining-button");
            $("a.web-mining-button").on('click.webmining', webmining);
        }
    }

    $('.resource-code').keyup(disableWebminingButton);

    var code = $('.resource-code').val();
    if (code === "" || !isValidIsbn(code)) {
        $("a.web-mining-button").click(function(e) {
            e.preventDefault();
        });
        $("a.web-mining-button").addClass("disabled-webmining-button");
        $("a.web-mining-button").addClass("disabled-webmining-button");
        $("a.web-mining-button").off('click.webmining', webmining);
    }

    $("a.web-mining-button").on('click.webmining', webmining);


    $("#clearSkeleton").on('click', function(e) {
        var url = $('.empty-skeleton-url').attr('value');
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(skeleton) {
                $(".web-mining-long-description").text(skeleton.replace(/\\r\\n/g, '\r\n'));
            },
            error: function() {
                $(".web-mining-long-description").text('Error');
            }
        });

        e.preventDefault();
        return false; // Empêche la redirection normale
    });
});