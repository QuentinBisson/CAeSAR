function fillForm(format) {
    var prefix = "caesar_tagBundle_tagFormattingType_";
    for(var key in format) {
        if(format.hasOwnProperty(key)) {
            $('input[id='+prefix+key+']').val(format[key]);
            $('label[id='+key+']').text(format[key]);
        }
    }
}

/* Pagination */
$(document).ready(function() {
    $("select.format-selection").change(function(e){
        var url = $('input.format-url').attr('value');

        e.preventDefault();
        if ("" === $(this).find(":selected").attr('value')) {
            var form = document.getElementsByTagName("form")[0];
            var elements = form.elements;
            for (i = 0; i < elements.length; i++) {
                var field_type = elements[i].type.toLowerCase();
                switch (field_type) {
                    case "number":
                    case "text":
                        elements[i].value = "";
                        break;
                    default:
                        break;
                }
            }
            $('label.format-data').each(function() {
                $(this).text('');
            });
            return false;
        }

        url += '/' + $(this).find(":selected").attr('value');
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(data){
                var format = JSON.parse(data);
                fillForm(format);
            },
            error: function(xhr, ajaxOptions, thrownError) {
            }
        });

        return false; // Empêche la redirection normale
    });
});