    $(function() {
      var bodyId = $('body').attr('id'),
          $stoerer = $('.stoerer');
      if (bodyId && $stoerer.length) {
        var cookieName = 'stoererClosed_' + bodyId;
        var lastClosed = parseInt(Cookies.get(cookieName) || 0, 10);
        if (!lastClosed || (Date.now() - lastClosed) > 10 * 60 * 1000) {
          $stoerer.show();
        } else {
          $stoerer.hide();
        }
        $('.stoerer-closer').on('click', function() {
          Cookies.set(cookieName, Date.now());
          $stoerer.hide();
        });
      }
    });