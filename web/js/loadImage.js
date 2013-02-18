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

document.getElementById('caesar_resourceBundle_resourceType_local').addEventListener('change', handleFileSelect, false);

document.getElementById('caesar_resourceBundle_resourceType_url').addEventListener('keyup', function(){
    var img = document.getElementById('resource-img');
    img.src = this.value;
    document.getElementById('caesar_resourceBundle_resourceType_path').value = this.value;
}, false);