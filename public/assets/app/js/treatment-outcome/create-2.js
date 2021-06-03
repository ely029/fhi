jQuery('document').ready(function($){
$('#others').hide();  

let removeTd = '<td><button class="button button--transparent remove-monthly-screening" type="button">Remove</button></td>'; 
    $('#rest_pattern_1').change(function(){
        if ($('#rest_pattern_1').val() == 'Xpert MTB/RIF') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_1').val() == 'Xpert MTB/RIF ULTRA') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_1').val() == 'Truenat TB') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_2').change(function(){
        if ($('#rest_pattern_2').val() == 'Xpert MTB/RIF') {
            $('#method_used_2').empty();
            $('#method_used_2').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_2').val() == 'Xpert MTB/RIF ULTRA') {
            $('#method_used_2').empty();
            $('#method_used_2').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_2').val() == 'Truenat TB') {
            $('#method_used_2').empty();
            $('#method_used_2').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_3').change(function(){
        if ($('#rest_pattern_3').val() == 'For Xpert MTB/RIF') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_3').val() == 'For Xpert MTB/RIF ULTRA') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_3').val() == 'Truenat TB') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_4').change(function(){
        if ($('#rest_pattern_4').val() == 'For Xpert MTB/RIF') {
            $('#method_used_4').empty();
            $('#method_used_4').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_4').val() == 'For Xpert MTB/RIF ULTRA') {
            $('#method_used_4').empty();
            $('#method_used_4').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_4').val() == 'Truenat TB') {
            $('#method_used_4').empty();
            $('#method_used_4').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_4').change(function(){
        if ($('#rest_pattern_4').val() == 'Other (specify)') {
            $('#others').show();
            $("input[name='dst_resistance_pattern_others']").attr('required', true);
        } else {
            $('#others').hide();
            $("input[name='dst_resistance_pattern_others']").removeAttr('required');
        }
    });


    $(document).on('click', '#add-screening', function(){
        $(".screening-2").show();
        $(".screening-2").find('#screening_2_date').attr('name','screening_2_date_collected').attr('required', true);
        $("#rest_pattern_2").attr('name','screening_2_method_used').attr('required', true);
        $("#method_used_2").attr('name','screening_2_resistance_pattern').attr('required', true);
        let buttonRemove = '<button class="button button--transparent button--add" id="remove-screening" type="button">Remove</button>';
        $(this).replaceWith(buttonRemove);
    });

    $(document).on('click', '#remove-screening', function(){
        $(".screening-2").hide();
        $(".screening-2").find('#screening_2_date').removeAttr('name').removeAttr('required');
        $("#rest_pattern_2").removeAttr('name').removeAttr('required');
        $("#method_used_2").removeAttr('name').removeAttr('required');
        let buttonAdd = '<button class="button button--transparent button--add" id="add-screening" type="button">Add more</button>';
        $(this).replaceWith(buttonAdd);
    });
    $("#case-management-add-button").click(function(){
        var e = $('#m-screening tbody tr').length;
        if (e <= 20) {

            
            let latest = $('#m-screening tbody tr').last();
   
            // lastTr.find('td:nth-child(6)').removeClass('screenings-remove');
        
            if(latest.find('td').length > 5){
                console.log("to remove 6th td ");
                latest.find('td:nth-child(6)').remove();
            }
            let newTR = latest.clone();
            newTR.find('td:last').after(removeTd);
            $('#m-screening tbody').append(newTR);
            $('#m-screening tbody tr').last().attr('id', 'counter-'+e);
            $('#m-screening tbody tr .base-letter').last().html('');
            $('#m-screening tbody tr .counter').last().html(e);
            $('#m-screening tbody tr img').last().attr('id', 'close-image-ms-'+e);
        }
        else {
            alert('allows only 20 months');
        }
    });

    $(document).on('click', '.remove-monthly-screening', function(){
        $(this).parent().parent().remove();
        let count = $('#m-screening tbody tr').length;
        if(count == 1){
            return;
        }
        let latest = $('#m-screening tbody tr').last();
        latest.find('td:last').after(removeTd);
    });

});