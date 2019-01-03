<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php if(!($error_flag)){?>
<div class="uab-social-icons">
	<?php
	if($uab_template_type == 'uab-template-1'){
		?>
		<?php if(!empty($uab_social_icons)):?>
			<span class="uab-contact-label"><?php esc_html_e('follow me','ultimate-author-box-lite');?></span>
		<?php endif;?>
		<?php	
	}
	?>
	<ul id="uap-social-outlets-fields">
		<?php 
		$uab_social_icons = maybe_unserialize(get_the_author_meta( 'uab_social_icons', $author_id));
		if(!empty($uab_social_icons)){
			foreach($uab_social_icons as $socialname => $innerarray){ 
				if(!empty($uab_social_icons[$socialname]['url'])){
					$uab_font_type = 'fab';
						if( $uab_social_icons[$socialname]['icon'] == 'rss'){
							$uab_font_type = 'fas';
						}
					?>
					<li class="uab-icon-<?php esc_attr_e($uab_social_icons[$socialname]['label']);?>">
						<a href="<?php esc_attr_e($uab_social_icons[$socialname]['url']);?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>">
							<i class="<?php esc_attr_e($uab_font_type); ?> fa-<?php esc_attr_e($uab_social_icons[$socialname]['icon']);?>"></i>
						</a>
					</li>
					<?php
				}
			}
		}
		?>
	</ul>
</div>
<?php }?>