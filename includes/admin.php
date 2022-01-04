<?php
/**
 * BCPT_Admin settings page
*/
if (!class_exists('BCPT_Admin')):

    class BCPT_Admin
    {
        public function __construct()
        {
            add_action( 'admin_menu', array( __CLASS__, 'addSettingsPage' ) );
            add_action( 'admin_init', array(__CLASS__, 'initSettings') );
        }

        public static function addSettingsPage()
        {
            add_menu_page(
                'Brewers CPT Settings',
                'BCPT',
                'manage_options',
                'brewers-api-settings',
                array(__CLASS__, 'renderSettingsPage')
            );
        }

        public static function renderSettingsPage()
        {
            $resultsLimit = get_option('bcpt_plugin_options_results_limit');
            $pageNumber = get_option('bcpt_plugin_options_page_number');
?>
            <h2>Brewers CPT Settings</h2>
            <p>
                <em>RESULTS LIMIT</em>: max 50; Number of breweries to return each call.<br />
                <em>PAGE NUMBER</em>: The offset or page of breweries to return.
            </p>
            <form action="options.php" method="post">
                <?php settings_fields( 'bcpt_plugin' ); ?>
                <?php do_settings_sections( 'brewers-api-settings' ); ?>
                <?php submit_button(); ?>
            </form>
            <button class="button button-secondary" id="bcpt_import_btn" data-limit="<?=$resultsLimit;?>" data-page="<?=$pageNumber;?>">Import</button>
<?php
        }

        public static function optionsResultsLimitCallback()
        {
            $options = get_option('bcpt_plugin_options_results_limit');

            echo "<input type='number' min='0' max='50' width='50' id='bcpt_plugin_options_results_limit' name='bcpt_plugin_options_results_limit' value='" . $options . "'/>";
        }

        public static function optionsPageNumberCallback()
        {
            $options = get_option('bcpt_plugin_options_page_number');

            echo "<input type='number' min='1' width='50' id='bcpt_plugin_options_page_number' name='bcpt_plugin_options_page_number' value='" . $options . "'/>";
        }

        public static function initSettings()
        {
            $optionGroup = 'bcpt_plugin';

            if ( false == get_option( $optionGroup . '_options_results_limit' ) ):
                add_option( $optionGroup . '_options_results_limit' );
            endif;

            if ( false == get_option( $optionGroup . '_options_page_number' ) ):
                add_option( $optionGroup . '_options_page_number' );
            endif;

            register_setting( $optionGroup, $optionGroup . '_options_results_limit' );
            register_setting( $optionGroup, $optionGroup . '_options_page_number' );

            add_settings_section(
        		'some_settings_section_id', // section ID
        		'', // title (if needed)
        		'', // callback function (if needed)
        		'brewers-api-settings' // page slug
        	);

            add_settings_field(
                $optionGroup . '_options_results_limit',
                'Results Limit',
                array(__CLASS__, 'optionsResultsLimitCallback'),
                'brewers-api-settings',
                'some_settings_section_id'
            );

            add_settings_field(
                $optionGroup . '_options_page_number',
                'Page Number',
                array(__CLASS__, 'optionsPageNumberCallback'),
                'brewers-api-settings',
                'some_settings_section_id'
            );
        }
    }
endif;
?>
