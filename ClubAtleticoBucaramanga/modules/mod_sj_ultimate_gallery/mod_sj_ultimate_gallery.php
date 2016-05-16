<?php
/**
* Module Sj Ultimate Gallery For Joomla
* Version		: 1.0
* Created by	: ExtensionSpot
* Email			: support@extensionspot.net
* Created on	: 18 Nov 2014
* Last Modified : 18 Nov 2014 
* URL			: www.extensionspot.net
* Copyright (C) 2011-2012  ExtensionSpot
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
*/
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
//require_once(dirname(__FILE__).DS.'helper.php');
$LiveSite 	= JURI::base();
$module_path=$LiveSite.'modules/mod_sj_ultimate_gallery/';
$document = JFactory::getDocument();
 $document->addScript($module_path.'js/noc.js');
?>

<script src="<?php echo $module_path; ?>js/jquery-1.10.2.min.js" type="text/javascript"></script>

  <script src="<?php echo $module_path; ?>source/jquery.fancybox.pack.js" type="text/javascript"></script>
  <script src="<?php echo $module_path; ?>source/helpers/jquery.fancybox-buttons.js" type="text/javascript"></script>
  <script src="<?php echo $module_path; ?>source/helpers/jquery.fancybox-media.js" type="text/javascript"></script>
  <script src="<?php echo $module_path; ?>source/helpers/jquery.fancybox-thumbs.js" type="text/javascript"></script>




<?php




$layout = $params->get('layout');
$thumb_width_sjultimate = $params->get('thumb_width_sjultimate');
$thumb_height_sjultimate = $params->get('thumb_height_sjultimate');

$vert_space_sjultimate = $params->get('vert_space_sjultimate');
$horiz_space_sjultimate = $params->get('horiz_space_sjultimate');

$proportion_sjultimate = $params->get('proportion_sjultimate');


$descsize_sjultimate = $params->get('descsize_sjultimate');
$descweight_sjultimate = $params->get('descweight_sjultimate');
$desccolor_sjultimate = $params->get('desccolor_sjultimate');
$descalign_sjultimate = $params->get('descalign_sjultimate');

$titledescsize_sjultimate = $params->get('titledescsize_sjultimate');
$titledescweight_sjultimate = $params->get('titledescweight_sjultimate');
$titledesccolor_sjultimate = $params->get('titledesccolor_sjultimate');
$titledescalign_sjultimate = $params->get('titledescalign_sjultimate');

$topborder_sjultimate = $params->get('topborder_sjultimate');
$rightborder_sjultimate = $params->get('rightborder_sjultimate');
$bottomborder_sjultimate = $params->get('bottomborder_sjultimate');
$leftborder_sjultimate = $params->get('leftborder_sjultimate');
$borderradius_sjultimate = $params->get('borderradius_sjultimate');
$borderstyle_sjultimate = $params->get('borderstyle_sjultimate');
$borderstyle_sjultimate_hover = $params->get('borderstyle_sjultimate_hover');
$bordercolor_sjultimate = $params->get('bordercolor_sjultimate');
$bordercolorhoover_sjultimate = $params->get('bordercolorhoover_sjultimate');


//----------Grid----
$grid_width = $params->get('grid_width');
$grid_height = $params->get('grid_height');
$grid_img_height = $params->get('grid_img_height');
$grid_c_bg_color = $params->get('grid_c_bg_color');


//-----------list------------
$img_align_list = $params->get('img_align_list');
$random=rand();
//---------------------------Items-------
$create_setup_ultimate= $params->get('create_setup_ultimate');

// echo '<pre>';
// print_r ($create_setup_ultimate);

$imagesfolder=$create_setup_ultimate->{'500'}[0];
if($imagesfolder=='0'){$imagesfolder="";}
// echo $imagesfolder;
unset ($create_setup_ultimate->{'500'}[0]);
// echo '<hr>';
$create_setup_ultimatear=(array)$create_setup_ultimate;
echo '<div class="ultimate_wrapper">
<a name="ulti"></a>
';
foreach ($create_setup_ultimatear as $items){
	if (!empty($items)){
 // print_r ($items);
//--------datatype----
 if($items[2]=='Web Page')
		{$datatype='fancybox fancybox.iframe';}
	else if($items[2]=='Video')
		{$datatype='fancybox-media';}
	else if($items[2]=='Image')
		{$datatype='fancybox-thumb';}
	else if($items[2]=='Google Maps')
		{$datatype='fancybox fancybox.iframe';}
//-------------navigate to----	
 $external_link=trim($items[0]);
if(empty($external_link)){$link=$LiveSite.'images/'.$imagesfolder.'/'.$items[1];}else{$link=$external_link;}
//------------------thumbs--------------
 $external_thumb=trim($items[3]);
if(empty($external_thumb)){$thumb=$LiveSite.'images/'.$imagesfolder.'/'.$items[4];}else{$thumb=$external_thumb;}

echo '<div class="qitem'.$random.'">

	<a class="'.$datatype.'" rel="gallery'.$random.'" href="'.$link.'" title="">
<div id="thumb_holder'.$random.'" style="background:url(\''.$thumb.'\') no-repeat 50%;background-size: '.$proportion_sjultimate.';"></div>
<div  class="caption" >
<h4>'.$items[5].'</h4><p>'.$items[6].'</p>
</div>
 </a>
	</div>
';
	
	}
 
}
echo '</div>';
// echo $ulimate_gallery;




