const {
  ThirdwebProvider,
  ConnectWallet
} = window.thirdweb.react;
const {
  useState,
  useEffect
} = React;

const App = () => {
    const [orderTotal, setOrderTotal] = useState(0);

    useEffect(() => {
        const checkoutRoot = document.getElementById('thirdweb-checkout-root');
        if (checkoutRoot) {
            setOrderTotal(checkoutRoot.getAttribute('data-order-total'));
        }
    }, []);

  return (
    <ThirdwebProvider
      activeChain="mumbai"
      clientId={ctw_checkout_vars.client_id}
    >
      <ConnectWallet
        // your configuration here
      />
      {/*
        The actual checkout widget would be rendered here, and would be passed the order total.
        Due to the complexity of integrating the thirdweb checkout widget with WooCommerce,
        this is a placeholder for now.
      */}
      <p>Order Total: {orderTotal}</p>
    </ThirdwebProvider>
  );
};

const root = ReactDOM.createRoot(document.getElementById('thirdweb-checkout-root'));
root.render( <App / > );
