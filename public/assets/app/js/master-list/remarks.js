jQuery('document').ready(function($){
    $('#masterlist').on('click', 'tbody tr', function(e){
        //var e = $(this).index('td.remarks');
        var e = $(this).index();
         var form_id = $('#masterlist tr input#form_id:eq('+ e +')').val();
         var remarks = $('#masterlist tr input#sec_remarks:eq('+ e +')').val();
         $('#sec_remarks_modal textarea').val(remarks);
         $('#sec_remarks_modal input#form_type').val($('#masterlist tr input#form_type:eq('+ e +')').val());
         $('#sec_remarks_modal input#form_id').val(form_id);
         $('#sec_remarks_modal').modal('show');
    });

    $('body').click(function (event) 
{
   if(!$(event.target).closest('#sec_remarks_modal').length && !$(event.target).is('#sec_remarks_modal')) {
     $(".modalDialog").hide();
   }     
});
});