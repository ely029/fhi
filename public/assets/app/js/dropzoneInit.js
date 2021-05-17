
jQuery( document ).ready(function( $ ) {
    var previewNode = document.querySelector("#gallery-container");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        const dropZone = $("#dropzoneDragArea").dropzone({
        url: "null",
        maxFileSize: 10000000,
        uploadMultiple: true,
        thumbnailWidth: 800,
        thumbnailHeight: 800,
        acceptedFiles: "image/*",
        init: function() {
            // this.on("maxfilesexceeded", function(file){
            //     this.removeFile(file);
            // });
            this.on("addedfiles", function(files) {
                //console.log('FILES: '+this.files);
                $.each(this.files,function(key, value){
                    // let input = '<input type="file" name="attachments[]" class="attachment-uploads" id="attachments-'+key+'">';
                    // $("#file-uploads").append(input);
                    // $("#attachments-"+key).prop('files',);
                });
                $("#attachments").prop('files',files);
            });
            
            this.on("addedfile", function(files){
                var ext = files.name.split('.').pop();
                if(ext == 'docx' || ext == 'doc') {
                    $('.image--gallery').last().attr('src', '../assets/app/img/docx.png');
                }
                if(ext == 'pdf') {
                    $('.image--gallery').last().attr('src', '../assets/app/img/pdf.png');
                }
                if(ext == 'xlsx' || ext == 'xls' || ext == 'csv') {
                    $('.image--gallery').last().attr('src', '../assets/app/img/excel.png');
                }
                $('.gallery__text--filename').last().html(files.name);
                if (files.size >= 10000000) {
                    alert('You had reached max file size');
                    this.removeFile(files);
                }
            });
            // this.on("removedfile", function(file) {
        
            //     let oldInput =  $("#attachments");
            //     oldInput.replaceWith(oldInput.val('').clone(true));
            //     console.log('files: '+this.files);

            //     $("#attachments").prop('files',fileList);
    
            // });
        },
        previewTemplate: previewTemplate,
        previewsContainer: "#gallery-preview",
        clickable: ".gallery",
        });

});