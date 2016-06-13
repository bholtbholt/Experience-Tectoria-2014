<?php //Template Name: Page Tree Template
			get_header();
			if ( have_posts() ) while ( have_posts() ) : the_post();
			$templatePID = $post->ID;
			$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($templatePID)); ?>

		<article id="<?php the_slug(); ?>" class="page-article" <?php echo ($thumbnail) ? 'style="background: url('.$thumbnail.') center center no-repeat fixed; background-size: cover;"' : ''; ?>>
			<div class="container">
				<?php the_content(); ?>
			</div>
		</article>
<?php endwhile; ?>
<div class="scroll-to-top hidden-xs"><span class="glyphicon glyphicon-upload"></span></div>

<?php $page_query = query_posts(array(
				'post_parent' => $templatePID,
				'post__not_in' => array( $templatePID ),
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'page',
				'posts_per_page' => -1
			));
			if ( have_posts() ) while ( have_posts() ) : the_post();
			$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>

		<article id="<?php the_slug(); ?>" class="page-article" <?php echo ($thumbnail) ? 'style="background: url('.$thumbnail.') center center no-repeat fixed; background-size: cover;"' : ''; ?>>
			<div class="container">
					<?php the_content(); ?>
			</div> <!-- close container -->
		</article>

<?php endwhile; wp_reset_postdata(); ?>

<?php get_footer(); ?>