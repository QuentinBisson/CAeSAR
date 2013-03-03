function click_generate(e) {
    var url = $("#generator-url").attr('value');
            
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        success: function(data){
            $('.colonnes').html(data);
        }
    });
    e.preventDefault();
    return false;
}

/* Pagination */
$(document).ready(function() {
   
    $("#generator").click(click_generate);
});