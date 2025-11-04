const { ThirdwebProvider, ConnectEmbed } = window.thirdweb.react;
const {
  useState,
  useEffect
} = React;

const App = () => {
  const [walletAddress, setWalletAddress] = useState(null);
  const [email, setEmail] = useState('');
  const [showEmailInput, setShowEmailInput] = useState(false);

  const handleConnect = (address) => {
    setWalletAddress(address);
    // Logic to determine if email is needed will be here.
    // For now, we'll assume we need it for guest users.
    if (!document.body.classList.contains('logged-in')) {
      setShowEmailInput(true);
    }
  };

  const handleEmailSubmit = () => {
    const formData = new FormData();
    formData.append('action', 'ctw_save_wallet_address');
    formData.append('nonce', ctw_vars.nonce);
    formData.append('address', walletAddress);
    formData.append('email', email);

    fetch(ctw_vars.ajax_url, {
      method: 'POST',
      body: formData,
    }).then(response => response.json()).then(data => {
      if (data.success) {
        console.log(data.data.message);
        setShowEmailInput(false);
        window.location.reload(); // Reload to reflect login
      } else {
        console.error(data.data.message);
        alert(data.data.message); // Show error to user
      }
    });
  };

  useEffect(() => {
    if (walletAddress && document.body.classList.contains('logged-in')) {
      const formData = new FormData();
      formData.append('action', 'ctw_save_wallet_address');
      formData.append('nonce', ctw_vars.nonce);
      formData.append('address', walletAddress);

      fetch(ctw_vars.ajax_url, {
        method: 'POST',
        body: formData,
      });
    }
  }, [walletAddress]);

  return (
    <ThirdwebProvider
      activeChain="mumbai"
      clientId={ctw_vars.client_id}
    >
      <ConnectEmbed
        onConnect={({
          address
        }) => handleConnect(address)}
      />
      {showEmailInput && (
        <div>
          <p>Please enter your email to create an account or link to an existing one.</p>
          <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} placeholder="your@email.com" />
          <button onClick={handleEmailSubmit}>Submit</button>
        </div>
      )}
    </ThirdwebProvider>
  );
};

const root = ReactDOM.createRoot(document.getElementById('thirdweb-connect-root'));
root.render(<App />);
