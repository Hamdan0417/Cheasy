(function () {
    const selectors = '.thirdweb-connect-embed';

    const maybeInit = () => {
        const containers = document.querySelectorAll(selectors);
        if (!containers.length) {
            return;
        }

        initEmbed(containers);
    };

    const initEmbed = async (containers) => {
        try {
            const [{ default: React }, { createRoot }, thirdweb] = await Promise.all([
                import('https://esm.sh/react@18.2.0?bundle'),
                import('https://esm.sh/react-dom@18.2.0/client?bundle'),
                import('https://esm.sh/@thirdweb-dev/react@latest?bundle'),
            ]);

            const { ThirdwebProvider, ConnectEmbed } = thirdweb;
            const wallets = [
                typeof thirdweb?.metamaskWallet === 'function' ? thirdweb.metamaskWallet() : null,
                typeof thirdweb?.walletConnect === 'function' ? thirdweb.walletConnect() : null,
                typeof thirdweb?.coinbaseWallet === 'function' ? thirdweb.coinbaseWallet() : null,
                typeof thirdweb?.embeddedWallet === 'function'
                    ? thirdweb.embeddedWallet({
                          auth: {
                              options: ['email', 'google', 'facebook', 'apple'],
                          },
                      })
                    : null,
            ].filter(Boolean);

            const sendWalletToServer = async (walletAddress, email) => {
                if (!walletAddress) {
                    return;
                }
                const action = thirdwebConnectSettings?.isLoggedIn ? 'thirdweb_store_wallet' : 'thirdweb_wallet_login';
                const body = new URLSearchParams({
                    action,
                    nonce: thirdwebConnectSettings?.nonce || '',
                    wallet: walletAddress,
                });
                if (email) {
                    body.set('email', email);
                }

                try {
                    await fetch(thirdwebConnectSettings?.ajaxUrl || '/wp-admin/admin-ajax.php', {
                        method: 'POST',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                        },
                        body: body.toString(),
                    });
                } catch (error) {
                    console.error('thirdweb wallet sync failed', error);
                }
            };

            const EmbedWrapper = ({ theme, modalTitle }) => {
                const connectedRef = React.useRef(false);

                const handleConnect = React.useCallback(async (wallet) => {
                    if (!wallet || connectedRef.current) {
                        return;
                    }
                    connectedRef.current = true;
                    try {
                        const address = typeof wallet.getAddress === 'function' ? await wallet.getAddress() : wallet.address;
                        const email = wallet?.email || (typeof wallet.getEmail === 'function' ? await wallet.getEmail() : undefined);
                        await sendWalletToServer(address, email);
                    } catch (error) {
                        console.error('thirdweb connect callback error', error);
                        connectedRef.current = false;
                    }
                }, []);

                return React.createElement(
                    ThirdwebProvider,
                    {
                        clientId: thirdwebConnectSettings?.clientId,
                        activeChain: thirdwebConnectSettings?.chain || 'polygon',
                    },
                    React.createElement(ConnectEmbed, {
                        modalTitle: modalTitle || thirdwebConnectSettings?.siteName || 'Connect Wallet',
                        theme: theme || 'dark',
                        showThirdwebBranding: false,
                        auth: {
                            loginOptional: true,
                        },
                        wallets,
                        onConnect: handleConnect,
                    })
                );
            };

            containers.forEach((container) => {
                const theme = container.dataset.theme || 'dark';
                const modalTitle = container.dataset.modalTitle || thirdwebConnectSettings?.siteName || 'Connect Wallet';
                const root = createRoot(container);
                root.render(React.createElement(EmbedWrapper, { theme, modalTitle }));
            });
        } catch (error) {
            console.error('Unable to initialize thirdweb connect embed', error);
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', maybeInit);
    } else {
        maybeInit();
    }
})();
