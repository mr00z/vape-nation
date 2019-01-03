<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
//For template 2
//For template 5

?>
<div class="uab-content-header <?php if($uab_template_type == 'uab-template-2' || $uab_template_type == 'uab-template-5') esc_attr_e('uab-clearfix');?>">
	<?php
	if($uab_template_type == 'uab-template-2'){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-name.php');
	}
	if($uab_template_type == 'uab-template-5'){
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-title.php');
		include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');
	}
	?>
</div>
	<?php if($uab_template_type == 'uab-template-5'){
		?>
		<div class="uab-content-temp-wrapper uab-clearfix">
			<?php
		}
		?>
		<div class="uab-content-mid <?php if($uab_template_type == 'uab-template-2') esc_attr_e('uab-clearfix');?>">
			<div class="uab-content-mid-inner-1">
				<?php
				if(
					$uab_template_type == 'uab-template-2'||
					$uab_template_type == 'uab-template-5'

				){
					include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-image.php');
				}
				?>
			</div>
			<div class="uab-content-mid-inner-2">
				<?php
				if($uab_template_type == 'uab-template-2' || $uab_template_type == 'uab-template-5'){
					include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-contact.php');
				}
			if($uab_template_type == 'uab-template-2'){
				include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');

			}
			?>

		</div>
	</div>

	
	<div class="uab-content-lower">
		<?php
		if($uab_template_type == 'uab-template-5'){
			include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-name.php');
		}
		if(
			$uab_template_type == 'uab-template-2'||
			$uab_template_type == 'uab-template-5'
		){
			include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-description.php');
		}
		?>
	</div>
	
	<?php if($uab_template_type == 'uab-template-5'){
		?>
	</div>
	<?php
}
?>


