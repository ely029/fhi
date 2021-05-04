// $.noConflict();
jQuery( document ).ready(function( $ ) {

    let currentStep = 1;
    let totalSteps = $("#steps").data('steps');
    // Code that uses jQuery's $ can follow here.
    $(".button--next").on('click', function(){

        if(currentStep == totalSteps){
            return;
        }
        
        if(checkForms()){

            if(currentStep == 1){
                return getPatientData();
            }

           nextStep();
        }
    
    });

    $("#proceedManually").on('click', function(){
        $("#is_from_itis").attr('name','is_from_itis');
        $("#noMatchModal").modal('hide');
        nextStep();
    });
    
    $(".button--back").on('click', function(){
        $('.step-'+currentStep).hide();
        currentStep--;
        $('.step-'+currentStep).show();
    });
    
    
    function checkForms()
    {
        let  elmForm = $(".form-step-" + currentStep);
    
        if(elmForm){
            elmForm.validator({
                focus: 0
            }).validator('validate');
            var elmErr = elmForm.children('.has-error');
            if(elmErr && elmErr.length > 0){
                return false;
            }
        }
    
        return true;
    }

    function nextStep()
    {
        $('.step-'+currentStep).hide();
        currentStep++;
        $('.step-'+currentStep).show();
    }

    function getPatientData()
    {
        $("#loadingModal").modal('show');

        facilityCode = $("input[name='facility_code']").val();
        lastName = $("input[name='last_name']").val();
        firstName = $("input[name='first_name']").val();
        middleName = $("input[name='middle_name']").val();
        birthday = $("input[name='birthday']").val();
        gender = $('option:selected', 'select[name="gender"]').data('property');

        $.get("/itis/get/patient", { last_name : lastName.toUpperCase(), first_name: firstName.toUpperCase(), middle_name: middleName.toUpperCase(),
        facility_code: facilityCode, birthday: birthday, sex: gender }, function(response) {
                $("#loadingModal").modal('hide');
                if(response.data == null || response.data == 'Patient Data is Invalid'){
                    $("#noMatchModal").modal('show');
                    return;
                }
                $("#is_from_itis").removeAttr('name');
                nextStep();
        }).fail(function() {
            console.error('failed');
        });


    }

  });