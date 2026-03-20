import React, { useState } from 'react';
import { CONFIG } from '../config';

const EnhancedLogin = ({ onLogin }) => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');

    try {
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(formData),
      });

      const data = await response.json();
      
      if (response.ok) {
        localStorage.setItem('iroda_token', data.token);
        localStorage.setItem('iroda_user', JSON.stringify(data.user));
        onLogin(data.user, data.token);
      } else {
        setError(data.message || 'Bejelentkezés sikertelen');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={{
      minHeight: '100vh',
      background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
      display: 'flex',
      justifyContent: 'center',
      alignItems: 'center',
      fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif'
    }}>
      <div style={{
        backgroundColor: 'white',
        padding: '40px',
        borderRadius: '16px',
        boxShadow: '0 20px 40px rgba(0,0,0,0.1)',
        width: '450px',
        backdropFilter: 'blur(10px)'
      }}>
        {/* Logo/Header */}
        <div style={{ textAlign: 'center', marginBottom: '40px' }}>
          <div style={{
            width: '60px',
            height: '60px',
            backgroundColor: '#1976d2',
            borderRadius: '12px',
            margin: '0 auto 20px',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            fontSize: '24px',
            color: 'white',
            fontWeight: 'bold'
          }}>
            SV
          </div>
          <h2 style={{ 
            margin: 0, 
            color: '#333',
            fontSize: '28px',
            fontWeight: '600'
          }}>
            SmartVoyager Iroda
          </h2>
          <p style={{ 
            margin: '8px 0 0', 
            color: '#666',
            fontSize: '14px'
          }}>
            Jelentkezzen be az iroda fiókjába
          </p>
        </div>
        
        {error && (
          <div style={{
            color: '#d32f2f',
            padding: '12px 16px',
            backgroundColor: '#ffebee',
            border: '1px solid #ffcdd2',
            borderRadius: '8px',
            marginBottom: '24px',
            fontSize: '14px'
          }}>
            {error}
          </div>
        )}

        <form onSubmit={handleSubmit}>
          <div style={{ marginBottom: '24px' }}>
            <label style={{ 
              display: 'block', 
              marginBottom: '8px',
              color: '#333',
              fontSize: '14px',
              fontWeight: '500'
            }}>
              Email cím
            </label>
            <input
              type="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              required
              placeholder="email@pelda.hu"
              style={{
                width: '100%',
                padding: '12px 16px',
                border: '2px solid #e0e0e0',
                borderRadius: '8px',
                fontSize: '14px',
                transition: 'all 0.3s ease',
                boxSizing: 'border-box'
              }}
              onFocus={(e) => {
                e.target.style.borderColor = '#1976d2';
                e.target.style.outline = 'none';
              }}
              onBlur={(e) => {
                e.target.style.borderColor = '#e0e0e0';
              }}
            />
          </div>

          <div style={{ marginBottom: '32px' }}>
            <label style={{ 
              display: 'block', 
              marginBottom: '8px',
              color: '#333',
              fontSize: '14px',
              fontWeight: '500'
            }}>
              Jelszó
            </label>
            <input
              type="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required
              placeholder="••••••••"
              style={{
                width: '100%',
                padding: '12px 16px',
                border: '2px solid #e0e0e0',
                borderRadius: '8px',
                fontSize: '14px',
                transition: 'all 0.3s ease',
                boxSizing: 'border-box'
              }}
              onFocus={(e) => {
                e.target.style.borderColor = '#1976d2';
                e.target.style.outline = 'none';
              }}
              onBlur={(e) => {
                e.target.style.borderColor = '#e0e0e0';
              }}
            />
          </div>

          <button
            type="submit"
            disabled={loading}
            style={{
              width: '100%',
              padding: '14px',
              backgroundColor: loading ? '#ccc' : '#1976d2',
              color: 'white',
              border: 'none',
              borderRadius: '8px',
              fontSize: '16px',
              fontWeight: '600',
              cursor: loading ? 'not-allowed' : 'pointer',
              transition: 'all 0.3s ease',
              boxShadow: loading ? 'none' : '0 4px 12px rgba(25, 118, 210, 0.3)'
            }}
            onMouseOver={(e) => {
              if (!loading) {
                e.target.style.backgroundColor = '#1565c0';
                e.target.style.transform = 'translateY(-1px)';
              }
            }}
            onMouseOut={(e) => {
              if (!loading) {
                e.target.style.backgroundColor = '#1976d2';
                e.target.style.transform = 'translateY(0)';
              }
            }}
          >
            {loading ? (
              <span style={{ display: 'flex', alignItems: 'center', justifyContent: 'center' }}>
                <span style={{
                  display: 'inline-block',
                  width: '16px',
                  height: '16px',
                  border: '2px solid #ffffff',
                  borderRadius: '50%',
                  borderTopColor: 'transparent',
                  animation: 'spin 1s linear infinite',
                  marginRight: '8px'
                }}></span>
                Bejelentkezés...
              </span>
            ) : (
              'Bejelentkezés'
            )}
          </button>
        </form>

        <div style={{ 
          textAlign: 'center', 
          marginTop: '24px',
          fontSize: '12px',
          color: '#666'
        }}>
          <p style={{ margin: 0 }}>
            Teszt fiókok: {CONFIG.TEST_ACCOUNTS.iroda.email} | {CONFIG.TEST_ACCOUNTS.admin.email}
          </p>
        </div>
      </div>

      <style jsx>{`
        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
      `}</style>
    </div>
  );
};

export default EnhancedLogin;
