<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="uab-post-title-wrapper">
	<a href="<?php esc_attr_e(get_permalink($post->ID));?>"><?php $title = get_the_title($post->ID); esc_html_e($title); ?></a>
</div>
