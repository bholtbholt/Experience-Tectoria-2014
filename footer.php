<?php $contactID = get_page_by_title('Contact')->ID;
			$contactAddress = get_post_meta( $contactID, 'address', true ); ?>

<footer id="main-footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<img src="<?php bloginfo('template_url'); ?>/images/icons/experience-tectoria-reverse-logo.svg" class="img-responsive experience-tectoria-reverse-logo">
			</div>
			<div class="col-sm-4">
        <p><?php echo $contactAddress ?></p>
 				<p class="social-icons"><?php echo social_icons_row($contactID) ?></p>
        <p>Powered by <a href="http://www.viatec.ca/" target="_blank">Viatec</a> <br>&copy; <?php echo date("Y") ?> All rights reserved</p>
      	<p>Design by <a href="https://www.behance.net/fusioncreative" target="_blank">Annika Lavinge</a> & <a href="http://www.brianholt.ca" target="_blank">Brian Holt</a><br>Development by <a href="http://www.brianholt.ca" target="_blank">Brian Holt</a></p>
			</div> <!-- close col-sm-4-->
			<div class="col-sm-3 col-sm-offset-1 moon-parallax">
				<img id="moon-rise" src="<?php bloginfo('template_url'); ?>/images/icons/planet.svg" class="hidden-xs animate-planet">
			</div>
		</div><!-- close row -->
	</div><!--close .container-->
</footer>

<?php wp_footer(); ?>
</body>
</html>