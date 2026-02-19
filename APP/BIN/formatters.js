  function EUR(number)
{
   
          var number = INT(number);
     for (var i =0;i<10;i++) {  number = number.replace(',', "c");}
   for (var i =0;i<10;i++) {  number = number.replace('.', "d");}
   
   for (var i =0;i<10;i++) {  number = number.replace('c', ".");}
   for (var i =0;i<10;i++) {  number = number.replace('d', ",");}

return number+'$';

}

function CHECK_DIV0(value){
  if (value == '#DIV/0!'){return '-';} else {return value;}

}

function INT(number)
{
   
// number  = Number(number).toLocaleString("en-IN", {minimumFractionDigits: 2});
if (number =="" || number =="-" ){return '£0' ;}

  number = parseFloat(number);
  var sign = '';
  if(number<0){sign = '-';}
  number = Math.abs( number.toFixed(2) );
  number=number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

return sign +'$'+number;

}

function INTX(number)
{

   
// number  = Number(number).toLocaleString("en-IN", {minimumFractionDigits: 2});
if (number =="" || number =="-" ){return '0' ;}

  number = parseFloat(number);
  var sign = '';
  if(number<0){sign = '-';}
  number = Math.abs( number.toFixed(2) );
  number=number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

return sign +number;

}

function INTX_RATIOS(number,id)
{
  if(id == '-'){}else{$('#'+id).attr('raw-val',number);}

   
// number  = Number(number).toLocaleString("en-IN", {minimumFractionDigits: 2});
if (number =="" || number =="-" ){return '£0' ;}

  number = parseFloat(number);
  var sign = '';
  if(number<0){sign = '-';}
  number = Math.abs( number.toFixed(2) );
  number=number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

return sign +number;

}

function INTS_BALANCESHEET(number)
{
  
if (number =="" || number =="-" ){return '-' ;}
  // number = parseFloat(number);
  if(isNaN(number)){return '-';}
  var sign = '';
  if(number<0){sign = '-';}
  number = Math.abs( number );
    number = number.toFixed(1);

  number=number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

return sign+number;

}

function INTS(number)
{
  
if (number =="" || number =="-" ){return '-' ;}
  // number = parseFloat(number);
  if(isNaN(number)){return '-';}
  var sign = '';
  if(number<0){sign = '-';}
  number = Math.abs( number );
    number = number.toFixed(2);

  number=number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

return sign+number;

}

function FORMAT_SYM(number){

if (number =="" || number =="-" || number =="$0" || number =="0" ){return 0 ;}

         number = number.replace(/[^\d.-]/g, '');

return parseFloat(number);
}

function EURTONUM(number){

   for (var i =0;i<10;i++) {  number = number.replace(',', "c");}
   for (var i =0;i<10;i++) {  number = number.replace('.', "d");};console.log('x='+number);
   
   for (var i =0;i<10;i++) {  number = number.replace('c', ".");}
   for (var i =0;i<10;i++) {  number = number.replace('d', ",");}

       number = number.replace(/[^\d.-]/g, '');


return number;

}

