<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
	$text = apply_filters('the_excerpt', get_post_field('post_excerpt', $post->ID));
	?><div class="uab-post-excerpt-wrapper"><?php _e($text);?></div><?php
?>