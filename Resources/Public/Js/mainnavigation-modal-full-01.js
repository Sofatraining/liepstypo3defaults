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
