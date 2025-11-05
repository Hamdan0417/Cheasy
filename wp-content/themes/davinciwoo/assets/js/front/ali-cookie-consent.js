(function () {
    'use strict';

    var storageKey = 'davinciwoo-cookie-consent';

    var onReady = function (cb) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', cb);
        } else {
            cb();
        }
    };

    var showBanner = function (banner) {
        banner.classList.add('is-visible');
        banner.removeAttribute('hidden');
    };

    var hideBanner = function (banner) {
        banner.classList.remove('is-visible');
        banner.setAttribute('hidden', 'hidden');
    };

    var createMarkup = function (config) {
        var banner = document.querySelector('[data-cookie-banner]');
        if (banner) {
            var messageEl = banner.querySelector('[data-cookie-message]');
            var buttonEl = banner.querySelector('[data-cookie-accept]');
            var policyEl = banner.querySelector('[data-cookie-policy]');

            if (messageEl) {
                messageEl.textContent = config.message;
            }

            if (buttonEl) {
                buttonEl.textContent = config.cta;
            }

            if (policyEl) {
                policyEl.textContent = config.policy;
                if (config.policyUrl) {
                    policyEl.setAttribute('href', config.policyUrl);
                }
            }

            return banner;
        }

        banner = document.createElement('div');
        banner.className = 'ali-cookie-banner';
        banner.setAttribute('role', 'region');
        banner.setAttribute('aria-live', 'polite');
        banner.setAttribute('data-cookie-banner', '');
        banner.setAttribute('hidden', 'hidden');

        var message = document.createElement('p');
        message.className = 'mb-0';
        message.setAttribute('data-cookie-message', '');
        message.textContent = config.message;
        banner.appendChild(message);

        var actions = document.createElement('div');
        actions.className = 'ali-cookie-banner__actions';

        var accept = document.createElement('button');
        accept.type = 'button';
        accept.className = 'button button alt';
        accept.setAttribute('data-cookie-accept', '');
        accept.textContent = config.cta;
        actions.appendChild(accept);

        if (config.policy && config.policyUrl) {
            var policyLink = document.createElement('a');
            policyLink.className = 'ali-cookie-banner__link';
            policyLink.setAttribute('data-cookie-policy', '');
            policyLink.href = config.policyUrl;
            policyLink.target = '_blank';
            policyLink.rel = 'noopener noreferrer';
            policyLink.textContent = config.policy;
            actions.appendChild(policyLink);
        }

        banner.appendChild(actions);
        document.body.appendChild(banner);
        return banner;
    };

    var persistConsent = function () {
        try {
            window.localStorage.setItem(storageKey, '1');
        } catch (error) {
            // localStorage might be unavailable; ignore.
        }
    };

    var hasConsent = function () {
        try {
            return window.localStorage.getItem(storageKey) === '1';
        } catch (error) {
            return false;
        }
    };

    onReady(function () {
        if (hasConsent()) {
            return;
        }

        var config = window.davinciwooCookieNotice || {
            message: 'This site uses cookies from Google to deliver its services and to analyze traffic.',
            cta: 'Got it',
            policy: 'Learn more',
            policyUrl: '/privacy-policy'
        };

        var banner = createMarkup(config);
        if (!banner) {
            return;
        }

        showBanner(banner);

        var acceptButton = banner.querySelector('[data-cookie-accept]');
        if (acceptButton) {
            acceptButton.addEventListener('click', function () {
                persistConsent();
                hideBanner(banner);
            });
        }
    });
})();
