<?php get_header(); ?>
    <div class="container bcpt">
        <div id="content" role="main">
            <div class="grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="grid-item">
                        <div class="post-container">
                            <h3><?=the_title();?></h3>
                            <div class="post-details">
                                <?php
                                    $address = (get_post_meta( get_the_ID(), 'bcpt_brewery_address_2', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_address_2', true ) . ', ' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_address_3', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_address_3', true ) . ', <br/>' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_street', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_street', true ). ', ' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_city', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_city', true ) . '<br/>' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_county_province', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_county_province', true )  . '<br/>' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_state', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_state', true ) . ', ' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_country', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_country', true ) . '<br/>' : '';
                                    $address .= (get_post_meta( get_the_ID(), 'bcpt_brewery_postal_code', true )) ? get_post_meta( get_the_ID(), 'bcpt_brewery_postal_code', true ) : '';
                                    $link = (get_post_meta( get_the_ID(), 'bcpt_brewery_website_url', true )) ? '<a href="' . get_post_meta( get_the_ID(), 'bcpt_brewery_website_url', true ) . '">Link</a>' : '';
                                ?>
                                <p>Address: <?=$address; ?></p>
                                <p>Contact: <?=get_post_meta( get_the_ID(), 'bcpt_brewery_phone', true )?></p>
                                <p>Website: <?=$link;?></p>
                                <p>Brewery Type: <?=get_post_meta( get_the_ID(), 'bcpt_brewery_type', true )?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; // end of the loop. ?>
            </div>

            <?php the_posts_pagination(); ?>

        </div><!-- #content -->
    </div><!-- #primary -->
<?php get_footer(); ?>
