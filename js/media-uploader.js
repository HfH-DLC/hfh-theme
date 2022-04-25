'use strict';

jQuery(document).ready(function($) {

    let frame;

    $('input[type=radio][name=hfh-theme-video-metabox-source]').change(function() {
        if (this.value == 'embed') {
            $("#hfh-theme-video-metabox-embed-wrapper").removeClass("hfh-hidden");
            $("#hfh-theme-video-metabox-file-wrapper").addClass("hfh-hidden");
            $("#hfh-theme-video-metabox-file").val(null)
            $('#hfh-theme-video-metabox-preview').empty()
        } else if (this.value == 'file') {
            $("#hfh-theme-video-metabox-file-wrapper").removeClass("hfh-hidden");
            $("#hfh-theme-video-metabox-embed-wrapper").addClass("hfh-hidden");
            $("#hfh-theme-video-metabox-embed").val(null)

        }
    });

    $('input[type=radio][name=post_format]').change(function() {
        if (this.value == 'video') {
            $("#hfh-theme-video-metabox").removeClass("hfh-hidden");
        } else {
            $("#hfh-theme-video-metabox").addClass("hfh-hidden");
        }

    });

    $('#hfh-theme-video-metabox-upload').click(function(e) {
        e.preventDefault();

        const field = $(this).data('media-uploader-target');

        if (!frame) {
            frame = wp.media.frames.hfhFrame = wp.media({
                title: phpVars.title,
                button: { text: phpVars.button },
                multiple: false,
                library: {
                    type: ['video']
                },
            });
            frame.on('select', function() {
                const attachment = frame.state().get('selection').first().toJSON();
                $(field).val(attachment.url);
                $('#hfh-theme-video-metabox-preview').empty().append($('<video>', { src: attachment.url }));
                $('#hfh-theme-video-metabox-remove').toggleClass('hfh-hidden');
            });
        }

        frame.open();

    });

    $('#hfh-theme-video-metabox-remove').click(function(e) {
        const field = $(this).data('media-uploader-target');
        $(field).val(null);
        $('#hfh-theme-video-metabox-preview').empty();
        $('#hfh-theme-video-metabox-remove').toggleClass('hfh-hidden');
    });
});