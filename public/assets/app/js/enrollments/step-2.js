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


    $(document).on("click","#js-add-section4", function(){
       
            
                // const e= document.getElementById("js-section4").innerHTML;
                const field = $("#js-section4");
                const cloned = field.clone();
                cloned.find('input[type="checkbox"]').attr('name','lpa-1-result[]');

                $("#js-section4").append(cloned);
                $("#js-add-section4").hide();
                $(".js-delete-section4").show();
            
        
    });
    let lpaCheckBoxChecked  = false; 
    $(document).on('click',".lpa-field",function(){
        if(lpaCheckBoxChecked){
            return;
        }
        if($(this).is(":checked")){
            
            $('.lpa-field').removeAttr('required');
            lpaCheckBoxChecked = true;
        }
        else
        {
            $('.lpa-field').attr('required', true);
            
        }
    });
    
});


