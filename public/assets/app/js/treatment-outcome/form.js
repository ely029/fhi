jQuery( document ).ready(function( $ ) {

    let currentStep = 1;
    let totalSteps = $("#steps").data('steps');
    let isManualInput = false;

    $(".button--next").on('click', function(){

        if(checkForms()){

            if(currentStep == 1){
                if(!isManualInput){
                    return getPatientData();
                }
        
            }

            if(currentStep == totalSteps){
                showConfirmModal();
                return;
            }

           nextStep();
        }
    
    });

    $("#proceedManually").on('click', function(){
        $("#is_from_itis").attr('name','is_from_itis');
        $("#noMatchModal").modal('hide');
        enableManualInput();
        // nextStep();
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

        tbCaseNumber = $("input[name='tb_case_number']").val();
        lastName = $("input[name='last_name']").val();

        $.get("/itis/get/patient", { last_name : lastName.toUpperCase(), tb_case_number: tbCaseNumber }, function(response) {
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

    function enableManualInput()
    {
        isManualInput = true;
        $('input:disabled').removeAttr('disabled').attr('required', true);
        $('select:disabled').removeAttr('disabled').attr('required', true);
    }

    function showConfirmModal()
    {
        $("#confirmation-modal").modal('show'); 
    }

    $("#proceedSubmit").on('click', function(){
        $(this).attr('disabled', true);
        $("#treatment-outcome-form").submit();
    });

  });