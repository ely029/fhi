// $.noConflict();
jQuery( document ).ready(function( $ ) {
    $("input[type='date']").addClass('form__input--date').attr('type', 'text');
    $(".form__input--date").datepicker({
        changeMonth: true,
        changeYear: true,
        maxDate:0,
        yearRange: '-100:+0',
        dateFormat: 'mm/dd/yy',
        buttonImageOnly: true
    });

    // $('.datepicker').keydown(function(e) {
    //     e.preventDefault();
    //     return false;
    //  });
    // $("input[type='date']").on("change", function() {
    //     this.setAttribute(
    //         "data-date",
    //         moment(this.value, "DD-MM-YYYY")
    //         .format( this.getAttribute("data-date-format") )
    //     )
    // }).trigger("change")
});