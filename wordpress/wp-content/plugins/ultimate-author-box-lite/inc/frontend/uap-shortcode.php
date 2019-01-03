<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 
$uab_general_settings = get_option('uap_general_settings');

$uab_shortcode_atts = shortcode_atts( array(
	'user_id' => get_the_author_meta('ID'),
	'template' => isset($uab_general_settings['uab_template'])?$uab_general_settings['uab_template']:'uab-template-1'
	), $atts );
$uab_shortcode_atts['template'] = isset($uab_general_settings['uab_template'])?$uab_general_settings['uab_template']:'uab-template-1';
$uab_custom_template = $uab_general_settings['uab_custom_template'];
$uab_template_type = isset($atts['template'])?$atts['template']:$uab_general_settings['uab_template'];
$author_id = $uab_shortcode_atts['user_id']; 
$author_description = get_the_author_meta('description',$author_id);

$uab_profile_data = maybe_unserialize(get_the_author_meta( 'uab_profile_data', $author_id));

$allowed_html = wp_kses_allowed_html('post');
$author_description = (isset($uab_profile_data[0]['uab_custom_description_status']) && !empty($uab_profile_data[0]['uab_custom_description']))?wp_kses($uab_profile_data[0]['uab_custom_description'],$allowed_html):'';

$uab_social_icons = maybe_unserialize(get_the_author_meta( 'uab_social_icons', $author_id));
$uab_wysiwyg_content = maybe_unserialize(get_the_author_meta( 'uab_wysiwyg_content', $author_id ));	

$uab_access_roles = $uab_general_settings['uab_user_roles'];

$uab_current_user_roles = new WP_User($author_id);

if ( !empty( $uab_current_user_roles->roles ) && is_array( $uab_current_user_roles->roles ) ) {
	foreach ( $uab_current_user_roles->roles as $role )
		$uab_current_user_role = $role;
}

if (isset($uab_social_icons) && !empty($uab_social_icons)){
	$error_flag="1";
	foreach($uab_social_icons as $key => $val) {
		if (!empty($val['url']))
			$error_flag="0";
	}
}else{
	$error_flag="1";
}


if(isset($uab_profile_data[1]['uab_personal_theme'])=='on'){
	$uab_temp_template = '';
	if(isset($uab_profile_data[1]['uab_select_template']) && $uab_profile_data[1]['uab_select_template'] == 'uab-custom-template'){
		$uab_temp_template = $uab_profile_data[1]['uab_select_template'];
		$uab_template_type = $uab_profile_data[1]['uab_custom_template'];
		include(UAB_PATH . 'inc/frontend/uab-custom-css.php');
	}else{
		$uab_temp_template = $uab_profile_data[1]['uab_select_template'];
		$uab_template_type = $uab_profile_data[1]['uab_select_template'];
	}
}else{
	$uab_temp_template = '';
	if($uab_template_type == 'uab-custom-template'){
		$uab_temp_template = $uab_template_type;
		$uab_template_type = $uab_custom_template;
		include(UAB_PATH . 'inc/frontend/uab-custom-css.php');
	}
}

if ($uab_general_settings['uab_disable_uab']){
	//echo 'Disable author box';
}else{
	if ($uab_general_settings['uab_empty_bio'] && $author_description == ''){
		//echo 'The Author Box Will not show if the author bio is empty';
	}
	else{
		if(in_array($uab_current_user_role, $uab_access_roles) || !empty($uab_profile_data)){
			?>
			<div id="uab-frontend-wrapper"  class="uab-frontend-wrapper 
			<?php 
			if($uab_temp_template == 'uab-custom-template'){
				esc_attr_e($uab_template_type.' uab-custom-template');
			}else{
				esc_attr_e($uab_template_type);  	
			}
			if($error_flag && $uab_template_type == 'uab-template-4') echo ' uab-hidden-icon';
			?>">
				<div id="uab-tab-index-wrapper" class="uab-tab-index-wrapper" <?php if(count($uab_profile_data)<'4') echo 'style="display:none;"'?>>
					<ul class="uab-tabs uab-clearfix">
						<li class="tab-link uab_author_detail uab-current" data-tab="tab-1" data-name="<?php !empty($uab_profile_data[0]['uab-frontend-title'])? esc_html_e($uab_profile_data[0]['uab-frontend-title']):esc_html_e('Author Details','ultimate-author-box-lite');?>">
							<?php !empty($uab_profile_data[0]['uab-frontend-title'])? esc_html_e($uab_profile_data[0]['uab-frontend-title']):esc_html_e('Author Details','ultimate-author-box-lite');
							?>
						</li>
						<?php
						if (!empty($uab_profile_data)) {
							foreach( $uab_profile_data as $index=>$val ){
								$keyArray[$index] = $index;
								if( $keyArray[$index] != '0' && $keyArray[$index] != 'uab_id' && $keyArray[$index] != '1'){
									?>
									<li class="tab-link <?php esc_attr_e($uab_profile_data[$index]['uab_tab_type']);?>" data-tab="tab-<?php esc_attr_e($index);?>" data-name="<?php 
										echo (isset( $uab_profile_data[$index]['uab_tab_name'] )) ? esc_attr($uab_profile_data[$index]['uab_tab_name']) : 'Tab'.$index ;?>">
										<?php 
										echo (isset( $uab_profile_data[$index]['uab_tab_name'] )) ? esc_html($uab_profile_data[$index]['uab_tab_name']) : 'Tab'.$index ;?>
									</li>
									<?php
								}
							}
						}
						?>
					</ul>
				</div>

				
				<div id="tab-1" class="uab-tab-content uab-current">
					<?php
					if($uab_template_type == 'uab-template-3'){
						?>
						<div class="uab-temp-wrapper "><?php
						}
						?>
						<div class="uab-defaut-tab-wrapper ">
							<div class="uab-defaut-tab 
							<?php 
							if($uab_template_type != 'uab-template-3') esc_attr_e('uab-clearfix');
							?>"
							>
								<?php 
								include(UAB_PATH . '/inc/frontend/frontend-default/uab-default.php');
								?>
							</div>
						</div>
						<?php
						if($uab_template_type == 'uab-template-3'){
							include(UAB_PATH . 'inc/frontend/frontend-default/components/uab-component-social.php');
						}
						?>
					</div>	
					<?php

					if($uab_template_type == 'uab-template-3'){
						?></div><?php
					}

					if (!empty($uab_profile_data)) {
						foreach ($uab_profile_data as $key => $val) {
							$keyArray[$key] = $key;
							if( $keyArray[$key] != '0' && $keyArray[$key] != 'uab_id' && $keyArray[$key] != '1'){
								?>  
								<div id="tab-<?php esc_attr_e($key);?>" class="uab-tab-content">
									<?php 
									if(isset($uab_profile_data[$key]['uab_tab_type'])){
										switch($uab_profile_data[$key]['uab_tab_type']) {
											case 'uab_author_post':
											include(UAB_PATH . '/inc/frontend/frontend-posts/uab-frontend-posts.php');
											break;
											case 'uab_editor':
											?>
											<div class="uab-frontend-editor">
												<?php _e(do_shortcode($uab_wysiwyg_content[$key])); ?>
											</div>
											<?php
											break;
											default:
											esc_html_e('No Tab Selected','ultimate-author-box-lite');
										}
									}	
									?>

								</div>
								<?php
							}
						}
					}
					?>
					
				</div>
				<?php
			}	
		} 
	}	
	?>

	<?php

	if ($uab_general_settings['uab_custom_css']){
		echo '<style>';
		_e($uab_general_settings['uab_custom_css']);
		echo '</style>';

	}

	?>
