<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="uab-short-contact <?php if($uab_template_type == 'uab-template-6') esc_attr_e('uab-clearfix');?>">
	<?php
	$author_url = get_the_author_meta( 'url', $author_id);
	$author_phone = isset($uab_profile_data[0]['uab_company_phone'])?$uab_profile_data[0]['uab_company_phone']:'';
	?>
	<?php if(!empty($author_url)):?>
		
		<div class="uab-contact-inner">

			<?php
			if (!empty($author_url)){
				if($uab_template_type == 'uab-template-1'){
					?>
					<span class="uab-contact-label"><?php esc_html_e('web','ultimate-author-box-lite');?></span>
					<?php	
				}
				?>
				<div class="uab-user-website">
					<a href="<?php esc_attr_e($author_url); ?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e($author_url); ?></a>
				</div>
				
				<?php
			}?>
			
		</div>
		
	<?php endif;?>
	<div class="uab-contact-inner">
		<?php
		if($uab_template_type == 'uab-template-1'){
			?>
			
			<span class="uab-contact-label"><?php esc_html_e('email','ultimate-author-box-lite');?></span>
			<?php	
		}
		?>
		<div class="uab-user-email">
			<a href="mailto:<?php esc_attr_e(the_author_meta( 'email', $author_id)); ?>"><?php esc_html_e($this->encode_email(the_author_meta( 'email', $author_id))); ?></a>
		</div>
	</div>
	<?php if(!empty($author_phone)):?>
		<div class="uab-contact-inner">
			<?php

			if(!empty($author_phone)){
				if($uab_template_type == 'uab-template-1'){
					?>
					
					<span class="uab-contact-label"><?php esc_html_e('call','ultimate-author-box-lite');?></span>
					<?php	
				}?>
				<div class="uab-user-phone">
					<a href="tel:<?php esc_attr_e($author_phone); ?>"><?php esc_html_e($author_phone);?></a>
				</div>
				
				<?php
			}
			?>
		</div>
	<?php endif;?>
</div>