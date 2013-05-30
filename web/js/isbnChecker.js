function isValidIsbn(text) {
    var length, j = 0, k;
    text = text.replace(/-/g, "");
    length = text.length;
    switch (length) {
        case 10:
            k = length;
            for (var i = 0; i < 9; i++) {
                j += parseInt(text.charAt(i)) * k;
                k--;
            }
            var t = text.charAt(9).toUpperCase();
            j += t === "X" ? 10 : parseInt(t);
            return j % 11 === 0;
            break;
        case 13:
            k = -1;
            for (var i = 0; i < length; i++) {
                j += parseInt(text.charAt(i)) * (2 + k);
                k *= -1;
            }
            return j % 10 === 0;
            break;
    }
    return false;
}