<?php
/**
 * $ModDesc
 * 
 * @version		v.1.2
 * @package		modules
 * @copyright	Copyright (C) NOV 18 ExtensionSpot.net
 <@emai:support@extensionspot.net>. All rights reserved.
 * @license		GNU General Public License version 2
 */
// no direct access
defined('_JEXEC') or die ('Restricted access');
  
  class JFormFieldSjaddrow extends JFormField {
  	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'SjAddRow';
	
	function getInput()
	{
	/*
		*/
		ini_set('display_errors', 'Off');
error_reporting(E_ALL);
		$values = $this->value; 
		$name = $this->name;

			
		$id = str_replace("jform_params_","",$this->id);
		$cname=array();
		// $cname[1] =''.$name.'[1][]';	
		
		/*
		if( !is_array($values) && empty($values) ){
			$values = array();
		}
		$values = !is_array($values) ? array($values):$values;
		$row ='';
		foreach( $values as $key=> $value ){
			$row .= '
				<div class="row">
					<span class="spantext">'.($key+1).'</span>
					<input type="text" value="'.$value.'" name="'.$cname.'">
					<span class="remove"></span>
				</div>
			';
		}
		return '<fieldset class="it-addrow-block"><div><span id="btna-'.$id.'" class="add">Add Row</span></div>'.$row.'</fieldset>';
		*/
		 // echo $this->id;
		 // echo '<hr>';
		
		//echo '<pre>';
		//print_r ($values);
		//echo '<hr>';
		$fieldsets='';
for ($j=0;$j<=500;$j++){

$cname[$j] =''.$name.'['.$j.'][]';

}	
//----select folders
$imagesfolder = '../images';
 $allfandf = array_diff(scandir($imagesfolder), array('..', '.'));
 foreach ($allfandf as $file){
	 if (!is_file($imagesfolder.'/'.$file)){ 
 $folders[]=$file;
	 }
 }


$fieldsets.='<span id="imgicon" class="imgicon"">Images folder: </span><select name="'.$cname[500].'" class="select">';
$fieldsets .= '<option value="0" >Select...</option>';
foreach($folders as $folder){
	$selected='';
	if((!empty($values[500][0])) AND ($values[500][0]==$folder)){$selected='selected';}
	$fieldsets.= '<option value="'.$folder.'" '.$selected.'>'.$folder.'</option>';
	}
if(!empty($values[500][0])){	
$imagefolderv=$values[500][0];
}	
if (isset($values[500])){unset($values[500]);}

					
			

	$fieldsets.='</select><input type="button" value="Select" onclick="Joomla.submitbutton(\'module.apply\')" class="toolbar" style="margin-left:  20px;">'; 
//----end select folders			
		$fieldsets .= '<span id="add_row_top" class="add" onClick="additem();">Add item </span>';
		$fieldsets.='<div id="total">';
		
		$fieldsets.='<input type="hidden" id="itemcount" name="itemcount" value="'.count($values).'">';
//---- select  music and images folders	

		$imagefolder='';
	
	if(isset($imagefolderv)){$imagefolder=$imagefolderv;}	

$imgdir    = '../images/'.$imagefolder;

$files2 = scandir($imgdir);

$images='';

foreach ($files2 as $file2){
	if (is_file($imgdir.'/'.$file2)){ 	
		$imgsize=getimagesize($imgdir.'/'.$file2);
		// print_r($imgsize);
				//-----check if image
				if($imgsize['mime']=='image/png' || $imgsize['mime']=='image/gif' || $imgsize['mime']=='image/jpeg'){
				$images[]=$file2;
				}
		}
}
// print_r($mp3files);		
// print_r($images);

//----end  select  music and images folders		
	
		if(!empty($values)){
		
		$i=-1;		
		foreach($values as $key ){
		$i++;
$item_div='&#39;#table_div'.$i.'&#39;,'.$i.'';
			$fieldsets .= '
				<div style="padding:5px;" class="tableclass" id="table_div'.$i.'">
		<table border=0 id="table_'.$i.'" class="tableclass2" >
		<tbody ><tr>
			
			<td class="side">Navigate to</td>
			<td colspan="2">
			<input type="text" name="'.$cname[$i].'" value="'.$key[0].'"> OR 
				<select name="'.$cname[$i].'" class="select" >
				';
				$fieldsets .= '<option value="0" >Select...</option>';
				if(!empty($images)){
	foreach($images as $image){
	$selected='';
	if($key[1]==$image){$selected='selected';}
	$fieldsets .= '<option value="'.$image.'" '.$selected.'>'.$image.'</option>';
	}	
}
$fieldsets .= '
				</select>
			</td>
		</tr>
		<tr>
			<td class="side">Data type</td>
			<td colspan="2">
<select name="'.$cname[$i].'" class="select" >';
	$fieldsets .= '<option value="0" >Select...</option>';
$types=array("Image","Video","Web Page","Google Maps");
foreach($types as $type){
$selectedtype='';
if($key[2]==$type){$selectedtype='selected';}
	$fieldsets .= '<option value="'.$type.'" '.$selectedtype.'>'.$type.'</option>';
}
	$fieldsets .= '</select></td>
		</tr>
		<tr>
			<td class="side">Thumbnail URL</td>
			<td><input type="text" name="'.$cname[$i].'" value="'.$key[3].'" onblur="showthumb(this,\'#posterimg'.$i.'\',\'\')" >  OR 
				<select name="'.$cname[$i].'" class="select" onchange="showthumb(this,\'#posterimg'.$i.'\',\''.$imgdir.'/\')" >
				';
				$fieldsets .= '<option value="0" >Select...</option>';
				if(!empty($images)){
	foreach($images as $image){
	$selected='';
	if($key[4]==$image){$selected='selected';}
	$fieldsets .= '<option value="'.$image.'" '.$selected.'>'.$image.'</option>';
	}	
}
$keyz=trim($key[3]);
if(empty($keyz)){$posterimg=$imgdir.'/'.$key[4];}else{$posterimg=$key[3];}

$fieldsets .= '
				</select>
				</td>
				<td>
				<div class="posterimg" id="posterimg'.$i.'" style="background-image:url('.$posterimg.');"></div>
				</td>
				
		</tr>
		<tr>
			<td class="side">Title</td>
			<td colspan="2"><input type="text" name="'.$cname[$i].'" value="'.$key[5].'"></td>
		</tr>
		
		<tr>
			<td class="side">Description</td>
			<td colspan="2"><textarea name="'.$cname[$i].'" style="height:100px;">'.$key[6].'</textarea></td>
		</tr>
		
		<tr>
			<td class="side">Add / Delete item</td>
			<td colspan="2">
<span style="float: left;" id="add_row" class="add" onClick="additem();"></span>			
<span id="remove_row" class="add" onClick="removerow('.$item_div.');"></span>				
			</td>
		</tr>
		</tbody>
		</table>
		
		</div>';
		}
	}else{
	echo '
<script language="javascript">
var sjzz = jQuery.noConflict();
sjzz(document).ready(function(){

item_nr=\'-1\';
used_nr=new Array();
for (i = 0; i <= item_nr; i++) { 
used_nr.push(i);

}

additem();

});
</script>
';
	
	}
		
		echo '
		<style>
		#add_row{
			background: url(../modules/mod_sj_ultimate_gallery/img/add.png) no-repeat;
			width: 26px;
			height: 26px;
			display: block;
			cursor: hand;
			cursor: pointer;	
		
		}
		#add_row_top{
			background: url(../modules/mod_sj_ultimate_gallery/img/add.png) no-repeat;
			height: 26px;
			display: block;
			cursor: hand;
			cursor: pointer;	
			padding:0px 0px 0px 30px;
		
		}
		
		#note{
			background: url(../modules/mod_sj_ultimate_gallery/img/note-24.png) no-repeat  top right;	
			padding:0px 26px 5px 5px;
			margin:0 5px 0 0px;
			height: 26px;
			display: inline-block;	
		}
		#imgicon{
			background: url(../modules/mod_sj_ultimate_gallery/img/Icon_InsertImage.png) no-repeat  top right;	
			padding:0px 26px 5px 5px;
			margin:0 5px 0 10px;
			height: 26px;
			display: inline-block;	
		}
		
		#remove_row{
			display: block;
			float: right;
			background: url(../modules/mod_sj_ultimate_gallery/img/remove.png) no-repeat;
			width: 20px;
			height: 16px;
			cursor: pointer;
			cursor: hand;
			padding-right: 9px;
}
		#total{
		//background:#ccc;
		}
		.side{
		padding:10px 10px 10px 5px;
		}
		.tableclass2{
		background:#F7F7F7;
		padding:5px;
		border: 1px solid #B1B1B1;
		margin-bottom: 20px;
		}
		.tableclass2 tr{
		border-bottom:1px solid #B1B1B1;
		}
		.chzn-container, .chzn-drop{
		padding-right: 9px;
		
		}
		.posterimg{
		width:100px;
		height:100px;
		float:right;
		background:#fff;
		background-size:contain;
		background-repeat: no-repeat;
		background-position: center center;
		margin-left: 9px;
		}
		</style>';
		
		
	
