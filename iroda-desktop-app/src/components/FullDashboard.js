import React, { useState, useEffect } from 'react';
import { CONFIG } from '../config';
import { getStatusColor, getStatusLabel } from '../utils/statusHelpers';

const FullDashboard = ({ user, onNavigate }) => {
  const [stats, setStats] = useState({
    totalReservations: 0,
    pendingReservations: 0,
    confirmedReservations: 0,
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

        setStats({
          totalReservations: reservationsData.pagination.total,
          pendingReservations: pendingCount,
          confirmedReservations: confirmedCount,
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
      color: '#1976d2',
    },
    {
      title: 'Függőben lévő',
      value: stats.pendingReservations,
      color: '#ff9800',
    },
    {
      title: 'Megerősített',
      value: stats.confirmedReservations,
      color: '#4caf50',
    },
    {
      title: 'Úticélok',
      value: stats.totalDestinations,
      color: '#9c27b0',
    },
  ];

  if (loading) {
    return (
      <div style={{ textAlign: 'center', marginTop: '50px' }}>
        <div>Statisztikák betöltése...</div>
      </div>
    );
  }

  return (
    <div style={{ padding: '20px' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '30px' }}>
        <div>
          <h1 style={{ margin: 0, color: '#333' }}>Üdvözöljük, {user.name}!</h1>
          <p style={{ margin: '5px 0', color: '#666' }}>
            {user.is_iroda ? 'Iroda felhasználó' : 'Admin felhasználó'}
          </p>
        </div>
        <div style={{ display: 'flex', gap: '10px' }}>
          <button
            onClick={() => onNavigate('reservations')}
            style={{
              padding: '10px 20px',
              backgroundColor: '#1976d2',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Foglalások
          </button>
          <button
            onClick={() => onNavigate('destinations')}
            style={{
              padding: '10px 20px',
              backgroundColor: '#9c27b0',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Úticélok
          </button>
        </div>
      </div>

      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))', gap: '20px', marginBottom: '30px' }}>
        {statCards.map((card, index) => (
          <div
            key={index}
            style={{
              padding: '20px',
              border: '1px solid #ddd',
              borderRadius: '8px',
              backgroundColor: '#fff',
              boxShadow: '0 2px 4px rgba(0,0,0,0.1)',
              textAlign: 'center'
            }}
          >
            <div style={{
              width: '50px',
              height: '50px',
              backgroundColor: card.color,
              borderRadius: '50%',
              margin: '0 auto 15px',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              color: 'white',
              fontSize: '24px',
              fontWeight: 'bold'
            }}>
              {card.value}
            </div>
            <h3 style={{ margin: '0 0 10px', color: '#333' }}>{card.title}</h3>
            <div style={{ fontSize: '32px', fontWeight: 'bold', color: card.color }}>
              {card.value}
            </div>
          </div>
        ))}
      </div>

      <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px' }}>
        <div style={{
          padding: '20px',
          border: '1px solid #ddd',
          borderRadius: '8px',
          backgroundColor: '#fff'
        }}>
          <h3 style={{ margin: '0 0 15px', color: '#333' }}>Gyors műveletek</h3>
          <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• Új foglalások kezelése</li>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• Státusz módosítások</li>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• Email küldés ügyfeleknek</li>
            <li style={{ padding: '8px 0' }}>• Úticélok szerkesztése</li>
          </ul>
        </div>
        <div style={{
          padding: '20px',
          border: '1px solid #ddd',
          borderRadius: '8px',
          backgroundColor: '#fff'
        }}>
          <h3 style={{ margin: '0 0 15px', color: '#333' }}>Rendszer információ</h3>
          <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• SmartVoyager Iroda Desktop App</li>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• API kapcsolat aktív</li>
            <li style={{ padding: '8px 0', borderBottom: '1px solid #eee' }}>• Valós idejű adatszinkronizáció</li>
            <li style={{ padding: '8px 0' }}>• Biztonságos hitelesítés</li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default FullDashboard;
