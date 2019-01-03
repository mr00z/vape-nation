<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
$uab_author_name_link = isset( $uab_general_settings['uab_author_name_link'] ) ? sanitize_text_field($uab_general_settings['uab_author_name_link']) : 0;
if($uab_author_name_link){
	$uab_author_name_link_url = get_author_posts_url($author_id);
}else{
	$uab_author_name_link_url = 'javascript:void(0)';
}
if($uab_template_type == 'uab-template-5'){
	?>
	<?php if(!empty($uab_profile_data[0]['uab_company_designation']) || !empty($uab_profile_data[0]['uab_company_separator']) || !empty($uab_profile_data[0]['uab_company_name'])):?>
		<div class="uab-company-info">
			<?php if(!empty($uab_profile_data[0]['uab_company_designation'])):?>
				<span class="uab-company-designation">
					<?php esc_html_e($uab_profile_data[0]['uab_company_designation']);?>
				</span> 
			<?php endif;?>
			<?php
			if (!empty($uab_profile_data[0]['uab_company_url'])){
				
				?><?php if (!empty(trim($uab_profile_data[0]['uab_company_designation'])) && !empty(trim($uab_profile_data[0]['uab_company_name']))) { ?><span class="uab-designation-separator"><?php
				isset($uab_profile_data[0]['uab_company_separator'])?esc_html_e($uab_profile_data[0]['uab_company_separator']):esc_html_e(' at','ultimate-author-box');?></span><?php } ?>

				<a href="<?php esc_attr_e($uab_profile_data[0]['uab_company_url']);?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e($uab_profile_data[0]['uab_company_name']);?></a>
				<?php
			}
			?>
		</div>
	<?php endif;?>
	<div class="uab-display-name">
		<!-- User Display Name -->
		<a href="<?php _e($uab_author_name_link_url);?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e(the_author_meta( 'display_name', $author_id)); ?></a>
	</div>
	<?php
}
else{
	?>
	<div class="uab-display-name">
		<!-- User Display Name -->
		<a href="<?php _e($uab_author_name_link_url);?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e(the_author_meta( 'display_name', $author_id)); ?></a>
		
		<?php
		if($uab_template_type == 'uab-template-1'){
			$user_meta=get_userdata($author_id);
			$user_roles=$user_meta->roles;
			$user_role_lists = $this->get_editable_roles();

			foreach($user_role_lists as $user_role_list => $value){
		//echo $user_role_list;
				foreach($user_roles as $role=>$val){
			//echo $val;
					if($user_role_list == $val){
						?><span class="uab-user-role"><?php esc_html_e($user_role_lists[$user_role_list]['name']);?></span><?php
					}
				}
			}
		}?>
	</div>
	<?php if(!empty($uab_profile_data[0]['uab_company_designation']) || !empty($uab_profile_data[0]['uab_company_separator']) || !empty($uab_profile_data[0]['uab_company_name'])):?>
		<div class="uab-company-info">
			<span class="uab-company-designation">
				<?php esc_html_e($uab_profile_data[0]['uab_company_designation']);?>
			</span> <?php
			if (!empty($uab_profile_data[0]['uab_company_url'])){
				?><?php if (!empty(trim($uab_profile_data[0]['uab_company_designation'])) && !empty(trim($uab_profile_data[0]['uab_company_name']))) { ?><span class="uab-designation-separator"><?php
				isset($uab_profile_data[0]['uab_company_separator'])?esc_html_e($uab_profile_data[0]['uab_company_separator']):esc_html_e(' at','ultimate-author-box');?></span><?php } ?>
				
				<a href="<?php esc_attr_e($uab_profile_data[0]['uab_company_url']);?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e($uab_profile_data[0]['uab_company_name']);?></a>
				<?php
			}
			?>
		</div>
	<?php endif;?>
	<?php
}
