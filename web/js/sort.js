function click_sort(e) {
    var url = this.href;
    var src = $(this).children("img").attr("src");
    var idx = src.indexOf('.png');
    $(".table > thead > tr > th a").each(function() {
        var s = $(this).children('img').attr('src');
        s = s.replace('-active', "");
        $(this).children('img').attr('src', s);
        $(this).unbind('click');
        $(this).bind('click', click_sort);
    });
    src = src.slice(0, idx) + "-active" + src.slice(idx);
    $(this).children("img").attr("src", src);
    $(this).unbind('click');
    $(this).bind('click', function(e){
        e.preventDefault();
    });     
            
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        success: function(data){
            $('#table_list').html(data);
            window.history.pushState('state', 'page', url);
        }
    });
    e.preventDefault();
    return false;
}

$('.table > thead > tr > th a').click(click_sort);

/* Pagination */
$(document).ready(function() {
    $("._pagination").click(function(e) {
        window.history.pushState('state', 'page',  $(this).attr('href'));
        $(".navigation a").each(function() {
            $(this).removeClass('active');
        });
        var elem = $(this);
        $.ajax({
            type: "POST",
            url: elem.attr('href'),
            cache: false,
            success: function(data){
                $('#table_list').html(data);
                elem.addClass('active');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#table_list').html('Une erreur est survenue');
            }
        });
        e.preventDefault();
        return false; // Empêche la redirection normale
    });
});