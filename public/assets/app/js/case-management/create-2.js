jQuery('document').ready(function($){
$('#others').hide();   
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
        if ($('#rest_pattern_3').val() == 'Xpert MTB/RIF') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_3').val() == 'Xpert MTB/RIF ULTRA') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_3').val() == 'Truenat TB') {
            $('#method_used_3').empty();
            $('#method_used_3').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_4').change(function(){
        if ($('#rest_pattern_4').val() == 'Xpert MTB/RIF') {
            $('#method_used_4').empty();
            $('#method_used_4').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_4').val() == 'Xpert MTB/RIF ULTRA') {
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
        } else {
            $('#others').hide();
        }
    });


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
    $("#case-management-add-button").click(function(){
        var e = $('#m-screening tbody tr').length;
        if (e <= 20) {
            $('#m-screening tbody').append($('#m-screening tbody tr').last().clone());
            $('#m-screening tbody tr').last().attr('id', 'counter-'+e);
            $('#m-screening tbody tr .base-letter').last().html('');
            $('#m-screening tbody tr .counter').last().html(e);
            $('#m-screening tbody tr img').last().attr('id', 'close-image-ms-'+e);
            $('#count').append('<input type="hidden" id='+ e +' name="count[]" value='+ e +'>');
        }
        else {
            alert('allows only 20 months');
        }
    });

});