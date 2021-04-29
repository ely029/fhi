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
            $('.step-'+currentStep).hide();
            currentStep++;
            $('.step-'+currentStep).show();
        }
    
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
  });