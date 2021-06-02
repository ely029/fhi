jQuery('document').ready(function($){
$('#itr_drugs_1').hide();
$('#others_1').hide();
    $('#suggested_regimen').change(function(){
            if ($('#suggested_regimen').val() === 'ITR') {
                $('#itr_drugs_1').show().find('input').attr('required', true);
                $('#others_1').hide().find('input').removeAttr('required', true);
            }

            else if ($('#suggested_regimen').val() === 'Other (Specify)') {
                $('#others_1').show().find('input').attr('required', true);
                $('#itr_drugs_1').hide().find('input').removeAttr('required', true);
            }

            else{
                $('#itr_drugs_1').hide().find('input').removeAttr('required');
                $('#others_1').hide().find('input').removeAttr('required');
            }
    });

    $("#case-management-form").submit(function(){
        $(".hasDatepicker")
            .map(function(key) {
                if($(this).val()){
                    var d = new Date($(this).val());
                   
                    newFormat = [
                        d.getFullYear(),
                        ('0' + (d.getMonth() + 1)).slice(-2),
                        ('0' + d.getDate()).slice(-2)
                      ].join('-');
                      $(this).val(newFormat);
                }
        });

        $('.button--next').prop('disabled', true);
    });
});