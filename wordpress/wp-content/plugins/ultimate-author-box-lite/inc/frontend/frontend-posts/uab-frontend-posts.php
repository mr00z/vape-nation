<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php if($uab_template_type == 'uab-template-6'):?>
<div class="uab-content-header">
	<div class="uab-tab-header"><?php esc_attr_e($uab_profile_data[$key]['uab_tab_name']);?></div>
</div>
<div class="uab-clearfix">
	<div class="uab-content-mid <?php if($uab_template_type == 'uab-template-6') esc_attr_e('uab-clearfix');?>">
		<div class="uab-content-mid-inner-1">
			<?php
			if($uab_template_type == 'uab-template-6'){
				include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-image.php');
				include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-name.php');
			}
			?>
		</div>
		<div class="uab-content-mid-inner-2">
			<div class="uab-content-temp-wrapper">
<?php endif;?>
<?php if($uab_template_type == 'uab-template-14'):?>
<div class="uab-defaut-tab uab-clearfix">	
<div class="uab-content-temp-wrapper">
<?php 
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-image.php');
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-name.php');
?>
</div>
<div class="uab-front-content">
<?php endif;?>
<?php if($uab_template_type == 'uab-template-16'):?>
<div class="uab-defaut-tab uab-clearfix">	
<div class="uab-content-temp-wrapper">
<?php 
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-image.php');
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-contact.php');
	include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');
?>
</div>
<div class="uab-front-content">
<?php endif;?>
			<div class="uab-recent-posts <?php if($uab_template_type == 'uab-template-2'||$uab_template_type == 'uab-template-3'||$uab_template_type == 'uab-template-4') echo 'uab-clearfix'?>">
				<?php
				if($uab_template_type == 'uab-template-5'){
					?>
					<div class="uab-post-header"><?php esc_attr_e($uab_profile_data[$key]['uab_tab_name']);?></div>
					<?php
				}
				?>
				<ul <?php if($uab_template_type == 'uab-template-5' || $uab_template_type == 'uab-template-7'|| $uab_template_type == 'uab-template-8'|| $uab_template_type == 'uab-template-9' ) echo 'class="uab-clearfix"';?>>
					<?php
					$uab_post_list = ((isset($uab_profile_data[$key]['uab_post_list']) && $uab_profile_data[$key]['uab_post_list'] != '')?$uab_profile_data[$key]['uab_post_list']:array());
					$uab_post_number = ((isset($uab_profile_data[$key]['uab_post_number']) && $uab_profile_data[$key]['uab_post_number'] != '')?$uab_profile_data[$key]['uab_post_number']:'5');
					$uab_post_excerpt = ((isset($uab_profile_data[$key]['uab_author_post_readmore']) && $uab_profile_data[$key]['uab_author_post_readmore'] != '')?$uab_profile_data[$key]['uab_author_post_readmore']: __('Read more...','ultimate-author-box-lite'));
					if(!empty($uab_profile_data[$key]['uab_post_select'])){
						switch($uab_profile_data[$key]['uab_post_select']){
							case 'uab_selective_posts':
							$postsids = implode(',', $uab_post_list);
							break;
							default:
							$postsids = '';
						}
					}	
					$recent = get_posts(array(
						'author'=> $author_id,
						'orderby'=>'date',
						'order'=>'desc',
						'numberposts' => $uab_post_number,
						'include' => $postsids,
					));

					if( $recent ){
						foreach($recent as $post){
							?>
							<li <?php if(!has_post_thumbnail($post->ID)) echo 'class="uab-no-image"';?>>
								<?php
								include(UAB_PATH . '/inc/frontend/frontend-posts/modules/uab-modues-1.php');
								?>
							</li>
							<?php
						}	
					}else{
						esc_html_e('The User does not have any posts','ultimate-author-box-lite');
					}
					?>
				</ul>
			</div>
<?php if($uab_template_type == 'uab-template-16'):?>
	</div>
</div>
<?php endif;?>
<?php if($uab_template_type == 'uab-template-14'):?>
	</div>
</div>
<?php endif;?>	
<?php if($uab_template_type == 'uab-template-6'):?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>	
