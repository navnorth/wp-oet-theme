<?php
/**
 * Template Name: Blog Index
 */
?>
<?php
    get_header();
    $page_id = get_the_ID();
?>

<div class="row">
    <div class="col-md-9 col-sm-12 col-xs-12 padding_left tlkt_stp_cntnr_lft_sid">

        <h1 class="entry-title"><?php the_title(); ?></h1>

        <?php // start with the top content for the page
            while ( have_posts() ) : the_post();
                get_template_part( 'content', 'page' );
            endwhile;
        ?>

        <hr />

        <?php /* Loop over all the blog posts */
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts( array( 'posts_per_page' => 10, 'post_status' => 'publish', 'paged' => $paged ) );

            while( have_posts() ): the_post();
                get_template_part( 'content', get_post_format() );
            endwhile;

            twentytwelve_content_nav( 'nav-below' );
        ?>

    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 pblctn_right_sid_mtr">
        <?php echo oer_dynamic_sidebar('blog-index-template', $page_id);?>
    </div>
</div>
<?php get_footer();?>