if ($layout=='thumbs'){
echo '
<style>
.qitem'.$random.' {
	float:left;
		height: '.$thumb_height_sjultimate.'px;
		width: '.$thumb_width_sjultimate.'px;	
		cursor:hand;
	cursor:pointer;
}

.qitem'.$random.' .caption {
		position:absolute;
		display:none;
		height: '.$thumb_height_sjultimate.'px;
		width: '.$thumb_width_sjultimate.'px;
		color:#ccc;
		background: rgba(0, 0, 0, 0.64);
	}
.qitem'.$random.' img,#thumb_holder'.$random.' {
		position:absolute;
		z-index:0;
	}
#thumb_holder'.$random.'{
height: '.$thumb_height_sjultimate.'px;
		width: '.$thumb_width_sjultimate.'px;
}
</style>
<script>



 sjulti(document).ready(function() {
 sjulti(".qitem'.$random.'").each(function () {
	sjulti(this).on("mouseenter mouseleave",function( e ) {
	sjulti(this).find(".caption").stop().fadeTo(400, e.type=="mouseenter"?1:0);	
	});
}); 
  
  
  })
  </script>
';
} else if ($layout=="grid"){
echo '
<style>
.qitem'.$random.' {
float:left;
width: '.$grid_width.'px;
height: '.$grid_height.'px;

}
#thumb_holder'.$random.'{
width:'.$grid_width.'px;
height: '.$grid_img_height.'px;
}
.qitem'.$random.' img,#thumb_holder'.$random.' {
z-index:0;
display: block;
padding: 5px 0;
margin: 5px 0;
}
.qitem'.$random.' .caption {
position:relative;
background: '.$grid_c_bg_color.';;		
height:100%;
		
	}
.qitem'.$random.' a:hover{
text-decoration:underline !important;
}	
</style>


';
}else if ($layout=='list'){
echo '
<style>
.qitem'.$random.' img,#thumb_holder'.$random.' {
float:'.$img_align_list.';
margin:10px;
position:relative;
z-index:1;
}
#thumb_holder'.$random.'{
height: '.$thumb_height_sjultimate.'px;
		width: '.$thumb_width_sjultimate.'px;
}

</style>
';

}

?>

 <link rel="stylesheet" href="<?php echo $module_path ?>source/jquery.fancybox.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $module_path ?>source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="<?php echo $module_path ?>source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />





<script  type="text/javascript" >


  sjulti(document).ready(function() {
         sjulti('.fancybox').fancybox();
			
			sjulti('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		nextEffect : 'none',
		prevEffect : 'none',
		helpers : {
			media : {}
		}
	});
			
	sjulti(".fancybox-button").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: false,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});		
	sjulti(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 70,
				height	: 70
			}
		}
	});		
				
       

 });
 
</script>

<style>


.qitem<?php echo $random?> {


border-top:<?php echo $topborder_sjultimate?>px;
border-right:<?php echo $rightborder_sjultimate?>px;
border-bottom:<?php echo $bottomborder_sjultimate?>px;
border-left:<?php echo $leftborder_sjultimate?>px;
border-color:<?php echo $bordercolor_sjultimate?>;
border-radius:<?php echo $borderradius_sjultimate?>px;
-moz-border-radius:<?php echo $borderradius_sjultimate?>px;
border-style:<?php echo $borderstyle_sjultimate?>;	
	margin:<?php echo $vert_space_sjultimate/2?>px <?php echo $horiz_space_sjultimate/2?>px;
	overflow:hidden;
	position:relative;
	
}
.qitem<?php echo $random?>:hover{
border-color:<?php echo $bordercolorhoover_sjultimate?>;
border-style:<?php echo $borderstyle_sjultimate_hover?>;	
}
.qitem<?php echo $random?> a{
position:relative;
z-index:1;

}
.qitem<?php echo $random?> img,#thumb_holder<?php echo $random?> {
		border:0;
		/* allow javascript moves the img position*/	
		
	}


.qitem<?php echo $random?> .caption {
		z-index:1;
	}
.qitem<?php echo $random?> .caption a:hover {
text-decoration: underline !important;
}

.qitem<?php echo $random?> .caption a.fancybox-media:hover {
text-decoration: none !important;
}

.qitem<?php echo $random?> .caption a {
		background:initial;
		color:<?php echo $desccolor_sjultimate?>;
		
	}

.qitem<?php echo $random?> .caption h4 {
		font-size:<?php echo $titledescsize_sjultimate?>px;
			font-weight:<?php echo $titledescweight_sjultimate?>;
			color:<?php echo $titledesccolor_sjultimate?> !important;
			text-align:<?php echo $titledescalign_sjultimate?>;
			clear:none;
			padding:10px 5px 0 8px !important;
			margin:0;
		}

.qitem<?php echo $random?> .caption p {

			font-size:<?php echo $descsize_sjultimate?>px;
			font-weight:<?php echo $descweight_sjultimate?>;
			color:<?php echo $desccolor_sjultimate?> !important;
			text-align:<?php echo $descalign_sjultimate?>;
			padding:3px 5px 0 8px !important;
			margin:0;
		}

.qitem<?php echo $random?> a{
text-decoration:none !important;

}
.qitem<?php echo $random?> .caption a{
text-decoration:none !important;
display: block;
}

.ultimate_wrapper {
overflow:hidden;
}
.fancybox-overlay a:hover{
background-color:initial;
}
</style>


