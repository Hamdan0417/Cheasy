(function () {
    'use strict';

    var onReady = function (callback) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback);
        } else {
            callback();
        }
    };

    onReady(function () {
        var menu = document.querySelector('[data-ali-mega-menu]');
        if (!menu) {
            return;
        }

        var toggle = menu.querySelector('[data-ali-mega-toggle]');
        var items = Array.prototype.slice.call(menu.querySelectorAll('.ali-mega-menu__item'));
        var mq = window.matchMedia('(min-width: 1200px)');

        var isDesktop = function () {
            return mq.matches;
        };

        var updateLinkState = function (item, expanded) {
            var link = item.querySelector('.ali-mega-menu__category-link');
            var panel = item.querySelector('.ali-mega-menu__panel');

            if (link && link.hasAttribute('aria-expanded')) {
                link.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            }

            if (panel) {
                panel.setAttribute('aria-hidden', expanded ? 'false' : 'true');
            }
        };

        var resetDesktopState = function () {
            if (!items.length) {
                return;
            }

            items.forEach(function (item, index) {
                if (index === 0) {
                    item.classList.add('is-hover');
                    updateLinkState(item, true);
                } else {
                    item.classList.remove('is-hover');
                    updateLinkState(item, false);
                }
                item.classList.remove('is-open');
            });
        };

        var clearMobileState = function () {
            items.forEach(function (item) {
                item.classList.remove('is-open');
                updateLinkState(item, false);
            });
        };

        if (items.length && isDesktop()) {
            resetDesktopState();
        }

        items.forEach(function (item) {
            var link = item.querySelector('.ali-mega-menu__category-link');

            if (link) {
                link.addEventListener('click', function (event) {
                    if (isDesktop() || !item.classList.contains('has-children')) {
                        return;
                    }

                    event.preventDefault();
                    var willOpen = !item.classList.contains('is-open');

                    items.forEach(function (other) {
                        if (other !== item) {
                            other.classList.remove('is-open');
                            updateLinkState(other, false);
                        }
                    });

                    item.classList.toggle('is-open', willOpen);
                    updateLinkState(item, willOpen);
                });

                link.addEventListener('focus', function () {
                    if (!isDesktop()) {
                        return;
                    }

                    items.forEach(function (other) {
                        other.classList.remove('is-hover');
                        updateLinkState(other, false);
                    });

                    item.classList.add('is-hover');
                    updateLinkState(item, true);
                });
            }

            item.addEventListener('mouseenter', function () {
                if (!isDesktop()) {
                    return;
                }

                items.forEach(function (other) {
                    other.classList.remove('is-hover');
                    updateLinkState(other, false);
                });

                item.classList.add('is-hover');
                updateLinkState(item, true);
            });
        });

        menu.addEventListener('mouseleave', function () {
            if (isDesktop()) {
                resetDesktopState();
            }
        });

        if (toggle) {
            toggle.addEventListener('click', function () {
                var expanded = !menu.classList.contains('is-active');
                menu.classList.toggle('is-active', expanded);
                toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');

                if (!expanded) {
                    clearMobileState();
                }
            });
        }

        document.addEventListener('click', function (event) {
            if (!menu.contains(event.target) && toggle && !toggle.contains(event.target)) {
                menu.classList.remove('is-active');
                toggle.setAttribute('aria-expanded', 'false');
                clearMobileState();
            }
        });

        var handleViewportChange = function () {
            menu.classList.remove('is-active');

            if (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            }

            if (isDesktop()) {
                resetDesktopState();
            } else {
                items.forEach(function (item) {
                    item.classList.remove('is-hover');
                    updateLinkState(item, false);
                });
            }
        };

        if (typeof mq.addEventListener === 'function') {
            mq.addEventListener('change', handleViewportChange);
        } else if (typeof mq.addListener === 'function') {
            mq.addListener(handleViewportChange);
        }

        window.addEventListener('pageshow', function () {
            if (isDesktop()) {
                resetDesktopState();
            }
        });
    });
})();
