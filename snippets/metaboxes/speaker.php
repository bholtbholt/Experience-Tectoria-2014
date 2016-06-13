<?php $position = esc_html( get_post_meta( $post->ID, 'position', true ) );
			$website = esc_html( get_post_meta( $post->ID, 'website', true ) ); ?>

<input type="hidden" name="hidden_flag" value="true" />
<p class="meta-box-title">Biography:</p>
<textarea class="meta-box-textarea" name="content" id="content"><?php echo $post->post_content; ?></textarea>
<div class="column">
	<p class="meta-box-title">Speaker's Position/Title:</p>
	<input type="text" class="meta-box-input full-width" name="position" value="<?php echo $position; ?>" />
</div>
<div class="column">
	<p class="meta-box-title">Speaker's Website:</p>
	<input type="text" class="meta-box-input full-width" name="website" value="<?php echo $website; ?>" />
</div>
<div style="clear:both"></div>