jQuery( document ).ready(function( $ ) {

    $(".step-1").click(function(){
        let bacteriologicalStatus = JSON.parse($("#bacteriological_status").val());

        let clicked = [];
        let xpertmtb = [];
        $.each(bacteriologicalStatus, function(key, value){
            if(value.name == 'Xpert MTB/RIF'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll1").trigger('click');
                }
                xpertmtb.push(value);
            }
        });

        if(xpertmtb.length > 1){
            $("#js-add-section1").trigger('click');
        }
        $.each(xpertmtb, function(key, value){
            
        });
    });
   


    let registrationGroup = $("#registration_group").val();
    let riskFactor = $("#risk_factor").val();
    let drugSusceptibility = $("#drug_susceptibility").val();
    let suggestedRegimen = $("#suggested_regimen").val();

    if(suggestedRegimen.startsWith('ITR')){
        itrDrugs = suggestedRegimen.substr(4);
        suggestedRegimen = suggestedRegimen.substr(0,3);

        $(".itr-drugs").show().find('input').attr('required', true).attr('name','suggested_regimen').val(itrDrugs);
    }
    if(suggestedRegimen.startsWith('Others')){
        specify = suggestedRegimen.substr(7);
        suggestedRegimen = 'Other (specify)';

        $(".other-regimen").show().find('input').attr('required',true).attr('name','suggested_regimen').val(specify);
    }

    $("#registration-group-select option").each(function(i){
        if($(this).val() == registrationGroup){
            $(this).prop("selected", true);
            return false;
        };
    });
    $("#risk_factor-select option").each(function(i){

        if($(this).val() == riskFactor){
            $(this).prop("selected", true);
            return false;
        };
    });

    $("#drug_susceptibility-select option").each(function(i){

        if($(this).val() == drugSusceptibility){
            $(this).prop("selected", true);
            return false;
        };
    });

    $("#suggested-regimen option").each(function(i){

        if($(this).val() == suggestedRegimen){
            $(this).prop("selected", true);
            return false;
        };
    });

    let otherCxrField = $("#otherCxrField").val();
    if(otherCxrField){
        $(".other-cxr-field").show();
    }



});
