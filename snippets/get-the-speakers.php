<?php $speakers = array( 'post_type' => 'speakers', 'posts_per_page' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC' );
			$speakers_loop = new WP_Query( $speakers ); 
			while ( $speakers_loop->have_posts() ) : $speakers_loop->the_post();
				$position = esc_html( get_post_meta( get_the_ID(), 'position', true ) );
				$website = esc_html( get_post_meta( get_the_ID(), 'website', true ) ); ?>
			<div class="col-sm-3">
				<div class="the-speaker text-center the-speaker-effect-trigger">
					<a href="<?php the_permalink() ?>" class="the-speaker-effect orbit">
						<?php if (rand(1,3)==2) { echo '<div class="orbit-2"></div>'; }
									if (rand(1,3)==3) { echo '<div class="orbit-2 orbit-3"></div>'; }
									the_post_thumbnail('thumbnail', array('class'=>"speaker-thumbnail")); ?>
					</a>
					<p class="speaker-name strong"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
					<?/*<p class="speaker-position"><?php echo $position ?></p>*/?>
					<p class="social-icons">
						<?php if ($website) { echo '<a href="'.$website.'"><span class="glyphicon glyphicon-globe" title="'.$website.'"></span></a>'; }
									echo social_icons_row(get_the_ID()) ?>
					</p>
				</div>
			</div>

<?php endwhile; wp_reset_postdata(); ?>