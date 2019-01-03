<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
if(empty($unserialized_uab_profile_data)){
	_e( 'Please fill your Author Box', 'ultimate-author-box-lite' );
}else{
	//$this->print_array($unserialized_uab_profile_data);
}

?>
<div class="uab-profile-backend-wrapper">
	<div class="uab-profile-header-wrapper">
		<div class="uab-profile-header-main"><h2><?php _e( 'Ultimate Author Box Profile Settings', 'ultimate-author-box-lite' ); ?></h2>
		<p class="description"><?php _e('Please visit ','ultimate-author-box-lite');?><a href="https://accesspressthemes.com/documentation/ultimate-author-box-lite/" target="_blank">https://accesspressthemes.com/documentation/ultimate-author-box-lite/</a><?php _e(' for detail documentation.','ultimate-author-box-lite');?></p>
		</div>
	</div>
	<div class="uab-profile-content-wrapper">
		<div id="dialog" class="uab-tab-option" title="<?php _e( 'Select New Tab Option', 'ultimate-author-box-lite' ); ?>">
			<fieldset class="ui-helper-reset">
				<div>
					<div class="select-tab-wrapper uab-profile-field">
						<label for="uab-tab-type-selection"><?php _e( 'Select Tab Type', 'ultimate-author-box-lite' ); ?></label>
							<select class="uab-tab-type-selection " name="uab_profile_data[0][uab_tab_type_selection]">
									<option  value="uab_author_post"><?php _e( 'Author posts', 'ultimate-author-box-lite' ); ?></option>
									<option  value="uab_editor"><?php _e( 'WYSIWYG Editor', 'ultimate-author-box-lite' ); ?></option>
							</select>
						</div>
					</div>
					<div class="uab-profile-field">
						<label for="uab_tab_title"><?php _e( 'Tab Name', 'ultimate-author-box-lite' ); ?></label>
							<input type="text" name="uab_profile_data[0][uab_tab_title]" id="uab_tab_title" value="<?php _e( 'New tab', 'ultimate-author-box-lite' ); ?>" class="ui-widget-content ui-corner-all">  
					</div>
				</div>
			</fieldset>	
		</div><!--End Of Dialog Box--> 

		<div id="tabs" class="uab-backend-tabs">
			<div class="uab-variable-width-wrapper">
				<ul class="uab-variable-width">
					<!-- Initial Static Tab -->
					<li><a href="#tabs-d"><?php _e( 'Author Details', 'ultimate-author-box-lite' ); ?></a></li>
					<!-- Dynamic Add New Tabs -->
					<?php
					if (!empty($unserialized_uab_profile_data)) {
						foreach( $unserialized_uab_profile_data as $index=>$val ){
							$keyArray[$index] = $index;
							if( $keyArray[$index] != '0' && $keyArray[$index] != 'uab_id' && $keyArray[$index] != '1'){
								?>

								<li><a href='#tabs-<?php esc_attr_e($index);?>'><?php echo (isset( $unserialized_uab_profile_data[$index]['uab_tab_name'] )) ? esc_attr( $unserialized_uab_profile_data[$index]['uab_tab_name'] ) : 'Tab'.$index;?><span class='ui-icon ui-icon-close' role='presentation'></span></a></li>
								<?php
							}

						}
					}
					?>
				</ul><!-- End of Tabs ul or Header definition -->
				<!-- Add New Tab Button -->
				<div class="uab-right-elements">
					<input type="button" value="<?php _e( '+', 'ultimate-author-box-lite' ); ?>" id="uab-add-field" title="<?php _e( 'New Tab', 'ultimate-author-box-lite' ); ?>">
				<?php 
				$uab_customizer_restriction = 0;
				if(isset($uab_general_settings['uab_disable_customizer']) && !empty($uab_general_settings['uab_disable_customizer']) && $uab_general_settings['uab_disable_customizer'] == 1):
					$uab_customizer_restriction = 1;
					?>
				<?php endif;?>
				<div id="uab-template-settings" title="<?php _e( 'Template Settings', 'ultimate-author-box-lite' ); ?>" <?php if($uab_customizer_restriction == 1) esc_attr_e('style=display:none;');?>><i class="fa fa-code"></i></div>
				</div>
			</div>
			

			
			<div id="tabs-d">
				<!-- <input type="hidden" name="uab_tab_keys" class="uab-tab-keys" value="<?php echo (isset($uab_key_set) ? esc_attr($uab_key_set) : ''); ?>"> -->
				<?php include(UAB_PATH . '/inc/backend/uab-backend-tabs/uap-defaut-tab.php'); ?>
			</div><!--End of Default Tab-->
			<?php
		        if (!empty($unserialized_uab_profile_data)) {
		            foreach ($unserialized_uab_profile_data as $key => $val) {
		        	    $keyArray[$key] = $key;
		          		if( $keyArray[$key] != '0' && $keyArray[$key] != 'uab_id' && $keyArray[$key] != '1'){
		                ?>  
			                <div id="tabs-<?php esc_attr_e($key);?>" class="uab-tab-panel">
			                <?php 
			                	if(isset($unserialized_uab_profile_data[$key]['uab_tab_type'])){
				                	switch($unserialized_uab_profile_data[$key]['uab_tab_type']) {
										case 'uab_author_post':
											?>
											<div class="uab-recent-post-wrapper uap-option-wrapper">
												<input type="hidden" id="uab_tab_name" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_tab_name]" value="<?php esc_attr_e($unserialized_uab_profile_data[$key]['uab_tab_name']);?>">
												<input type="hidden" id="uab_tab_type" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_tab_type]" value="<?php esc_attr_e($unserialized_uab_profile_data[$key]['uab_tab_type']);?>">
												<div class="uab-recent-post-header-wrapper uab-title-wrapper uab-profile-header">
													<h2><?php _e( 'Author Posts', 'ultimate-author-box-lite' ); ?></h2>
												</div>
												<div class="uab-profile-content-wrapper">
													<div class="author-post-wrapper">
														<div class="latest-posts-wrapper uab-author-post-option uab-profile-field">
															<label><?php _e( 'Frontend Tab Title', 'ultimate-author-box-lite' ); ?></label>	
															<input type="text" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_author_post_tab_title]" value="<?php echo (isset( $unserialized_uab_profile_data[$key]['uab_author_post_tab_title'] )) ? esc_attr( $unserialized_uab_profile_data[$key]['uab_author_post_tab_title'] ) : ''; ?>"/>
														</div>
														<div class="latest-posts-wrapper uab-author-post-option uab-profile-field">
															<label><?php _e( 'Number of posts', 'ultimate-author-box-lite' ); ?></label>	
															<input type="number" min="0" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_post_number]" value="<?php echo (isset( $unserialized_uab_profile_data[$key]['uab_post_number'] )) ? esc_attr( $unserialized_uab_profile_data[$key]['uab_post_number'] ) : ''; ?>"/>
														</div>
														<div class="uab-field uab-profile-field">
															<label><?php _e( 'Select Post Type', 'ultimate-author-box-lite' ); ?></label>
															<select class="uab_post_select " name="uab_profile_data[<?php esc_attr_e($key);?>][uab_post_select]" >
																<option value="uab_latest_posts" <?php if ( $unserialized_uab_profile_data[$key]['uab_post_select'] =='uab_latest_posts' ) echo 'selected'; ?>><?php _e( 'Latest Posts', 'ultimate-author-box-lite' ); ?></option>
																<option value="uab_selective_posts" <?php if ( $unserialized_uab_profile_data[$key]['uab_post_select'] =='uab_selective_posts' ) echo 'selected'; ?>><?php _e( 'Selective Posts', 'ultimate-author-box-lite' ); ?></option>
															</select>
														</div>
														<div class="uab-selective-posts uab-author-post-option uab-profile-field" <?php if($unserialized_uab_profile_data[$key]['uab_post_select'] =='uab_latest_posts') echo 'style="display:none;"' ;?>>
															<label><?php _e( 'Posts to show', 'ultimate-author-box-lite' ); ?></label>
															<div class="uab-profile-content-wrapper uab-profile-recent-post-list-wrapper">
																<?php
																$recent = get_posts(array(
																	'posts_per_page' => '-1',
																	'author'=> $user->ID,
																	'orderby'=>'date',
																	'order'=>'desc',
																));
																if( $recent ){
																	foreach($recent as $post){
																		$title = get_the_title($post->ID);		
																		?>
																		<div class="uab-profile-recent-post-list">
																		<input type="checkbox" value="<?php esc_attr_e($post->ID);?>" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_post_list][]"

																		<?php 
																		if( isset($unserialized_uab_profile_data[$key]['uab_post_list'])){
																			foreach( $unserialized_uab_profile_data[$key]['uab_post_list'] as $innerKey => $type){
																				if($post->ID==$type) echo 'checked';
																			}
																		}
																		?>
																		><?php _e($title); ?>
																		</div>
																		<?php
																	}
																}else{
																	_e('The User does not have any posts','ultimate-author-box-lite','ultimate-author-box-lite');
																}?>
															</div>
														</div>
													</div>
												</div>
											</div><!-- End of Recent Posts-->
											<?php
										break;
		
										case 'uab_editor':
											?>
												<input type="hidden" id="uab_tab_name" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_tab_name]" value="<?php esc_attr_e($unserialized_uab_profile_data[$key]['uab_tab_name']);?>">
												<input type="hidden" id="uab_tab_type" name="uab_profile_data[<?php esc_attr_e($key);?>][uab_tab_type]" value="<?php esc_attr_e($unserialized_uab_profile_data[$key]['uab_tab_type']);?>">
												<?php
													$allowed_html = wp_kses_allowed_html( 'post' );
													$retrieved_value = (isset($uab_wysiwyg_content[$key]) && !empty($uab_wysiwyg_content[$key]))?$uab_wysiwyg_content[$key]:'';
													$content = stripslashes(stripslashes(wp_kses($retrieved_value,$allowed_html)));
													$editor_id = "uab-wysiwyg-content-" . esc_attr__($key);
													$settings = array(
														'textarea_name'	=> 'uab_wysiwyg_content[' . esc_attr__($key) . ']',
														'media_buttons'	=> true,
														'wpautop'		=> false,
														'editor_class'	=> 'uab-editor',
														'editor_height'	=> 200,
														// 'quicktags'		=> array('buttons'=>'a,b,i,strong,em,ul,ol,li'),
													);
													wp_editor( $content , $editor_id , $settings );
												?>
											<?php
										break;
										default:
									
									}
			                	}	

							?>
			                </div><!-- End of Dynamic Tab-->
		               	<?php
		           	}
		            }
			    }
			?>
			<div class="uab-custom-tab ui-tabs-panel" style="display:none;">
				<div class="uab-profile-content-wrapper">
					<div class="uab-field uab-profile-field">
						<label><?php _e('Enable Personal Template','ultimate-author-box-lite');?></label>
						<input type="checkbox" name="uab_profile_data[1][uab_personal_theme]" <?php if ( isset($unserialized_uab_profile_data[1]['uab_personal_theme'] )) echo 'checked'; ?>>
					</div>
					<div class="uab-field uab-profile-field">
						<label for="uab-tab-type-selection"><?php _e( 'Select Template', 'ultimate-author-box-lite' ); ?></label>
						<select class="uab-select-input1 uab-select-template"  name="uab_profile_data[1][uab_select_template]">	<optgroup label="<?php _e( 'Default template', 'ultimate-author-box-lite' ); ?>"></optgroup>
							<option  value="uab-template-1" <?php if (isset($unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template']=='uab-template-1' ) echo 'selected'; ?>><?php _e( 'Template 1', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-2" <?php if (isset( $unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template'] == 'uab-template-2') echo 'selected'; ?>><?php _e( 'Template 2', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-3" <?php if (isset( $unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template']=='uab-template-3') echo 'selected'; ?>><?php _e( 'Template 3', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-4" <?php if (isset( $unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template'] =='uab-template-4' ) echo 'selected'; ?>><?php _e( 'Template 4', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-5" <?php if (isset( $unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template'] =='uab-template-5' ) echo 'selected'; ?>><?php _e( 'Template 5', 'ultimate-author-box-lite' ); ?></option>
							<optgroup label="<?php _e( 'Custom template', 'ultimate-author-box-lite' ); ?>"></optgroup>
									<option  value="uab-custom-template" <?php if (isset( $unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template'] =='uab-custom-template') echo 'selected'; ?>><?php _e( 'Custom Template', 'ultimate-author-box-lite' ); ?></option>
						</select>
					</div>
						<div class="uab-template-image-preview" <?php if(isset($unserialized_uab_profile_data[1]['uab_select_template']) &&  $unserialized_uab_profile_data[1]['uab_select_template'] == 'uab-custom-template') echo 'style="display:none;"';?>>
							<?php 
								$uab_image_source='uab-template-1.PNG';
								if(isset($unserialized_uab_profile_data[1]['uab_select_template'])){
									$uab_select_template = $unserialized_uab_profile_data[1]['uab_select_template'];
								}
								else{
									$uab_select_template = 'uab-template-1';
								}
								switch($uab_select_template){
									case 'uab-template-1':
									$uab_image_source='uab-template-1.PNG';
									break;
									case 'uab-template-2':
									$uab_image_source='uab-template-2.PNG';
									break;
									case 'uab-template-3':
									$uab_image_source='uab-template-3.PNG';
									break;
									case 'uab-template-4':
									$uab_image_source='uab-template-4.PNG';
									break;
									case 'uab-template-5':
									$uab_image_source='uab-template-5.PNG';
									break;
									default:
									$uab_image_source='uab-template-1.PNG';
								}							
							?>
							<img src="<?php esc_attr_e(UAB_IMG_DIR); ?>/uab-template-screenshorts/<?php esc_attr_e($uab_image_source); ?>" width="100%"/>
						</div>
					<div class="uab-personal-template-select" <?php if(!(isset($unserialized_uab_profile_data[1]['uab_select_template']) && $unserialized_uab_profile_data[1]['uab_select_template'] =='uab-custom-template')) echo 'style="display:none;"'?>>
						<div class="uab-field uab-profile-field">
							<label for="uab-tab-type-selection"><?php _e( 'Select Custom Template', 'ultimate-author-box-lite' ); ?></label>
							<select class="uab-select-input1 uab-custom-template"  name="uab_profile_data[1][uab_custom_template]">
								<option  value="uab-template-1" <?php if (isset( $unserialized_uab_profile_data[1]['uab_custom_template']) && $unserialized_uab_profile_data[1]['uab_custom_template']=='uab-template-1' ) echo 'selected'; ?>><?php _e( 'Template 1', 'ultimate-author-box-lite' ); ?></option>
								<option  value="uab-template-2" <?php if (isset( $unserialized_uab_profile_data[1]['uab_custom_template']) &&  $unserialized_uab_profile_data[1]['uab_custom_template']=='uab-template-2' ) echo 'selected'; ?>><?php _e( 'Template 2', 'ultimate-author-box-lite' ); ?></option>
								<option  value="uab-template-3" <?php if (isset( $unserialized_uab_profile_data[1]['uab_custom_template']) &&  $unserialized_uab_profile_data[1]['uab_custom_template']=='uab-template-3' ) echo 'selected'; ?>><?php _e( 'Template 3', 'ultimate-author-box-lite' ); ?></option>
								<option  value="uab-template-4" <?php if (isset( $unserialized_uab_profile_data[1]['uab_custom_template']) &&  $unserialized_uab_profile_data[1]['uab_custom_template']=='uab-template-4' ) echo 'selected'; ?>><?php _e( 'Template 4', 'ultimate-author-box-lite' ); ?></option>
								<option  value="uab-template-5" <?php if (isset( $unserialized_uab_profile_data[1]['uab_custom_template']) &&  $unserialized_uab_profile_data[1]['uab_custom_template']=='uab-template-5' ) echo 'selected'; ?>><?php _e( 'Template 5', 'ultimate-author-box-lite' ); ?></option>
							</select>
						</div>
						<div class="uab-template-image-preview" >
							<?php 
								$uab_image_source='uab-template-1.PNG';
								if(isset($unserialized_uab_profile_data[1]['uab_custom_template'])){
									$uab_custom_template = $unserialized_uab_profile_data[1]['uab_custom_template'];
								}
								else{
									$uab_custom_template = 'uab-template-1';
								}
								switch($uab_custom_template){
									case 'uab-template-1':
									$uab_image_source='uab-template-1.PNG';
									break;
									case 'uab-template-2':
									$uab_image_source='uab-template-2.PNG';
									break;
									case 'uab-template-3':
									$uab_image_source='uab-template-3.PNG';
									break;
									case 'uab-template-4':
									$uab_image_source='uab-template-4.PNG';
									break;
									case 'uab-template-5':
									$uab_image_source='uab-template-5.PNG';
									break;
									default:
									$uab_image_source='uab-template-1.PNG';
								}							
							?>
							<img src="<?php esc_attr_e(UAB_IMG_DIR); ?>/uab-template-screenshorts/<?php esc_attr_e($uab_image_source); ?>" width="100%"/>
						</div>
						<?php //$this->print_array($unserialized_uab_profile_data[1]['uab_custom_template']);?>
						<div class="uab-field uab-profile-field uab-primary-color uab-custom-template-option">
							<label><?php _e('Primary Color','ultimate-author-box-lite');?></label>
							<input type="text" name="uab_profile_data[1][uab_primary_color]" data-alpha="true" value="<?php echo isset($unserialized_uab_profile_data[1]['uab_primary_color'])? esc_attr($unserialized_uab_profile_data[1]['uab_primary_color']) :'';?>" class="small uab-color-picker uab-primary-color-picker" >
						</div>
						<div class="uab-field uab-profile-field uab-secondary-color uab-custom-template-option" <?php if(isset($unserialized_uab_profile_data[1]['uab_custom_template']) && !($unserialized_uab_profile_data[1]['uab_custom_template'] == 'uab-template-3' || $unserialized_uab_profile_data[1]['uab_custom_template'] == 'uab-template-5')) echo 'style="display:none;"'; elseif(!isset($unserialized_uab_profile_data[1]['uab_custom_template'])) echo 'style="display:none;"';?>>
							<label><?php _e('Secondary Color','ultimate-author-box-lite');?></label>
							<input type="text" name="uab_profile_data[1][uab_secondary_color]" data-alpha="true" value="<?php echo isset($unserialized_uab_profile_data[1]['uab_secondary_color'] )? esc_attr( $unserialized_uab_profile_data[1]['uab_secondary_color']) : ''; ?>" class="small uab-color-picker uab-secondary-color-picker" >
						</div>
					</div>
				</div>
			</div>
		</div><!-- End Of Tabs-->
	</div>
</div>

<?php include(UAB_PATH . '/inc/backend/uab-backend-tabs/uap-skeleton-tab.php'); ?>

	
