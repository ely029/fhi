// $.noConflict();
jQuery( document ).ready(function( $ ) {
    $("input[type='date']").addClass('datepicker').attr('type', 'text');
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate:0,
        buttonImageOnly: true
    });
    // $("input[type='date']").on("change", function() {
    //     this.setAttribute(
    //         "data-date",
    //         moment(this.value, "DD-MM-YYYY")
    //         .format( this.getAttribute("data-date-format") )
    //     )
    // }).trigger("change")
});