import React, { useState, useEffect } from 'react';
import { CONFIG } from '../config';

const EnhancedDashboard = ({ user, onNavigate }) => {
  const [stats, setStats] = useState({
    totalReservations: 0,
    pendingReservations: 0,
    confirmedReservations: 0,
    cancelledReservations: 0,
    totalDestinations: 0,
  });
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchStats();
  }, []);

  const fetchStats = async () => {
    try {
      const token = localStorage.getItem('iroda_token');
      
      const [reservationsResponse, destinationsResponse] = await Promise.all([
        fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations?per_page=${CONFIG.DASHBOARD_PAGE_SIZE}`, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
        }),
        fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/destinations?per_page=1`, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
        }),
      ]);

      if (reservationsResponse.ok && destinationsResponse.ok) {
        const reservationsData = await reservationsResponse.json();
        const destinationsData = await destinationsResponse.json();

        // Calculate status counts from actual reservation data
        const reservations = reservationsData.data || [];
        const pendingCount = reservations.filter(r => r.status === CONFIG.RESERVATION_STATUSES.PENDING).length;
        const confirmedCount = reservations.filter(r => r.status === CONFIG.RESERVATION_STATUSES.CONFIRMED).length;
        const cancelledCount = reservations.filter(r => r.status === CONFIG.RESERVATION_STATUSES.CANCELLED).length;

        setStats({
          totalReservations: reservationsData.pagination.total,
          pendingReservations: pendingCount,
          confirmedReservations: confirmedCount,
          cancelledReservations: cancelledCount,
          totalDestinations: destinationsData.pagination.total,
        });
      }
    } catch (error) {
      console.error('Error fetching stats:', error);
    } finally {
      setLoading(false);
    }
  };

  const statCards = [
    {
      title: 'Összes foglalás',
      value: stats.totalReservations,
      icon: '📋',
      color: '#1976d2',
      bgColor: '#e3f2fd',
    },
    {
      title: 'Függőben lévő',
      value: stats.pendingReservations,
      icon: '⏳',
      color: '#ff9800',
      bgColor: '#fff3e0',
    },
    {
      title: 'Megerősített',
      value: stats.confirmedReservations,
      icon: '✅',
      color: '#4caf50',
      bgColor: '#e8f5e8',
    },
    {
      title: 'Lemondott',
      value: stats.cancelledReservations,
      icon: '❌',
      color: '#f44336',
      bgColor: '#ffebee',
    },
    {
      title: 'Úticélok',
      value: stats.totalDestinations,
      icon: '🌍',
      color: '#9c27b0',
      bgColor: '#f3e5f5',
    },
  ];

  if (loading) {
    return (
      <div style={{ textAlign: 'center', marginTop: '50px', fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif' }}>
        <div style={{
          display: 'inline-block',
          padding: '40px',
          backgroundColor: '#f5f5f5',
          borderRadius: '16px'
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
          <p style={{ margin: 0, color: '#666', fontSize: '16px' }}>Statisztikák betöltése...</p>
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

  return (
    <div style={{ padding: '24px', fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif' }}>
      {/* Header */}
      <div style={{ 
        display: 'flex', 
        justifyContent: 'space-between', 
        alignItems: 'center', 
        marginBottom: '40px',
        paddingBottom: '20px',
        borderBottom: '2px solid #e0e0e0'
      }}>
        <div>
          <h1 style={{ 
            margin: 0, 
            color: '#333',
            fontSize: '36px',
            fontWeight: '700',
            background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            WebkitBackgroundClip: 'text',
            WebkitTextFillColor: 'transparent',
            backgroundClip: 'text'
          }}>
            Üdvözöljük vissza, {user.name}!
          </h1>
          <p style={{ 
            margin: '8px 0 0', 
            color: '#666',
            fontSize: '16px'
          }}>
            {user.is_iroda ? '🏢 Iroda felhasználó' : '👤 Admin felhasználó'} • {user.email}
          </p>
        </div>
        <div style={{ display: 'flex', gap: '12px' }}>
          <button
            onClick={() => onNavigate('reservations')}
            style={{
              padding: '14px 24px',
              backgroundColor: '#1976d2',
              color: 'white',
              border: 'none',
              borderRadius: '12px',
              cursor: 'pointer',
              fontSize: '14px',
              fontWeight: '600',
              transition: 'all 0.3s ease',
              boxShadow: '0 4px 12px rgba(25, 118, 210, 0.3)',
              display: 'flex',
              alignItems: 'center',
              gap: '8px'
            }}
            onMouseOver={(e) => {
              e.target.style.backgroundColor = '#1565c0';
              e.target.style.transform = 'translateY(-2px)';
              e.target.style.boxShadow = '0 6px 16px rgba(25, 118, 210, 0.4)';
            }}
            onMouseOut={(e) => {
              e.target.style.backgroundColor = '#1976d2';
              e.target.style.transform = 'translateY(0)';
              e.target.style.boxShadow = '0 4px 12px rgba(25, 118, 210, 0.3)';
            }}
          >
            📋 Foglalások
          </button>
          <button
            onClick={() => onNavigate('destinations')}
            style={{
              padding: '14px 24px',
              backgroundColor: '#9c27b0',
              color: 'white',
              border: 'none',
              borderRadius: '12px',
              cursor: 'pointer',
              fontSize: '14px',
              fontWeight: '600',
              transition: 'all 0.3s ease',
              boxShadow: '0 4px 12px rgba(156, 39, 176, 0.3)',
              display: 'flex',
              alignItems: 'center',
              gap: '8px'
            }}
            onMouseOver={(e) => {
              e.target.style.backgroundColor = '#7b1fa2';
              e.target.style.transform = 'translateY(-2px)';
              e.target.style.boxShadow = '0 6px 16px rgba(156, 39, 176, 0.4)';
            }}
            onMouseOut={(e) => {
              e.target.style.backgroundColor = '#9c27b0';
              e.target.style.transform = 'translateY(0)';
              e.target.style.boxShadow = '0 4px 12px rgba(156, 39, 176, 0.3)';
            }}
          >
            🌍 Úticélok
          </button>
        </div>
      </div>

      {/* Stats Cards */}
      <div style={{ 
        display: 'grid', 
        gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', 
        gap: '24px', 
        marginBottom: '40px' 
      }}>
        {statCards.map((card, index) => (
          <div
            key={index}
            style={{
              padding: '32px',
              borderRadius: '16px',
              backgroundColor: card.bgColor,
              boxShadow: '0 8px 24px rgba(0,0,0,0.1)',
              border: `2px solid ${card.color}20`,
              textAlign: 'center',
              transition: 'all 0.3s ease',
              position: 'relative',
              overflow: 'hidden'
            }}
            onMouseOver={(e) => {
              e.target.style.transform = 'translateY(-4px)';
              e.target.style.boxShadow = '0 12px 32px rgba(0,0,0,0.15)';
            }}
            onMouseOut={(e) => {
              e.target.style.transform = 'translateY(0)';
              e.target.style.boxShadow = '0 8px 24px rgba(0,0,0,0.1)';
            }}
          >
            <div style={{
              fontSize: '48px',
              marginBottom: '16px',
              opacity: 0.8
            }}>
              {card.icon}
            </div>
            <h3 style={{ 
              margin: '0 0 12px', 
              color: '#333',
              fontSize: '18px',
              fontWeight: '600'
            }}>
              {card.title}
            </h3>
            <div style={{ 
              fontSize: '42px', 
              fontWeight: '700',
              color: card.color,
              lineHeight: 1
            }}>
              {card.value}
            </div>
          </div>
        ))}
      </div>

      {/* Info Cards */}
      <div style={{ 
        display: 'grid', 
        gridTemplateColumns: 'repeat(auto-fit, minmax(400px, 1fr))', 
        gap: '24px' 
      }}>
        <div style={{
          padding: '32px',
          borderRadius: '16px',
          backgroundColor: 'white',
          boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
          border: '1px solid #e0e0e0'
        }}>
          <div style={{ display: 'flex', alignItems: 'center', marginBottom: '20px' }}>
            <div style={{
              width: '48px',
              height: '48px',
              backgroundColor: '#e8f5e8',
              borderRadius: '12px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              fontSize: '24px',
              marginRight: '16px'
            }}>
              🛡️
            </div>
            <h3 style={{ margin: 0, color: '#333', fontSize: '20px', fontWeight: '600' }}>
              Rendszer információ
            </h3>
          </div>
          <ul style={{ 
            listStyle: 'none', 
            padding: 0, 
            margin: 0,
            display: 'grid',
            gap: '12px'
          }}>
            <li style={{ 
              padding: '12px 16px',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              display: 'flex',
              alignItems: 'center',
              gap: '12px',
              fontSize: '14px',
              color: '#666'
            }}>
              <span>💻</span> SmartVoyager Iroda Desktop App
            </li>
            <li style={{ 
              padding: '12px 16px',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              display: 'flex',
              alignItems: 'center',
              gap: '12px',
              fontSize: '14px',
              color: '#666'
            }}>
              <span>🔗</span> API kapcsolat aktív
            </li>
            <li style={{ 
              padding: '12px 16px',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              display: 'flex',
              alignItems: 'center',
              gap: '12px',
              fontSize: '14px',
              color: '#666'
            }}>
              <span>⚡</span> Valós idejű adatszinkronizáció
            </li>
            <li style={{ 
              padding: '12px 16px',
              backgroundColor: '#f8f9fa',
              borderRadius: '8px',
              display: 'flex',
              alignItems: 'center',
              gap: '12px',
              fontSize: '14px',
              color: '#666'
            }}>
              <span>🔒</span> Biztonságos hitelesítés
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default EnhancedDashboard;
