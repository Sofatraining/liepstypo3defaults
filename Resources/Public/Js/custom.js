// LIEPS Console
console.log(
  '%c Wieder eine schöne Typo3-Webseite von der LIEPS Werbeagentur - www.lieps.de',
  `font-size: 17px;
  color: #ff8172;
  font-weight: 900;`
);

/* Magnific Popup START */
(function ($) {
  'use strict';

  function getBestSource($link) {
    var href = ($link.attr('href') || '').trim();
    var dataMfpSrc = ($link.attr('data-mfp-src') || '').trim();
    var dataSrc = ($link.attr('data-src') || '').trim();

    var $img = $link.find('img').first();
    var imgCurrentSrc = ($img.prop('currentSrc') || '').trim();
    var imgSrc = ($img.attr('src') || '').trim();
    var imgDataSrc = ($img.attr('data-src') || '').trim();
    var imgLazySrc = ($img.attr('data-lazy-src') || '').trim();
    var imgOrigSrc = ($img.attr('data-original') || '').trim();

    return (
      dataMfpSrc ||
      href ||
      dataSrc ||
      imgCurrentSrc ||
      imgSrc ||
      imgDataSrc ||
      imgLazySrc ||
      imgOrigSrc ||
      ''
    );
  }

  function isVideoUrl(url, dataType) {
    if (dataType === 'iframe' || dataType === 'video') {
      return true;
    }

    return /(?:youtube\.com|youtu\.be|youtube-nocookie\.com|vimeo\.com|player\.vimeo\.com)/i.test(url);
  }

  function extractYouTubeId(url) {
    var match =
      url.match(/[?&]v=([^?&]+)/i) ||
      url.match(/youtu\.be\/([^?&/]+)/i) ||
      url.match(/youtube\.com\/embed\/([^?&/]+)/i) ||
      url.match(/youtube\.com\/shorts\/([^?&/]+)/i) ||
      url.match(/youtube-nocookie\.com\/embed\/([^?&/]+)/i);

    return match && match[1] ? match[1] : null;
  }

  function extractVimeoId(url) {
    var match =
      url.match(/vimeo\.com\/(?:video\/)?(\d+)/i) ||
      url.match(/player\.vimeo\.com\/video\/(\d+)/i);

    return match && match[1] ? match[1] : null;
  }

  function isImageUrl(url) {
    return /\.(jpg|jpeg|png|gif|webp|avif|svg)(\?.*)?$/i.test(url);
  }

  function initMagnific() {
    var $root = $('body');

    // vorhandene Initialisierung sauber entfernen, damit es nicht zu Doppelbindungen kommt
    if ($root.data('magnificPopup')) {
      $root.magnificPopup('destroy');
    }

    $root.magnificPopup({
      delegate: 'a.image-link',
      type: 'image',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1],
        tCounter: '%curr% / %total%'
      },
      closeOnContentClick: false,
      closeBtnInside: false,
      removalDelay: 160,
      mainClass: 'mfp-fade',
      callbacks: {
        elementParse: function (item) {
          var $el = item.el;
          var src = getBestSource($el);
          var dataType = ($el.attr('data-type') || '').toLowerCase();

          if (!src) {
            item.type = 'inline';
            item.src = '<div class="mfp-error">Kein Medium gefunden.</div>';
            return;
          }

          item.src = src;

          if (isVideoUrl(src, dataType)) {
            item.type = 'iframe';
            return;
          }

          if (dataType === 'image' || isImageUrl(src)) {
            item.type = 'image';
            return;
          }

          // Fallback:
          // Wenn kein Video erkannt wurde, aber auch keine klassische Bildendung vorhanden ist,
          // trotzdem als Bild probieren – viele CMS liefern Bilder ohne Endung oder mit Parametern.
          item.type = 'image';
        },
        open: function () {
          $('html').addClass('mfp-is-open');
        },
        close: function () {
          $('html').removeClass('mfp-is-open');
        }
      },
      image: {
        verticalFit: true,
        titleSrc: function (item) {
          var $el = item.el;
          var $img = $el.find('img').first();

          return (
            $img.attr('title') ||
            $img.attr('alt') ||
            $el.attr('title') ||
            $el.attr('data-title') ||
            ''
          );
        }
      },
      iframe: {
        markup:
          '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>' +
          '</div>',
        patterns: {
          youtube: {
            index: 'youtube.com',
            id: function (url) {
              return extractYouTubeId(url);
            },
            src: 'https://www.youtube-nocookie.com/embed/%id%?autoplay=1&rel=0'
          },
          youtu_be: {
            index: 'youtu.be/',
            id: function (url) {
              return extractYouTubeId(url);
            },
            src: 'https://www.youtube-nocookie.com/embed/%id%?autoplay=1&rel=0'
          },
          youtube_nocookie: {
            index: 'youtube-nocookie.com/',
            id: function (url) {
              return extractYouTubeId(url);
            },
            src: 'https://www.youtube-nocookie.com/embed/%id%?autoplay=1&rel=0'
          },
          vimeo: {
            index: 'vimeo.com/',
            id: function (url) {
              return extractVimeoId(url);
            },
            src: 'https://player.vimeo.com/video/%id%?autoplay=1'
          },
          vimeo_player: {
            index: 'player.vimeo.com/video/',
            id: function (url) {
              return extractVimeoId(url);
            },
            src: 'https://player.vimeo.com/video/%id%?autoplay=1'
          }
        }
      }
    });
  }

  $(document).ready(function () {
    initMagnific();
  });

  // optional: bei dynamisch nachgeladenem Content erneut initialisieren
  $(document).on('ajaxComplete', function () {
    initMagnific();
  });

})(jQuery);
/* Magnific Popup STOP */
