jQuery(document).ready(function($) {
    var frame,
        metabox = jQuery("#oet-sidebar-metabox.postbox"),
        btn = metabox.find('button.oet_select_medium_background_image'),
        input = btn.prev('input.oet_medium_background_image_url');
    
    btn.on("click", function( e ){
        e.preventDefault();
        
        if (frame) {
            frame.open();
            return;
        }
        
        frame = wp.media({
            title: 'Select or Upload background image',
            button: {
                text: "Use this image"
            },
            multiple:false
        });
        
        frame.on("select", function(){
            var attachment = frame.state().get("selection").first().toJSON();
            
            input.val(attachment.url);
        });
        
        frame.open();
    });
});