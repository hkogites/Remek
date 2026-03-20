import React, { useState, useEffect } from 'react';
import SimpleLogin from './components/SimpleLogin';

function SimpleApp() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const token = localStorage.getItem('iroda_token');
    const userData = localStorage.getItem('iroda_user');
    
    if (token && userData) {
      setUser(JSON.parse(userData));
    }
    setLoading(false);
  }, []);

  const handleLogin = (userData, token) => {
    setUser(userData);
    localStorage.setItem('iroda_token', token);
    localStorage.setItem('iroda_user', JSON.stringify(userData));
  };

  const handleLogout = () => {
    setUser(null);
    localStorage.removeItem('iroda_token');
    localStorage.removeItem('iroda_user');
  };

  if (loading) {
    return <div style={{ textAlign: 'center', marginTop: '50px' }}>Betöltés...</div>;
  }

  return (
    <div>
      {user ? (
        <div style={{ padding: '20px' }}>
          <h1>Üdvözöljük, {user.name}!</h1>
          <p>Email: {user.email}</p>
          <p>Szerepkör: {user.is_iroda ? 'Iroda' : 'Admin'}</p>
          <button 
            onClick={handleLogout}
            style={{
              padding: '10px 20px',
              backgroundColor: '#dc004e',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Kijelentkezés
          </button>
        </div>
      ) : (
        <SimpleLogin onLogin={handleLogin} />
      )}
    </div>
  );
}

export default SimpleApp;
