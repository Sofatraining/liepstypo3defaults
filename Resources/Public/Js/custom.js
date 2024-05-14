// LIEPS Console
console.log(
  '%c Wieder eine schöne Typo3-Webseite von der LIEPS Werbeagentur - www.lieps.de',
  `font-size: 17px;
  color: #ff8172;
  font-weight: 900;`
);

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
