jQuery( document ).ready(function( $ ) {
    $(".other-cxr").on('change', function(){
    
        if($(this).is(":checked")){
            $(this).removeAttr('name');
           $(".other-cxr-field").show().find('input').attr('required', true).attr('name','cxr_reading[]');
          
        }else{
            $(this).attr('name','cxr_reading[]');
            $(".other-cxr-field").hide().find('input').removeAttr('required').removeAttr('name');
        }
    });

});


