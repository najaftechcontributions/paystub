<?php 
function create_opt($a,$s=""){
$arr = explode(',', $a);
$html = '';

for($i=0;$i<sizeof($arr);$i++){

$x = trim($arr[$i]);
$selected = '';
if($x == trim($s)){$selected = 'selected';}
$html .= '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';

}


return $html;
}



function create_range($a,$s){
$arr = explode('-', $a);
$st = floatval( $arr[0] );
$et = floatval( $arr[1] );

$html = '';

for($i=$st;$i<=$et;$i++){

$x = $i;
$selected = '';
if($x == trim($s)){$selected = 'selected';}
$html .= '<option value="'.$x.'" '.$selected.'>'.$x.'</option>';

}


return $html;
}


function create_slider($title,$id,$max,$format){

$html = '

<tr>
   <td class="full_tx">'.$title.'</td>
   <td><input type="text" class="khyzer s_l '.$format.'" sld-id="'.$id.'" id="label_'.$id.'" name="'.$id.'" data-max="'.$max.'"></td>
</tr>

<tr>
   <td colspan="2"><div class="sldr-div"><input type="text" class="khyzer sld"  id="'.$id.'" placeholder="Enter" data-form="'.$format.'" ></div></td>
</tr>


';

return $html;

}
?>

