<?php get_header();
			if ( have_posts() ) while ( have_posts() ) : the_post();
				$PID = $post->ID;
				$date = esc_html( get_post_meta( $PID, 'date', true ) );
				$start_time = esc_html( get_post_meta( $PID, 'start_time', true ) );
				$end_time = esc_html( get_post_meta( $PID, 'end_time', true ) );
				$DBlocation = get_post_meta( $PID, 'location', true );
				$location = explode(':', $DBlocation);
				$ticket_link = esc_html( get_post_meta( $PID, 'ticket_link', true ) );
				$pass_type = esc_html( get_post_meta( $PID, 'pass_type', true ) ); ?>

<div class="page-article event-single" >
	<div class="container">
		<div class="row">
			<div class="col-sm-7 col-sm-push-5 event-details single-details">
				<h1 class="giant-text caps text-shadow orange"><?php the_title() ?></h1>
				<p class="lead">
					<?php	echo date("l, F j", strtotime($date)) . ' from ' . 
									str_replace(':00', '', date("g:i a", strtotime($start_time))) . ' &mdash; ' . 
									str_replace(':00', '', date("g:i a", strtotime($end_time))) . '<br>'; 
								echo strpos($DBlocation, ':') ? '<strong>'.$location[0].':</strong> '.$location[1] : $DBlocation;
					?>
				</p>	
				<?php the_content() ?>

				
	<?php // Show the connected speakers
			$connected = new WP_Query( array(
										  'connected_type' => 'Speakers and Events',
										  'connected_items' => get_queried_object(),
										  'nopaging' => true,
										) );
			if ( $connected->have_posts() ) :
				echo "<div class='row event-speakers-row'>";
				while ( $connected->have_posts() ) : $connected->the_post(); ?>

<?php	$position = esc_html( get_post_meta( get_the_ID(), 'position', true ) ); ?>
			<div class="col-md-4 col-sm-6">
				<div class="the-speaker text-center the-speaker-effect-trigger">
					<a href="<?php the_permalink() ?>" class="the-speaker-effect orbit">
						<?php if (rand(1,3)==2) { echo '<div class="orbit-2"></div>'; }
									if (rand(1,3)==3) { echo '<div class="orbit-2 orbit-3"></div>'; }
									the_post_thumbnail('thumbnail', array('class'=>"speaker-thumbnail")); ?>
					</a>
					<p class="speaker-name strong"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
				</div>
			</div>

<?php endwhile; wp_reset_postdata();
			echo '</div>'; //close event-speakers-row
			endif; //finish event information ?>

			</div><!-- close col-sm-7 -->
			<div class="col-sm-5 col-sm-pull-7">
				<a href="<?php echo $ticket_link ?>" class="<?php echo $pass_type ?>-pass" target="_blank">
					<div class="pass-row">
						<div class="row">
							<div class="col-xs-12 col-sm-5 col-md-4 xs-text-center rocket-icon">
								<?php echo ($pass_type == 'VIP') ? do_shortcode('[orange_rocket size="large"]') : do_shortcode('[green_rocket size="large"]') ; ?>
							</div>
							<div class="col-sm-7 col-md-8 xs-text-center">
								<h4>Buy Pass</h4>
								<p class="lead "><strong class="price">$49</strong> Full Access</p>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div><!-- close event-row -->
	</div><!--close container -->
</div>
<?php endwhile; ?>
<?php get_footer(); ?>