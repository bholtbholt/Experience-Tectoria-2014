<?php get_header();
			$thumbnail = wp_get_attachment_url(get_post_thumbnail_id(get_page_by_title('Speakers')->ID)); ?>
			
<div class="page-article" <?php echo ($thumbnail) ? 'style="background: url('.$thumbnail.') center center no-repeat fixed; background-size: cover;"' : ''; ?>>
	<div class="container">
	<?php echo do_shortcode('[get_the_speakers]') ?>
	</div>
</div>
<?php get_footer(); ?>