<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="post-item-wrapper <?php if($uab_template_type == 'uab-template-1' || $uab_template_type == 'uab-template-3') echo 'uab-clearfix';?>">
	<div class="uab-post-first-wrapper">
		<?php 
			include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-image.php');
		?>
	</div>
	<div class="uab-post-second-wrapper">
		<?php include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-title.php'); ?>
		<div class="uab-post-meta-info">
			<?php
			if($uab_template_type == 'uab-template-1' || $uab_template_type == 'uab-template-3'){
				include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-date.php');	
				if(!($uab_template_type == 'uab-template-3')){
					include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-author.php');
				}
			}
			else{
				if(!($uab_template_type == 'uab-template-4')){
					include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-author.php');	
					include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-date.php');
				}
			}
			?>
		</div>
		<?php 
		if($uab_template_type == 'uab-template-2' || $uab_template_type == 'uab-template-4'){
			include(UAB_PATH . '/inc/frontend/frontend-posts/components/uab-post-excerpt.php');	
		}
		?>

	</div>
</div>