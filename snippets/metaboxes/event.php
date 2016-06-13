<?php $date = esc_html( get_post_meta( $post->ID, 'date', true ) );
			$start_time = esc_html( get_post_meta( $post->ID, 'start_time', true ) );
			$end_time = esc_html( get_post_meta( $post->ID, 'end_time', true ) );
			$contactAddress = 'Fort Tectoria: 777 Fort Street, Victoria, BC';
			$location = esc_html( get_post_meta( $post->ID, 'location', true ) );
			$ticket_link = esc_html( get_post_meta( $post->ID, 'ticket_link', true ) );
			$pass_type = esc_html( get_post_meta( $post->ID, 'pass_type', true ) ); ?>

<input type="hidden" name="hidden_flag" value="true" />
<div class="row">
	<div class="column">
		<p class="meta-box-title">Date:</p>
		<input type="date" name="date" class="meta-box-input width-99" value="<?php echo $date? $date : date("m/d/Y"); ?>"/>
	</div>
	<div class="column">
		<p class="meta-box-title">Start Time:</p>
		<input type="time" name="start_time" class="meta-box-input width-99" value="<?php echo $start_time? $start_time : date("g:i"); ?>"/>
	</div>
	<div class="column">
		<p class="meta-box-title">End Time:</p>
		<input type="time" name="end_time" class="meta-box-input width-99" value="<?php echo $end_time? $end_time : date("g:i"); ?>"/>
	</div>
	<div class="clearfix"></div>
</div>
<div class="row">
	<div class="column">
		<p class="meta-box-title">Location:</p>
		<input type="text" class="meta-box-input full-width" name="location" value="<?php echo ($location == '0') ? $contactAddress : $location; ?>" />
	</div>
	<div class="column">
		<p class="meta-box-title">Ticket Link:</p>
		<input type="text" class="meta-box-input full-width" name="ticket_link" value="<?php echo ($ticket_link == '0') ? 'http://experiencetectoria2014.eventbrite.ca' : $ticket_link; ?>" />
	</div>
	<div class="column">
		<p class="meta-box-title">Pass Type:</p>
		<div class="radio-group">
		  <label><input type="radio" <?php if ($pass_type=="general" || $pass_type=="0") {echo "checked ";}?>name="pass_type" value="general">General</label>
		  <label><input type="radio"  <?php if ($pass_type=="VIP") {echo "checked ";}?>name="pass_type" value="VIP">VIP</label>
	  </div>
	</div>
	<div class="clearfix"></div>
</div>

<p class="meta-box-title">Details:</p>
<textarea class="meta-box-textarea" name="content" id="content"><?php echo $post->post_content; ?></textarea>