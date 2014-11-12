<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div class="row site-content">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php 
					//get_template_part( 'content', get_post_format() );
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                    <div class="featured-post">
                        <?php _e( 'Featured post', 'twentytwelve' ); ?>
                    </div>
                    <?php endif; ?>
                    <header class="entry-header">
                        
                        <?php if ( is_single() ) : ?>
                        <h2 class="entry-title"><?php the_title(); ?></h1>
                        <?php else : ?>
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                        <?php endif; // is_single() ?>
                        
                    </header><!-- .entry-header -->
            
                    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->
                    <?php else : ?>
                    <div class="entry-content">
                        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
                    <?php endif; ?>
            
                </article><!-- #post -->

			<?php endwhile; ?>


		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

	</div><!-- .row -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>