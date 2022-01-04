<?php
    get_header();

    echo '<div class="container bcpt">';

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();

        $address = (get_post_meta( get_the_ID(), 'bcpt_brewery_address_2', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_address_2', true ) . ', ' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_address_3', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_address_3', true ) . ', <br/>' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_street', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_street', true ). ', ' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_city', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_city', true ) . '<br/>' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_county_province', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_county_province', true )  . '<br/>' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_state', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_state', true ) . ', ' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_country', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_country', true ) . '<br/>' : '';
        $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_postal_code', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_postal_code', true ) : '';
        $link = (get_post_meta( get_the_ID(), 'bcpt_brewery_website_url', true )) ? '<a href="' . get_post_meta( get_the_ID(), 'bcpt_brewery_website_url', true ) . '">Link</a>' : '';

        $uTime = get_the_time('U');
        $uModifiedTime = get_the_modified_time('U');
        $updatedDateTime = 'Not yet updated';

        if ($uModifiedTime >= $uTime + 86400) {
            $updatedDate = get_the_modified_time('F jS, Y');
            $updatedTime = get_the_modified_time('h:i a');
            $updatedDateTime = '<p class="last-updated">Last updated on '. $updatedDate . ' at '. $updatedTime .'</p>';
        }
?>
            <div class="single">
                <h3><?=get_the_title();?></h3>
                <table>
                    <tr>
                        <th>Address</th>
                        <td><?=$address;?></td>
                    </tr>
                    <tr>
                        <th>Website</th>
                        <td><?=$link;?></td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td><?=get_post_meta( get_the_ID(), 'bcpt_brewery_phone', true )?></td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <td><?=get_post_meta( get_the_ID(), 'bcpt_brewery_long', true )?></td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <td><?=get_post_meta( get_the_ID(), 'bcpt_brewery_lat', true )?></td>
                    </tr>
                    <tr>
                        <th>Brewery Type</th>
                        <td><?=get_post_meta( get_the_ID(), 'bcpt_brewery_phone', true )?></td>
                    </tr>
                    <tr>
                        <th>Created at</th>
                        <td><?=get_post_meta( get_the_ID(), 'bcpt_brewery_created_at', true )?></td>
                    </tr>
                    <tr>
                        <th>Updated at</th>
                        <td><?=$updatedDateTime;?></td>
                    </tr>
                </table>
            </div>
<?php
        endwhile;
    else :
        _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif;

    echo '</div>';
    get_footer();
?>
