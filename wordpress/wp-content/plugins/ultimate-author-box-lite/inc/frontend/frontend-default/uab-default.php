<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
switch($uab_template_type){
	case 'uab-template-2':
		include(UAB_PATH . '/inc/frontend/frontend-default/modules/uab-modues-2.php');
	break;
	case 'uab-template-3':
		include(UAB_PATH . '/inc/frontend/frontend-default/modules/uab-modues-1.php');
	break;
	case 'uab-template-4':
		include(UAB_PATH . '/inc/frontend/frontend-default/modules/uab-modues-1.php');
	break;
	case 'uab-template-5':
		include(UAB_PATH . '/inc/frontend/frontend-default/modules/uab-modues-2.php');
	break;
	default:
		include(UAB_PATH . '/inc/frontend/frontend-default/modules/uab-modues-1.php');

}

