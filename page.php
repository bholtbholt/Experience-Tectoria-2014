<?php get_header(); 
			if ( have_posts() ) while ( have_posts() ) : the_post();
			$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
		
<article class="page-article" <?php echo ($thumbnail) ? 'style="background: url('.$thumbnail.') center center no-repeat fixed; background-size: cover;"' : ''; ?>>
	<div class="container">
			<?php the_content(); ?>
	</div> <!-- close container -->
</article>

	<?php endwhile; ?>
<?php get_footer(); ?>