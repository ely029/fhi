jQuery( document ).ready(function( $ ) {
        
    $('#recommendation-button').click(function(){
        let action = $("#action-dropdown").val();
        if(action == 'Referred to Regional'){
            $("#modal-title").text('Refer To R-TBMac');
            $("#modal-text").text("You are about to confirm 'Refer To R-TBMac' for this case and patient. If you have additional remarks, enter them below.");
        }
        if(action == 'Not for Referral'){
            $("#modal-title").text('Not For Referral');
            $("#modal-text").text("You are about to decline and set this case to 'Not for Referral' If you have additional remarks. Enter them below.");
        }

        $("#modal-form").find('input[name="status"]').val(action);
    });
});
