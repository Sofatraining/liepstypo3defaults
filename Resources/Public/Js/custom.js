//This simple script handles the header nav menu modal
//also covered nav sub menu selection
//Dependencies: jQuery
$(document).ready(function() {
	$('.ham').click(function(){
		$('header').toggleClass('clicked');
	});

	$('nav ul li').click(function(){
		$('nav ul li').removeClass('selected');
		$('nav ul li').addClass('notselected');
		$(this).toggleClass('selected');
		$(this).removeClass('notselected');
	});	
});

// Magnific Popup
$(document).ready(function() {
	$('.image-link').magnificPopup({
		type:'image',
		gallery: {
			enabled: true
		},
		image: {
			titleSrc: function(item) {
				return item.el.find('img').attr('title');
			}
		}
	});
});
