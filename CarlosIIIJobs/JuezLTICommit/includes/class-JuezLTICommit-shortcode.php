<?php

class JuezLTICommit_shortcode
{

    public function JuezLTICommit_shortcode_init()
    {
        function JuezLTICommit_shortcode($atts, $content = null)
        {

            $numeroOfertas = get_option('JuezLTICommit_options_nOfertas');

            if (!($numeroOfertas)) {
                $numeroOfertas = 5;
            }

            $atts = shortcode_atts( array(
                'n_ofertas' => $numeroOfertas,
            ), $atts );

            $query = new WP_Query( array( 'post_type' => 'commit' , 'posts_per_page' => $atts['n_ofertas']) );
            ob_start();
            if ( $query->have_posts() ) : ?>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div>
                        <a target="_blank" href="<?php echo @get_post_meta(get_the_ID(), 'url_commit', true) ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <!-- show pagination here -->
            <?php else : ?>
                <!-- show 404 error here -->
            <?php endif; ?>
<?php
            $content = ob_get_contents ();
            ob_end_clean();
            return $content;
        }
        add_shortcode('JuezLTICommit', 'JuezLTICommit_shortcode');
    }

}