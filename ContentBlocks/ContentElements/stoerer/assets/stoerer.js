(function () {
    var ready = function (fn) {
        if (document.readyState !== 'loading') {
            fn();
        } else {
            document.addEventListener('DOMContentLoaded', fn);
        }
    };

    ready(function () {
        var stoererEl = document.querySelector('.stoerer');
        if (!stoererEl) return;

        var body = document.body;
        var bodyId = body.id || 'default';
        var uid = stoererEl.getAttribute('data-uid') || 'default';
        var storageKey = 'stoererClosed_' + uid + '_' + bodyId;
        var cooldownMs = 10 * 60 * 1000; // 10 Minuten

        var now = Date.now();
        var lastClosed = 0;
        try {
            lastClosed = parseInt(localStorage.getItem(storageKey) || '0', 10);
        } catch (e) {
            lastClosed = 0;
        }

        if (!lastClosed || (now - lastClosed > cooldownMs)) {
            stoererEl.style.display = 'block';
        }

        var closer = stoererEl.querySelector('.stoerer-closer');
        if (closer) {
            closer.addEventListener('click', function () {
                try {
                    localStorage.setItem(storageKey, String(Date.now()));
                } catch (e) {}
                stoererEl.style.display = 'none';
            });
        }
    });
})();
