// Sink the rocket
if ($('#rocket').length) {
  setInterval(function(){
    if (isScrolledIntoView('#rocket', '#main-footer')) {
      if ($('#rocket').position().top+400 < $(window).height()) {
        $('#rocket').stop().animate({top:'+=32'}, 2000);
      }
    }
  }, 2000);
}

// Power the Rocket - animate up
$('#rocket').click(function(event) {
  posX = event.pageX - $(this).offset().left;
  leftValue = posX > 40 ? '-=8' : '+=8';
  $(this).stop().animate({top:'-=32', left:leftValue})
});

// Check if item is in view
function isScrolledIntoView(elem, stop) {
  docViewTop = $(window).scrollTop();
  docViewBottom = docViewTop + $(window).height();

  elemTop = $(elem).offset().top;
  elemBottom = elemTop + $(elem).height();

  stopTop = $(stop).offset().top;

  return ((elemBottom <= docViewBottom) && (elemBottom <= stopTop));
}

/*#rocket {
  cursor: pointer;
  width: 154px;
  height: 392px;
  position: absolute;
  top: 0;
  left: 0;
  -webkit-animation-name: bob;
  -webkit-animation-duration: 1000ms;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  -webkit-animation-direction: alternate;
  -moz-animation-name: bob;
  -moz-animation-duration: 1000ms;
  -moz-animation-iteration-count: infinite;
  -moz-animation-timing-function: linear;
  -moz-animation-direction: alternate;
  -ms-animation-name: bob;
  -ms-animation-duration: 1000ms;
  -ms-animation-iteration-count: infinite;
  -ms-animation-timing-function: linear;
  -ms-animation-direction: alternate;
  -o-transition: rotate(360deg);
  -webkit-transform-origin:center center;
  -ms-transform-origin:center center;  
  transform-origin:center center;
}
#rocket:before, #rocket:after {
  content: '';
  height: 222px;
  width: 77px;
  position: absolute;
  top: 0;
}
#rocket:before {left: 0}
#rocket:after {left: 77px}
.rocket {fill:#777}*/