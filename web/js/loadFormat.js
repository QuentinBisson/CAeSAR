function fillForm(format) {
    var prefix = "caesar_tagBundle_tagFormattingType_";
    for (var key in format) {
        if (format.hasOwnProperty(key)) {
            $('input[id=' + prefix + key + ']').val(format[key]);
            $('label[id=' + key + ']').text(format[key]);
        }
    }
}