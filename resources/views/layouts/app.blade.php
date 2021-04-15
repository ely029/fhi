@extends('layouts.base')

@push('styles')

    <!-- Styles -->
    <link href="{{ asset('assets/app/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/app/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/css/dataTables.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css"> --}}
    @yield('additional_styles')
@endpush

@push('scripts')
    {{-- @TB: If you need custom scripts for dashboard place it in assets/dashboard/js/ --}}
    <script src="{{ asset('assets/app/js/app.js') }}"></script>
    <script src="{{ asset('assets/app/js/main.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/logout.js') }}"></script>
  
    @yield('additional_scripts')

    <script>
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
    </script>
@endpush
