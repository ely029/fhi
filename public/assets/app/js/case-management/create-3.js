jQuery('document').ready(function($){
$('#itr_drugs_1').hide();
$('#others_1').hide();
    $('#suggested_regimen').change(function(){
            if ($('#suggested_regimen').val() === 'ITR') {
                $('#itr_drugs_1').show().find('input').attr('required', true);
                $('#others_1').hide().find('input').removeAttr('required', true);
            }

            else if ($('#suggested_regimen').val() === 'Other (Specify)') {
                $('#others_1').show().find('input').attr('required', true);
                $('#itr_drugs_1').hide().find('input').removeAttr('required', true);
            }

            else{
                $('#itr_drugs_1').hide().find('input').removeAttr('required');
                $('#others_1').hide().find('input').removeAttr('required');
            }
    });
});