import React, { useState, useEffect } from 'react';
import EnhancedLogin from './components/EnhancedLogin';
import EnhancedDashboard from './components/EnhancedDashboard';
import EnhancedReservations from './components/EnhancedReservations';
import DestinationsList from './components/DestinationsList';

function FullApp() {
  const [user, setUser] = useState(null);
  const [currentView, setCurrentView] = useState('dashboard');
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
    setCurrentView('dashboard');
    localStorage.removeItem('iroda_token');
    localStorage.removeItem('iroda_user');
  };

  const handleNavigate = (view) => {
    setCurrentView(view);
  };

  if (loading) {
    return (
      <div style={{ 
        display: 'flex', 
        justifyContent: 'center', 
        alignItems: 'center', 
        height: '100vh',
        fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
        background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
      }}>
        <div style={{
          backgroundColor: 'white',
          padding: '40px',
          borderRadius: '16px',
          boxShadow: '0 20px 40px rgba(0,0,0,0.1)',
          textAlign: 'center'
        }}>
          <div style={{
            width: '60px',
            height: '60px',
            border: '6px solid #1976d2',
            borderTop: '6px solid transparent',
            borderRadius: '50%',
            animation: 'spin 1s linear infinite',
            margin: '0 auto 20px'
          }}></div>
          <p style={{ margin: 0, color: '#666', fontSize: '16px' }}>Betöltés...</p>
        </div>
        <style jsx>{`
          @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
          }
        `}</style>
      </div>
    );
  }

  if (!user) {
    return <EnhancedLogin onLogin={handleLogin} />;
  }

  // Main app with enhanced navigation
  return (
    <div style={{ 
      fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif', 
      height: '100vh', 
      display: 'flex', 
      flexDirection: 'column',
      backgroundColor: '#f8f9fa'
    }}>
      {/* Enhanced Navigation Header */}
      <div style={{
        background: 'linear-gradient(135deg, #1976d2 0%, #1565c0 100%)',
        color: 'white',
        padding: '16px 24px',
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        boxShadow: '0 4px 12px rgba(0,0,0,0.15)',
        position: 'relative',
        overflow: 'hidden'
      }}>
        <div style={{ 
          position: 'absolute',
          top: 0,
          left: 0,
          right: 0,
          bottom: 0,
          background: 'linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%)',
          pointerEvents: 'none'
        }}></div>
        <div style={{ display: 'flex', alignItems: 'center', gap: '40px', position: 'relative', zIndex: 1 }}>
          <div style={{ display: 'flex', alignItems: 'center', gap: '12px' }}>
            <div style={{
              width: '40px',
              height: '40px',
              backgroundColor: 'rgba(255,255,255,0.2)',
              borderRadius: '10px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              fontSize: '18px',
              fontWeight: 'bold'
            }}>
              SV
            </div>
            <h1 style={{ 
              margin: 0, 
              fontSize: '20px',
              fontWeight: '600',
              letterSpacing: '0.5px'
            }}>
              SmartVoyager Iroda
            </h1>
          </div>
          <nav style={{ display: 'flex', gap: '8px' }}>
            <button
              onClick={() => handleNavigate('dashboard')}
              style={{
                padding: '10px 20px',
                backgroundColor: currentView === 'dashboard' ? 'rgba(255,255,255,0.2)' : 'transparent',
                color: 'white',
                border: currentView === 'dashboard' ? '1px solid rgba(255,255,255,0.3)' : '1px solid transparent',
                borderRadius: '8px',
                cursor: 'pointer',
                fontSize: '14px',
                fontWeight: '500',
                transition: 'all 0.3s ease',
                display: 'flex',
                alignItems: 'center',
                gap: '8px'
              }}
              onMouseOver={(e) => {
                if (currentView !== 'dashboard') {
                  e.target.style.backgroundColor = 'rgba(255,255,255,0.1)';
                }
              }}
              onMouseOut={(e) => {
                if (currentView !== 'dashboard') {
                  e.target.style.backgroundColor = 'transparent';
                }
              }}
            >
              📊 Vezérlőpult
            </button>
            <button
              onClick={() => handleNavigate('reservations')}
              style={{
                padding: '10px 20px',
                backgroundColor: currentView === 'reservations' ? 'rgba(255,255,255,0.2)' : 'transparent',
                color: 'white',
                border: currentView === 'reservations' ? '1px solid rgba(255,255,255,0.3)' : '1px solid transparent',
                borderRadius: '8px',
                cursor: 'pointer',
                fontSize: '14px',
                fontWeight: '500',
                transition: 'all 0.3s ease',
                display: 'flex',
                alignItems: 'center',
                gap: '8px'
              }}
              onMouseOver={(e) => {
                if (currentView !== 'reservations') {
                  e.target.style.backgroundColor = 'rgba(255,255,255,0.1)';
                }
              }}
              onMouseOut={(e) => {
                if (currentView !== 'reservations') {
                  e.target.style.backgroundColor = 'transparent';
                }
              }}
            >
              📋 Foglalások
            </button>
            <button
              onClick={() => handleNavigate('destinations')}
              style={{
                padding: '10px 20px',
                backgroundColor: currentView === 'destinations' ? 'rgba(255,255,255,0.2)' : 'transparent',
                color: 'white',
                border: currentView === 'destinations' ? '1px solid rgba(255,255,255,0.3)' : '1px solid transparent',
                borderRadius: '8px',
                cursor: 'pointer',
                fontSize: '14px',
                fontWeight: '500',
                transition: 'all 0.3s ease',
                display: 'flex',
                alignItems: 'center',
                gap: '8px'
              }}
              onMouseOver={(e) => {
                if (currentView !== 'destinations') {
                  e.target.style.backgroundColor = 'rgba(255,255,255,0.1)';
                }
              }}
              onMouseOut={(e) => {
                if (currentView !== 'destinations') {
                  e.target.style.backgroundColor = 'transparent';
                }
              }}
            >
              🌍 Úticélok
            </button>
          </nav>
        </div>
        <div style={{ display: 'flex', alignItems: 'center', gap: '16px', position: 'relative', zIndex: 1 }}>
          <div style={{ textAlign: 'right' }}>
            <div style={{ fontSize: '14px', fontWeight: '500' }}>{user.name}</div>
            <div style={{ fontSize: '12px', opacity: 0.8 }}>
              {user.is_iroda ? 'Iroda' : 'Admin'}
            </div>
          </div>
          <div style={{
            width: '40px',
            height: '40px',
            backgroundColor: 'rgba(255,255,255,0.2)',
            borderRadius: '50%',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            fontSize: '16px'
          }}>
            👤
          </div>
          <button
            onClick={handleLogout}
            style={{
              padding: '8px 16px',
              backgroundColor: 'rgba(255,255,255,0.2)',
              color: 'white',
              border: '1px solid rgba(255,255,255,0.3)',
              borderRadius: '8px',
              cursor: 'pointer',
              fontSize: '12px',
              fontWeight: '500',
              transition: 'all 0.3s ease'
            }}
            onMouseOver={(e) => {
              e.target.style.backgroundColor = 'rgba(255,255,255,0.3)';
            }}
            onMouseOut={(e) => {
              e.target.style.backgroundColor = 'rgba(255,255,255,0.2)';
            }}
          >
            Kijelentkezés
          </button>
        </div>
      </div>

      {/* Main Content */}
      <div style={{ flex: 1, overflow: 'auto' }}>
        {currentView === 'dashboard' && (
          <EnhancedDashboard user={user} onNavigate={handleNavigate} />
        )}
        {currentView === 'reservations' && (
          <EnhancedReservations onBack={() => handleNavigate('dashboard')} />
        )}
        {currentView === 'destinations' && (
          <DestinationsList onBack={() => handleNavigate('dashboard')} />
        )}
      </div>
    </div>
  );
}

export default FullApp;
