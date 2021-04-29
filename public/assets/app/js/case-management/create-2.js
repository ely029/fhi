jQuery('document').ready(function($){
   
    $('#rest_pattern_1').change(function(){
        if ($('#rest_pattern_1').val() == 'For Xpert MTB/RIF') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_1').val() == 'For Xpert MTB/RIF ULTRA') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_1').val() == 'Truenat') {
            $('#method_used_1').empty();
            $('#method_used_1').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });

    $('#rest_pattern_2').change(function(){
        if ($('#rest_pattern_2').val() == 'For Xpert MTB/RIF') {
            $('#method_used_2').empty();
            $('#method_used_2').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_2').val() == 'For Xpert MTB/RIF ULTRA') {
            $('#method_used_2').empty();
            $('#method_used_2').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Detected Trace, Rifampicin Resistance'>MTB Detected Trace, Rifampicin Resistance</option><option value='Indeterminate'>Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }

        if ($('#rest_pattern_2').val() == 'Truenat') {
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

        if ($('#rest_pattern_3').val() == 'Truenat') {
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

        if ($('#rest_pattern_4').val() == 'Truenat') {
            $('#method_used_4').empty();
            $('#method_used_4').append("<option value='MTB Detected, Rifampicin Resistance Detected'>MTB Detected, Rifampicin Resistance Detected</option><option value='MTB Detected, Rifampicin Resistance Not Detected'>MTB Detected, Rifampicin Resistance Not Detected</option><option value='MTB Detected, Rifampicin Resistance Indeterminate'>MTB Detected, Rifampicin Resistance Indeterminate</option><option value='MTB Not Detected'>MTB Not Detected</option><option value='Invalid/No Result/Error'>Invalid/No Result/Error</option>");
        }
    });
});