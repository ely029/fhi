jQuery('document').ready(function($){

    $("#itr_drugs_current_regiment").hide();
    $("#others_current_regiment").hide();
    $("#current_regiment").change(function(){
        alert($('#current_regiment').val());
        if ($('#current_regiment').val() === 'ITR') {
            $('#itr_drugs_current_regiment').show().find('input').attr('required', true);
            $('#others_current_regiment').hide().find('input').removeAttr('required', true);
        }

        else if ($('#current_regiment').val() === 'Other (Specify)') {
            $('#others_current_regiment').show().find('input').attr('required', true);
            $('#itr_drugs_current_regiment').hide().find('input').removeAttr('required', true);
        }

        else{
            $('#itr_drugs_current_regiment').hide().find('input').removeAttr('required');
            $('#others_current_regiment').hide().find('input').removeAttr('required');
        }
    });
});