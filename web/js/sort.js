function click_sort(e) {
    $.blockUI({
        message: '<h1 style="color:white">' + message + '</h1>',
        css: {backgroundColor :'black', color: 'white'}
        });
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
            
    window.history.pushState('state', 'page', url);
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        success: function(data){
            $('#table_list').html(data);
            $.unblockUI();
        }
    });
    e.preventDefault();
    return false;
}

$('.table > thead > tr > th a').click(click_sort);