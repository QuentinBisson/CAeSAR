function fillForm(format) {
    var prefix = "caesar_tagBundle_tagFormattingType_";
    for(var key in format) {
        if(format.hasOwnProperty(key))
            $('input[id='+prefix+key+']').val(format[key]);
    }
}

/* Pagination */
$(document).ready(function() {
    $("select.format-selection").change(function(e){
        var url = $('input.format-url').attr('value');
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
        e.preventDefault();
        return false; // Empêche la redirection normale
    });
});