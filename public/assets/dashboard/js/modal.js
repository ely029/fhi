// $.noConflict();
jQuery( document ).ready(function( $ ) {

    $('.create-recom').click(function(){
        $('#create-recom').modal('show');
    });

    $('#refer-button').click(function(){
            if ($('#refer').val() == '1') {
                $('#refer-to-regional').modal('show');
            }

            if ($('#refer').val() == '2') {
                $('#not-for-referal').modal('show');
            }

            if ($('#refer').val() == '3') {
                $('#not-for-recommended-for-enrolment').modal('show');
            }

            if ($('#refer').val() == '4') {
                $('#recommended-for-enrolment').modal('show');
            }

            if ($('#refer').val() == '5') {
                $('#need-further-details').modal('show');
            }

            if ($('#refer').val() == '6') {
                $('#for-enrolment').modal('show');
            }

            if ($('#refer').val() == '7') {
                $('#not-for-enrolment').modal('show');
            }

            if ($('#refer').val() == '8') {
                $('#need-further-details').modal('show');
            }

            if ($('#refer').val() == '9') {
                $('#refer-to-ntbmac').modal('show');
            }

            if ($('#refer').val() == '10') {
                $('#enrolled').modal('show');
            }
            if ($('#refer').val() == '11') {
                $('#not-enrolled').modal('show');
            }
            // for resubmit enrollment option
            if($('#refer').val() == 'Resubmit Enrollment') {
                $("#resubmit-enrollment-modal").modal('show');
            }

            if ($('#refer').val() == 'recommend_further_details') {
                $('#recommend-need-further-details').modal('show');
            }

            if($('#refer').val() == 'Resolved' || $('#refer').val() == 'Not resolved')
            {
                $("#ntb-chair-text").text($("#refer").val());
                $("#ntbmac-chair-modal").find('.modal__title').html($("#refer").val());
                $("#ntbmac-chair-modal").find("input[name='status']").val($("#refer").val());
                $("#ntbmac-chair-modal").modal('show');
            }
    });


    let recommendationModal = $("#recommendation-successful");
    if(recommendationModal.length > 0){
        recommendationModal.modal('show');
    }

});