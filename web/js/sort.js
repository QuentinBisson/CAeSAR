function click_sort(e) {
    var url = this.href;
    var form = $('form');
    var data = '';
    if (form !== null) {
        form.attr('action', url);
        data = $("#serialize-request").val();
    }

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(data) {
			if (window.history && window.history.pushState) {
				window.history.pushState('state', 'page', url);
			}
            onSuccessAjaxRequest(data, url);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $('.contentBody').html('Une erreur est survenue');
        }
    });
    e.preventDefault();
    return false;
}

function click_paginate(e) {
	if (window.history && window.history.pushState) {
    	window.history.pushState('state', 'page', $(this).attr('href'));
	}
    $(".navigation a").each(function() {
        $(this).removeClass('active');
    });
    var elem = $(this);
    var form = $('form');
    var url = elem.attr('href');
    var data = '';
    if (form !== null) {
        form.attr('action', url);
        data = $("#serialize-request").val();
    }

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(data) {
            elem.addClass('active');
			if (window.history && window.history.pushState) {
    			window.history.pushState('state', 'page', url);
			}
            onSuccessAjaxRequest(data, url);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $('.contentBody').html('Une erreur est survenue');
        }
    });
    e.preventDefault();
    return false; // Empêche la redirection normale
}

function onSuccessAjaxRequest(data, url) {
    $('.contentBody').html(data);
    $(".sort-link").each(function() {
        $(this).bind('click', click_sort);
        if (url.match($(this).attr('href') + '$')) {
            var src = $(this).children("img").attr("src");
            var idx = src.indexOf('.png');
            src = src.slice(0, idx) + "-active" + src.slice(idx);
            $(this).children("img").attr("src", src);
            $(this).unbind('click');
            $(this).bind('click', function(e) {
                e.preventDefault();
            });
        }
    });
}

function form_submit(e) {
    var elem = $(this);
    var url = elem.attr('action');
    var data = elem.serialize();
    $("#serialize-request").val(data);
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false,
        success: function(data) {
            onSuccessAjaxRequest(data, url);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $('.contentBody').html('Une erreur est survenue');
        }
    });
    e.preventDefault();
    return false; // Empêche la redirection normale
}

/* Pagination */
$(document).ready(function() {
    var bool = false;
    $(".sort-link").each(function() {
        $(this).bind('click', click_sort);
        var url = document.location.href;
        if (url.match($(this).attr('href') + '$')) {
            bool = true;
            var src = $(this).children("img").attr("src");
            var idx = src.indexOf('.png');
            src = src.slice(0, idx) + "-active" + src.slice(idx);
            $(this).children("img").attr("src", src);
            $(this).unbind('click');
            $(this).bind('click', function(e) {
                e.preventDefault();
            });
        }
    });
    if (bool === false) {
        var elem = $('table > thead th:first-child a.sort-up');
        var src = elem.children("img").attr("src");
        var idx = src.indexOf('.png');
        src = src.slice(0, idx) + "-active" + src.slice(idx);
        elem.children("img").attr("src", src);
        elem.unbind('click');
        elem.bind('click', function(e) {
            e.preventDefault();
        });
    }
    $("._pagination").click(click_paginate);
    $("form").submit(form_submit);
    $(window).unload(function() {
        $("#serialize-request").val("");
    })
});
