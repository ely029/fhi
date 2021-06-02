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

        $(".hasDatepicker")
            .map(function(key) {
                if($(this).val()){
                    var d = new Date($(this).val());
                   
                    newFormat = [
                        d.getFullYear(),
                        ('0' + (d.getMonth() + 1)).slice(-2),
                        ('0' + d.getDate()).slice(-2)
                      ].join('-');
                      $(this).val(newFormat);
                }
        });

        $('.button--next').prop('disabled', true);
    });

});


