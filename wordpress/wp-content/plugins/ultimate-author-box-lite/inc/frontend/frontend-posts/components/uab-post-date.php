<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<div class="uap-post-date"><?php _e(date_i18n( get_option( 'date_format' ), strtotime( $post->post_date )));?></div>
