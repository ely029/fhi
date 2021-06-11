jQuery( document ).ready(function( $ ) {

    let startYear = 1900;
    let endYear = new Date().getFullYear();
    for (var i = endYear; i > startYear; i--)
    {
      $('.js-year').append($('<option />').val(i).html(i));
    }

    let selectedPeriod = $("#selected_period").val();
    let selectedYear = $("#selected_year").val();
    if(selectedPeriod){
        onPeriodValue(selectedPeriod);
    }

    if(selectedYear){
        $(".js-year option").each(function(i){

            if($(this).val() == selectedYear){
                $(this).prop("selected", true);
                return false;
            };
        });
    }

    $("input[name='period']").change(function(){
        onPeriodValue($(this).val());
    });

    $("#submit_report").on('click', function(){
        $("#submit_modal").modal('show');
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