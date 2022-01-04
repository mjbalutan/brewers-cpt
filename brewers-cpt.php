<?php
/**
 * Plugin Name: Brewers CPT
 * Author: MJ Balutan
*/
require_once(plugin_dir_path(__FILE__) . 'includes/admin.php');
require_once(plugin_dir_path(__FILE__) . 'includes/cpt.php');
require_once(plugin_dir_path(__FILE__) . 'includes/frontend.php');

if (!class_exists('BCPT')):

    class BCPT
    {
        public function __construct()
        {
            self::init();
        }

        public static function enqueueScripts()
        {
            wp_register_script( 'brewers-cpt', plugin_dir_url(__FILE__) . 'includes/brewers-cpt.js', array('jquery'), '1.0.0', true );
            wp_localize_script( 'brewers-cpt', 'bcptAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

            wp_enqueue_style( 'brewers-cpt', plugin_dir_url(__FILE__) . 'includes/brewers-cpt.css' );

            wp_enqueue_script( 'brewers-cpt' );
        }

        public static function init()
        {
            $cpt = new BCPT_CPT();
            $fe = new BCPT_Frontend();

            if (is_admin()) :
                new BCPT_Admin();
            endif;

            add_action('init', array($cpt, 'createBreweriesPostType'));
            add_action('wp_ajax_createPost', array($cpt, 'createPost'));
            add_action('wp_ajax_nopriv_createPost', array($cpt, 'createPost'));
            add_action( 'wp_enqueue_scripts', array(__CLASS__, 'enqueueScripts') );
            add_action( 'admin_enqueue_scripts', array(__CLASS__, 'enqueueScripts') );
        }
    }

    new BCPT();
endif;
?>
