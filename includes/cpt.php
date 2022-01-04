<?php
/**
 * BCPT_CPT Custom Post Type - Breweries
*/
if (!class_exists('BCPT_CPT')):

    class BCPT_CPT
    {

        public static function createBreweriesPostType()
        {
            register_post_type( 'brewers',
                array(
                    'labels' => array(
                        'name' => __( 'Brewers' ),
                        'singular_name' => __( 'Brewery' )
                    ),
                    'public' => true,
                    'show_in_rest' => true,
                    'has_archive' => true,
                    'rewrite' => array('slug' => 'brewers'),
                    'supports' => array('title', 'editor', 'custom-fields')
                )
            );
        }

        public static function createPost()
        {
            global $wpdb;

            $data = $_POST['data'];
            $sql = 'SELECT * FROM ' . $wpdb->prefix . 'posts WHERE post_type = "brewers"';
            $results = $wpdb->get_results($sql, ARRAY_N);
            $response = '';

            if(!post_type_exists('brewers')):
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                exit();
            endif;

            if (empty($results)) :
                $response = self::addNewBreweryPost($data);
            else:
                $uniquePosts = self::updateBreweryPost($data);
                $response = self::addNewBreweryPost($uniquePosts);
            endif;

            echo json_encode($response);

            die();
        }

        private static function addNewBreweryPost($data = NULL)
        {
            if ($data == NULL) :
                return 'empty dataset';
                exit();
            endif;

            for ($i = 0; $i < count($data); $i++) {

                $postArr = array(
                    'post_title' => $data[$i]['name'],
                    'post_name' => $data[$i]['id'],
                    'post_content' => '',
                    'post_type' => 'brewers',
                    'post_status' => 'publish'
                );

                $postId = wp_insert_post($postArr);

                if ($postId !== NULL) :
                    self::updatePostMeta($postId, 'bcpt_brewery_address_2', $data[$i]['address_2']);
                    self::updatePostMeta($postId, 'bcpt_brewery_address_3', $data[$i]['address_3']);
                    self::updatePostMeta($postId, 'bcpt_brewery_type', $data[$i]['brewery_type']);
                    self::updatePostMeta($postId, 'bcpt_brewery_city', $data[$i]['city']);
                    self::updatePostMeta($postId, 'bcpt_brewery_country', $data[$i]['country']);
                    self::updatePostMeta($postId, 'bcpt_brewery_county_province', $data[$i]['county_province']);
                    self::updatePostMeta($postId, 'bcpt_brewery_created_at', $data[$i]['created_at']);
                    self::updatePostMeta($postId, 'bcpt_brewery_lat', $data[$i]['latitude']);
                    self::updatePostMeta($postId, 'bcpt_brewery_long', $data[$i]['longitude']);
                    self::updatePostMeta($postId, 'bcpt_brewery_phone', $data[$i]['phone']);
                    self::updatePostMeta($postId, 'bcpt_brewery_postal_code', $data[$i]['postal_code']);
                    self::updatePostMeta($postId, 'bcpt_brewery_state', $data[$i]['state']);
                    self::updatePostMeta($postId, 'bcpt_brewery_street', $data[$i]['street']);
                    self::updatePostMeta($postId, 'bcpt_brewery_updated_at', $data[$i]['updated_at']);
                    self::updatePostMeta($postId, 'bcpt_brewery_website_url', $data[$i]['website_url']);
                endif;
            }

            return 'added';
        }

        private static function updateBreweryPost($data = NULL)
        {
            global $wpdb;
            $sql = 'SELECT * FROM ' . $wpdb->prefix . 'posts WHERE post_type = "brewers"';
            $results = $wpdb->get_results($sql, ARRAY_A);
            $uniquePosts = array();

            for ($i = 0; $i < count($data); $i++) {

                if (
                    (array_search($data[$i]['id'], array_column($results, 'post_name')) === false)
                ) :
                    $uniquePosts[] = $data[$i];
                endif;

            }

            return $uniquePosts;
        }

        private static function updatePostMeta($post_id, $field_name, $value = '')
        {
            if ( empty($value) OR !$value ) :
                delete_post_meta($post_id, $field_name);
            elseif ( !get_post_meta($post_id, $field_name) ) :
                add_post_meta( $post_id, $field_name, $value );
            else:
                update_post_meta( $post_id, $field_name, $value );
            endif;
        }
    }
endif;
?>
