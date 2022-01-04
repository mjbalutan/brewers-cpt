<?php
/*
* BCPT_Frontend
*/
if (!class_exists('BCPT_Frontend')):

    class BCPT_Frontend {

        public function __construct()
        {
            self::init();
        }

        public static function singlePostTemplate($single) {

            global $post;

            if ( $post->post_type == 'brewers' ) {
                if ( file_exists( plugin_dir_path(__DIR__) . 'templates/single.php' ) ) {
                    return plugin_dir_path(__DIR__) . 'templates/single.php';
                }
            }

            return $single;

        }

        public static function archivePostTemplate($archive) {

            global $post;

            if ($post->post_type == 'brewers'):
                if ( file_exists( plugin_dir_path(__DIR__) . 'templates/archive.php' ) ) {
                    return plugin_dir_path(__DIR__) . 'templates/archive.php';
                }
            endif;

            return $archive;
        }

        public static function init()
        {
            add_filter('single_template', array(__CLASS__, 'singlePostTemplate'));
            add_filter('archive_template', array(__CLASS__, 'archivePostTemplate'));
        }
    }

endif;
?>
