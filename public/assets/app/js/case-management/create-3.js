jQuery('document').ready(function($){
$('#itr_drugs_1').hide();
$('#others_1').hide();
    $('#suggested_regimen').change(function(){
            if ($('#suggested_regimen').val() === 'ITR') {
                $('#itr_drugs_1').show();
                $('#others_1').hide();
            }

            if ($('#suggested_regimen').val() === 'Other (Specify)') {
                $('#others_1').show();
                $('#itr_drugs_1').hide();
            }
    });
});