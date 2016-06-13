<?php get_header();
			if ( have_posts() ) while ( have_posts() ) : the_post();
			$position = esc_html( get_post_meta( $post->ID, 'position', true ) );
			$img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
			$photo = $img_url[0];
			$email = esc_html( get_post_meta( get_the_ID(), 'email', true ) );
			$website = esc_html( get_post_meta( get_the_ID(), 'website', true ) ); ?>

<div class="page-article speaker-single">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 text-center">
				<div class="speaker-photo-large the-speaker-effect orbit" style="background: url(<?php echo $photo ?>) center center no-repeat;">
					<?php if (rand(1,3)==2) { echo '<div class="orbit-2"></div>'; }
								if (rand(1,3)==3) { echo '<div class="orbit-2 orbit-3"></div>'; } ?>
				</div>
				<p class="social-icons">
						<?php if ($website) { echo '<a href="'.$website.'"><span class="glyphicon glyphicon-globe" title="'.$website.'"></span></a>'; }
									echo social_icons_row(get_the_ID()) ?>
				</p>
			</div>
			<div class="col-sm-7 col-sm-offset-1 speaker-details single-details">
				<h1 class="giant-text caps text-shadow"><?php the_title(); ?></h1>
				<h3 class="subheadline"><?php echo $position ?></h3>
				<div class="speaker-bio">
					<?php the_content() ?>
				</div>
<?php // Display event information pertaining to the speaker
			$connected = new WP_Query( array(
										  'connected_type' => 'Speakers and Events',
										  'connected_items' => get_queried_object(),
										  'nopaging' => true,
										) );
			if ( $connected->have_posts() ) :
				while ( $connected->have_posts() ) : $connected->the_post();
					$PID = get_the_ID();
					$date = esc_html( get_post_meta( $PID, 'date', true ) );
					$start_time = esc_html( get_post_meta( $PID, 'start_time', true ) );
					$end_time = esc_html( get_post_meta( $PID, 'end_time', true ) );
					$location = get_post_meta( $PID, 'location', true );
					$ticket_link = esc_html( get_post_meta( $PID, 'ticket_link', true ) );
					$pass_type = esc_html( get_post_meta( $PID, 'pass_type', true ) ); ?>

		<div class="row speaker-event-row">
			<div class="col-md-10 col-md-push-2">
				<a href="<?php the_permalink(); ?>"><h3 class="large-text caps heavy"><?php the_title() ?></h3></a>
				<p>
					<?php	echo date("l, F j", strtotime($date)) . ' from ' . 
									str_replace(':00', '', date("g:i a", strtotime($start_time))) . ' &mdash; ' . 
									str_replace(':00', '', date("g:i a", strtotime($end_time))) . '<br>' . 
									$location;
					?>
				</p>
				<?php the_content() ?>
			</div>
			<div class="col-md-2 col-md-pull-10 xs-text-center">
				<a href="<?php echo $ticket_link ?>" target="_blank" class="text-right">
					<?php echo ($pass_type == 'VIP') ? do_shortcode('[orange_rocket]') : do_shortcode('[green_rocket]') ; ?>Buy Pass
				</a>
			</div>
		</div><!-- close event-row --><?php endwhile; 
			wp_reset_postdata();
			endif;
			//finish event information ?>
			</div><!--close col-sm-7 -->
		</div><!--close row -->
	</div><!--close container -->
</div>

<?php endwhile; ?>
<?php get_footer(); ?>