var payer_email = '';

function download_paystub(trans_details){
console.log(trans_details);

var tid = trans_details.purchase_units[0].payments.captures[0].id;
payer_email = trans_details.payer.email_address;

save_record(tid,payer_email);

}


function mail_paystub(pdf){
  if(payer_email == "" || pdf == ""){return 0;}

var form_data = 'send_pdf_stub=1&pdf_='+pdf+'&email_=' + payer_email;

  $.ajax({
    url : 'https://bestpaystub.com/',
    type: 'GET',
    data : form_data,
    cache: false,
  }).done(function(response){ //
   
   console.log(response);

});

}


function download_pdf(trans_id,pdf_uid){
  var form_data = 'trans_id='+trans_id+'&pdf_uid=' + pdf_uid;

$('[action-btn="edit"]').hide();
$('[action-btn="download"]').show();

// console.log(form_data);
// console.log("starting_download...");return 0;

  $.ajax({
    url : 'download/',
    type: 'POST',
    data : form_data,
    cache: false,
  }).done(function(response){ //
   
   console.log(response); 
   
   if(response.includes(".pdf")){

    var x = JSON.parse(response);
   var pdf = x.pdf;
   pdf = pdf.trim();

   // var host = parent.happs_download_path("?puid=");
   var link = parent.happs_download_path(pdf);
   mail_paystub(pdf);

   var pdf_div = $('[action-btn="download"]');

   pdf_div.find('a').attr("href",link);
   pdf_div.find('h2').hide();
   pdf_div.find('p').show();

   window.open(link,"_blank");
   
   }     
     
});


}


$(document).on('click', '[action="pdf-stub"]', function() {
  save_record();

});

