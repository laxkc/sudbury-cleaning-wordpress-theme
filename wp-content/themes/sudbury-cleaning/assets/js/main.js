(function () {
  'use strict';

  var settings = window.SudburySettings || { debug: false, version: '' };
  var sudbury = {
    debug: !!settings.debug,
    version: settings.version || '',
    log: function (event, ctx) {
      if (!sudbury.debug) return;
      console.log('[sudbury]', { event: event, ctx: ctx, version: sudbury.version, time: new Date().toISOString() });
    },
    warn: function (event, ctx) {
      if (!sudbury.debug) return;
      console.warn('[sudbury]', { event: event, ctx: ctx, version: sudbury.version, time: new Date().toISOString() });
    },
    error: function (event, ctx) {
      if (!sudbury.debug) return;
      console.error('[sudbury]', { event: event, ctx: ctx, version: sudbury.version, time: new Date().toISOString() });
    }
  };
  window.sudbury = sudbury;
  sudbury.log('theme_loaded');

  // Mobile menu toggle
  var toggle = document.querySelector('.menu-toggle');
  var drawer = document.getElementById('mobile-drawer');

  if (toggle && drawer) {
    toggle.addEventListener('click', function () {
      var open = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!open));
      drawer.setAttribute('aria-hidden', String(open));
      document.body.style.overflow = open ? '' : 'hidden';
      sudbury.log('mobile_menu_toggled', { open: !open });
    });

    // Close drawer when a link inside is clicked
    drawer.addEventListener('click', function (e) {
      if (e.target.closest('a')) {
        toggle.setAttribute('aria-expanded', 'false');
        drawer.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }
    });

    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
        toggle.click();
        toggle.focus();
      }
    });
  } else if (document.querySelector('.site-header')) {
    sudbury.warn('mobile_menu_missing');
  }

  // FAQ accordion (data-faq toggles within .faq-list)
  var faqButtons = document.querySelectorAll('.faq-q');
  if (document.querySelector('.faq-list') && faqButtons.length === 0) {
    sudbury.warn('faq_buttons_missing');
  }
  faqButtons.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      var panelId = btn.getAttribute('aria-controls');
      var panel = panelId ? document.getElementById(panelId) : btn.nextElementSibling;
      btn.setAttribute('aria-expanded', String(!expanded));
      if (panel) {
        if (expanded) {
          panel.setAttribute('hidden', '');
        } else {
          panel.removeAttribute('hidden');
        }
      }
    });
  });
})();
