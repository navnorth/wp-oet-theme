<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
$results = array();
?>

	<div id="content" class="row site-content">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header>

			<?php while ( have_posts() ) : the_post();
				if (get_post_type() == 'stories' && function_exists('get_story_template_part')) { 
					$results[] = array('typeId'=>4,'type'=>'stories','post'=>$post);
				} else {
					$id = get_the_ID();
					$template = get_page_template_slug($id);
					
					switch ($template){
						case "page-templates/resource-template.php":
							$results[] = array('typeId'=>3,'type'=>'resources','post'=>$post);
							break;
						case "page-templates/publication-subsection-template.php":
						case "page-templates/publication-template.php":
							$results[] = array('typeId'=>1,'type'=>'publications','post'=>$post);
							break;
						case "page-templates/initiative-template.php":
							$results[] = array('typeId'=>2,'type'=>'initiatives','post'=>$post);
							break;
						default:
							$results[] = array('typeId'=>5,'type'=>'other results','post'=>$post);
							break;
					}
				}
			endwhile;
			asort($results);
			
			$current_content_type = "";
			foreach($results as $result) {
				if ($current_content_type!==$result['type']){
					echo "<h2 class='content-type-heading'>".ucwords($result['type'])."</h2>";
					$current_content_type = $result['type'];
				}
				if ($result['type']=="stories") {
					include( locate_template( 'content-search.php', false, false ) ); 
				} else {
					$post_id = $result['post']->ID;
					$full_width = true;
					?>
					<article id="post-<?php echo $post_id; ?>" <?php post_class('', $post_id); ?>>
						<div class="entry-content">
						<?php
						if (has_post_thumbnail($post_id)) {
							$thumbnail = get_the_post_thumbnail($post_id, 'search-thumbnail', array( 'class' => 'alignleft' ));
							echo '<div class="col-md-3 col-sm-6 col-xs-12 search-thumbnail">'.$thumbnail.'</div>';
							$full_width = false;
						}
						?>
						<div class="<?php if ($full_width==true): ?>col-md-12 col-sm-12<?php else: ?>col-md-9 col-sm-6<?php endif; ?> col-xs-12 search-result-content">
							<header class="search-header">
							<?php if ( is_single() ) : ?>
							    <h3 class="entry-title"><?php  echo get_the_title($post_id); ?></h3>
							<?php else : ?>
							    <h3 class="entry-title">
								<a href="<?php echo get_the_permalink($post_id); ?>" rel="bookmark"><?php echo get_the_title($post_id); ?></a>
							    </h3>
							<?php endif; // is_single() ?>
							</header><!-- .entry-header -->
			    
							<?php if ( is_search() ) : // Only display Excerpts for Search ?>
							<div class="search-summary">
							    <?php echo get_the_excerpt($post_id); ?>
							</div><!-- .entry-summary -->
							<?php else : ?>
							<div class="search-content">
							    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
							    <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->
							<?php endif; ?>
							</div>
						</div>
					</article><!-- #post -->
					<?php
				}
			}
			?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found col-md-12">
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
