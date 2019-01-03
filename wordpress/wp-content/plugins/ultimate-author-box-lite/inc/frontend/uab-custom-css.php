<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); 
if(isset($uab_profile_data[1]['uab_personal_theme'])=='on'){
	$uab_primary_color = $uab_profile_data[1]['uab_primary_color'];
	$uab_seconday_color = $uab_profile_data[1]['uab_secondary_color'];
	
}else{
	$uab_primary_color = $uab_general_settings['uab_primary_color'];
	$uab_seconday_color = $uab_general_settings['uab_secondary_color'];
}

?>
<style>


/*Seconday Colors*/
.uab-template-3.uab-custom-template .uab-tabs li,
.uab-template-3.uab-custom-template .uab-social-icons,
.uab-template-5.uab-custom-template .uab-tabs li
{
	background: <?php echo $uab_seconday_color; ?>;
}

.uab-template-3.uab-custom-template .uab-tab-content .uab-defaut-tab
{
	border:3px solid <?php echo $uab_seconday_color; ?>;
}

/*Primary Colors*/
.uab-template-1.uab-custom-template .uab-tabs li,
.uab-template-1.uab-custom-template .uab-contact-inner .uab-contact-label,
.uab-template-1.uab-custom-template .uab-social-icons ul li a:hover i,
.uab-template-1.uab-custom-template .uab-display-name a:hover,
.uab-template-1.uab-custom-template .uab-short-contact .uab-user-website a:hover,
.uab-template-1.uab-custom-template .uab-user-email a:hover,
.uab-template-1.uab-custom-template .uab-user-phone a:hover,
.uab-template-1.uab-custom-template .uab-template-1.uab-custom-template .uab-post-title-wrapper a:hover,
.uab-template-1.uab-custom-template .uab-post-meta-info .uap-post-author-name a:hover,
.uab-template-1.uab-custom-template .uab-social-content a,
.uab-template-1.uab-custom-template  .uab-temp-content-wrapper .uab-social-action-wrapper .uab-social-action a:hover, 
.uab-template-1.uab-custom-template .uap-success-message,
.uab-template-1.uab-custom-template .uab-rss-feed-title-wrapper a:hover,
.uab-template-2.uab-custom-template .uab-rss-feed-title-wrapper a:hover,
.uab-template-3.uab-custom-template .uab-rss-feed-title-wrapper a,
.uab-template-4.uab-custom-template .uab-rss-feed-title-wrapper a:hover,
.uab-template-5.uab-custom-template .uab-rss-feed-title-wrapper a:hover,
.uab-template-2.uab-custom-template .uab-tabs li,
.uab-template-2.uab-custom-template .uab-content-header .uab-display-name a:hover,
.uab-template-2.uab-custom-template .uab-content-header .uab-company-info a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-website a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-email a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-phone a:hover,
.uab-template-2.uab-custom-template .uab-content-header .uab-display-name a:hover,
.uab-template-2.uab-custom-template .uab-content-header .uab-company-info a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-website a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-email a:hover,
.uab-template-2.uab-custom-template .uab-short-contact .uab-user-phone a:hover,
.uab-template-2.uab-custom-template .uab-social-content a,
.uab-template-2.uab-custom-template  .uab-social-wrapper-second .uab-title-social-wrapper a:hover,
.uab-template-2.uab-custom-template  .uab-social-wrapper-second  .uab-social-username-wrapper a:hover,
.uab-template-2.uab-custom-template.uab-frontend-wrapper .uab-facebook-count i,
.uab-template-2.uab-custom-template .uap-success-message,
.uab-template-3.uab-custom-template .uab-display-name a,
.uab-template-3.uab-custom-template .uab-short-contact a:hover, 
.uab-template-3.uab-custom-template .uab-company-info >a:hover, 
.uab-template-3.uab-custom-template .uab-display-name a:hover, 
.uab-template-3.uab-custom-template .uab-social-icons ul li a:hover i,
.uab-template-3.uab-custom-template .uab-tabs li,
.uab-template-3.uab-custom-template .uab-post-title-wrapper a,
.uab-template-3.uab-custom-template .uab-social-content a,
.uab-template-3.uab-custom-template  .uab-social-wrapper-second .uab-title-social-wrapper a:hover,
.uab-template-3.uab-custom-template  .uab-social-wrapper-second  .uab-social-username-wrapper a:hover,
.uab-template-4.uab-custom-template .uab-user-website a:hover, 
.uab-template-4.uab-custom-template .uab-front-content .uab-company-info a:hover, 
.uab-template-4.uab-custom-template .uab-front-content .uab-display-name a:hover, 
.uab-template-4.uab-custom-template .uab-user-email a:hover, 
.uab-template-4.uab-custom-template .uab-user-phone a:hover,
.uab-template-4.uab-custom-template .uab-front-content .uab-display-name a,
.uab-template-4.uab-custom-template .uab-post-title-wrapper a:hover,
.uab-template-4.uab-custom-template .uab-social-content a,
.uab-template-4.uab-custom-template  .uab-social-wrapper-second .uab-title-social-wrapper a:hover, 
.uab-template-4.uab-custom-template  .uab-social-wrapper-second  .uab-social-username-wrapper a:hover,
.uab-template-5.uab-custom-template .uab-company-info a:hover, 
.uab-template-5.uab-custom-template .uab-display-name a:hover, 
.uab-template-5.uab-custom-template .uab-user-website a:hover, 
.uab-template-5.uab-custom-template .uab-user-email a:hover, 
.uab-template-5.uab-custom-template .uab-user-phone a:hover,
.uab-template-5.uab-custom-template .uab-post-title-wrapper a:hover, 
.uab-template-5.uab-custom-template .uab-post-meta-info .uap-post-author-name a:hover,
.uab-template-5.uab-custom-template.uab-frontend-wrapper .uab-facebook-count i
{
	color: <?php echo $uab_primary_color; ?>;
}