$encodedcname=json_encode($cname);

$encodeimages=json_encode($images);

echo '
<script language="javascript">

var sjzz = jQuery.noConflict();
sjzz(document).ready(function(){
item_nr=sjzz("#itemcount").val();
item_nr=item_nr;
used_nr=new Array();
for (i = 0; i <= item_nr; i++) { 
used_nr.push(i);

}

});

function additem(){
item_nr++;
var index2 = used_nr.indexOf(item_nr);
item_nr2=item_nr;
if(index2>0){
item_nr2=item_nr+1;
item_nr=item_nr2;

}
used_nr.push(item_nr);


var onblurvar=\'&apos;#posterimg\'+item_nr+\'&apos;\';
var cname= '.$encodedcname.';

var encodedflyimages= '.$encodeimages.';
var selected=null;
item_div=\'&#39;#table_div\'+item_nr+\'&#39;\';



items=\'<div style="padding:5px;" class="tableclass" id="table_div\'+item_nr+\'"><table id="table_\'+item_nr+\'" border=0 class="tableclass2">\';

items+=\'<tbody ><tr><td class="side">Navigate to</td>\';

items+=\'<td colspan="2" style="padding-right: 9px;"><input type="text" name="\'+cname[item_nr]+\'" value="" placeholder="http://..."> OR <select name="\'+cname[item_nr]+\'" class="select">\';
items+=\'<option value="0" >Select...</option>\';
sjzz.each(encodedflyimages,function(key,value){
items+=\'<option value="\'+value+\'" \'+selected+\'>\'+value+\'</option>\';
});
items+=\'</select></td></tr>\';
items+=\'<tr><td class="side">Data type</td><td colspan="2">\';
items+=\'<select name="\'+cname[item_nr]+\'" class="select">\';
items+=\'<option value="0" >Select...</option>\';
items+=\'<option value="Image" >Image</option>\';
items+=\'<option value="Video" >Video</option>\';
items+=\'<option value="Web Page" >Webpage</option>\';
items+=\'<option value="Google Maps" >Google Maps</option>\';
items+=\'</select></td></tr>\';
		
items+=\'<tr><td class="side">Thumbnail URL</td><td><input type="text" name="\'+cname[item_nr]+\'" value="" placeholder="http://..." onblur="showthumb(this,\'+onblurvar+\',&apos;&apos;)"> OR <select name="\'+cname[item_nr]+\'" class="select" onchange="showthumb(this,\'+onblurvar+\',&apos;'.$imgdir.'/&apos;)">\';
items+=\'<option value="0" >Select...</option>\';
sjzz.each(encodedflyimages,function(key,value){
items+=\'<option value="\'+value+\'" \'+selected+\'>\'+value+\'</option>\';
});

items+=\'</select></td><td><div class="posterimg" id="posterimg\'+item_nr+\'"></div>			</td></tr>\';
		
items+=\'<tr><td class="side">Title</td><td colspan="2"><input type="text" name="\'+cname[item_nr]+\'" value="Title" ></td></tr>\';

items+=\'<tr><td class="side">Description</td><td colspan="2"><textarea name="\'+cname[item_nr]+\'" style="height:100px;">Description...</textarea></td></tr>\';

items+=\'<tr><td class="side">Add / Delete item</td><td colspan="2"><span style="float: left;" id="add_row" class="add" onClick="additem();"></span><span id="remove_row" class="add" onClick="removerow(\'+item_div+\',\'+item_nr+\');"></span></td></tr>\';

items+=\'</tbody></table><hr></div>\';





sjzz(items).hide().appendTo("#total").fadeIn(1000);


sjzz("#itemcount").val(item_nr);


};

function removerow(e,inr){

item_nr--;
var index = used_nr.indexOf(inr);
used_nr.splice(index, 1);

 sjzz(e).remove();
 

 sjzz("#itemcount").val(item_nr);

}
function showthumb(e,v,q){

xval=e.value;
sjzz(v).css("background-image","url("+q+xval+")");

}

</script>

';

$endtotal='</div>';
		return $fieldsets.$endtotal;    
		
	}
  }

?>
