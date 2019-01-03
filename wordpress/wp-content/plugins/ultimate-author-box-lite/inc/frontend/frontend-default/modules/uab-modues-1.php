<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
	//For template 1
	//For template 3
	//For template 4
	//For template 7	
	//For template 9
	//For template 11
	//For template 12
	//For template 13
	//For template 14
	//For template 15
	//For template 16
	//For template 18
	//For template 19

	if($uab_template_type == 'uab-template-4'){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');
	}

	if(
		$uab_template_type == 'uab-template-1'||
		$uab_template_type == 'uab-template-3'||
		$uab_template_type == 'uab-template-4'

	){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-image.php');
	}



?>
<div class="uab-front-content">
<?php
	if(
		$uab_template_type == 'uab-template-4'
	){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-title.php');
	}
	
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-name.php');
	
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-description.php');
	if(	
		$uab_template_type == 'uab-template-1'||
		$uab_template_type == 'uab-template-3'||
		$uab_template_type == 'uab-template-4'
	){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-contact.php');
	}
	if(
		$uab_template_type == 'uab-template-1'
	){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');
	}

?>
</div>


