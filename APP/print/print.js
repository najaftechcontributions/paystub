function getVar(key) {
  const params = new URLSearchParams(window.location.search);
  return params.get(key); // returns null if not found
}

function getUtcTimeNumber() {
    const d = new Date();

    const hh = String(d.getUTCHours()).padStart(2, '0');
    const mm = String(d.getUTCMinutes()).padStart(2, '0');
    const ss = String(d.getUTCSeconds()).padStart(2, '0');

    return Number(hh + mm + ss);
}


var uid = getUtcTimeNumber();

// ========= Saving records ========
function save_record(tid="test",payer_email="test@gmail.com"){
 var n = parseFloat( $('[name="no_of_paystub"]').val() ); 

 var data = {
    main_data: [],
    additional_paystubs_data: []
  };


$('#step-1 input[pid], #step-1 select[pid],[addon_paystub="1"] input[pid], [addon_paystub="1"] select[pid]').each(function(i, obj) {
var pid = $(this).attr('pid');
var pv = $(this).val();

        data.main_data.push({ id: pid, v: pv });

});


$('[addon_paystub="1"] [pdi_label]').each(function(i, obj) {
var pid = $(this).attr('pdi_label');
var pv = $(this).text();

        data.main_data.push({ id: pid, v: pv });

});

// other paystubs data
var apd = [];
$('[addon-paystubs-box="1"] [paystub-content]').each(function(i, obj) {
var ps_count = parseFloat( $(this).attr('paystub-content'));

if(ps_count > n){return;}
console.log("json data for paystub:",ps_count);

var paystub_data = [];
// ----------------------------------------------------
$(this).find('input[pid], select[pid]').each(function(i, obj) {
var pid = $(this).attr('pid');
var pv = $(this).val();

paystub_data.push({pid,v:pv});

});
// ----------------------------------------------------
apd.push({["paystub_" + ps_count]:paystub_data});
});

data.additional_paystubs_data.push({
      index: n,
      data: apd
    });

// console.log(data);return 0;

// console.log(data);
var uid = getUtcTimeNumber();

  var form_data = 
  'action=save&uid=' + uid + 
  '&pypl_id=' + tid +
  '&payer_email=' + payer_email +
  // '&pdf_id=1' +
  "&data=" + encodeURIComponent( JSON.stringify(data) ); 

  $.ajax({
    url : 'print/save-records.php',
    type: 'POST',
    data : form_data,
    cache: false,
  }).done(function(response){ //
   
   console.log(response); 
   // var x = JSON.parse(response);
   var x = response;
   pdf_uid =   x.uid;
     download_pdf(tid, pdf_uid);

   
});

	
}



function retrive_record(uid){
var form_data = 'action=retrive&uid=' + uid; 

$.ajax({
    url : 'print/save-records.php',
    type: 'POST',
    data : form_data,
    cache: false,
  }).done(function(response){ //
   
   // console.log(response);

   //-----------------------
   var data = response.data;
   $.each(data, function (i, item) {
   	// console.log(item);

        var $el = $('[pid="' + item.id+'"]');

        if (!$el.length) return; // skip if element not found

        // Handle different field types safely
        if ($el.is('input, textarea')) {
            $el.val(item.v);
        } 
        else if ($el.is('select')) {
            $el.val(item.v);
        }
    });

   //-----------------------
   calc();
   show_print_preview();   
   
});


}



$( document ).ready(function() {

var j = 0;
$('input,select').each(function(i, obj) {

var pid = $(this).attr("pid");
if(pid === undefined){}else{return;}

$(this).attr("pid","p"+j);

j++;
});


if(getVar("print_5566")){ 
	var sid = getVar("print_5566");
	retrive_record(sid); 
}

});


function test_pv(){
$('input[pid], select[pid]').each(function(i, obj) {
if(this.value ==""){$(this).val("ABC-" + i);}
});
}





function show_print_preview() {

    var fields = $('.es-wrap input,.es-wrap select');
    var bottom_fields = $('.es-bottom input');
    var check_no_field = $('[field="check_no"]');
    var current_v = check_no_field.val();

    current_v = current_v.replaceAll("#","");
    check_no_field.val("#" + current_v);


    fields.css({
            'border': '0px solid #cfcfcf',
            'background-color': 'transparent',
            'font-weight' : "400"
        });


    bottom_fields.css({
            'font-weight' : "600"
        });


    $('.es-wrap input').prop('readonly', true);

    $('.es-wrap select')
        .css({
            // 'pointer-events': 'none',
            'background-color': 'transparent',
            '-webkit-appearance': 'none',
            // 'appearance': 'none'
        });


        $('.es-subhead').css({'text-align':'center'});
    $('.es-wrap [date-field]').css({'max-width':'80px'});
    $('[table="pay_table"] input, [table="deduction"] input').css("text-align","center");
    $('input[name="ssn"]').css("padding-left","0px")



$('#step-1').hide();
$('.flexer-1').removeClass("flexer-1").addClass("flexer-1_");

}

$(document).on('click', '[action="preview-stub"]', function() {
  show_preview();
  $('[action-btn="preview"]').hide();
  $('[action-btn="edit"]').show();
});
