var previewNode = document.querySelector("#gallery-container");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);
        
        $("#dropzoneDragArea").dropzone({
        url: "null",
        maxFileSize: 10,
        uploadMultiple: true,
        thumbnailWidth: 800,
        thumbnailHeight: 800,
        acceptedFiles: "image/*",
        init: function() {
            this.on("maxfilesexceeded", function(file){
            this.removeFile(file);
            });
        },
        previewTemplate: previewTemplate,
        previewsContainer: "#gallery-preview",
        clickable: ".gallery",
        });