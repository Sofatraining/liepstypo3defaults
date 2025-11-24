(function () {
    // Warte bis DOM bereit ist
    var ready = function (fn) {
    if (document.readyState !== 'loading') { fn(); }
    else { document.addEventListener('DOMContentLoaded', fn); }
    };

    var showModal = function (el) {
        // Bootstrap 5 API bevorzugt
        try {
            if (window.bootstrap && window.bootstrap.Modal) {
                var inst = window.bootstrap.Modal.getOrCreateInstance(el);
                inst.show();
                return;
            }
        } catch (e) {}
        // Fallback auf jQuery/Bootstrap 4
        try {
            if (window.jQuery && typeof jQuery(el).modal === 'function') {
                jQuery(el).modal('show');
                return;
            }
        } catch (e) {}
        // Simpler CSS-Fallback (falls kein Bootstrap vorhanden)
        el.classList.add('show');
        el.style.display = 'block';
        el.removeAttribute('aria-hidden');
    };

    ready(function () {
        var modals = document.querySelectorAll('.modal.auto-start');
        var cooldownMs = 5 * 60 * 1000; // 5 Minuten


        modals.forEach(function (modalEl) {
            var uid = modalEl.getAttribute('data-cb-modal-uid') || modalEl.id || 'cb-modal';
            var storageKey = 'modalClosed-' + uid;
            var now = Date.now();
            var last = 0;
            try { last = parseInt(localStorage.getItem(storageKey) || '0', 10); } catch (e) { last = 0; }


            if (!last || (now - last > cooldownMs)) {
                // Zeigen beim Laden
                showModal(modalEl);
            }

            // Timestamp beim Schließen setzen
            modalEl.addEventListener('hidden.bs.modal', function () {
                try { localStorage.setItem(storageKey, String(Date.now())); } catch (e) {}
            });
            // Fallback: auf Button mit data-bs-dismiss hören
            modalEl.addEventListener('click', function (ev) {
                var target = ev.target;
                if (target && target.getAttribute && target.getAttribute('data-bs-dismiss') === 'modal') {
                    try { localStorage.setItem(storageKey, String(Date.now())); } catch (e) {}
                }
            });
        });
    });
})();