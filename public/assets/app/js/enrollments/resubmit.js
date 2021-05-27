jQuery( document ).ready(function( $ ) {
    let isStep1Clicked = false;
    $(".step-1").click(function(){
        if(isStep1Clicked){
            return;
        }
        let bacteriologicalStatus = JSON.parse($("#bacteriological_status").val());
        let dstFromOtherLab = JSON.parse($("#dst_other_lab").val());

        let clicked = [];
        let xpertmtb = [];
        let xpertmtb_ultra = [];
        let trunat_tb = [];
        let lpa = [];
        let smear_mic = [];
        let tb_lamp = [];
        let tb_culture = [];
        let dst = [];
        let others = [];
        let dstOtherLab = [];
        $.each(bacteriologicalStatus, function(key, value){
            if(value.name == 'Xpert MTB/RIF'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll1").trigger('click');
                }
                xpertmtb.push(value);
            }
            if(value.name == 'Xpert MTB/RIF ULTRA'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll2").trigger('click');
                }
                xpertmtb_ultra.push(value);
            }
            if(value.name == 'Truenat TB'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll3").trigger('click');
                }
                trunat_tb.push(value);
            }
            if(value.name == 'Truenat TB'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll3").trigger('click');
                }
                trunat_tb.push(value);
            }
            if(value.name == 'Line Probe Assay (LPA)'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll4").trigger('click');
                }
                lpa.push(value);
            }
            if(value.name == 'Smear Microscopy'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll5").trigger('click');
                }
                smear_mic.push(value);
            }
            if(value.name == 'TB Loop-Mediated Isothermal Amplification (TB-LAMP)'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll6").trigger('click');
                }
                tb_lamp.push(value);
            }
            if(value.name == 'TB Culture'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll8").trigger('click');
                }
                tb_culture.push(value);
            }
            if(value.name == 'Drug Susceptibility Test (DST)'){
                if(!clicked[value.name]){
                    clicked[value.name] = true;
                    $("#js-toggle-enroll9").trigger('click');
                }
                dst.push(value);
            }

            if(value.name.startsWith('Others')){
                if(!clicked['Others']){
                    clicked['Others'] = true;
                    $("#js-toggle-enroll10").trigger('click');
                }
                others.push(value);
            }
        });

        $.each(dstFromOtherLab, function(key, value){
            if(!clicked[value.name]){
                clicked[value.name] = true;
                $("#js-toggle-enroll11").trigger('click');
            }
            dstOtherLab.push(value);

        });


        if(xpertmtb.length > 1){
            $("#js-add-section1").trigger('click');
        }
        if(xpertmtb_ultra.length > 1){
            $("#js-add-section2").trigger('click');
        }
        if(trunat_tb.length > 1){
            $("#js-add-section3").trigger('click');
        }
        if(lpa.length > 1){
            $("#js-add-section4").trigger('click');
        }
        if(smear_mic.length > 1){
            $("#js-add-section5").trigger('click');
        }
        if(tb_lamp.length > 1){
            $("#js-add-section6").trigger('click');
        }
        if(tb_culture.length > 1){
            $("#js-add-section8").trigger('click');
        }
        if(dst.length > 1){
            $("#js-add-section9").trigger('click');
        }
        if(others.length > 1){
            $("#js-add-section10").trigger('click');
        }

        if(dstOtherLab.length > 1){
            $("#js-add-section11").trigger('click');
        }

        // xpertmtb
        $("input[name='xpert_mtb_rif-date_collected[]']")
            .map(function(key) {
                if(xpertmtb[key])
                {
                    return $(this).val(xpertmtb[key].date_collected);
                }
          
            });

        $("input[name='xpert_mtb_rif-name_of_laboratory[]']")
            .map(function(key) {
                if(xpertmtb[key])
                {
                    return $(this).val(xpertmtb[key].name_of_laboratory);
                }
               
        });

        $("select[name='xpert_mtb_rif-result[]']")
            .map(function(key) {
                if(xpertmtb[key])
                {
                    return $(this).val(xpertmtb[key].result);
                }
  
        });
        // xpertmtb_ultra
        $("input[name='xpert_mtb_rif_ultra-date_collected[]']")
            .map(function(key) {
                if(xpertmtb_ultra[key])
                {
                     return $(this).val(xpertmtb_ultra[key].date_collected);
                }
               
            });

        $("input[name='xpert_mtb_rif_ultra-name_of_laboratory[]']")
            .map(function(key) {
                if(xpertmtb_ultra[key])
                {
                    return $(this).val(xpertmtb_ultra[key].name_of_laboratory);
                }
       
        });

        $("select[name='xpert_mtb_rif_ultra-result[]']")
            .map(function(key) {
                if(xpertmtb_ultra[key])
                {
                    return $(this).val(xpertmtb_ultra[key].result);
                }
              
        });
        // trunat tb
        $("input[name='truenat_tb-date_collected[]']")
            .map(function(key) {
                if(trunat_tb[key])
                {
                    return $(this).val(trunat_tb[key].date_collected);
                }
            });

        $("input[name='truenat_tb-name_of_laboratory[]']")
            .map(function(key) {
                if(trunat_tb[key])
                {
                    return $(this).val(trunat_tb[key].name_of_laboratory);
                }
                
        });

        $("select[name='truenat_tb-result[]']")
            .map(function(key) {
                if(trunat_tb[key])
                {
                    return $(this).val(trunat_tb[key].result);
                }
        });
        //lpa
        $("input[name='lpa-date_collected[]']")
            .map(function(key) {
                if(lpa[key])
                {
                    return $(this).val(lpa[key].date_collected);
                }

      
            });

        $("input[name='lpa-name_of_laboratory[]']")
            .map(function(key) {
                if(lpa[key]){
                     return $(this).val(lpa[key].name_of_laboratory);
                }
               
        });

        $("input[name='lpa-0-result[]']")
        .map(function(key) {
            if(lpa[0]){
                if(lpa[0].result.includes($(this).val())){
                    return $(this).prop('checked', true).removeAttr('required');
                }else{
                    return $(this).removeAttr('required');
                }
            }
        });
        if(lpa.length > 1){
            $("input[name='lpa-1-result[]']")
            .map(function(key) {
                if(lpa[1]){
                    if(lpa[1].result.includes($(this).val())){
                        return $(this).prop('checked', true).removeAttr('required');
                    }else{
                        return $(this).removeAttr('required');
                    }
                }
            });
        }
       

        // $("select[name='lpa-result[]']")
        //     .map(function(key) {
        //         return $(this).val(trunat_tb[key].result);
        // });
        // smear mic
        $("input[name='smear_mic-date_collected[]']")
            .map(function(key) {
               if(smear_mic[key])
               {
                    return $(this).val(smear_mic[key].date_collected);
               }
  
            });

        $("input[name='smear_mic-name_of_laboratory[]']")
            .map(function(key) {
                if(smear_mic[key])
                {
                    return $(this).val(smear_mic[key].name_of_laboratory);
                }
         
        });

        $("select[name='smear_mic-result[]']")
            .map(function(key) {
                if(smear_mic[key])
                {
                    return $(this).val(smear_mic[key].result);
                }
              
        });

        // tb lamp
        $("input[name='tb_lamp-date_collected[]']")
            .map(function(key) {
                if(tb_lamp[key])
                {
                    return $(this).val(tb_lamp[key].date_collected);
                }
              
            });

        $("input[name='tb_lamp-name_of_laboratory[]']")
            .map(function(key) {
                if(tb_lamp[key])
                {
                    return $(this).val(tb_lamp[key].name_of_laboratory);
                }

                
        });

        $("select[name='tb_lamp-result[]']")
            .map(function(key) {
                if(tb_lamp[key])
                {
                    return $(this).val(tb_lamp[key].result);
                }
               
        });

        // tb culture
        $("input[name='tb_culture-date_collected[]']")
            .map(function(key) {
                if(tb_culture[key]){
                    return $(this).val(tb_culture[key].date_collected);
                }
                
            });

        $("input[name='tb_culture-name_of_laboratory[]']")
            .map(function(key) {
                if(tb_culture[key])
                {
                    return $(this).val(tb_culture[key].name_of_laboratory);
                }
         
        });

        $("select[name='tb_culture-result[]']")
            .map(function(key) {
                if(tb_culture[key])
                {
                    return $(this).val(tb_culture[key].result);
                }

                
        });

        // dst
        $("input[name='dst-date_collected[]']")
            .map(function(key) {
               if(dst[key]){
                   return $(this).val(dst[key].date_collected);
               }
                
            });

        $("input[name='dst-name_of_laboratory[]']")
            .map(function(key) {
                if(dst[key]){
                    return $(this).val(dst[key].name_of_laboratory);
                }
              
        });

        $("select[name='dst-result[]']")
            .map(function(key) {
                if(dst[key]){
                    if(dst[key].result.startsWith('OTHERS')){
                        $(this).val('Other (please specify)');

                        $(this).trigger('change');

                        $(this).parent().find('.dst-other').val(dst[key].result);
                        return;
                      
                    }
                    return $(this).val(dst[key].result);
                }
                
        });

        // others
        $("input[name='others-date_collected[]']")
            .map(function(key) {
               if(others[key]){
                    return $(this).val(others[key].date_collected);
               }
                
            });

        $("input[name='others-specify[]']")
            .map(function(key) {
                if(others[key]){
                    return $(this).val(others[key].name.substr(7));
                }
                
            });

        $("input[name='others-name_of_laboratory[]']")
            .map(function(key) {
                if(others[key]){
                    return $(this).val(others[key].name_of_laboratory);
                }
                
        });

        $("input[name='others-result[]']")
            .map(function(key) {
                if(others[key]){
                    return $(this).val(others[key].result);
                }
              
        });

         // dst from other lab
         $("input[name='dst_from_other_lab-date_collected[]']")
         .map(function(key) {
            if(dstOtherLab[key]){
                return $(this).val(dstOtherLab[key].date_collected);
            }
          
         });

        $("input[name='dst_from_other_lab-name_of_laboratory[]']")
            .map(function(key) {
                if(dstOtherLab[key]){
                    return $(this).val(dstOtherLab[key].name_of_laboratory);
                }
                
            });

        $("input[name='dst_from_other_lab-result[]']")
            .map(function(key) {
                if(dstOtherLab[key]){
                    return $(this).val(dstOtherLab[key].result);
                }
                
        });

        isStep1Clicked = true;
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

    let toRemoveAttachments = [];
    $(".remove-attachment").on('click', function(){
        toRemoveAttachments.push($(this).data('filename'));
        $(".exist-attach-"+$(this).data('key')).remove();
        $("#attachments-to-remove").val(JSON.stringify(toRemoveAttachments));
    });

});
