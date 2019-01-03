jQuery(document).ready(function($){

  var tabCounter = $("#uab-tab-index-wrapper .uab-tabs li").length;
  if(tabCounter=='1'){
    $('#uab-tab-index-wrapper').hide();
  };

// Frontend Tabs js
$('ul.uab-tabs li').click(function(){
  var tab_id = $(this).attr('data-tab');

  
  $(this).closest('ul.uab-tabs').find('.tab-link').removeClass('uab-current');
  //alert($(this).closest('#uab-frontend-wrapper').find("#"+tab_id).attr('id'));
  $(this).closest('.uab-frontend-wrapper').find('.uab-tab-content').removeClass('uab-current');

  $(this).addClass('uab-current');
  $(this).closest('.uab-frontend-wrapper').find("#"+tab_id).addClass('uab-current');
});

});
