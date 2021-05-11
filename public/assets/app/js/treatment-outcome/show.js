jQuery( document ).ready(function( $ ) {
$('.hide--button').hide();
    $('#recommendation-button').click(function(){
        let action = $("#action-dropdown").val();
        if(action == 'Referred to Regional'){
            $("#modal-title").text('Refer To R-TB MAC');
            $("#modal-text").text("You are about to confirm 'Refer To R-TB MAC' for this case and patient. If you have additional remarks, enter them below.");
        }
        if(action == 'Not for Referral'){
            $("#modal-title").text('Not for referral');
            $("#modal-text").text("You are about to decline and set this case to 'Not for Referral' If you have additional remarks. Enter them below.");
        }
        if(action.startsWith('Recommend')){

            
            if(action === 'Recommend for Approval'){
                $("#modal-title").text('Recommend for approval');
                $("#modal-text").text("You are about to recommend this case for approval. If you have additional remarks, enter them below.");
            }
            else if(action === 'Recommend for other suggestions'){
                $("#modal-title").text(action);
                $("#modal-text").text("You are about to recommend this case be tagged 'Other suggestion.' If you have additional remarks, enter them below.");
            }else{
                $("#modal-title").text(action);
                $("#modal-text").text("You are about to recommend this case for need further details. If you have additional remarks, enter them below.");
            }

            $("#modal-form").find('input[name="status"]').val('Referred to Regional Chair');
            return;
        }
        if(action == 'For approval'){
            $("#modal-title").text(action);
            $("#modal-text").text("You are about to send this case back to a healthcare worker tagged as Approved.' If you have additional remarks, enter them below.");
        }
        if(action == 'Other suggestions'){
            $("#modal-title").text(action);
            $("#modal-text").text("You are about to send this case back to a healthcare worker tagged as 'Other suggestions.' If you have additional remarks, enter them below.");
        }
        if(action == 'Need Further Details'){
            $("#modal-title").text('Need further details');
            $("#modal-text").text("You are about to send this case back to a healthcare worker tagged as 'Need Further Details.' If you have additional remarks, enter them below.");
        }
        if(action == 'Referred to National'){
            $("#modal-title").text('Refer to N-TB MAC');
            $("#modal-text").text("You are about to send this case to National TB MAC. If you have additional remarks, enter them below.");
        }

        if(action == 'Resubmit Treatment Outcome') {
            $('textarea[name="recommendation"]').hide();
            $('button').hide();
            $("#modal-title").text('Resubmit treatment outcome');
            $('#modal-text').text("You are about to resubmit a new treatment outcome. Please read and prepare the requested information and documents and the remarks and recommendations section");
            $('label').hide();
            $('.hide--button').show();
        }

        if(action == 'Not Resolved'){
            $("#modal-title").text('Not resolved');
            $("#modal-text").text("You are about to recommend this case for not resolved. If you have additional remarks, enter them below.");
        }

        if(action == 'Resolved'){
            $("#modal-title").html('Resolved');
            $("#modal-text").html("You are about to recommend this case for resolved. If you have additional remarks, enter them below.");
        }

        $("#modal-form").find('input[name="status"]').val(action);
    });

    $(".create-recommendation").click(function(){
        // $("#ntbmac-modal").modal('show');
        $("#modal-text").text('Create recommendation');
        
        if($(this).data('role') == 7){
            $("#modal-form").find('input[name="status"]').val('Referred to National Chair');
        }else if($(this).data('role') == 8)
        {
            $("#modal-form").find('input[name="status"]').val('Referred back to regional chair');
        }
     
    });
});
