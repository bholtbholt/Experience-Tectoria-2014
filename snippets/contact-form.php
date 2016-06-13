<?php $contactEmail = get_post_meta( get_page_by_title('Contact')->ID, 'email', true );
			$siteTitle = get_bloginfo('name'); ?>

<form id="ContactForm" role="form" method="post">
	<div class="form-group">
		<label class="sr-only" for="name">Name</label>
		<input type="text" class="form-control" id="name" name="name" required placeholder="Name">
	</div>
	<div class="form-group">
		<label class="sr-only" for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" required placeholder="Email">
	</div>
	<div class="form-group">
		<label class="sr-only" for="subject">Subject</label>
		<input type="text" class="form-control" id="subject" name="subject" required placeholder="Subject">
	</div>
	<div class="form-group">
		<label class="sr-only" for="message">Message</label>
		<textarea class="form-control" rows="3" id="message" name="message" required placeholder="Message"></textarea>
	</div>
	<input type="hidden" name="site_title" value="<?php echo $siteTitle ?>">
	<input type="hidden" name="contact_email" value="<?php echo $contactEmail ?>">
	<div class="form-group">
		<button type="submit" id="submit" class="btn btn-primary">Send Your Message</button>
	</div>
	<div id="form-messages"></div>
</form>