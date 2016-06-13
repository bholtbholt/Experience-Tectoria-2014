<?php $events = array( 'post_type' => 'events', 'posts_per_page' => -1, 'orderby' => 'meta_value', 'meta_key' => 'date', 'order' => 'ASC' );
			$events_loop = new WP_Query( $events ); ?>

<div class="row">
	<div id="event-date-list-div" class="event-date-list text-justify" role="event-date-list">

<?php $tabCount=0; $event_dates=array(); while ( $events_loop->have_posts() ) : $events_loop->the_post();
			$date = esc_html( get_post_meta( get_the_ID(), 'date', true ) );
			// Make tabs for each day only once
			if (!in_array($date, $event_dates)) :
				$tabCount++; $event_dates[]=$date; ?>
					<button href="#<?php echo date('M-j', strtotime($date)); ?>" data-toggle="tab" class="btn btn-primary btn-lg">
						<span><?php echo date("l", strtotime($date)) ?></span><span><?php echo date("F j, Y", strtotime($date)) ?></span>
					</button>
			<?php endif; ?>
<?php endwhile; ?>

	</div> <!-- close event-date-list -->
</div><!-- close row -->
<div class="tab-content">

<?php	$tabCount=0; $event_dates=array(); while ( $events_loop->have_posts() ) : $events_loop->the_post();
			$date = esc_html( get_post_meta( get_the_ID(), 'date', true ) );
			// Make tabs for each day only once
			if (!in_array($date, $event_dates)) :
				$tabCount++; $event_dates[]=$date; ?>
				<div class="tab-pane fade <?php echo $tabCount==1? 'in active' : ''; ?>" id="<?php echo date('M-j', strtotime($date)) ?>">
				<?php // Events that match the tab date are inserted into the tab
							$events_on_date = array( 'post_type' => 'events', 'posts_per_page' => -1, 'orderby' => 'meta_value', 'meta_key' => 'start_time', 'order' => 'ASC', 'meta_query' => array( array('key' => 'date','value' => $date) ) );
								$events_on_date_loop = new WP_Query( $events_on_date );
								// Put each of the events in the tab and get the values
								while ( $events_on_date_loop->have_posts() ) : $events_on_date_loop->the_post();
									$PID = get_the_ID();
									$date = esc_html( get_post_meta( $PID, 'date', true ) );
									$start_time = esc_html( get_post_meta( $PID, 'start_time', true ) );
									$end_time = esc_html( get_post_meta( $PID, 'end_time', true ) );
									$DBlocation = get_post_meta( $PID, 'location', true );
									$location = explode(':', $DBlocation);
									$ticket_link = esc_html( get_post_meta( $PID, 'ticket_link', true ) );
									$pass_type = esc_html( get_post_meta( $PID, 'pass_type', true ) ); ?>

<div class="row event-row" >
			<div class="col-sm-5">
				<h2 class="giant-text caps"><?php echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'; ?></h2>
			</div>
			<div class="col-sm-7">
				<p class="lead">
					<?php	echo date("l, F j", strtotime($date)) . ' from ' . 
									str_replace(':00', '', date("g:i a", strtotime($start_time))) . ' &mdash; ' . 
									str_replace(':00', '', date("g:i a", strtotime($end_time))) . '<br>';
								echo strpos($DBlocation, ':') ? '<strong>'.$location[0].':</strong> '.$location[1] : $DBlocation;
					?>
				</p>
				<div class="hidden-xs"><?php the_content() ?></div>
			</div> <!-- close col-sm-7 -->
</div> <!-- close event-row -->

					<?php endwhile; wp_reset_postdata(); ?>
				</div><!-- end tab pane -->
			<?php endif; ?>
<?php endwhile; wp_reset_postdata(); ?>

</div><!-- end tab-content -->