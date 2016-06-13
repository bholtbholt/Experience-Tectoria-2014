jQuery(document).ready(function($) {
	// Mailto Anti Spam logic
	// Use: <a class="mailto" data-domain="youneeq.ca" data-prefix="info" ></a>
  $('.mailto').each(function() {
      prefix = $(this).data('prefix');
      domain = $(this).data('domain');
      text = $(this).data('text') ? $(this).data('text') : prefix+'@'+domain;
      $(this).attr('href', 'mailto:'+prefix+'@'+domain).append(text);
  });

  // Make Home Navigation links send users to
  // the right spot when navigation from another page
  $('.slide-menu a').each(function() {
    link = $(this).attr('title');
    href = $(this).attr('href');
    $(this).attr('href', href+'#'+link);
  })

  // Auto Scrolling Function
  function autoScrollTo(link) {
    $('body,html').animate({scrollTop: $(link).position().top}, 800);
  }

  // Scrolls to button
  // use: <button class="scoll-button" data-scroll="main-footer">CLick</button>
  $('.scroll-button').click(function(event) {
  	link = '#'+$(this).data('scroll');
  	autoScrollTo(link);
  });

  // Scrolls to the article from the menu
  $('.slide-menu a').click(function(event) {
		link = '#'+$(this).attr('title');
		if ($(link).length) {
	  	event.preventDefault();
  	 	autoScrollTo(link);
  	}
  });

  // Scroll to top button
  $('.scroll-to-top').click(function(event) {
    autoScrollTo('body,html');
  });


  
  if ($(window).width() > 768) {
    // Define Parallax Objects
    if ($('#moon-rise').length) {
      moonTop = $('#moon-rise').offset().top-$( window ).height()+$('#main-footer').height();
    }
    if ($('.rocket').length) {
      rocketTop = $('.rocket').offset().top;
    }
    if ($('.robot-planet').length) {
      RPContainer = $('.robot-planet').closest('article').attr('ID');
      RPOffsetTop = $('#'+RPContainer).offset().top-600;
      RPOffsetBottom = $('#'+RPContainer).offset().top+$('#'+RPContainer).height()-400;
    }

    // Scroll Effects
    $(window).scroll(function () {
      // Parallax Effect
      scroll = $(this).scrollTop();

      if ($('.rocket').length) {
        thrustBoost = Math.min(Math.max(scroll/20,2),15);
        $('.thrust').css({transform: 'scaleY('+thrustBoost+')'});
        $('.rocket').css({'top': rocketTop-(scroll) + "px"});
      }
      if ($('#moon-rise').length) {
        moonRise = Math.max(moonTop-scroll, 1);
        $('#moon-rise').css({'top': moonRise + "px"});
      }

      if ($('.robot-planet').length) {
        RPEnlarge = Math.max(Math.min(scroll/2500,1.4),.2);
        $('.robot-planet').css({transform: 'scale('+RPEnlarge+')'});
      }

      // Make Scroll to top button visible
      if ($('.scroll-to-top').length) {
        if (scroll > 1000) {
          $('.scroll-to-top').animate({bottom:40}, 400);
        }
      }

    });
  }

	//Ajax contact form
	$(function() {
		var form = $('#ContactForm');
		var formMessages = $('#form-messages');

		$(form).submit(function(event) {
			event.preventDefault();
			var formData = $(form).serialize();

			$.ajax({  
				type: "POST",
				data: formData,
				url: et_scripts_vars.template_path + '/snippets/forms/contactForm.php'				
			}).done(function(response) {
		    // Set the message text.
		    $(formMessages).show().text(response);

		    // Clear the form.
        formIDS = ['name', 'email', 'subject', 'message'];
        for (id in formIDS) {
          $('#'+formIDS[id]).val('');
        }
		    $(formMessages).delay(2500).fadeOut();
			}).fail(function(data) {
		    // Set the message text.
		    if (data.responseText !== '') {
	        $(formMessages).text(data.responseText);
		    } else {
	        $(formMessages).text('Oops! An error occurred and your message could not be sent.');
		    }
			})
		});
	})
});