<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="new-tab-outer-wrapper" style="display:none">
	<div class="uab-new-tab">
		<div class="uab-tab-content">
			<div class="uab-recent-post-outer-wrapper uap-option-wrapper">
				<div class="uab-recent-post-wrapper uap-option-wrapper">
					<input type="hidden" id="uab_tab_name" name="uab_profile_data[uab_id][uab_tab_name]">
					<input type="hidden" id="uab_tab_type" name="uab_profile_data[uab_id][uab_tab_type]">
					<input type="hidden" id="uab_tab_id" name="uab_profile_data[uab_id][uab_tab_id] ">
					<div class="uab-recent-post-header-wrapper uab-title-wrapper uab-profile-header">
						<h2><?php _e( 'Author Posts', 'ultimate-author-box-lite' ); ?></h2>
					</div>
					<div class="uab-profile-content-wrapper">
						<div class="author-post-wrapper">
							<div class="latest-posts-wrapper uab-author-post-option uab-profile-field">
								<label><?php _e( 'Frontend Tab Title', 'ultimate-author-box-lite' ); ?></label>	
								<input type="text" name="uab_profile_data[uab_id][uab_author_post_tab_title]" value="<?php esc_html_e('Recent Posts','ultimate-form-builder');?>"/>
							</div>
							<div class="latest-posts-wrapper uab-author-post-option uab-profile-field">
								<label><?php _e( 'Number of posts', 'ultimate-author-box-lite' ); ?></label>	
								<input type="number" min="0" name="uab_profile_data[uab_id][uab_post_number]" value="5"/>
							</div>
							<div class="uab-field uab-profile-field">
								<label><?php _e( 'Select Post Type', 'ultimate-author-box-lite' ); ?></label>
								<select class="uab_post_select" name="uab_profile_data[uab_id][uab_post_select]">
									<option value="uab_latest_posts"><?php _e( 'Latest Posts', 'ultimate-author-box-lite' ); ?></option>
									<option value="uab_selective_posts"><?php _e( 'Selective Posts', 'ultimate-author-box-lite' ); ?></option>
								</select>
							</div>

							<div class="uab-selective-posts uab-author-post-option uab-profile-field" style="display: none;">
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
												<input type="checkbox" value="<?php esc_attr_e($post->ID);?>" name="uab_profile_data[uab_id][uab_post_list][]">
												<?php esc_html_e($title); ?>
											</div>
											<?php
										}
									}else{
										esc_html_e('The User does not have any posts','ultimate-author-box-lite');
									}?>
								</div>
							</div>	
						</div>
					</div>
				</div><!-- End of Recent Posts-->
			</div>		
			<div class="uab-editor-outer-wrapper uap-option-wrapper">
				<div class="uab-editor-wrapper uap-option-wrapper">
					<input type="hidden" id="uab_tab_name" name="uab_profile_data[uab_id][uab_tab_name]">
					<input type="hidden" id="uab_tab_type" name="uab_profile_data[uab_id][uab_tab_type]">
					<?php
					$content = '';
					$editor_id = "uab-wysiwyg-content";
					$settings = array(
						'textarea_name'	=> 'uab_wysiwyg_content[uab_id]',
						'wpautop'		=> false,
						'media_buttons'	=> true,
						'editor_height'	=> 200,
						// 'quicktags'		=> array('buttons'=>'a,b,i,strong,em,ul,ol,li'),
					);
					wp_editor( $content , $editor_id , $settings );
					?>
				</div><!-- End of WYSIWYG Wrapper-->
			</div>
		</div><!-- End of Tab Contents-->
	</div><!-- End of New Wrapper-->
</div><!-- End of Hidden Wrapper-->
