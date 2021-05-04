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
        $(document).on('click', '#add-screening', function(){
            $(".screening-2").show();
            $(".screening-2").find('input[type="date"]').attr('name','date_collected_screening_2').attr('required', true);
            $("#rest_pattern_2").attr('name','ressitance_pattern_screening_2').attr('required', true);
            $("#method_used_2").attr('name','method_used_screening_2').attr('required', true);
            let buttonRemove = '<button class="button button--transparent button--add" id="remove-screening" type="button">Remove</button>';
            $(this).replaceWith(buttonRemove);
        });
    
        $(document).on('click', '#remove-screening', function(){
            $(".screening-2").hide();
            $(".screening-2").find('input[type="date"]').removeAttr('name').removeAttr('required');
            $("#rest_pattern_2").removeAttr('name').removeAttr('required');
            $("#method_used_2").removeAttr('name').removeAttr('required');
            let buttonAdd = '<button class="button button--transparent button--add" id="add-screening" type="button">Add more</button>';
            $(this).replaceWith(buttonAdd);
        });
    });