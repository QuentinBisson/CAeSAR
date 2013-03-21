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
}

function colorAndDisplayOnLeave() {
    $(".web-mining-to-color").removeClass('notify-web-mining');
}

function eraseLocal(){
    document.getElementById("caesar_resourceBundle_resourceType_local").value="";
}
function eraseURL(){
    document.getElementById("caesar_resourceBundle_resourceType_url").value="";
}

/* Pagination */
$(document).ready(function() {
    $("select.shelf-selection").change(function(e){
        var url = $('.shelf-description-url').attr('value');
        url += '/' + $(this).find(":selected").attr('value');
        $.ajax({
            type: "POST",
            url: url,
            cache: false,
            success: function(data){
                $('.shelf-description').html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.shelf-description').html("");
            }
        });
        e.preventDefault();
        return false; // Empêche la redirection normale
    });

    document.getElementById('caesar_resourceBundle_resourceType_local').addEventListener('change', handleFileSelect, false);
    document.getElementById("caesar_resourceBundle_resourceType_local").addEventListener('click', eraseURL);
    document.getElementById('apply-image').addEventListener('click', function(){
        var a  = document.getElementById('caesar_resourceBundle_resourceType_url');
        eraseLocal();
        var img = document.getElementById('resource-img');
        img.src = a.value;
        document.getElementById('caesar_resourceBundle_resourceType_path').value = a.value;
    }, false);

    $('input.web-mining-button').hover(colorAndDisplayOnEnter, colorAndDisplayOnLeave);
});