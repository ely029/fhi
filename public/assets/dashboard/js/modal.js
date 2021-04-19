$('document').ready(function(){

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
    });
});