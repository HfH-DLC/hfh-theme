<?php

namespace HFH\Theme;

class PostVideoFormat
{
    private static $instance = false;

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('after_setup_theme', array($this, 'add_theme_support'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts'));
        add_action('add_meta_boxes_post', array($this, 'add_metabox'));
        add_action('save_post', array($this, 'save_meta_box'), 10, 2);
        add_filter('wp_kses_allowed_html', array($this, 'allow_iframes_filter'), 10, 2);
        add_filter('postbox_classes_post_hfh-theme-video-metabox', array($this, 'postbox_classes_post_video'));
    }

    public function add_theme_support()
    {
        add_theme_support('post-formats', array('video'));
    }

    public function load_admin_scripts()
    {
        global $post;
        if ($post && get_post_type($post) == 'post') {
            wp_enqueue_media();
            wp_register_script('hfh_theme_media_uploader', get_template_directory_uri() . '/js/media-uploader.js', array('jquery'), HFH_THEME_VERSION);
            wp_localize_script(
                'hfh_theme_media_uploader',
                'phpVars',
                array(
                    'title' => __('Choose or Upload Media', 'hfh-theme'),
                    'button' => __('Use this File', 'hfh-theme'),
                )
            );
            wp_enqueue_script('hfh_theme_media_uploader');
        }
    }

    public function add_metabox($post)
    {
        add_meta_box(
            'hfh-theme-video-metabox',
            __('Video', 'hfh-theme'),
            array($this, 'render_metabox'),
            'post',
            'normal'
        );
    }

    public function render_metabox($object)
    {
        $source = get_post_meta($object->ID, "hfh_theme_video_metabox_source", true);
        wp_nonce_field('hfh_theme_video_metabox', 'hfh_wpnonce'); ?>
        <div class="hfh-theme-video-metabox-content">
            <label for="hfh-theme-video-metabox-source"><?= __("Choose a video source:") ?></label>
            <div class="video-metabox-sources">
                <div><input type="radio" name="hfh-theme-video-metabox-source" id="hfh-theme-video-metabox-source-embed" value="embed" <?= $source == 'embed' ? 'checked' : ''  ?>>
                    <label for="hfh-theme-video-metabox-source-embed"><?= __('Embed external video', 'hfh-theme') ?></label>
                </div>
                <div>
                    <input type="radio" name="hfh-theme-video-metabox-source" id="hfh-theme-video-metabox-source-file" value="file" <?= $source == 'file' ? 'checked' : ''  ?>>
                    <label for="hfh-theme-video-metabox-source-file"><?= __('Use video from media library', 'hfh-theme') ?></label>
                </div>
            </div>
            <div id="hfh-theme-video-metabox-embed-wrapper" class="<?= $source == 'embed' ? '' : 'hfh-hidden' ?>">
                <label for="hfh-theme-video-metabox-embed"><?= __('Enter video embed code:') ?></label><br>
                <textarea id="hfh-theme-video-metabox-embed" name="hfh-theme-video-metabox-embed"><?= get_post_meta($object->ID, "hfh_theme_video_metabox_embed", true) ?></textarea>
            </div>
            <div id="hfh-theme-video-metabox-file-wrapper" class="<?= $source == 'file' ? '' : 'hfh-hidden' ?>">
                <?php
                global $post;
                $file = get_post_meta($post->ID, 'hfh_theme_video_metabox_file', true);
                ?>
                <input type="hidden" name="hfh-theme-video-metabox-file" id="hfh-theme-video-metabox-file" value="<?php echo esc_attr($file); ?>"><br>
                <div id="hfh-theme-video-metabox-preview">
                    <?php if ($file) : ?>
                        <video src=<?= $file ?>></video>
                    <?php endif; ?>
                </div>
                <button type="button" class="button<?php if (!$file) : ?> hfh-hidden<?php endif; ?>" id="hfh-theme-video-metabox-remove" data-media-uploader-target="#hfh-theme-video-metabox-file"><?php _e('Remove Video', 'hfh-theme') ?></button>
                <button type="button" class="button" id="hfh-theme-video-metabox-upload" data-media-uploader-target="#hfh-theme-video-metabox-file"><?php _e('Select Video', 'hfh-theme') ?></button>
            </div>
        </div>
<?php
    }

    public function save_meta_box($post_id, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (
            !isset($_POST['post_type']) ||
            !$_POST['post_type'] == 'post' ||
            !isset($_POST['post_format']) ||
            !$_POST['post_format'] == 'video' ||
            !current_user_can('edit_post', $post_id)
        ) {
            return;
        }

        if (
            isset($_POST['hfh_wpnonce']) &&
            wp_verify_nonce($_POST['hfh_wpnonce'], 'hfh_theme_video_metabox') &&
            check_admin_referer('hfh_theme_video_metabox', 'hfh_wpnonce')
        ) {
            if (isset($_POST['hfh-theme-video-metabox-source'])) {
                $source = $_POST['hfh-theme-video-metabox-source'];
                if (!in_array($source, array('embed', 'file'))) {
                    return;
                }
                $sourceChanged = update_post_meta($post_id, 'hfh_theme_video_metabox_source', $source);
                if ($source === 'embed' && isset($_POST['hfh-theme-video-metabox-embed'])) {
                    update_post_meta($post_id, 'hfh_theme_video_metabox_embed', wp_kses_post($_POST['hfh-theme-video-metabox-embed']));
                    if ($sourceChanged) {
                        delete_post_meta($post_id, 'hfh_theme_video_metabox_file');
                    }
                } else if ($source === 'file' && isset($_POST['hfh-theme-video-metabox-file'])) {
                    update_post_meta($post_id, 'hfh_theme_video_metabox_file', esc_url_raw($_POST['hfh-theme-video-metabox-file']));
                    if ($sourceChanged) {
                        delete_post_meta($post_id, 'hfh_theme_video_metabox_embed');
                    }
                }
            }
        }
        return;
    }

    public function allow_iframes_filter($tags, $context)
    {
        if ('post' === $context) {
            $tags['iframe'] = array(
                'src'             => true,
                'height'          => true,
                'width'           => true,
                'frameborder'     => true,
                'allowfullscreen' => true,
            );
        }
        return $tags;
    }

    /**
     * Hide video metabox if post format is not video.
     */
    public function postbox_classes_post_video($classes)
    {
        if (get_post_format() !== 'video') {
            array_push($classes, 'hfh-hidden');
        }
        return $classes;
    }
}
