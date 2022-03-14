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
