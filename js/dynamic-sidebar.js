jQuery( document ).ready(function($) {
    $('.oet-add-sidebar-section').on("click", function(e){
        e.preventDefault();
        var btn = $(this).closest('.button-row.form-group');
                
        var total_sections = parseInt($('.oet-sidebar-section-wrapper').length, 10);
        var id = total_sections + 1;
        console.log(oet_ajax_object.ajaxurl);
        $.post(oet_ajax_object.ajaxurl,
               {
                action:'oet_add_sidebar_section_callback',
                row_id: id
               }).done(function (response) {
            btn.before(response);
        });
    });
});