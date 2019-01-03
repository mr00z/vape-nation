<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$uab_general_settings = get_option( 'uap_general_settings' );
$uab_general_settings = empty( $uab_general_settings ) ? array() : $uab_general_settings;
//$this->print_array($uab_general_settings);

?>
<!-- Save settings and Restore Success Message -->
<?php if ( isset( $_GET['message'] ) ) {
	?>
	<div class="notice notice-success is-dismissible"><p><?php _e( 'Settings saved successfully', 'ultimate-author-box-lite' ); ?></p></div>
	<?php }
	if ( isset( $_GET['restore-message'] ) ) {?>
	<div class="notice notice-success is-dismissible"><p><?php _e( 'Settings restored to default successfully', 'ultimate-author-box-lite' ); ?></p></div>
	<?php }
	?>
	<div class="uab-settings-header-wrapper-main">
		<div class="uab-settings-header-wrapper-main-wrap uab-clearfix">
			<div class="uab-settings-header-title">
				<div class="uab-title-menu"><?php _e('Ultimate Author Box Lite');?></div>
				<div class="uab-version-wrap">
					<span>Version <?php _e(UAB_VERSION);?></span>
				</div>
			</div>
			<div class="uab-header-social-link">
				<p class="uab-follow-us"><?php _e( 'Follow us for new updates', 'ultimate-author-box-lite' ); ?></p>
				<iframe src="//www.facebook.com/plugins/follow?href=https%3A%2F%2Fwww.facebook.com%2FAccessPressThemes&amp;layout=button&amp;show_faces=true&amp;colorscheme=light&amp;width=450&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:px; height:20px;" allowTransparency="true"></iframe>
				<iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" class="twitter-follow-button twitter-follow-button-rendered" style="position: static; visibility: visible; width:px; height: 20px;" title="Twitter Follow Button" src="http://platform.twitter.com/widgets/follow_button.c4fd2bd4aa9a68a5c8431a3d60ef56ae.en.html#dnt=false&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=apthemes&amp;show_count=false&amp;show_screen_name=true&amp;size=m&amp;time=1484717853708" data-screen-name="accesspressthemes"></iframe>
			</div>
		</div>
	</div><!--End of uab-settings-header-wrapper-main-->
	<div class="uab-setting-page-wrapper">
		<form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
			<input type="hidden" name="action" value="uab_settings_save_action"/>
			<div class="uab-tabs-wrap">
				<ul class="uab-tabs">
					<li class="tab-link uab-general-setting-tab current" data-tab="tab-1"><?php _e( 'General Settings', 'ultimate-author-box-lite' ); ?></li>
					<li class="tab-link uab-permission-setting-tab" data-tab="tab-4"><?php _e( 'Permission Settings', 'ultimate-author-box-lite' ); ?></li>
					<li class="tab-link uab-layout-setting-tab" data-tab="tab-3"><?php _e( 'Layout Settings', 'ultimate-author-box-lite' ); ?></li>
					<li class="tab-link uab-custom-setting-tab" data-tab="tab-5"><?php _e( 'Custom Settings', 'ultimate-author-box-lite' ); ?></li>
				</ul>
			</div>
			<div id="tab-5" class="uab-tab-content">
				<div class="uab-settings-header-wrapper">
					<h3><?php _e('Custom Theme Settings','ultimate-author-box-lite');?></h3>
				</div><!--End of uab-settings-header-wrapper-->
				<div class="uab-custom-settings-content-wrapper">
					<div class="uab-fields uab-content-wrapper">
						<div class="uab-label-info-wrap">
							<label for="uab-tab-type-selection"><?php _e( 'Select Template', 'ultimate-author-box-lite' ); ?></label>
						</div>
						<select class="uab-select-input1 uab-custom-template"  name="uab_custom_template">
							<option  value="uab-template-1" <?php if ( $uab_general_settings['uab_custom_template']=='uab-template-1' ) echo 'selected'; ?>><?php _e( 'Template 1', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-2" <?php if ( $uab_general_settings['uab_custom_template']=='uab-template-2' ) echo 'selected'; ?>><?php _e( 'Template 2', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-3" <?php if ( $uab_general_settings['uab_custom_template']=='uab-template-3' ) echo 'selected'; ?>><?php _e( 'Template 3', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-4" <?php if ( $uab_general_settings['uab_custom_template']=='uab-template-4' ) echo 'selected'; ?>><?php _e( 'Template 4', 'ultimate-author-box-lite' ); ?></option>
							<option  value="uab-template-5" <?php if ( $uab_general_settings['uab_custom_template']=='uab-template-5' ) echo 'selected'; ?>><?php _e( 'Template 5', 'ultimate-author-box-lite' ); ?></option>
							
						</select>
					</div>
					<div class="uab-template-image-preview">
						<?php 
						$uab_image_source='uab-template-1.PNG';
						switch($uab_general_settings['uab_custom_template']){
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
					<?php //echo $uab_general_settings['uab_custom_template'];?>
					<div class="uab-fields uab-content-wrapper uab-primary-color uab-custom-template-option">
						<div class="uab-label-info-wrap">
							<label><?php _e('Primary Color','ultimate-author-box-lite');?></label>
						</div>
						<div>
							<input type="text" name="uab_primary_color" data-alpha="true" value="<?php esc_attr_e(isset($uab_general_settings['uab_primary_color'])?$uab_general_settings['uab_primary_color']:'');?>" class="uab-color-picker uab-primary-color-picker" >
						</div>
					</div>
					<div class="uab-fields uab-content-wrapper uab-secondary-color uab-custom-template-option" 

					<?php if(!(
						$uab_general_settings['uab_custom_template']=='uab-template-3'||
						$uab_general_settings['uab_custom_template']=='uab-template-5'
						)){
						echo 'style="display:none;"'; 
					} 
					elseif(!isset($uab_general_settings['uab_custom_template'])) 
					{
						echo 'style="display:none;"';	
					}
					?>>
					<div class="uab-label-info-wrap">
						<label><?php _e('Secondary Color','ultimate-author-box-lite');?></label>
					</div>
					<div>
						<input type="text" name="uab_secondary_color" data-alpha="true" value="<?php esc_attr_e( $uab_general_settings['uab_secondary_color']);?>" class="uab-color-picker uab-secondary-color-picker" >
					</div>
				</div>
			</div>
		</div>
		<div id="tab-1" class="uab-tab-content current">
			<div class="uab-settings-header-wrapper">
				<h3><?php _e('General Settings');?></h3>
			</div><!--End of uab-settings-header-wrapper-->
			<div class="uab-general-settings-content-wrapper">
				<div class="uap-disable-authorbox uab-content-wrapper">
					<div class="uab-label-info-wrap">
						<label><?php _e( 'Disable Ultimate Author Box', 'ultimate-author-box-lite' ); ?></label>
						<span class="uab-info"><?php _e( 'Disable Author Box in frontend entirely', 'ultimate-author-box-lite' ); ?></span>
					</div>	
					<div class="uab-slide-checkbox-wrapper">
						<div class="uab-slide-checkbox-wrapper-inner">
							<div class="uab-slide-checkbox">  
								<input type="checkbox" id="uab-disable-uab" name="uab_disable_uab" <?php if(!empty($uab_general_settings['uab_disable_uab'])) echo 'checked';?>>
								<label for="uab-disable-uab"></label>
							</div>
						</div>
					</div>
				</div>
				<div class="uab-postion-wrapper ">
					<span class="uab-inner-title"><?php _e( 'Choose place to show Author Box', 'ultimate-author-box-lite' ); ?></span>

					<div class="uap-disable-authorbox uab-content-wrapper">
						<div class="uab-label-info-wrap">
							<label><?php _e( 'Show in Posts', 'ultimate-author-box-lite' ); ?></label>
							<span class="uab-info"><?php _e( 'Check to show Ultimate Author Box in Posts', 'ultimate-author-box-lite' ); ?></span>
						</div>
						<div class="uab-slide-checkbox-wrapper">
							<div class="uab-slide-checkbox-wrapper-inner">
								<div class="uab-slide-checkbox">  
									<input type="checkbox" id="uab-posts" name="uab_posts" <?php if ( !empty($uab_general_settings['uab_posts'] )) echo 'checked'; ?> value="post">
									<label for="uab-posts"></label>
								</div>

							</div>
						</div>
					</div>
					<div class="uap-disable-authorbox uab-content-wrapper" >
						<div class="uab-label-info-wrap">
							<label><?php _e( 'Show in Pages', 'ultimate-author-box-lite' ); ?></label>
							<span class="uab-info"><?php _e( 'Check to show Ultimate Author Box in Pages', 'ultimate-author-box-lite' ); ?></span>
						</div>

						<div class="uab-slide-checkbox-wrapper">
							<div class="uab-slide-checkbox-wrapper-inner">
								<div class="uab-slide-checkbox">  
									<input type="checkbox" id="uab-pages" name="uab_pages" <?php if ( !empty($uab_general_settings['uab_pages'] )) echo 'checked'; ?> value="page">
									<label for="uab-pages"></label>
								</div>

							</div>
						</div>
					</div>
					<?php

					$args = array(
						'public'   => true,
						'_builtin' => false,
					);

			    			$output = 'names'; // names or objects, note names is the default
			    			$operator = 'and'; // 'and' or 'or'

			    			$post_types = get_post_types( $args, $output, $operator ); 
			    			?>
			    			<div class="uap-disable-authorbox uab-content-wrapper" <?php if(empty($post_types)) echo 'style="display:none;"';?>>
			    				<div class="uab-label-info-wrap">
			    					<label><?php _e( 'Show in Custom Post Types', 'ultimate-author-box-lite' ); ?></label>
			    					<span class="uab-info"><?php _e( 'Check to show Ultimate Author Box in Custom Post Type', 'ultimate-author-box-lite' ); ?></span>
			    				</div>
			    				<div class="uab-slide-checkbox-wrapper">
			    					<div class="uab-slide-checkbox-wrapper-inner">
			    						<div class="uab-slide-checkbox">  
			    							<input type="checkbox" id="uab-custom-posts" name="uab_custom_post" <?php if ( !empty($uab_general_settings['uab_custom_post'] )) echo 'checked'; ?>>
			    							<label for="uab-custom-posts"></label>
			    						</div>

			    					</div>
			    				</div>
			    			</div><!-- End of uap-disable-authorbox -->
			    			<div class="uab-custom-post-type-list-wrapper">
			    				<?php
			    				foreach ( $post_types  as $key=>$post_type ) {
			    					?>
			    					<div class="uab-single-checkbox-wrap">
			    						<div class="uab-single-checkbox">
			    							<input type="checkbox" id="uab-post-type-<?php esc_attr_e($key);?>" name="uab_custom_post_type_list[]" value="<?php esc_attr_e($post_type);?>" <?php 
			    							foreach( $uab_general_settings['uab_custom_post_type_list'] as $innerKey => $type){
			    								if($key==$type) echo 'checked';
			    							}
			    							?>>
			    							<label for="uab-post-type-<?php esc_attr_e($key);?>"></label>
			    						</div>
			    						<span class="uab-info"><?php _e($post_type);?></span>
			    					</div>
			    					<?php
			    				}
			    				?>
			    			</div><!-- End of uab-custom-post-type-list-wrapper -->
			    		</div><!-- End of uab-postion-wrapper -->	
			    		<div class="select-tab-wrapper uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label for="uab-tab-type-selection"><?php _e( 'Show Author Box at', 'ultimate-author-box-lite' ); ?></label>
			    			</div>
			    			<div>	
			    				<select class="uab-select-input"   name="uab_box_position">
			    					<option  value="uab_top" <?php if ( $uab_general_settings['uab_box_position'] == 'uab_top' ) echo 'selected'; ?>><?php _e( 'Top of Posts', 'ultimate-author-box-lite' ); ?></option>
			    					<option  value="uab_bottom" <?php if ( $uab_general_settings['uab_box_position'] == 'uab_bottom' ) echo 'selected'; ?>><?php _e( 'Bottom of Posts', 'ultimate-author-box-lite' ); ?></option>
			    					<option  value="uab_none" <?php if ( $uab_general_settings['uab_box_position'] == 'uab_none' ) echo 'selected'; ?>><?php _e( 'None', 'ultimate-author-box-lite' ); ?></option>
			    				</select>
			    			</div>
			    		</div>
			    		<div class="uap-hide-empty-authorbox uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label><?php _e( 'Hide Author Box if Author Biographical Info is empty', 'ultimate-author-box-lite' ); ?></label>
			    				<span class="uab-info"><?php _e( 'Check to hide Author Box if Author Biographical Info is empty', 'ultimate-author-box-lite' ); ?></span>
			    			</div>

			    			<div class="uab-slide-checkbox-wrapper">
			    				<div class="uab-slide-checkbox-wrapper-inner">
			    					<div class="uab-slide-checkbox">  
			    						<input type="checkbox" id="uab-empty-bio" name="uab_empty_bio" <?php if(!empty($uab_general_settings['uab_empty_bio'])) echo 'checked'; ?>>
			    						<label for="uab-empty-bio"></label>
			    					</div>

			    				</div>
			    			</div>
			    		</div>
			    		<div class="uap-show-default-authorbox uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label><?php _e( 'Show Default Biographical Info if empty', 'ultimate-author-box-lite' ); ?></label>
			    				<span class="uab-info"><?php _e( 'Check to Show Default Biographical Info if empty', 'ultimate-author-box-lite' ); ?></span>
			    			</div>

			    			<div class="uab-slide-checkbox-wrapper">
			    				<div class="uab-slide-checkbox-wrapper-inner">
			    					<div class="uab-slide-checkbox">  
			    						<input type="checkbox" id="uab-default-bio" name="uab_default_bio" <?php if ( !empty($uab_general_settings['uab_default_bio']) ) echo 'checked'; ?>>
			    						<label for="uab-default-bio"></label>
			    					</div>

			    				</div>
			    			</div>
			    		</div>
			    		<div class="uap-default-authorbox-message uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label><?php _e( 'Default Author Box Message', 'ultimate-author-box-lite' ); ?></label>
			    			</div>
			    			<div>
			    				<textarea name="uab_default_message"><?php echo (isset( $uab_general_settings['uab_default_message'] )) ? esc_attr( $uab_general_settings['uab_default_message'] ) : ''; ?></textarea>
			    			</div> 
			    		</div>
			    		<div class="select-tab-wrapper uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label for="uab-link-target-option"><?php _e( 'Frontend link target options ', 'ultimate-author-box-lite' ); ?></label>
			    			</div>
			    			<div>
			    				<select class="uab-select-input" id="uab-link-target-option" name="uab_link_target_option">
			    					<option  value="_blank" <?php if ( $uab_general_settings['uab_link_target_option']=='_blank' ) echo 'selected'; ?>><?php _e( 'New Page', 'ultimate-author-box-lite' ); ?></option>
			    					<option  value="_self" <?php if ( $uab_general_settings['uab_link_target_option']=='_self' ) echo 'selected'; ?>><?php _e( 'Same Page', 'ultimate-author-box-lite' ); ?></option>
			    				</select>
			    			</div>
			    		</div>
			    		<div class="select-tab-wrapper uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label for="uab-author-name-link"><?php _e( 'Author Name link to Author Archive', 'ultimate-author-box-lite' ); ?></label>
			    			</div>
			    			<div class="uab-slide-checkbox-wrapper">
			    				<div class="uab-slide-checkbox-wrapper-inner">
			    					<div class="uab-slide-checkbox">  
			    						<input type="checkbox" id="uab-author-name-link" name="uab_author_name_link" <?php if ( !empty($uab_general_settings['uab_author_name_link']) ) echo 'checked'; ?>>
			    						<label for="uab-author-name-link"></label>
			    					</div>

			    				</div>
			    			</div>
			    		</div>
			    	</div><!--End of uab-general-settings-content-wrapper-->
			    </div><!--End of tab 1-->
			    <div id="tab-4" class="uab-tab-content">
			    	<div class="uab-template-settings-wrapper">
			    		<div class="uab-customize-header-wrapper uab-settings-header-wrapper">
			    			<h3><?php _e('Permission Settings');?></h3>
			    		</div><!--End of uab-settings-header-wrapper-->
			    		<div class="uab-permission-settings uab-template-settings">
			    			<span class="uab-backend-description"><?php _e('Manage user permission for author box user fields access.','ultimate-author-box-lite');?></span>
			    			<div class="uab-content-wrapper">
			    				<div class="uab-label-info-wrap">
			    					<label><?php _e( 'Choose user roles', 'ultimate-author-box-lite' ); ?></label>
			    					<span class="uab-info"><?php _e( 'Select user roles for user fields access', 'ultimate-author-box-lite' ); ?></span>
			    				</div>
			    				<div class="uab-custom-post-type-list-wrapper">
			    					<?php
			    					$user_role_list = $this->get_editable_roles();
			    					foreach($user_role_list as $key => $value){
			    						?>
			    						<div class="uab-single-checkbox-wrap">
			    							<div class="uab-single-checkbox">
			    								<input type="checkbox" id="uab-post-type-<?php esc_attr_e($key);?>" name="uab_user_roles[]" value="<?php esc_attr_e($key);?>" <?php if(in_array($key,$uab_general_settings['uab_user_roles'])) echo 'checked';?>>
			    								<label for="uab-post-type-<?php esc_attr_e($key);?>"></label>
			    							</div>
			    							<span class="uab-info"><?php _e($user_role_list[$key]['name']);?></span>
			    						</div>
			    						<?php
			    					}
			    					?>
			    				</div><!-- End of uab-custom-post-type-list-wrapper -->
			    			</div><!-- End of uap-disable-authorbox -->
			    		</div>
			    	</div>
			    </div>
			    <div id="tab-3" class="uab-tab-content">
			    	<div class="uab-template-settings-wrapper">
			    		<div class="uab-customize-header-wrapper uab-settings-header-wrapper">
			    			<h3><?php _e('Layout Settings','ultimate-author-box-lite');?></h3>
			    		</div><!--End of uab-settings-header-wrapper-->
			    		<div class="uab-template-settings">
			    			<div class="select-tab-wrapper uab-content-wrapper">
			    				<div class="uab-label-info-wrap">
			    					<label for="uab-tab-type-selection"><?php _e( 'Select Template', 'ultimate-author-box-lite' ); ?></label>
			    				</div>
			    				<div>
			    					<select class="uab-select-input-1 uab-template-select"  name="uab_template">
			    						<optgroup label="<?php _e( 'Default template', 'ultimate-author-box-lite' ); ?>"></optgroup>
			    						<option  value="uab-template-1" <?php if ( $uab_general_settings['uab_template']=='uab-template-1' ) echo 'selected'; ?>><?php _e( 'Template 1', 'ultimate-author-box-lite' ); ?></option>
			    						<option  value="uab-template-2" <?php if ( $uab_general_settings['uab_template']=='uab-template-2' ) echo 'selected'; ?>><?php _e( 'Template 2', 'ultimate-author-box-lite' ); ?></option>
			    						<option  value="uab-template-3" <?php if ( $uab_general_settings['uab_template']=='uab-template-3' ) echo 'selected'; ?>><?php _e( 'Template 3', 'ultimate-author-box-lite' ); ?></option>
			    						<option  value="uab-template-4" <?php if ( $uab_general_settings['uab_template']=='uab-template-4' ) echo 'selected'; ?>><?php _e( 'Template 4', 'ultimate-author-box-lite' ); ?></option>
			    						<option  value="uab-template-5" <?php if ( $uab_general_settings['uab_template']=='uab-template-5' ) echo 'selected'; ?>><?php _e( 'Template 5', 'ultimate-author-box-lite' ); ?></option>
			    						<optgroup label="<?php _e( 'Custom template', 'ultimate-author-box-lite' ); ?>"></optgroup>
			    						<option  value="uab-custom-template" <?php if ( $uab_general_settings['uab_template']=='uab-custom-template' ) echo 'selected'; ?>><?php _e( 'Custom Template', 'ultimate-author-box-lite' ); ?></option>

			    					</select>
			    				</div>
			    			</div>
			    			<div class="uab-template-image-preview" <?php if($uab_general_settings['uab_template'] == 'uab-custom-template') echo 'style="display:none;"';?>>
			    				<?php 
			    				$uab_image_source='uab-template-1.PNG';
			    				switch($uab_general_settings['uab_template']){
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
			    		</div>
			    	</div>
			    	<div class="uab-customize-settings-content-wrapper">
			    		<div class="uab-content-wrapper">
			    			<div class="uab-label-info-wrap">
			    				<label><?php _e( 'Enable Custom CSS Section', 'ultimate-author-box-lite' ); ?></label>
			    				<span class="uab-info"><?php _e( 'Check to Enable Custom CSS Section', 'ultimate-author-box-lite' ); ?></span>
			    			</div>
			    			<div class="uab-slide-checkbox-wrapper">
			    				<div class="uab-slide-checkbox-wrapper-inner">
			    					<div class="uab-slide-checkbox">  
			    						<input type="checkbox" id="uab-enable-custom-css" name="uab_enable_custom_css" <?php if ( !empty($uab_general_settings['uab_enable_custom_css'] )) echo 'checked'; ?>>
			    						<label for="uab-enable-custom-css"></label>
			    					</div>
			    				</div>

			    			</div>
			    		</div>
			    		<div class="uab-custom-css-wrapper">
			    			<label for="uab-codemirror-textarea"><h4><?php _e('Custom CSS');?></h4></label>
			    			<textarea id="uab-codemirror-textarea" class="uab-codemirror-textarea" name="uab_custom_css"><?php echo (isset( $uab_general_settings['uab_custom_css'] )) ? wp_kses_post( $uab_general_settings['uab_custom_css'] ) : ''; ?></textarea>			
			    		</div><!--End of uab-custom-css-wrapper-->

			    	</div>
			    </div>

			    <div class="uab_admin-general-bttn">
			    	<?php 
			    	wp_nonce_field( 'uab_admin_option_update' ); 
			    	wp_nonce_field('uab_action_nonce', 'uab_nonce_field');
			    	$restore_nonce = wp_create_nonce('uab-restore-nonce');
			    	?>
			    	<input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'ultimate-author-box-lite' ); ?>" name="uab_settings_save_button"/>
			    	<a href="<?php echo admin_url() . 'admin-post.php?action=uab_restore_settings&_wpnonce=' . $restore_nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', 'ultimate-author-box-lite') ?>');"><input type="button" class="button-secondary" value="<?php _e('Restore Default Settings', 'ultimate-author-box-lite'); ?>" class="button-primary"/></a>
			    	<a href="<?php echo admin_url() . 'profile.php';?>"><input type="button" class="button-secondary" value="<?php _e('Go to Profile Settings', 'ultimate-author-box-lite'); ?>"></a>
			    </div>
			</div>


		</form>
	</div><!--End of uab-setting-page-wrapper-->



