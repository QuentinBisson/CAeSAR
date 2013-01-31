function click_sort(e) {
    var url = this.href;
            
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        success: function(data){
            $('.contentBody').html(data);
            window.history.pushState('state', 'page', url);
            $("._pagination").click(click_paginate);
            $(".table > thead > tr > th a").each(function() {
                $(this).bind('click', click_sort);
                if (url.match($(this).attr('href')+'$')) {
                    var src = $(this).children("img").attr("src");
                    var idx = src.indexOf('.png');
                    src = src.slice(0, idx) + "-active" + src.slice(idx);
                    $(this).children("img").attr("src", src);
                    $(this).unbind('click');
                    $(this).bind('click', function(e){
                        e.preventDefault();
                    });    
                }
            });
        }
    });
    e.preventDefault();
    return false;
}

function click_paginate(e) {
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
            $('.contentBody').html(data);
            elem.addClass('active');
            $('.table > thead > tr > th a').click(click_sort);
            $("._pagination").click(click_paginate);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $('.contentBody').html('Une erreur est survenue');
            $('.table > thead > tr > th a').click(click_sort);
            $("._pagination").click(click_paginate);
        }
    });
    e.preventDefault();
    return false; // Empêche la redirection normale
}

/* Pagination */
$(document).ready(function() {
    var bool = false;
    $(".table > thead > tr > th a").each(function() {
        $(this).bind('click', click_sort);
        var url = document.location.href;
        if (url.match($(this).attr('href')+'$')) {
            bool = true;
            var src = $(this).children("img").attr("src");
            var idx = src.indexOf('.png');
            src = src.slice(0, idx) + "-active" + src.slice(idx);
            $(this).children("img").attr("src", src);
            $(this).unbind('click');
            $(this).bind('click', function(e){
                e.preventDefault();
            });    
        }
    });
    if (bool === false) {
        var elem = $('.table > thead th:first-child a.sort-up');
        var src = elem.children("img").attr("src");
        alert(src);
        var idx = src.indexOf('.png');
        src = src.slice(0, idx) + "-active" + src.slice(idx);
        elem.children("img").attr("src", src);
        elem.unbind('click');
        elem.bind('click', function(e){
            e.preventDefault();
        });    
    }
    $("._pagination").click(click_paginate);
});