jQuery('document').ready(function($){
    $('#masterlist').find('tr').click(function(){
        var e = $(this).index();
         var form_id = $('#masterlist tr input#form_id:eq('+ e +')').val();
         var remarks = $('#masterlist tr input#sec_remarks:eq('+ e +')').val();
         $('#sec_remarks_modal textarea').val(remarks);
         $('#sec_remarks_modal input#form_type').val($('#masterlist tr input#form_type:eq('+ e +')').val());
         $('#sec_remarks_modal input#form_id').val(form_id);
         $('#sec_remarks_modal').modal('show');
    });
});