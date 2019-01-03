<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="uab-default-tab-wrapper">
	<div class="uab-field uab-profile-field">
		<label for="uab-frontend-title"><?php _e( 'Frontend Tab Title', 'ultimate-author-box-lite' ); ?></label>
		<input type="text" class="uab-text-field" id="uab-frontend-title" name="uab_profile_data[0][uab-frontend-title]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab-frontend-title'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab-frontend-title'] ) : esc_html_e( 'Author Details', 'ultimate-author-box-lite' ); ?>" >
	</div>
	<table class="uab-temporary-structure">
		<tr class="user-custom-description-status-wrap" style="display: none;">
			<th>
				<label for="custom-description"><?php _e( 'Enable Customed Biography' , 'ultimate-author-box-lite') ?></label>
			</th>
			<td>
				<input type="checkbox" id="uab-custom-desc-status" name="uab_profile_data[0][uab_custom_description_status]" <?php checked((isset($unserialized_uab_profile_data[0]['uab_custom_description_status'])?intval($unserialized_uab_profile_data[0]['uab_custom_description_status']):intval(0)),1) ?> value="1">
			</td>
		</tr>
		<tr class="user-custom-description-wrap" style="display: none;">
			<th>
				<label for="custom-description"><?php _e( 'Custom Biographical Information' , 'ultimate-author-box-lite') ?></label>
			</th>
			<td>
				<?php
				$allowed_html = wp_kses_allowed_html( 'post' );
				$general_value = (!empty($unserialized_uab_profile_data[0]['uab_custom_description']))?($unserialized_uab_profile_data[0]['uab_custom_description']):'';
				$content = wp_kses(stripslashes($general_value),$allowed_html);
				$editor_id = 'uab-custom-desc';
				$settings = array(
					'textarea_name' => 'uab_profile_data[0][uab_custom_description]',
					'media_buttons'	=> false,
					'wpautop'		=> false,
					'editor_class'	=> 'uab-wp-editor',
					'editor_height'	=> 200,
					// 'quicktags'		=> array('buttons'=>'a,b,i,strong,em,ul,ol,li'),
				);
				wp_editor($content,$editor_id,$settings);
				?>
			</td>
		</tr>
	</table>

	<div class="uab-profile-image-wrapper">
		<div class="uab-profile-header">
			<h2><?php _e( 'Profile Image Settings', 'ultimate-author-box-lite' ); ?></h2>
		</div>
		<div class="uab-profile-content-wrapper">
			<div class="uab-alternate-image-selection">
				<div class="uab-image-selection-option uab-profile-field">
					<label><?php _e( 'Choose Image Type', 'ultimate-author-box-lite' );?></label>
					<select class="uab_image_select " name="uab_profile_data[0][uab_image_select]" value="<?php echo isset($unserialized_uab_profile_data[0]['uab_image_select'])?$unserialized_uab_profile_data[0]['uab_image_select']: 'uab_gravatar';?>">
						<optgroup label="<?php _e( 'Default', 'ultimate-author-box-lite' ); ?>"></optgroup>
						<option value="uab_gravatar" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_select']) && $unserialized_uab_profile_data[0]['uab_image_select'] =='uab_gravatar' ) echo 'selected'; ?>><?php _e( 'Gravatar', 'ultimate-author-box-lite' ); ?></option>
						<optgroup label="<?php _e( 'Social Profile Image', 'ultimate-author-box-lite' ); ?>"></optgroup>
						<option value="uab_facebook" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_select']) && $unserialized_uab_profile_data[0]['uab_image_select'] =='uab_facebook' ) echo 'selected'; ?>><?php _e( 'Facebook', 'ultimate-author-box-lite' ); ?></option>
						<option value="uab_instagram" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_select']) && $unserialized_uab_profile_data[0]['uab_image_select'] =='uab_instagram' ) echo 'selected'; ?>><?php _e( 'Instagram', 'ultimate-author-box-lite' ); ?></option>
						<option value="uab_twitter" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_select']) && $unserialized_uab_profile_data[0]['uab_image_select'] =='uab_twitter' ) echo 'selected'; ?>><?php _e( 'Twitter', 'ultimate-author-box-lite' ); ?></option>
						<optgroup label="<?php _e( 'Custom Image', 'ultimate-author-box-lite' ); ?>"></optgroup>
						<option value="uab_upload_image" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_select']) && $unserialized_uab_profile_data[0]['uab_image_select'] =='uab_upload_image' ) echo 'selected'; ?>><?php _e( 'Upload Image', 'ultimate-author-box-lite' ); ?></option>
					</select>
				</div><!-- End of Image Option Selection-->
				<div class="uab-social-image-option-wrapper">
					<div class="uab-facebook-image-upload-wrapper uab-image-upload-option-wrapper" <?php if(isset($unserialized_uab_profile_data[0]['uab_image_select']) !='uab_facebook') echo 'style="display:none;"'; elseif($unserialized_uab_profile_data[0]['uab_image_select']!='uab_facebook') echo'style="display:none;"';?>>
						<div class="uab-field uab-profile-field">
							<label><?php _e( 'Facebook User ID', 'ultimate-author-box-lite' ); ?></label>
							<div class="uab-input-field">
								<input type="text" name="uab_profile_data[0][uab_profile_image_facebook]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_profile_image_facebook'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_profile_image_facebook'] ) : ''; ?>"/>
								<div class="uab-label-hint">
									<?php _e( 'To get your Facebook User ID, Please go to ','ultimate-author-box-lite');?><a href="http://findmyfbid.com/" target="_blank">http://findmyfbid.com/</a><?php _e(' paste your Facebook Profile URL and click on Find Numeric ID.', 'ultimate-author-box-lite' ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="uab-instagram-image-upload-wrapper uab-image-upload-option-wrapper" <?php if(isset($unserialized_uab_profile_data[0]['uab_image_select']) !='uab_instagram') echo 'style="display:none;"'; elseif($unserialized_uab_profile_data[0]['uab_image_select']!='uab_instagram') echo 'style="display:none;"';?>>
						<div class="uab-field uab-profile-field">
							<label><?php _e( 'Instagram Image ID', 'ultimate-author-box-lite' ); ?></label>
							<div class="uab-input-field">
								<input type="text" name="uab_profile_data[0][uab_profile_image_instagram]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_profile_image_instagram'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_profile_image_instagram'] ) : ''; ?>"/>
								<div class="uab-label-hint"><?php _e( 'To get your Instagram Image ID, Please open any image on Instagram you want in the single preview. If your image URL is https://www.instagram.com/p/7FfbBpSOaC/ then 7FfbBpSOaC is your Instagram Image ID', 'ultimate-author-box-lite' ); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="uab-twitter-image-upload-wrapper uab-image-upload-option-wrapper" <?php if(isset($unserialized_uab_profile_data[0]['uab_image_select']) !='uab_twitter') echo 'style="display:none;"'; elseif($unserialized_uab_profile_data[0]['uab_image_select']!='uab_twitter') echo 'style="display:none;"';?>>
						<div class="uab-field uab-profile-field">
							<label><?php _e( 'Twitter Username', 'ultimate-author-box-lite' ); ?></label>
							<div class="uab-input-field">
								<input type="text" name="uab_profile_data[0][uab_profile_image_twitter]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_profile_image_twitter'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_profile_image_twitter'] ) : ''; ?>"/>
								<div class="uab-label-hint"><?php _e( 'To get your Twitter Username, Please open your twitter profile. If your profile URL is https://twitter.com/apthemes  then apthemes is your Twitter username.', 'ultimate-author-box-lite' ); ?>

								</div>
							</div>
						</div>
					</div>
					<div class="uab-custom-image-upload-wrapper uab-image-upload-option-wrapper" <?php if(isset($unserialized_uab_profile_data[0]['uab_image_select']) !='uab_upload_image') echo 'style="display:none;"'; elseif($unserialized_uab_profile_data[0]['uab_image_select']!='uab_upload_image') echo 'style="display:none;"';?>>
						<div class="uab-field uab-profile-field">
							<label for="uab_upload_image_url"><?php _e( 'Upload Custom Image', 'ultimate-author-box-lite' ); ?></label>
							<input class="uab_upload_image_url" type="text" name="uab_profile_data[0][uab_upload_image_url]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_upload_image_url'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_upload_image_url'] ) : ''; ?>" class="input-controller required"/>
							<input type="button" class="uab_upload_image_button input-controller image_button button-secondary"  value="<?php esc_attr_e('Upload Image','ultimate-author-box-lite');?>" size="25"/>
							<span class="uab-info"><?php _e('Recommended image size is 200x200 px.','ultimate-author-box-lite');?></span>
							<div class="image-preview">
								<h4><?php _e( 'Image Preview:', 'ultimate-author-box-lite' ); ?></h4>
								<div class="current-image" ><img src="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_upload_image_url'] )) ? esc_url( $unserialized_uab_profile_data[0]['uab_upload_image_url'] ) : ''; ?>" style="height:180px; width:180px;"/></div>
							</div>
						</div>
					</div>
				</div><!--End of Social Image Option Wrapper-->
			</div><!--End of Alternate Image Selection Option-->

			<div class="uap-image-shape-wrapper uab-profile-field">
				<label><?php _e( 'Choose Image Shape', 'ultimate-author-box-lite' ); ?></label>
				<select class="uab_image_shape " name="uab_profile_data[0][uab_image_shape]" value="<?php echo isset($unserialized_uab_profile_data[0]['uab_image_shape'])?$unserialized_uab_profile_data[0]['uab_image_shape']:'uab_is_square';?>">
					<option value="uab_is_square" <?php if ( isset($unserialized_uab_profile_data[0]['uab_image_shape']) && $unserialized_uab_profile_data[0]['uab_image_shape'] =='uab_is_square' ) echo 'selected'; ?>><?php _e( 'Square', 'ultimate-author-box-lite' ); ?></option>
					<option value="uab_is_circle" <?php if ( !empty($unserialized_uab_profile_data[0]['uab_image_shape']) && $unserialized_uab_profile_data[0]['uab_image_shape'] =='uab_is_circle' ) echo 'selected'; ?>><?php _e( 'Circular', 'ultimate-author-box-lite' ); ?></option>
				</select>
			</div><!--End of Image Shape Option Wrapper-->
		</div><!--End of Image Wrapper-->
	</div>
	<div class="uab-company-info-wrapper uap-option-wrapper">
		<div class="uab-company-info-header-wrapper uab-title-wrapper uab-profile-header">
			<h2><?php _e( 'Company Information', 'ultimate-author-box-lite' ); ?></h2>
		</div>
		<div class="uab-profile-content-wrapper">
			<div class="uab-field uab-profile-field">
				<label for="uab-company-name"><?php _e( 'Company Name', 'ultimate-author-box-lite' ); ?></label>
				<input type="text" class="uab-text-field" id="uab-company-name" name="uab_profile_data[0][uab_company_name]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_company_name'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_company_name'] ) : ''; ?>" />
			</div>
			<div class="uab-field uab-profile-field">
				<label for="uab-company-url"><?php _e( 'Company URL', 'ultimate-author-box-lite' ); ?></label>
				<input type="url" class="uab-url-field" id="uab-company-url" name="uab_profile_data[0][uab_company_url]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_company_url'] )) ? esc_url( $unserialized_uab_profile_data[0]['uab_company_url'] ) : ''; ?>" />
			</div>
			<div class="uab-field uab-profile-field">
				<label for="uab-company-designation"><?php _e( 'Designation', 'ultimate-author-box-lite' ); ?></label>
				<input type="text" class="uab-text-field" id="uab-company-designation" name="uab_profile_data[0][uab_company_designation]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_company_designation'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_company_designation'] ) : ''; ?>" />
			</div>
			<div class="uab-field uab-profile-field">
				<label for="uab-company-separator"><?php _e( 'Separator', 'ultimate-author-box-lite' ); ?></label>
				<input type="text" class="uab-text-field" id="uab-company-separator" name="uab_profile_data[0][uab_company_separator]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_company_separator'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_company_separator'] ) : ','; ?>" />
				<span class="uab-info"><?php esc_html_e('Degisnation [separator] Company Name. Example, Plugin Developer at AccessPress','ultimate-author-box-lite');?></span>
			</div>
			<div class="uab-field uab-profile-field">
				<label for="uab-company-phone"><?php _e( 'Phone Number', 'ultimate-author-box-lite' ); ?></label>
				<input type="text" class="uab-text-field" id="uab-company-phone" name="uab_profile_data[0][uab_company_phone]" value="<?php echo (isset( $unserialized_uab_profile_data[0]['uab_company_phone'] )) ? esc_attr( $unserialized_uab_profile_data[0]['uab_company_phone'] ) : ''; ?>" />
			</div>
		</div>
	</div><!-- End of Company info -->

	<div class="uab-social-outlets-wrapper">
		<div class="uab-social-outlets-header-wrapper uab-title-wrapper uab-profile-header">
			<h2><?php _e( 'Social Media Icons', 'ultimate-author-box-lite' ); ?></h2>
		</div>
		<div class="uab-profile-content-wrapper">
			<ul class="uap-social-outlets-fields">
				<?php 
				if(!empty($uab_social_icons)){
					foreach($uab_social_icons as $socialname => $innerarray){ 
						$uab_font_type = 'fab';
						if( $uab_social_icons[$socialname]['icon'] == 'rss'){
							$uab_font_type = 'fas';
						}
						?>
						<li>
							<div class="uab-field uab-profile-field">
								<label><i class="<?php esc_attr_e($uab_font_type); ?> fa-<?php echo $uab_social_icons[$socialname]['icon'];?>"></i><?php esc_html_e($uab_social_icons[$socialname]['label']);?></label>
								<input type="url" name="uab_social_icons[<?php esc_attr_e($socialname);?>][url]" value="<?php echo esc_url($uab_social_icons[$socialname]['url']);?>" placeholder="<?php esc_attr_e('Enter link for social media icon', 'ultimate-author-box-lite' );?>">
							</div>
						</li>
						<?php
					}
				}
				if(!array_key_exists('rss',$uab_social_icons)){
				?>	
				<li>
					<div class="uab-field uab-profile-field">
						<label><i class="fa fa-rss"></i><?php esc_html_e('RSS');?></label>
						<input type="url" name="uab_social_icons[rss][url]" value="<?php echo esc_url($uab_social_icons['rss']['url']);?>" placeholder="<?php esc_attr_e('Enter link for social media icon', 'ultimate-author-box-lite' );?>">
					</div>
				</li>
				<?php }
				?>
			</ul>
		</div><!-- End of Social Outlet Fields-->
	</div><!-- End of Social Outlet Wrapper-->


	
</div><!--End of Default Content Wrapper-->