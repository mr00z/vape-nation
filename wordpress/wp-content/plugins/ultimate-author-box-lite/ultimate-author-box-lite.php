<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/* Plugin Name: Ultimate Author Box Lite
  Plugin URI: accesspressthemes.com/wordpress-plugins/ultimate-author-box-lite
  Description: Ultimate Author Box Lite is a plugin that allows you to add additional information about the author in your Post, Page and Custom Post Type as a default option or through use of shortcode.
  Version: 1.1.0
  Author: AccessPress Themes
  Author URI: http://accesspressthemes.com
  License: GPL2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages/
  Text Domain: ultimate-author-box-lite
 */

// Create class Ultimate_Author_Box
  if ( !class_exists( 'Ultimate_Author_Box_Lite' ) ) {

  	class Ultimate_Author_Box_Lite {

		// Construtor to load all hooks
  		function __construct() {

            // Define Folder Paths
  			$this->define_constants();

            // Start Session for Facebook API and Define Text Domain
  			add_action( 'init', array( $this, 'uab_init' ) );

            // Enqueue Backend Scripts
  			add_action( 'admin_enqueue_scripts', array( $this, 'uab_register_backend_assets' ) );

            // Enqueue Frontend Scripts
  			add_action( 'wp_enqueue_scripts', array( $this, 'uab_register_frontend_assets' ) );

            // Register Ultimate Author Box Dashboard Menu
  			add_action( 'admin_menu', array( $this, 'uab_menu' ) );

            // Register Ultimate Author Box Dashboard Sub-menu
  			add_action( 'admin_menu', array( $this, 'uab_add_how_to_sub_menu_page' ) );
  			add_action( 'admin_menu', array( $this, 'uab_add_about_sub_menu_page' ) );

            // Register additional support link in plugin listings
  			add_filter( 'plugin_action_links', array( $this, 'uab_plugin_action_link' ), 10, 5 );
            
  			add_action( 'show_user_profile', array( $this, 'uab_profile_fields' ) );
  			add_action( 'edit_user_profile', array( $this, 'uab_profile_fields' ) );

  			add_action( 'personal_options_update', array( $this, 'uab_save_profile_fields' ) );
  			add_action( 'edit_user_profile_update', array( $this, 'uab_save_profile_fields' ) );

			//General Settings Save
  			add_action('admin_post_uab_settings_save_action',array($this,'uab_save_settings'));
			//General Settings Restore
  			add_action('admin_post_uab_restore_settings', array($this, 'uab_restore_settings'));
            
  			register_activation_hook(__FILE__, array($this, 'uab_load_default_settings'));

  			add_shortcode( 'ultimate_author_box', array($this,'ultimate_author_box') );

  			add_filter ('the_content', array($this, 'uab_add_post_content'), 0);

            //Register Meta Box
  			add_action( 'add_meta_boxes', array($this,'uab_metabox'));
  			add_action( 'save_post', array($this,'uab_meta_save'));

            //disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php
            remove_filter('pre_user_description', 'wp_filter_kses');
            //add sanitization for WordPress posts
            add_filter( 'pre_user_description', 'wp_filter_post_kses');


        }


        function get_editable_roles() {
        	global $wp_roles;

        	$all_roles = $wp_roles->roles;

        	return $all_roles;
        }

		// Define Folder Paths
        function define_constants() {
        	defined( 'UAB_CSS_DIR' ) or define( 'UAB_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css' );
        	defined( 'UAB_JS_DIR' ) or define( 'UAB_JS_DIR', plugin_dir_url( __FILE__ ) . 'js' );
        	defined( 'UAB_IMG_DIR' ) or define( 'UAB_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images' );
        	defined( 'UAB_PATH' ) or define( 'UAB_PATH', plugin_dir_path( __FILE__ ) );
        	defined( 'UAB_Version' ) or define( 'UAB_VERSION', '1.1.0' );
        }

		// Register Text Domain
        function uab_init() {
        	load_plugin_textdomain( 'ultimate-author-box-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
        }

		// Register Backend resources (Enqueue scripts and style)
        function uab_register_backend_assets( $hook ) {
			if ( !('toplevel_page_ultimate-author-box-lite' == $hook ||'profile.php' == $hook ||'user-edit.php' == $hook || 'ultimate-author-box-lite_page_ultimate-author-box-lite-how-to' == $hook || 'ultimate-author-box-lite_page_ultimate-author-box-lite-about' == $hook)){
				return;
			}
			/*wp_enqueue_style( 'uab-font-awesome-style', UAB_CSS_DIR . '/font-awesome.min.css', array(), UAB_VERSION );*/
            wp_enqueue_script( 'uab-fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js', array(), '5.0.8' );
            wp_enqueue_style( 'uab-fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css', array(), '5.0.8' );
			wp_enqueue_style( 'uab-codemirror-style', UAB_CSS_DIR . '/codemirror.css', array(), UAB_VERSION );
			wp_enqueue_style( 'ultimate-author-box-lite-backend-style', UAB_CSS_DIR . '/backend.css', array(), UAB_VERSION );
            wp_enqueue_script( 'uab-codemirror-script', UAB_JS_DIR . '/codemirror.js', array(), '5.22.0' );
        	wp_enqueue_script( 'uab-codemirror-css-js', UAB_JS_DIR . '/css.js', array('jquery', 'uab-codemirror-script'), UAB_VERSION );
      	    wp_enqueue_style( 'jquery-ui-css', UAB_CSS_DIR . '/jquery-ui.css', array(), '1.12.1' );
            wp_enqueue_style( 'wp-color-picker' );

            wp_enqueue_script( 'uab-color-picker-js', UAB_JS_DIR . '/wp-color-picker-alpha.js', array('jquery','wp-color-picker'), UAB_VERSION );
        	wp_enqueue_script( 'uab-backend-script', UAB_JS_DIR . '/backend.js', array( 'jquery','jquery-ui-tabs','jquery-ui-dialog'), UAB_VERSION );
        	wp_enqueue_media();      
        	wp_localize_script( 'uab-backend-script', 'uab_variable', array(
        		'plugin_javascript_path' => UAB_JS_DIR,
                'plugin_image_path' => UAB_IMG_DIR
        	));
        }

		// Register Frontend resources (Enqueue scripts and style)
        function uab_register_frontend_assets() {
        	wp_enqueue_style( 'uab-frontend-style', UAB_CSS_DIR . '/frontend.css', array(), UAB_VERSION );
        	wp_enqueue_style( 'uab-frontend-responsive-style', UAB_CSS_DIR . '/uab-responsive.css', array(), UAB_VERSION );
        	/*wp_enqueue_style('uab-font-awesome-style',UAB_CSS_DIR.'/font-awesome.min.css',array(),UAB_VERSION);*/
            wp_enqueue_script( 'uab-fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js', array(), '5.0.8' );
            wp_enqueue_style( 'uab-fontawesome', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css', array(), '5.0.8' );
        	wp_enqueue_script( 'uab-frontend-script', UAB_JS_DIR . '/frontend.js', array( 'jquery'), UAB_VERSION );
            wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Amatic+SC|Merriweather|Roboto+Slab|Montserrat|Lato|Italianno|PT+Sans|PT+Sans+Narrow|Raleway|Crafty+Girls|Roboto|Open+Sans|Schoolbell|Great+Vibes|Droid+Sans|Poppins|Oswald|Varela+Round|Roboto+Condensed|Fira+Sans|Lora|Signika|Cabin|Arimo|Droid+Serif|Arvo|Rubik' );
        }

        //Add Support Link in Plugin Listing Page
        function uab_plugin_action_link( $actions, $plugin_file ) {
        	static $plugin;

        	if ( !isset( $plugin ) )
        		$plugin = plugin_basename( __FILE__ );
        	if ( $plugin == $plugin_file ) {

        		$settings = array( 'settings' => '<a href="admin.php?page=ultimate-author-box-lite">' . __( 'Settings', 'ultimate-author-box-lite' ) . '</a>' );
        		$site_link = array( 'support' => '<a href="https://accesspressthemes.com/support/" target="_blank">'.__( 'Support', 'ultimate-author-box-lite' ).'</a>' );

        		$actions = array_merge( $settings, $actions );
        		$actions = array_merge( $site_link, $actions );
        	}

        	return $actions;
        }

		// Registering Plugin access through Dashboard
        function uab_menu() {
        	add_menu_page(
        		__( 'Ultimate Author Box Lite', 'ultimate-author-box-lite' ), __( 'Ultimate Author Box Lite', 'ultimate-author-box-lite' ), 'manage_options', 'ultimate-author-box-lite', array( $this, 'uab_settings_page' ), 'dashicons-id', 70
        	);
        }

		// Registering Plugin backend settings
        function uab_settings_page() {
        	include(UAB_PATH . '/inc/backend/uap-settings.php');
        }

        // Register How to sub-menus
        function uab_add_how_to_sub_menu_page() {
        	add_submenu_page(
        		'ultimate-author-box-lite', __( 'How to use', 'ultimate-author-box-lite' ), __( 'How to use', 'ultimate-author-box-lite' ), 'edit_posts', 'ultimate-author-box-lite-how-to', array( $this, 'uab_ultimate_author_box_lite_how_to' ) );
        }

        //How To page Callback
        function uab_ultimate_author_box_lite_how_to() {
        	include(UAB_PATH . '/inc/backend/uab-boards/uap-how-to.php');
        }

        //Register About Sub Menu
        function uab_add_about_sub_menu_page() {
        	add_submenu_page(
                'ultimate-author-box-lite', __( 'More WordPress Stuff', 'ultimate-author-box-lite' ), __( 'More WordPress Stuff', 'ultimate-author-box-lite' ), 'edit_posts', 'ultimate-author-box-lite-about', array( $this, 'uab_ultimate_author_box_lite_about' ) );
        }

        //About Page Callback
        function uab_ultimate_author_box_lite_about() {
        	include(UAB_PATH . '/inc/backend/uab-boards/uap-about.php');
        }

        //Load Default General Settings
        function uab_load_default_settings(){		
        	$default_settings = $this->get_default_settings();
        	if (!get_option('uap_general_settings')) {
        		update_option('uap_general_settings', $default_settings);
        	}
        }

        //Save General Settings
        function uab_save_settings(){
        	if(check_admin_referer('uab_admin_option_update')){
           		if(isset($_POST['uab_settings_save_button'])){
        			$uab_general_settings = array();
        			$uab_general_settings['uab_custom_post_type_list']=array();
                    $uab_general_settings['uab_user_roles']=array();
        			
                    if(isset($_POST['uab_custom_post_type_list'])){
                        foreach($_POST['uab_custom_post_type_list'] as $key=>$value){
                            $uab_general_settings['uab_custom_post_type_list'][$key]= sanitize_text_field($value);
                        }

                    }else{
                        $uab_general_settings['uab_custom_post_type_list']=array();    
                    }

                    if(isset($_POST['uab_user_roles'])){
                     foreach($_POST['uab_user_roles'] as $key=>$value){
                        $uab_general_settings['uab_user_roles'][$key] = sanitize_text_field($value);
                    }
                }
                else{
                    $uab_general_settings['uab_user_roles']=array();    
                }

        			$uab_general_settings['uab_disable_uab'] = (isset($_POST['uab_disable_uab'])?1:0);
        			$uab_general_settings['uab_posts'] = (isset($_POST['uab_posts'])?1:0);
        			$uab_general_settings['uab_pages'] = (isset($_POST['uab_pages'])?1:0);
        			$uab_general_settings['uab_custom_post'] = (isset($_POST['uab_custom_post'])?1:0);
        			$uab_general_settings['uab_box_position'] = sanitize_text_field($_POST['uab_box_position']);
        			$uab_general_settings['uab_empty_bio'] = (isset($_POST['uab_empty_bio'])?1:0);
        			$uab_general_settings['uab_default_bio'] = (isset($_POST['uab_default_bio'])?1:0);
        			$uab_general_settings['uab_default_message'] = sanitize_text_field($_POST['uab_default_message']);
        			$uab_general_settings['uab_link_target_option'] = sanitize_text_field($_POST['uab_link_target_option']);
                    $uab_general_settings['uab_author_name_link'] = sanitize_text_field($_POST['uab_author_name_link']);
                    $uab_general_settings['uab_disable_customizer'] = (isset($_POST['uab_disable_customizer'])?1:0);

        			$uab_general_settings['uab_template'] = sanitize_text_field($_POST['uab_template']);
        			$uab_general_settings['uab_enable_custom_css'] = (isset($_POST['uab_enable_custom_css'])?1:0);
                    $uab_general_settings['uab_custom_css'] = stripslashes(wp_kses_post( $_POST['uab_custom_css'] ));

        			$uab_general_settings['uab_custom_template'] = sanitize_text_field($_POST['uab_custom_template']);
        			$uab_general_settings['uab_primary_color'] = sanitize_text_field($_POST['uab_primary_color']);
        			$uab_general_settings['uab_secondary_color'] = sanitize_text_field($_POST['uab_secondary_color']);

        			$check = update_option('uap_general_settings',$uab_general_settings);
        			wp_redirect(admin_url('admin.php?page=ultimate-author-box-lite&message=1'));
        			exit;
        		}
        	}
        	else{
        		die('No script kiddies please!');
        	}
        }

		// Settings Default Values
        function get_default_settings(){

        	$uab_general_settings = array();
        	$user_role_list = $this->get_editable_roles();
        	foreach($user_role_list as $key => $value){
        		$uab_general_settings['uab_user_roles'][]=$key;
        	}
            $uab_general_settings['uab_custom_post_type_list']=array();
        	$uab_general_settings['uab_disable_uab'] = 0;
        	$uab_general_settings['uab_posts'] = 1;
        	$uab_general_settings['uab_pages'] = 1;
        	$uab_general_settings['uab_custom_post'] = 1;
        	$uab_general_settings['uab_box_position'] = 'uab_bottom';
        	$uab_general_settings['uab_empty_bio'] = 0;
        	$uab_general_settings['uab_default_bio'] = 1;
        	$uab_general_settings['uab_default_message'] = __('Sorry! The Author has not filled his profile.','ultimate-author-box-lite');
        	$uab_general_settings['uab_link_target_option'] = '_blank';
            $uab_general_settings['uab_author_name_link'] = 1;
        	$uab_general_settings['uab_template'] = 'uab-template-1';
        	$uab_general_settings['uab_enable_custom_css'] = 1;
        	$uab_general_settings['uab_custom_css'] = '';

        	$uab_general_settings['uab_custom_template'] = 'uab-template-1';
        	$uab_general_settings['uab_primary_color'] = '';
        	$uab_general_settings['uab_secondary_color'] = '';


        	return $uab_general_settings;
        }

        // Restore Default Settings
        function uab_restore_settings(){
        	if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'uab-restore-nonce')) {

        		$default_settings = $this->get_default_settings();
        		update_option('uap_general_settings', $default_settings);
        		wp_redirect(admin_url('admin.php?page=ultimate-author-box-lite&restore-message=1'));
        	} else {

        		die('No script kiddies please!');

        	}
        }

        // Register Shortcode [ultimate_author_box user_id="1" template='uab-template-1']
        function ultimate_author_box($atts){
        	ob_start();?>
        	<?php
        	include(UAB_PATH.'/inc/frontend/uap-shortcode.php');
        	?>
        	<?php
        	$form_html = ob_get_contents();
        	ob_end_clean();
        	return $form_html;
        }

        // Add Author Box To post content
        function uab_add_post_content($content){
        	$uab_general_settings = get_option( 'uap_general_settings' );
        	$post_id = get_the_ID();
        	$uab_stored_meta = (get_post_meta( $post_id, 'uab_option' )!==NULL)?get_post_meta( $post_id, 'uab_option' ):array();
        	$uab_stored_meta_position = (get_post_meta( $post_id, 'uab_meta_position' )!==NULL)?get_post_meta( $post_id, 'uab_meta_position' ):array();
        	$uab_stored_meta_value = (isset($uab_stored_meta[0])&&!empty($uab_stored_meta[0]))?$uab_stored_meta[0]:'yes';
            $uab_stored_meta_value_position = (isset($uab_stored_meta_position[0])&&!empty($uab_stored_meta[0]))?$uab_stored_meta_position[0]:'default';
            
            if (is_singular('post')) { 
                    $postID = get_the_ID();
                    
                    $content .= '<input type="hidden" value="'.$postID.'">';
                    
                    $count_key = 'post_views_count';
                    $count = get_post_meta($postID, $count_key, true);
                    if($count==''){
                        $count = 0;
                        delete_post_meta($postID, $count_key);
                        add_post_meta($postID, $count_key, '0');
                    }else{
                        $count++;
                        update_post_meta($postID, $count_key, $count);
                    }
            }

        	if($uab_general_settings['uab_posts'] && $uab_stored_meta_value == 'yes'){
        		if (is_singular('post')) { 
        			if($uab_stored_meta_value_position!='default'){
        				$check_position	= $uab_stored_meta_value_position;
        			}
        			else{
        				$check_position	= $uab_general_settings['uab_box_position'];
        			}
        			switch ($check_position) {
        				case 'uab_top':
                        remove_filter ('the_content', 'wpautop'); 
        				$content = do_shortcode( '[ultimate_author_box]' ).wpautop($content);
        				break;
        				case 'uab_bottom':
                        remove_filter ('the_content', 'wpautop'); 
                        $content = wpautop($content);
        				$content .= do_shortcode( '[ultimate_author_box]' );
        				break;
        				default:
        				return $content;
        			}
        		}
        	}

        	if($uab_general_settings['uab_pages'] && $uab_stored_meta_value == 'yes'){
        		if (is_singular('page')) { 
        			if($uab_stored_meta_value_position!='default'){
        				$check_position	= $uab_stored_meta_value_position;
        			}
        			else{
        				$check_position	= $uab_general_settings['uab_box_position'];
        			}
        			switch ($check_position) {
        				case 'uab_top':
                        remove_filter ('the_content', 'wpautop'); 
        				$content = do_shortcode( '[ultimate_author_box]' ).wpautop($content);
        				break;
        				case 'uab_bottom':
                        remove_filter ('the_content', 'wpautop'); 
                        $content = wpautop($content);
        				$content .= do_shortcode( '[ultimate_author_box]' );
        				break;
        				default:
        				return $content;
        			}
        		}
        	}

        	if($uab_general_settings['uab_custom_post'] && isset($uab_general_settings['uab_custom_post_type_list']) && $uab_stored_meta_value == 'yes'){
        		foreach( $uab_general_settings['uab_custom_post_type_list'] as $innerKey => $type){
        			if (is_singular($type)) { 
        				if($uab_stored_meta_value_position!='default'){
        					$check_position	= $uab_stored_meta_value_position;
        				}
        				else{
        					$check_position	= $uab_general_settings['uab_box_position'];
        				}
        				switch ($check_position) {
        					case 'uab_top':
                            remove_filter ('the_content', 'wpautop'); 
        					$content = do_shortcode( '[ultimate_author_box]' ).wpautop($content);
        					break;
        					case 'uab_bottom':
                            remove_filter ('the_content', 'wpautop'); 
                            $content = wpautop($content);
        					$content .= do_shortcode( '[ultimate_author_box]' );
        					break;
        					default:
        					return $content;
        				}
        			}
        		}
        	}	
        	return $content;
        }

		// Print function to Print Array
        function print_array($array){
        	echo "<pre>";
        	print_r($array);
        	echo "</pre>";
        }





		// Callback funtion to Add Content to Profile.php
		function uab_profile_fields( $user ) {
			if ( !current_user_can( 'edit_posts', $user->ID ) ) 
				return false;

            $uab_current_user = get_current_user_id();

            $uab_current_user_roles = new WP_User($uab_current_user);

            if ( !empty( $uab_current_user_roles->roles ) && is_array( $uab_current_user_roles->roles ) ) {
                foreach ( $uab_current_user_roles->roles as $role )
                    $uab_current_user_role[] = $role;
            }

			$uab_general_settings = get_option( 'uap_general_settings' );

			$user_permission_flag=0;
            foreach($uab_current_user_role as $user_role){

				if(in_array($user_role, $uab_general_settings['uab_user_roles']) || $user_role == 'administrator'){

					$unserialized_uab_profile_data = maybe_unserialize(get_the_author_meta( 'uab_profile_data', $user->ID ));

					$uab_social_data = maybe_unserialize(get_the_author_meta( 'uab_social_icons', $user->ID ));
					if(!empty($uab_social_data)){
						$uab_social_icons = maybe_unserialize(get_the_author_meta( 'uab_social_icons', $user->ID ));
					}
					else{
						$uab_social_icons = array(
							'facebook' => array(
								'icon' => 'facebook',
								'label' => 'Facebook',
								'url' => ''
							),
							'twitter' => array(
								'icon' => 'twitter',
								'label' => 'Twitter',
								'url' => ''
							),
							'instagram' => array(
								'icon' => 'instagram',
								'label' => 'Instagram',
								'url' => ''
							),
							'youtube' => array(
								'icon' => 'youtube',
								'label' => 'Youtube',
								'url' => ''
							),
							'linkedin' => array(
								'icon' => 'linkedin',
								'label' => 'Linkedin',
								'url' => ''
							),
							'google-plus' => array(
								'icon' => 'google-plus',
								'label' => 'Google+',
								'url' => ''
							),
							'github' => array(
								'icon' => 'github',
								'label' => 'Github',
								'url' => ''
							),
							'wordpress' => array(
								'icon' => 'wordpress',
								'label' => 'WordPress',
								'url' => ''
							),
							'skype' => array(
								'icon' => 'skype',
								'label' => 'Skype',
								'url' => ''
							),
                            'rss' => array(
                                'icon' => 'rss',
                                'label' => 'RSS',
                                'url' => ''
                            )
						);
					}
					$uab_wysiwyg_content = maybe_unserialize(get_the_author_meta( 'uab_wysiwyg_content', $user->ID ));	

					include(UAB_PATH . '/inc/backend/ultimate-profile-settings.php');
                    break;
				}
				else{
					$user_permission_flag++;
				}
                
			}
            if($user_permission_flag>0){
                    ?><div id="setting-error-bloger" class="notice notice-info is-dismissible"> 
                    <p><strong><span style="display: block; margin: 0.5em 0.5em 0 0; clear: both;"><?php esc_html_e('Note: The Ultimate Author Box is installed but you do not have the permission to configure it. Please contact the site Admin to have access to your AuthorBox.','ultimate-author-box-lite');?></span>
                    </strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div><?php
                }
		}



		//Register Ultimate Author Box Option Metabox 
		function uab_metabox() {
            $args = array(
                'public'   => true,
                '_builtin' => false,
            );

            $output = 'names'; // names or objects, note names is the default
            $operator = 'and'; // 'and' or 'or'

            $post_types = get_post_types( $args, $output, $operator );
			add_meta_box(
				'uab_meta',
				__( 'Ultimate Author Box Lite Options' ),
				array($this,'uab_meta_callback'),
				array('post','page',$post_types),
				'side',
				'high'
			);
		}

		// Ultimate Author Box Option Metabox Callback Function
		function uab_meta_callback( $post ) {
			wp_nonce_field( basename( __FILE__ ), 'uab_nonce' );
			$uab_stored_meta = get_post_meta( $post->ID, 'uab_option' );
			$uab_stored_meta_position = get_post_meta( $post->ID, 'uab_meta_position' );

			?>
            <p>
			<label><?php _e('Show Author Box in this post','ultimate-author-box-lite');?></label>
			<select name="uab_meta_option" id="uab-meta-option" value="<?php !empty($uab_stored_meta[0])?$uab_stored_meta[0]:'yes'?>">
				<option value="yes" <?php if ( ! empty ( $uab_stored_meta[0]) ) selected( $uab_stored_meta[0], 'yes' ); ?>><?php _e('Yes','ultimate-author-box-lite');?></option>
				<option value="no" <?php if ( ! empty ( $uab_stored_meta[0]) ) selected( $uab_stored_meta[0], 'no' ); ?>><?php _e('No','ultimate-author-box-lite');?></option>
			</select>
            </p>
            <p>
			<label><?php _e('Author Box Position','ultimate-author-box-lite');?></label>
			<select name="uab_meta_position" id="uab-meta-position" value="<?php !empty($uab_stored_meta_position[0])?$uab_stored_meta_position[0]:'default'?>">
				<option value="default" <?php if ( ! empty ( $uab_stored_meta_position[0]) ) selected( $uab_stored_meta_position[0], 'default' ); ?>><?php _e('Default','ultimate-author-box-lite');?></option>
				<option value="uab_top" <?php if ( ! empty ( $uab_stored_meta_position[0]) ) selected( $uab_stored_meta_position[0], 'uab_top' ); ?>><?php _e('Top','ultimate-author-box-lite');?></option>
				<option value="uab_bottom" <?php if ( ! empty ( $uab_stored_meta_position[0]) ) selected( $uab_stored_meta_position[0], 'uab_bottom' ); ?>><?php _e('Bottom','ultimate-author-box-lite');?></option>
			</select>
            </p>
			<?php
		}

		// Ultimate Author Box Option Metabox Save 
		function uab_meta_save( $post_id ) {
			// Checks save status
			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['uab_nonce'] ) && wp_verify_nonce( $_POST['uab_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';
			if ( $is_autosave || $is_revision || !$is_valid_nonce) {

				return;
			}
			
			$uab_meta_option = !empty($_POST['uab_meta_option'])?$_POST['uab_meta_option']:'';
			$uab_meta_position = !empty($_POST['uab_meta_position'])?$_POST['uab_meta_position']:'';
			update_post_meta( $post_id, 'uab_option', sanitize_text_field($uab_meta_option));
			update_post_meta( $post_id, 'uab_meta_position', sanitize_text_field($uab_meta_position));


		}

        //Encode Email
		function encode_email($e) {
			$output ='';
			for ($i = 0; $i < strlen($e); $i++) { $output .= '&#'.ord($e[$i]).';'; }
			return $output;
		}

		// Callback funtion to Save values of Profile.php
		function uab_save_profile_fields( $user_id) {
			if ( !current_user_can( 'edit_user', $user_id ) )
				return false;

			/** Query to save current tab structure setting into usermeta table */
			if(isset($_POST['uab_profile_data']))
			{
                foreach($_POST as $key=>$val)
                {
                    if($key == 'uab_profile_data'){
                        $$key = $val;
                    }
                    else {
                        $$key = sanitize_text_field( $val );
                    }
                }

				/** Sanitizing each form fields for Menu field added */
				$uab_profile_data_temp = array();
				foreach ( $uab_profile_data as $key => $val ) {
					$uab_profile_data_temp[$key] = array();
					foreach ( $val as $k => $v ) {
						if ( !is_array( $v ) ) {
                            if ($k == 'uab_custom_description') {
                                $allowed_html = wp_kses_allowed_html( 'post' );
                                $uab_profile_data_temp[$key][$k] = wp_kses( $v , $allowed_html );
                            }
                            else{
    							$uab_profile_data_temp[$key][$k] = sanitize_text_field( $v );
                            }
						} else {
							$uab_profile_data_temp[$key][$k] = array_map( 'sanitize_text_field', $v );
						}
					}
				}
               
				$uab_profile_data = $uab_profile_data_temp;			
				$serialized_uab_profile_data = serialize($uab_profile_data);

				update_user_meta( $user_id, 'uab_profile_data', $serialized_uab_profile_data);
			}

			if(isset($_POST['uab_social_icons'])){
				$uab_social_icons = array();
				foreach($_POST['uab_social_icons'] as $socialname => $innerarray)
				{
					$uab_social_icons[$socialname]['icon'] = sanitize_text_field($socialname);
					$uab_social_icons[$socialname]['label'] = sanitize_text_field($socialname);
					$uab_social_icons[$socialname]['url'] = sanitize_text_field($innerarray['url']);
				}

				$serialized_social_icons = serialize($uab_social_icons);
				update_user_meta( $user_id, 'uab_social_icons', $serialized_social_icons);
			}

			if ( isset($_POST['uab_wysiwyg_content'])){
				$uab_wysiwyg_content = array();
				foreach($_POST['uab_wysiwyg_content'] as $key => $value){
					$uab_wysiwyg_content[$key] = wp_kses_post($value);
				}

				update_user_meta( $user_id, 'uab_wysiwyg_content', $uab_wysiwyg_content);
			}
		}

		
		
}

	// Creating AP_Contact_Form class object
	$ultimate_author_box_lite_obj = new Ultimate_Author_Box_Lite();
}










