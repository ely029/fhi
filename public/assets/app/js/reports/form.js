jQuery( document ).ready(function( $ ) {
    $("input[name='period']").change(function(){
        if($(this).val() == 'monthly'){
            $("#monthly_dropdown").show();
            $("#quarterly_dropdown").hide();
            $("#year_month_div").show();
            $("#year_month_label").html('Month');
        }else if($(this).val() == 'annual'){
            $("#monthly_dropdown").hide();
            $("#quarterly_dropdown").hide();
            $("#year_month_div").hide();
        }else{
            $("#monthly_dropdown").hide();
            $("#quarterly_dropdown").show();
            $("#year_month_div").show();
            $("#year_month_label").html('Quarter');
        }
    });
});