import React, { useState, useEffect } from 'react';
import { CONFIG } from '../config';
import { getStatusColor, getStatusLabel, getStatusOptions } from '../utils/statusHelpers';

const ReservationsList = ({ onBack }) => {
  const [reservations, setReservations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);

  useEffect(() => {
    fetchReservations();
  }, [page]);

  const fetchReservations = async () => {
    setLoading(true);
    setError('');
    try {
      const token = localStorage.getItem('iroda_token');
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations?page=${page}&per_page=${CONFIG.DEFAULT_PAGE_SIZE}`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      });

      if (response.ok) {
        const data = await response.json();
        setReservations(data.data);
        setTotalPages(data.pagination.last_page);
      } else {
        setError('Hiba a foglalások betöltése közben');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
      console.error('Error fetching reservations:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleStatusUpdate = async (id, newStatus) => {
    try {
      const token = localStorage.getItem('iroda_token');
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations/${id}/update-status`, {
        method: 'PUT',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ status: newStatus }),
      });

      if (response.ok) {
        fetchReservations();
      } else {
        setError('Hiba a státusz frissítése közben');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
      console.error('Error updating status:', err);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Biztosan törli ezt a foglalást?')) {
      try {
        const token = localStorage.getItem('iroda_token');
        const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations/${id}`, {
          method: 'DELETE',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
        });

        if (response.ok) {
          fetchReservations();
        } else {
          setError('Hiba a foglalás törlése közben');
        }
      } catch (err) {
        setError('Hálózati hiba történt');
        console.error('Error deleting reservation:', err);
      }
    }
  };

  
  if (loading) {
    return (
      <div style={{ textAlign: 'center', marginTop: '50px' }}>
        <div>Foglalások betöltése...</div>
      </div>
    );
  }

  return (
    <div style={{ padding: '20px' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '30px' }}>
        <h1 style={{ margin: 0 }}>Foglalások kezelése</h1>
        <button
          onClick={onBack}
          style={{
            padding: '10px 20px',
            backgroundColor: '#666',
            color: 'white',
            border: 'none',
            borderRadius: '4px',
            cursor: 'pointer'
          }}
        >
          Vissza a vezérlőpultra
        </button>
      </div>

      {error && (
        <div style={{
          color: 'red',
          padding: '10px',
          backgroundColor: '#ffebee',
          border: '1px solid #f8bbd9',
          borderRadius: '4px',
          marginBottom: '20px'
        }}>
          {error}
        </div>
      )}

      <div style={{
        border: '1px solid #ddd',
        borderRadius: '8px',
        backgroundColor: '#fff',
        overflow: 'hidden'
      }}>
        <table style={{ width: '100%', borderCollapse: 'collapse' }}>
          <thead>
            <tr style={{ backgroundColor: '#f5f5f5' }}>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Név</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Email</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Létszám</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Státusz</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Műveletek</th>
            </tr>
          </thead>
          <tbody>
            {reservations.map((reservation) => (
              <tr key={reservation.id}>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>{reservation.full_name}</td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>{reservation.email}</td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>{reservation.people_count}</td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  <span style={{
                    padding: '4px 8px',
                    borderRadius: '4px',
                    backgroundColor: getStatusColor(reservation.status),
                    color: 'white',
                    fontSize: '12px'
                  }}>
                    {getStatusLabel(reservation.status)}
                  </span>
                </td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  <select
                    value={reservation.status}
                    onChange={(e) => handleStatusUpdate(reservation.id, e.target.value)}
                    style={{
                      padding: '5px',
                      marginRight: '10px',
                      border: '1px solid #ddd',
                      borderRadius: '4px'
                    }}
                  >
                    {getStatusOptions().map(option => (
                    <option key={option.value} value={option.value}>
                      {option.label}
                    </option>
                  ))}
                  </select>
                  <button
                    onClick={() => handleDelete(reservation.id)}
                    style={{
                      padding: '5px 10px',
                      backgroundColor: '#f44336',
                      color: 'white',
                      border: 'none',
                      borderRadius: '4px',
                      cursor: 'pointer',
                      fontSize: '12px'
                    }}
                  >
                    Törlés
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

      {totalPages > 1 && (
        <div style={{ textAlign: 'center', marginTop: '20px' }}>
          <button
            onClick={() => setPage(Math.max(1, page - 1))}
            disabled={page === 1}
            style={{
              padding: '8px 16px',
              marginRight: '10px',
              backgroundColor: page === 1 ? '#ccc' : '#1976d2',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: page === 1 ? 'not-allowed' : 'pointer'
            }}
          >
            Előző
          </button>
          <span style={{ margin: '0 10px' }}>
            Oldal {page} / {totalPages}
          </span>
          <button
            onClick={() => setPage(Math.min(totalPages, page + 1))}
            disabled={page === totalPages}
            style={{
              padding: '8px 16px',
              marginLeft: '10px',
              backgroundColor: page === totalPages ? '#ccc' : '#1976d2',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: page === totalPages ? 'not-allowed' : 'pointer'
            }}
          >
            Következő
          </button>
        </div>
      )}
    </div>
  );
};

export default ReservationsList;
