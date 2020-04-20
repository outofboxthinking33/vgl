jQuery(document).ready(function($) {

	$('.vgl-media-upload-btn').on('click', function(e) {
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
            e.preventDefault();
            var button = $(this);
            var logo_input = $(this).closest('td').find('input[name="theme_options[logo_id]"]');
            var logo_image = $(this).closest('td').find('img.vgl-media-image');
            // var original_media = wp.emdia.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                logo_input.val(attachment.id);
                logo_image.attr('src', attachment.url);
                console.log(attachment);
            };
            wp.media.editor.open();
            return false;
        }
	});

});