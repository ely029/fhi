jQuery( document ).ready(function( $ ) {
    $(".bacteriological-check").on('click', function(){
        let type = $(this).data('type');
        if($(this).is(":checked")){
            $("."+type).attr('name',type+'[]');
            $("."+type+'-field').attr('required',true);
        }else{
            $("."+type).removeAttr('name',type+'[]');
            $("."+type+'-field').removeAttr('required');
        }
    });

    $(document).on('change',".dst_option",function(){
        if($(this).val() == 'Other (please specify)'){
            const input = '<input class="form__input dst-other" type="text" required placeholder="Result" name="dst-result[]"/>';
            $(this).parent().append(input);
            $(this).attr('name','');
        }else{
            $(this).attr('name','dst-result[]');
            $(this).parent().find(".dst-other").remove();
        }
    });


});


