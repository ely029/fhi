jQuery('document').ready(function($){

    let screening2 = $("#hasScreening2").val();
    if(screening2){
        $(".screening-2").show();
    }else{
        $(".screening-2").hide();
        $(".screening-2").find('input[type="date"]').removeAttr('name').removeAttr('required');
        $("#rest_pattern_2").removeAttr('name').removeAttr('required');
        $("#method_used_2").removeAttr('name').removeAttr('required');
    }

    let toRemoveAttachments = [];
    $(".remove-attachment").on('click', function(){
        toRemoveAttachments.push($(this).data('filename'));
        $(".exist-attach-"+$(this).data('key')).remove();
        $("#attachments-to-remove").val(JSON.stringify(toRemoveAttachments));
    });

    let othersDST = $("#othersDST").val();
    if(othersDST){
        $('#others').show();
    }
});