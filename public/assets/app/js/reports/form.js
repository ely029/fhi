jQuery( document ).ready(function( $ ) {

    let selectedPeriod = $("#selected_period").val();
    if(selectedPeriod){
        onPeriodValue(selectedPeriod);
    }

    $("input[name='period']").change(function(){
        onPeriodValue($(this).val());
    });

    function onPeriodValue(period){
        if(period == 'monthly'){
            $("#monthly_dropdown").show();
            $("#monthly_dropdown").attr('name','month');
            $("#quarterly_dropdown").hide();
            $("#quarterly_dropdown").removeAttr('name');
            $("#year_month_div").show();
            $("#year_month_label").html('Month');
        }else if(period == 'annual'){
            $("#monthly_dropdown").hide();
            $("#monthly_dropdown").removeAttr('name');
            $("#quarterly_dropdown").hide();
            $("#quarterly_dropdown").removeAttr('name');
            $("#year_month_div").hide();
        }else{
            $("#monthly_dropdown").hide();
            $("#monthly_dropdown").removeAttr('name');
            $("#quarterly_dropdown").show();
            $("#quarterly_dropdown").attr('name','quarter');
            $("#year_month_div").show();
            $("#year_month_label").html('Quarter');
        }
    }
});