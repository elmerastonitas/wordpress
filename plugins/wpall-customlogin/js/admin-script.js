// admin-script.js
jQuery(document).ready(function($) {
    // Solo ejecutar el script si estamos en la página de inicio de sesión
    if ($('#login').length > 0) {
        var mediaUploader;

        $('#upload_logo_button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: wpcustomLoginScript.chooseLogo,
                button: {
                    text: wpcustomLoginScript.chooseLogo
                },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#custom_login_logo_url').val(attachment.url);
                $('#logo_preview').html('<img src="'+attachment.url+'" alt="'+wpcustomLoginScript.logoPreview+'" style="max-width: 100px; height: auto;" />');
            });
            mediaUploader.open();
        });

        $('#remove_logo_button').click(function(e) {
            e.preventDefault();
            $('#custom_login_logo_url').val('');
            $('#logo_preview').html('');
        });
    }
});
