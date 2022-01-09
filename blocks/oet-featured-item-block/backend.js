

jQuery( window ).load(function() {
  setTimeout(function(){
    oet_gutenberg_toolbar_observer_func.observe(document.querySelector(".edit-post-visual-editor .popover-slot"), {childList: true, subtree: true });
  }, 500);
  var oet_gutenberg_toolbar_observer_func = new MutationObserver(function(mutations) { oet_gutenberg_toolbar_enpoint_script();});
  function oet_gutenberg_toolbar_enpoint_script(){
    var oet_target = jQuery('.edit-post-visual-editor');
    oet_gutenberg_toolbar_observer_clear_classes(oet_target);
    if(jQuery('.edit-post-visual-editor .popover-slot').html().length > 0){
      var oet_title_selected = jQuery('.oet-featured-item-title-ytr85g9wer').hasClass('is-selected');
      var oet_date_selected = jQuery('.oet-featured-item-date-ytr85g9wer').hasClass('is-selected');
      var oet_button_selected = jQuery('.oet-featured-item-button-ytr85g9wer').hasClass('is-selected');
      if(oet_title_selected || oet_date_selected){
          oet_target.addClass('oet-featured-item-title-toolbar-hide');
      }else if(oet_button_selected){
          oet_target.addClass('oet-featured-item-button-toolbar-hide');
      }
    }
  }
});

function oet_gutenberg_toolbar_observer_clear_classes(tgt){
  tgt.removeClass('oet-featured-item-title-toolbar-hide oet-featured-item-button-toolbar-hide');
}