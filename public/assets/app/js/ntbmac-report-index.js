jQuery('document').ready(function($){
    $.ajax({
        type: "GET",
        url: "/province",
        data: { region: $('#region').val()}
    })
    .done(function( data ) {
        $("#province").empty();
        jQuery.each(data, function(index, item) {
            $('#province').append("<option value=\'"+item.name1.toUpperCase()+"\'>\'"+item.name1.toUpperCase()+"\'</option>");
        });
    });      

    $('#region').change(function(){

        $.ajax({
            type: "GET",
            url: "/province",
            data: { region: $('#region').val()}
        })
        .done(function( data ) {
            $("#province").empty();
            jQuery.each(data, function(index, item) {
               $('#province').append("<option value=\'"+item.name1.toUpperCase()+"\'>\'"+item.name1.toUpperCase()+"\'</option>");
            });
        });
    });
});