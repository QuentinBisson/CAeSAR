function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                // Render thumbnail.
                var img = document.getElementById('resource-img');
                img.src = e.target.result;
                document.getElementById('caesar_resourceBundle_resourceType_path').value = e.target.result;
                img.title = escape(theFile.name);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }
}

function colorAndDisplayOnEnter() {
    $(".web-mining-to-color").addClass('notify-web-mining');
    $(".web-mining-to-color").removeClass('unnotify-web-mining');
}

function colorAndDisplayOnLeave() {
    $(".web-mining-to-color").removeClass('notify-web-mining');
    $(".web-mining-to-color").addClass('unnotify-web-mining');
}

function eraseLocal() {
    document.getElementById("caesar_resourceBundle_resourceType_local").value = "";
}
function eraseURL() {
    document.getElementById("caesar_resourceBundle_resourceType_url").value = "";
}
