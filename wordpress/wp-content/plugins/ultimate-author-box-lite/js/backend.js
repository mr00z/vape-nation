jQuery(document).ready(function($){

//Template Preview Js
$('.uab-template-select').on('change',function(){
	var selected_template = $(this).val();
	if(selected_template!='uab-custom-template'){
		$(this).closest('.uab-template-settings').find('.uab-template-image-preview').show();
		var image_path = uab_variable.plugin_image_path + '/uab-template-screenshorts/'+selected_template+'.PNG';
		$(this).closest('.uab-template-settings').find('.uab-template-image-preview img').attr('src',image_path);
	}else{
		$(this).closest('.uab-template-settings').find('.uab-template-image-preview').hide();
	}
	
});

//Template Preview Js Custom Template
$('.uab-custom-template').on('change',function(){
	var selected_template = $(this).val();
	var image_path = uab_variable.plugin_image_path + '/uab-template-screenshorts/'+selected_template+'.PNG';
	$(this).closest('.uab-custom-settings-content-wrapper').find('.uab-template-image-preview img').attr('src',image_path);
});

//Profile Custom Template hide/show
$('.uab-select-template').on('change',function(){
	selected_template = $('option:selected',this).val();
	if(selected_template=='uab-custom-template'){
		$(this).closest('.uab-profile-content-wrapper').find('.uab-personal-template-select').show();
		$(this).closest('.uab-profile-content-wrapper').children('.uab-template-image-preview').hide();
		
	}else{
		$(this).closest('.uab-profile-content-wrapper').find('.uab-personal-template-select').hide();
		$(this).closest('.uab-profile-content-wrapper').find('.uab-template-image-preview').show();
		var image_path = uab_variable.plugin_image_path + '/uab-template-screenshorts/'+selected_template+'.PNG';
		$(this).closest('.uab-profile-content-wrapper').find('.uab-template-image-preview img').attr('src',image_path);
	}
});

//User profile custom template tab settings
$('#uab-template-settings').on('click',function(){
	$('.uab-backend-tabs .ui-tab').each(function(){
		if($(this).attr('role')=='tab'){
			$(this).removeClass('ui-tabs-active ui-state-active');
			$(this).attr({
				'aria-selected': 'false',
				'aria-expanded': 'false'
			});
		}
	});
	$('.uab-backend-tabs .ui-tabs-panel').each(function(){
		if($(this).attr('role')=='tabpanel'){
			$(this).fadeOut();
		}
	});
	$('.uab-backend-tabs .uab-custom-tab').fadeIn();
});

$('.uab-variable-width-wrapper ul').on('click',function(){
	$('.uab-variable-width-wrapper ul li.ui-tabs-tab').each(function(){
		if($(this).attr('tabindex')=='0'){
			$(this).addClass('ui-tabs-active ui-state-active');
			$(this).attr({
				'aria-selected': 'true',
				'aria-expanded': 'true'
			});
		}
	});
	$('.uab-backend-tabs .ui-tabs-panel').each(function(){
		if($(this).attr('aria-hidden')=='false'){
			$(this).fadeIn();
		}
	});
	$('.uab-backend-tabs .uab-custom-tab').fadeOut();
});

$('.uab-color-picker').wpColorPicker();

//Template color options
	var uabPrimaryColor = $('.uab-primary-color-picker').val() || '';
	var uabSecondaryColor = $('.uab-primary-color-picker').val() || '';
	var uabTertiaryColor = $('.uab-primary-color-picker').val() || '';
	//Custom Template options
	function chooseTemplateOptions(post_option){
		//alert(post_option);
		switch(post_option) {
			case 'uab-template-1':
			$('.uab-custom-template-option').hide();
			$('.uab-primary-color').show();
			break;
			case 'uab-template-2':
			$('.uab-custom-template-option').hide();
			$('.uab-primary-color').show();
			break;
			case 'uab-template-3':
			$('.uab-custom-template-option').hide();
			$('.uab-primary-color').show();
			$('.uab-secondary-color').show();
			break;
			case 'uab-template-4':
			$('.uab-custom-template-option').hide();
			$('.uab-primary-color').show();
			break;
			case 'uab-template-5':
			$('.uab-custom-template-option').hide();
			$('.uab-primary-color').show();
			$('.uab-secondary-color').show();
			break;
			default:
			$('.uab-custom-template-option').hide();
		}	
	}

	$('.uab-custom-settings-content-wrapper').on('change','.uab-custom-template',function(){
		var post_option = $('option:selected',this).val();
		chooseTemplateOptions(post_option);

	});

	$('.uab-profile-content-wrapper').on('change','.uab-custom-template',function(){
		var post_option = $('option:selected',this).val();
		var image_path = uab_variable.plugin_image_path + '/uab-template-screenshorts/'+post_option+'.PNG';
		$(this).closest('.uab-personal-template-select').find('.uab-template-image-preview img').attr('src',image_path);
		chooseTemplateOptions(post_option);
	});

//Js For Media Uploader for Custom Template
	if($('.uab_upload_background_url').val() != ''){
		$('.current-background-image').show(); 
	}else{
		$('.current-background-image').hide();    
	} 

	$('.custom_image_background_button').click(function(e) {
		e.preventDefault();
		
		var image = wp.media({ 
			title: 'Upload Image',
			multiple: false
		}).open()

		.on('select', function(e){
			var uploaded_image = image.state().get('selection').first();
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			$('.uab_upload_background_url').val(image_url);
			$('.current-background-image').find('img').attr('src', image_url);
			if($('.uab_upload_background_url').val(image_url) != ''){
				$('.current-background-image').show(); 
			}else{
				$('.current-background-image').hide();    
			}
		});
	});

/**
 * Backend Settings Tabs Configuration
 *  
 * @since 1.0.0
 */
 $('ul.uab-tabs li').click(function(){
 	var tab_id = $(this).attr('data-tab');

 	$('ul.uab-tabs li').removeClass('current');
 	$('.uab-tab-content').removeClass('current');

 	$(this).addClass('current');
 	$("#"+tab_id).addClass('current');
 });

/**
 * Media Uploader for Custom Template Background
 *  
 * @since 1.0.0
 */
 if($('.uab_upload_background_url').val() != ''){
 	$('.current-background-image').show(); 
 }else{
 	$('.current-background-image').hide();    
 }  

 $('.custom_image_background_button').click(function(e) {
 	e.preventDefault();

 	var image = wp.media({ 
 		title: 'Upload Image',
 		multiple: false
 	}).open()

 	.on('select', function(e){
 		var uploaded_image = image.state().get('selection').first();
 		console.log(uploaded_image);
 		var image_url = uploaded_image.toJSON().url;
 		$('.uab_upload_background_url').val(image_url);
 		$('.current-background-image').find('img').attr('src', image_url);
 		if($('.uab_upload_background_url').val(image_url) != ''){
 			$('.current-background-image').show(); 
 		}else{
 			$('.current-background-image').hide();    
 		}
 	});
 });

/**
 * Media Uploader for Custom Profile Image
 *  
 * @since 1.0.0
 */
 if($('.uab_upload_image_url').val() != ''){
 	$('.image-preview').show(); 
 }else{
 	$('.image-preview').hide();    
 }  

 $('.uab_upload_image_button').click(function(e) {
 	e.preventDefault();

 	var image = wp.media({ 
 		title: 'Upload Image',
 		multiple: false
 	}).open()

 	.on('select', function(e){
 		var uploaded_image = image.state().get('selection').first();
 		console.log(uploaded_image);
 		var image_url = uploaded_image.toJSON().url;
 		$('.uab_upload_image_url').val(image_url);
 		$('.current-image').find('img').attr('src', image_url);
 		if($('.uab_upload_image_url').val(image_url) != ''){
 			$('.image-preview').show(); 
 		}else{
 			$('.image-preview').hide();    
 		}
 	});
 });

 /**
 * Profile Social Icons Sortable js
 *  
 * @since 1.0.0
 */
$('.uap-social-outlets-fields').sortable({containment: "parent"	});


/**
 * Get a random integer between `min` and `max`.
 * 
 * @param {number} min - min number
 * @param {number} max - max number
 * @return {int} a random integer
 */
 function eg_getRandomInt(min, max) {
 	return Math.floor(Math.random() * (max - min + 1) + min);
 }

/**
 * Generates random string
 * 
 * @param {int} length
 * @returns {string}
 * 
 * @since 1.0.0
 */
 function eg_generate_random_string(length) {
 	var string = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 	var random_string = '';
 	for (var i = 1; i <= length; i++) {
 		random_string += string[eg_getRandomInt(0, 61)];
 	}
 	return random_string;

 }

 /**
 * Backend jQuery UI Tabs
 *  
 * @since 1.0.0
 */

	var tabs = $( "#tabs" ).tabs({hide: { effect: "fadeOut", duration: 250 },show: { effect: "fadeIn", duration: 250 }});

	// Modal dialog init: custom buttons and a "close" callback resetting the form inside
    var dialog = $( "#dialog" ).dialog({
      autoOpen: false,
      modal: true,
      dialogClass: 'uab-tab-selection-dialog',
      buttons: {
        Add: function() {
          addTab();
          
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    // AddTab form: calls addTab function on submit and closes the dialog
    var form = dialog.find( "form" ).on( "submit", function( event ) {
      addTab();
      dialog.dialog( "close" );
      event.preventDefault();
    });

    //Deleting Tab
	tabs.on( "click", "span.ui-icon-close", function() {
		var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
		$( "#" + panelId ).remove();
		tabs.tabs( "refresh" );
	});

    // AddTab button: just opens the dialog
    $( "#uab-add-field" ).button().on( "click", function() {
        dialog.dialog( "open" );
    });

	keyArray = $('.uab-tab-keys').val();

	//Settings Tab Width
    var activeCounter = $("#tabs .ui-tabs-nav li").length;
    if(activeCounter > 5){
    	var tabWidth = (100/activeCounter);
    	$("#tabs .ui-tabs-nav li").width(tabWidth+'%');	
    }
    else{
    	$("#tabs .ui-tabs-nav li").width('200px');		
    }

	var tabTitle = $( "#uab_tab_title" ),
		tabTemplate = "<li><a href='#{href}'>#{label}<span class='ui-icon ui-icon-close' role='presentation'></span></a></li>";
				
	// Actual addTab function: adds new tab using the input from the form above
	function addTab(){
		tabCounter = eg_generate_random_string(10);
		keyArray = keyArray+','+tabCounter;
		$('.uab-tab-keys').val(keyArray);

		var activeCounter = $("#tabs .ui-tabs-nav li").length;

		$("#tabs .ui-tabs-nav li").width(tabWidth+'%');
		var label = tabTitle.val() || "Tab" + tabCounter,
		id = "tabs-" + tabCounter,
		li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );
		tab_selector = $('.uab-tab-type-selection',this);
		uab_tab_type = $('.uab-tab-type-selection :selected').val();
		switch(uab_tab_type) {
			case 'uab_author_post':
			$('.new-tab-outer-wrapper .uab-recent-post-wrapper').find('#uab_tab_name').val(label);
			$('.new-tab-outer-wrapper .uab-recent-post-wrapper').find('#uab_tab_type').val(uab_tab_type);
			$('.new-tab-outer-wrapper .uab-recent-post-wrapper').find('#uab_tab_id').val(tabCounter);
			tabContentHtml = $('.new-tab-outer-wrapper').find('.uab-recent-post-outer-wrapper').html();
			break;
			case 'uab_editor':
			$('.new-tab-outer-wrapper .uab-editor-wrapper').find('#uab_tab_name').val(label);
			$('.new-tab-outer-wrapper .uab-editor-wrapper').find('#uab_tab_type').val(uab_tab_type);
			$('.new-tab-outer-wrapper .uab-recent-post-wrapper').find('#uab_tab_id').val(tabCounter);
			tabContentHtml = $('.new-tab-outer-wrapper').find('.uab-editor-outer-wrapper').html();
			break;
			default:
			alert('nothing selected');
		}


		tabs.find( ".ui-tabs-nav" ).append( li );

		tabs.append( "<div id='" + id + "'>" + tabContentHtml + "</div>");
		
		tab_type_selector = $('#'+id);

		tab_type_selector.find('input').each(function() {
			var name_attr = $(this).attr('name');
			if (name_attr) {

				name_attr = name_attr.replace('uab_id', tabCounter);

				$(this).attr('name', name_attr);

                   // alert(tabCounter);
               }
           });
		tab_type_selector.find('select').each(function() {
			var name_attr = $(this).attr('name');
			if (name_attr) {

				name_attr = name_attr.replace('uab_id', tabCounter);
				$(this).attr('name', name_attr);
			}
		});
		tab_type_selector.find('textarea').each(function() {
			var name_attr = $(this).attr('name');
			if (name_attr) {
				
				name_attr = name_attr.replace('uab_id', tabCounter);
				$(this).attr('name', name_attr);
			}
			var id_attr = $(this).attr('id');
			if (id_attr) {
				
				id_attr = id_attr+'-'+tabCounter;
				$(this).attr('id', id_attr);
				tinymce.execCommand( 'mceRemoveEditor', false, id_attr );
                tinymce.execCommand( 'mceAddEditor', false, id_attr );
                quicktags({id : id_attr});
                //init tinymce
                tinymce.init({
                    selector: id_attr,          
                    relative_urls:false,
                    remove_script_host:false,
                    convert_urls:false,
                    browser_spellcheck:true,
                    fix_list_elements:true,
                    entities:"38,amp,60,lt,62,gt",
                    entity_encoding:"raw",
                    keep_styles:false,
                    paste_webkit_styles:"font-weight font-style color",
                    preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
                    wpeditimage_disable_captions:false,
                    wpeditimage_html5_captions:true,
                    plugins:"charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
                    // selector:"#" + fullId,
                    resize:"vertical",
                    menubar:false,
                    wpautop:true,
                    indent:false,
                    toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",
                    toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
                    toolbar3:"",
                    toolbar4:"",
                    tabfocus_elements:":prev,:next",
                    body_class:"id post-type-post post-status-publish post-format-standard",
                }); //init tinymce ends
			}
		});		
		tabs.tabs( "refresh" ).tabs({ active: activeCounter});
		var activeCounter = $("#tabs .ui-tabs-nav li").length;
		if(activeCounter > 5){
			var tabWidth = (100/activeCounter);
			$("#tabs .ui-tabs-nav li").width(tabWidth+'%');	
		}
		else{
			$("#tabs .ui-tabs-nav li").width('200px');		
		}

	};

 /**
 * Author Detail Tab Choose Post Option
 *  
 * @since 1.0.0
 */

 function choosePostSelectionType(post_option, currentTabID){
 	switch(post_option) {
 		case 'uab_selective_posts':
 		currentTabID.find('.uab-selective-posts').show();
 		break;
 		default:
 		currentTabID.find('.uab-selective-posts').hide();
 	}	
 }

 $('.uab-backend-tabs').on('change',' select.uab_post_select',function(){
 	var currentTabID = $('#'+$(this).closest('.uab-recent-post-wrapper').parent().attr('id'));
 	var post_option = $('option:selected',this).val();
 	choosePostSelectionType(post_option, currentTabID);
 });

/**
 * Profile Image Selector
 *  
 * @since 1.0.0
 */

function chooseImageType(){
	var image_option = $('.uab_image_select :selected').val();
	switch(image_option) {
		case 'uab_facebook':
		$('.uab-image-upload-option-wrapper').hide();
		$('.uab-facebook-image-upload-wrapper').show();
		break;
		case 'uab_instagram':
		$('.uab-image-upload-option-wrapper').hide();
		$('.uab-instagram-image-upload-wrapper').show();
		break;
		case 'uab_twitter':
		$('.uab-image-upload-option-wrapper').hide();
		$('.uab-twitter-image-upload-wrapper').show();
		break;
		case 'uab_google_plus':
		$('.uab-image-upload-option-wrapper').hide();
		$('.uab-google-plus-image-upload-wrapper').show();
		break;
		case 'uab_upload_image':
		$('.uab-image-upload-option-wrapper').hide();
		$('.uab-custom-image-upload-wrapper').show();
		break;
		default:
		$('.uab-image-upload-option-wrapper').hide();
	}	
}

$('.uab_image_select').on('change',function(){
	chooseImageType();
});

 /**
 * Code Mirror for Custom CSS
 *  
 * @since 1.0.0
 */
 $('.uab-layout-setting-tab').on('click', function() {
 	codeMirrorDisplay();

 });

 function codeMirrorDisplay() {
 	var $codeMirrorEditors = $('.uab-codemirror-textarea');
 	$codeMirrorEditors.each(function(i, el) {
 		var $active_element = $(el);
 		if ($active_element.data('cm')) {
 			$active_element.data('cm').doc.cm.toTextArea();
 		}
 		var codeMirrorEditor = CodeMirror.fromTextArea(el, {
 			lineNumbers: true,
 			lineWrapping: true
 		});
 		$active_element.data('cm', codeMirrorEditor);
 	});
 }

var table_count = 1;
$('form#your-profile table.form-table').each(function(){
	if (table_count == 4) {
		$('.uab-temporary-structure tr.user-custom-description-status-wrap').appendTo($(this));
		$('.uab-temporary-structure tr.user-custom-description-wrap').appendTo($(this));
		$('.uab-temporary-structure').remove();
		$('.form-table tr.user-custom-description-status-wrap').show();
		if ($('#uab-custom-desc-status').prop('checked')) {
			$('.form-table tr.user-custom-description-wrap').show();
		}
		$('#uab-custom-desc-status').on('click',function(){
			if ($(this).prop('checked')) {
				$('.form-table tr.user-custom-description-wrap').show();
			}
			else{
				$('.form-table tr.user-custom-description-wrap').hide();
			}
		});
	}
	else{
		table_count++;
	}
});

});





