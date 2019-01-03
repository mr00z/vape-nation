<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<a href="<?php esc_attr_e(get_permalink($post->ID));?>"><div class="uab-post-image"><?php _e(get_the_post_thumbnail($post->ID,'large'));?></div></a>
