// LIEPS Console
console.log(
  '%c Wieder eine schöne Typo3-Webseite von der LIEPS Werbeagentur - www.lieps.de',
  `font-size: 17px;
  color: #ff8172;
  font-weight: 900;`
);

// Magnific Popup
$(function () {
  $('body').magnificPopup({
    delegate: 'a.mfp-link',
    type: 'image',
    gallery: { enabled: true },
    callbacks: {
      elementParse: function (item) {
        var $el = item.el;
        var href = $el.attr('href') || '';
        var dataType = $el.attr('data-type');

        if (
          dataType === 'iframe' ||
          /youtube\.com|youtu\.be|youtube-nocookie\.com|vimeo\.com/i.test(href)
        ) {
          item.type = 'iframe';
        } else {
          item.type = 'image';
        }
      }
    },
    image: {
      titleSrc: function (item) {
        // zuerst Titel aus <img>, fallback auf <a title="">
        return (
          item.el.find('img').attr('title') ||
          item.el.attr('title') ||
          ''
        );
      }
    },
    iframe: {
      patterns: {
        youtube: {
          index: 'youtube.com/',
          id: function (url) {
            var m = url.match(/[?&]v=([^?&]+)/);
            return m && m[1] ? m[1] : null;
          },
          src: 'https://www.youtube-nocookie.com/embed/%id%?autoplay=1&rel=0'
        },
        youtu_be: {
          index: 'youtu.be/',
          id: function (url) {
            var m = url.match(/youtu\.be\/([^?&/]+)/);
            return m && m[1] ? m[1] : null;
          },
          src: 'https://www.youtube-nocookie.com/embed/%id%?autoplay=1&rel=0'
        }
      }
    }
  });
});
