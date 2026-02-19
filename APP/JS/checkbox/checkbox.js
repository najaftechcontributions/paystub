	$('input[type=checkbox]').each(function(i, obj) {
    //test
    var id = this.id;
    var box = '';
    var tick = 'checkbox-kzr-hide';

    if($(this).is(':checked')){$(this).val('TRUE');}else{$(this).val('FALSE');}
    if($(this).is(':checked')){box = 'checkbox-kzr-hide';tick = '';}else{box = '';tick = 'checkbox-kzr-hide';}

	$(this).wrap('<div class="khyzer checkbox" id="checkbox-div-'+id+'">');

    var html = '<i class="far fas fa-square '+box+' kzr-box" id="kzr-box-'+id+'" data-check-id="'+id+'"></i>';   
        html += '<i class="fas fa-check-square '+tick+' kzr-tick" id="kzr-tick-'+id+'" data-check-id="'+id+'"></i>';   

	$(this).hide();
    $('#checkbox-div-'+id).append(html);

});


$(document).on("click", ".kzr-box" , function() {
var check_id = $(this).attr("data-check-id");
$(this).addClass('checkbox-kzr-hide');
$('#kzr-tick-'+check_id).removeClass('checkbox-kzr-hide');
$('#'+check_id).val('TRUE');

$( "input[type=checkbox]" ).trigger( "change" );

});


$(document).on("click", ".kzr-tick" , function() {
var check_id = $(this).attr("data-check-id");
$(this).addClass('checkbox-kzr-hide');
$('#kzr-box-'+check_id).removeClass('checkbox-kzr-hide');
$('#'+check_id).val('FALSE');

$( "input[type=checkbox]" ).trigger( "change" );


});