.uab-template-2.uab-custom-template .uab-tabs li.uab-current,
.uab-template-3.uab-custom-template .uab-tabs li.uab-current
{
	color: #fff;	
}

/*Active Colors*/
.uab-template-1.uab-custom-template .uab-contact-form input[type="submit"].uab-contact-submit:hover,
.uab-template-3.uab-custom-template .uab-contact-form-submit input[type=submit]:hover,
.uab-template-4.uab-custom-template .uab-contact-form-submit input[type=submit]:hover,
.uab-template-5.uab-custom-template .uab-contact-form-submit input[type=submit]:hover
{
	background: <?php echo $uab_primary_color; ?>;
	opacity: 0.7;
}

.uab-template-1.uab-custom-template .uab-display-name span.uab-user-role, 
.uab-template-1.uab-custom-template .uab-social-icons > span,
.uab-template-1.uab-custom-template .uab-contact-form input[type="submit"].uab-contact-submit,
.uab-template-2.uab-custom-template .uab-tabs li.uab-current,
.uab-template-2.uab-custom-template .uab-social-icons li a:hover,
.uab-template-2.uab-custom-template .uab-contact-form-submit input[type=submit],
.uab-template-2.uab-custom-template .uab-social-action-wrapper .uab-social-action a:hover,
.uab-template-2.uab-custom-template .uab-social-header .uab-social-follow a,
.uab-template-2.uab-custom-template.uab-frontend-wrapper .uab-facebook-count,
.uab-template-3.uab-custom-template .uab-tabs li.uab-current,
.uab-template-3.uab-custom-template .uab-contact-form-submit input[type=submit],
.uab-template-3.uab-custom-template .uab-social-header .uab-social-follow a,
.uab-template-3.uab-custom-template  .uab-social-action-wrapper .uab-social-action a:hover,
.uab-custom-template .uab-frontend-wrapper .uab-facebook-count,
.uab-template-4.uab-custom-template .uab-tabs li.uab-current:after,
.uab-template-4.uab-custom-template .uab-front-content .uab-tab-header:after,
.uab-template-4.uab-custom-template .uab-post-title-wrapper:after,
.uab-template-4.uab-custom-template .uab-field-wrap label:after,
.uab-template-4.uab-custom-template .uab-contact-form-submit input[type=submit],
.uab-template-4.uab-custom-template .uab-social-header .uab-social-follow a,
.uab-template-4.uab-custom-template .uab-social-action-wrapper .uab-social-action a:hover,
.uab-template-5.uab-custom-template .uab-tab-header,
.uab-template-5.uab-custom-template .uab-social-icons ul li a:hover,
.uab-template-5.uab-custom-template .uab-tabs li.uab-current,
.uab-template-5.uab-custom-template .uab-post-header,
.uab-template-5.uab-custom-template .uab-contact-form-submit input[type=submit],
.uab-template-5.uab-custom-template.uab-frontend-wrapper .uab-facebook-count,
.uab-template-6.uab-custom-template .uab-tabs li.uab-current:after
{
	background: <?php echo $uab_primary_color;?>;
}


/*Especial Borders*/
.uab-template-2.uab-custom-template .uab-tabs li:after,
.uab-template-5.uab-custom-template .uab-tabs li.uab-current:after
{
	border-color: <?php echo $uab_primary_color; ?> transparent transparent transparent;
}

.uab-template-3.uab-custom-template .uab-tabs
{
	border-color: <?php echo $uab_primary_color; ?>;
}

</style>
