
$(".gallery").dropzone({
    url: "../upload_files",
    maxFilesize: 1000,
    acceptedFiles: 'image/*',
    init: function () {
        var submit2 = document.getElementById('edit_property_data');
        if (this.getUploadingFiles().length != 0 && this.getQueuedFiles().length != 0) {
            submit2.disabled = true;
        }
        this.on("complete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                submit2.disabled = false;
            }
        });
        var thisDropzone = this;
        var id = $("#prop_id").val();
        var path = "../get_images/" + id
        $.getJSON(path, function (data) { // get the json response
            $.each(data, function (key, value) { //loop through it
                var mockFile = {name: value.name, size: value.size, customid: value.path, image_id: value.image_id};
                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                if (value.attachment_type == 1) {

                } else {
                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, value.path);//uploadsfolder is the folder where you have all those uploaded files
                }
                thisDropzone.emit("complete", mockFile);
                thisDropzone.files.push(mockFile);
            });

        });
        this.on('success', function (file, resp) {
        });
    },
    success: function (result, xhr) {
        var obj = jQuery.parseJSON(xhr);
        result.customid = obj.path;
        if (obj.type == 0) {
            $("#hiddenimages").append('<input type="hidden" name="images[]" value="' + obj.path + '">');
        } else {
            $("#hiddenimages").append('<input type="hidden" name="images[]" value="' + obj.path + '">');
        }
    },
    addRemoveLinks: true,
    removedfile: function (file) {
        var path = file.customid;
        var res = path.replace(base_url, '');
        $.ajax({
            type: 'POST',
            url: "../delete_files",
            data: {path: res},
            success: function (data) {
                $("#hiddenimages input[value='" + path + "']").remove();
            }
        });
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    },
    sending: function () {
        var submit2 = document.getElementById('edit_property_data');
        submit2.disabled = true;
    }
});
