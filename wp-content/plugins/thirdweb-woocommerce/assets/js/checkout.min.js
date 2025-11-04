(function ($) {
    const modalId = 'thirdweb-checkout-modal';

    const ensureModal = () => {
        if (document.getElementById(modalId)) {
            return document.getElementById(modalId);
        }

        const overlay = document.createElement('div');
        overlay.id = modalId;
        overlay.style.position = 'fixed';
        overlay.style.inset = '0';
        overlay.style.backgroundColor = 'rgba(20, 24, 29, 0.85)';
        overlay.style.display = 'flex';
        overlay.style.alignItems = 'center';
        overlay.style.justifyContent = 'center';
        overlay.style.zIndex = '100000';

        const wrapper = document.createElement('div');
        wrapper.style.width = 'min(900px, 90vw)';
        wrapper.style.height = 'min(720px, 90vh)';
        wrapper.style.background = '#0b0f1a';
        wrapper.style.borderRadius = '16px';
        wrapper.style.boxShadow = '0 10px 40px rgba(0,0,0,0.3)';
        wrapper.style.overflow = 'hidden';
        wrapper.style.position = 'relative';

        const close = document.createElement('button');
        close.type = 'button';
        close.textContent = '×';
        close.setAttribute('aria-label', 'Close thirdweb checkout');
        close.style.position = 'absolute';
        close.style.top = '8px';
        close.style.right = '12px';
        close.style.background = 'transparent';
        close.style.color = '#fff';
        close.style.fontSize = '28px';
        close.style.border = '0';
        close.style.cursor = 'pointer';

        const iframe = document.createElement('iframe');
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = '0';
        iframe.setAttribute('allow', 'clipboard-read; clipboard-write; accelerometer; autoplay; camera; payment');

        close.addEventListener('click', () => {
            overlay.remove();
        });

        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) {
                overlay.remove();
            }
        });

        wrapper.appendChild(close);
        wrapper.appendChild(iframe);
        overlay.appendChild(wrapper);
        document.body.appendChild(overlay);
        return overlay;
    };

    const openCheckoutModal = (checkoutUrl) => {
        const overlay = ensureModal();
        const iframe = overlay.querySelector('iframe');
        iframe.src = checkoutUrl;
    };

    const requestCheckoutSession = async (orderId) => {
        try {
            const response = await fetch(thirdwebCheckoutSettings.gatewayUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ order_id: orderId }),
                credentials: 'same-origin',
            });

            const payload = await response.json();
            if (!response.ok) {
                throw new Error(payload?.error || 'Unable to create checkout session');
            }

            if (payload.checkoutUrl) {
                openCheckoutModal(payload.checkoutUrl);
            } else {
                throw new Error('Missing checkout URL');
            }
        } catch (error) {
            window.alert(error.message || 'Unable to launch thirdweb checkout.');
            console.error('thirdweb checkout error', error);
        }
    };

    const handleButtonClick = (event) => {
        event.preventDefault();
        const button = event.currentTarget;
        const orderId = button.getAttribute('data-order-id');
        if (!orderId) {
            window.alert('Order not created yet. Please place your order first.');
            return;
        }

        requestCheckoutSession(orderId);
    };

    $(document.body).on('click', '#thirdweb-launch-checkout', handleButtonClick);
    $(document.body).on('click', '#thirdweb-resume-checkout', handleButtonClick);

    document.addEventListener('DOMContentLoaded', () => {
        const thankyouBlock = document.querySelector('.thirdweb-payment-status');
        if (thankyouBlock && thankyouBlock.dataset.orderId) {
            const orderId = thankyouBlock.dataset.orderId;
            const autoLaunch = thankyouBlock.dataset.autolaunch === '1';
            const button = thankyouBlock.querySelector('#thirdweb-resume-checkout');
            if (button) {
                button.setAttribute('data-order-id', orderId);
            }
            if (autoLaunch) {
                requestCheckoutSession(orderId);
            }
        }
    });
})(jQuery);
