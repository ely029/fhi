jQuery( document ).ready(function( $ ) {
    $("#suggested-regimen").on('change', function(){
    
        if($(this).val() == 'ITR'){
           $(".itr-drugs").show().find('input').attr('required', true).attr('name','suggested_regimen');
           $(".other-regimen").hide().find('input').removeAttr('required').removeAttr('name');
        }else if($(this).val() == 'Other (specify)'){

            $(".other-regimen").show().find('input').attr('required',true).attr('name','suggested_regimen');
            $(".itr-drugs").hide().find('input').removeAttr('required').removeAttr('name');
        }
        else{
            $(".itr-drugs").hide().find('input').removeAttr('required').removeAttr('name');
            $(".other-regimen").hide().find('input').removeAttr('required').removeAttr('name');
        }
    });

    $("#enrollment-form").submit(function(){
        let suggestedRegimen = $("#suggested-regimen").val();
       
        if(suggestedRegimen == 'ITR'){
            let drugsGiven = $("#drugs_given").val();
            $("#drugs_given").val('ITR-'+drugsGiven);
        }else if(suggestedRegimen == 'Other (specify)'){
            let othersSpecify = $("#others_specify").val();
            $("#others_specify").val('Others-'+othersSpecify);
        }


        if($(".other-cxr").is(":checked")){
            let otherCxr = $("#other-cxr").val();
            $("#other-cxr").val('Other-'+otherCxr);
        }

        $('.button--next').prop('disabled', true);
    });

});


