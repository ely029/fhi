
$.noConflict();
jQuery( document ).ready(function( $ ) {
    $('.logout-button').click(function () {
        $('#logout-form').submit();
    })
});