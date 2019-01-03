<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="uap-post-author-name">
	<?php 
	if(!($uab_template_type == 'uab-template-1')){
		_e('By','ultimate-author-box-lite');
	}
	?>
	<a href="<?php esc_attr_e(get_author_posts_url($author_id));?>" target="<?php esc_attr_e($uab_general_settings['uab_link_target_option']);?>"><?php esc_html_e(the_author_meta( 'display_name', $author_id)); ?></a>

</div>
