import React, { useState, useEffect } from 'react';
import { CONFIG } from '../config';
import { getStatusColor, getStatusLabel, getStatusOptions } from '../utils/statusHelpers';

const EnhancedReservations = ({ onBack }) => {
  const [reservations, setReservations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [editingReservation, setEditingReservation] = useState(null);
  const [showEditForm, setShowEditForm] = useState(false);

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

  const handleStatusUpdate = async (id, newStatus, adminNotes = '') => {
    try {
      const token = localStorage.getItem('iroda_token');
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations/${id}/update-status`, {
        method: 'PUT',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({ status: newStatus, admin_notes: adminNotes }),
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

  const handleDetailsUpdate = async (id, details) => {
    try {
      const token = localStorage.getItem('iroda_token');
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations/${id}/details`, {
        method: 'PUT',
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(details),
      });

      if (response.ok) {
        setShowEditForm(false);
        setEditingReservation(null);
        fetchReservations();
      } else {
        const errorData = await response.json();
        setError(errorData.message || 'Hiba a részletek frissítése közben');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
      console.error('Error updating details:', err);
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

  const handleEdit = (reservation) => {
    setEditingReservation(reservation);
    setShowEditForm(true);
  };

  
  if (showEditForm) {
    return <ReservationEditForm 
      reservation={editingReservation}
      onSave={handleDetailsUpdate}
      onCancel={() => {
        setShowEditForm(false);
        setEditingReservation(null);
      }}
    />;
  }

  if (loading) {
    return (
      <div style={{ textAlign: 'center', marginTop: '50px' }}>
        <div style={{
          display: 'inline-block',
          padding: '20px',
          backgroundColor: '#f5f5f5',
          borderRadius: '8px'
        }}>
          <div style={{
            width: '40px',
            height: '40px',
            border: '4px solid #1976d2',
            borderTop: '4px solid transparent',
            borderRadius: '50%',
            animation: 'spin 1s linear infinite',
            margin: '0 auto'
          }}></div>
          <p style={{ marginTop: '15px', color: '#666' }}>Foglalások betöltése...</p>
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
      <div style={{ 
        display: 'flex', 
        justifyContent: 'space-between', 
        alignItems: 'center', 
        marginBottom: '32px',
        paddingBottom: '16px',
        borderBottom: '2px solid #e0e0e0'
      }}>
        <div>
          <h1 style={{ 
            margin: 0, 
            color: '#333',
            fontSize: '32px',
            fontWeight: '600'
          }}>
            Foglalások kezelése
          </h1>
          <p style={{ 
            margin: '8px 0 0', 
            color: '#666',
            fontSize: '14px'
          }}>
            Összesen: {reservations.length} foglalás
          </p>
        </div>
        <button
          onClick={onBack}
          style={{
            padding: '12px 24px',
            backgroundColor: '#6c757d',
            color: 'white',
            border: 'none',
            borderRadius: '8px',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: '500',
            transition: 'all 0.3s ease',
            boxShadow: '0 2px 4px rgba(0,0,0,0.1)'
          }}
          onMouseOver={(e) => {
            e.target.style.backgroundColor = '#5a6268';
            e.target.style.transform = 'translateY(-1px)';
          }}
          onMouseOut={(e) => {
            e.target.style.backgroundColor = '#6c757d';
            e.target.style.transform = 'translateY(0)';
          }}
        >
          ← Vissza a vezérlőpultra
        </button>
      </div>

      {error && (
        <div style={{
          color: '#d32f2f',
          padding: '16px',
          backgroundColor: '#ffebee',
          border: '1px solid #ffcdd2',
          borderRadius: '8px',
          marginBottom: '24px',
          fontSize: '14px',
          display: 'flex',
          alignItems: 'center',
          gap: '8px'
        }}>
          <span style={{ fontSize: '18px' }}>⚠</span>
          {error}
        </div>
      )}

      <div style={{
        backgroundColor: 'white',
        borderRadius: '12px',
        boxShadow: '0 4px 12px rgba(0,0,0,0.1)',
        overflow: 'hidden'
      }}>
        <div style={{ overflowX: 'auto' }}>
          <table style={{ width: '100%', borderCollapse: 'collapse' }}>
            <thead>
              <tr style={{ backgroundColor: '#f8f9fa' }}>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Név</th>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Email</th>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Telefon</th>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Létszám</th>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Státusz</th>
                <th style={{ padding: '16px', textAlign: 'left', borderBottom: '2px solid #e0e0e0', color: '#333', fontWeight: '600' }}>Műveletek</th>
              </tr>
            </thead>
            <tbody>
              {reservations.map((reservation, index) => (
                <tr key={reservation.id} style={{ 
                  backgroundColor: index % 2 === 0 ? 'white' : '#f8f9fa',
                  transition: 'background-color 0.2s ease'
                }}>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0' }}>
                    <div style={{ fontWeight: '500', color: '#333' }}>{reservation.full_name}</div>
                  </td>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0', color: '#666' }}>
                    {reservation.email}
                  </td>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0', color: '#666' }}>
                    {reservation.phone || '-'}
                  </td>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0' }}>
                    <span style={{
                      padding: '4px 8px',
                      backgroundColor: '#e3f2fd',
                      color: '#1976d2',
                      borderRadius: '4px',
                      fontSize: '12px',
                      fontWeight: '500'
                    }}>
                      {reservation.people_count} fő
                    </span>
                  </td>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0' }}>
                    <span style={{
                      padding: '6px 12px',
                      borderRadius: '6px',
                      backgroundColor: getStatusColor(reservation.status),
                      color: 'white',
                      fontSize: '12px',
                      fontWeight: '500',
                      textTransform: 'uppercase'
                    }}>
                      {getStatusLabel(reservation.status)}
                    </span>
                  </td>
                  <td style={{ padding: '16px', borderBottom: '1px solid #e0e0e0' }}>
                    <div style={{ display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                      <button
                        onClick={() => handleEdit(reservation)}
                        style={{
                          padding: '6px 12px',
                          backgroundColor: '#1976d2',
                          color: 'white',
                          border: 'none',
                          borderRadius: '6px',
                          cursor: 'pointer',
                          fontSize: '12px',
                          fontWeight: '500',
                          transition: 'all 0.2s ease'
                        }}
                        onMouseOver={(e) => {
                          e.target.style.backgroundColor = '#1565c0';
                        }}
                        onMouseOut={(e) => {
                          e.target.style.backgroundColor = '#1976d2';
                        }}
                      >
                        ✏️ Szerkesztés
                      </button>
                      <select
                        value={reservation.status}
                        onChange={(e) => handleStatusUpdate(reservation.id, e.target.value)}
                        style={{
                          padding: '6px 8px',
                          border: '1px solid #ddd',
                          borderRadius: '6px',
                          fontSize: '12px',
                          cursor: 'pointer'
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
                          padding: '6px 12px',
                          backgroundColor: '#f44336',
                          color: 'white',
                          border: 'none',
                          borderRadius: '6px',
                          cursor: 'pointer',
                          fontSize: '12px',
                          fontWeight: '500',
                          transition: 'all 0.2s ease'
                        }}
                        onMouseOver={(e) => {
                          e.target.style.backgroundColor = '#d32f2f';
                        }}
                        onMouseOut={(e) => {
                          e.target.style.backgroundColor = '#f44336';
                        }}
                      >
                        🗑️ Törlés
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>

      {totalPages > 1 && (
        <div style={{ textAlign: 'center', marginTop: '24px' }}>
          <button
            onClick={() => setPage(Math.max(1, page - 1))}
            disabled={page === 1}
            style={{
              padding: '10px 20px',
              marginRight: '10px',
              backgroundColor: page === 1 ? '#e0e0e0' : '#1976d2',
              color: page === 1 ? '#999' : 'white',
              border: 'none',
              borderRadius: '8px',
              cursor: page === 1 ? 'not-allowed' : 'pointer',
              fontSize: '14px',
              fontWeight: '500',
              transition: 'all 0.3s ease'
            }}
          >
            ← Előző
          </button>
          <span style={{ 
            margin: '0 16px',
            padding: '8px 16px',
            backgroundColor: '#f5f5f5',
            borderRadius: '8px',
            fontSize: '14px',
            fontWeight: '500'
          }}>
            Oldal {page} / {totalPages}
          </span>
          <button
            onClick={() => setPage(Math.min(totalPages, page + 1))}
            disabled={page === totalPages}
            style={{
              padding: '10px 20px',
              marginLeft: '10px',
              backgroundColor: page === totalPages ? '#e0e0e0' : '#1976d2',
              color: page === totalPages ? '#999' : 'white',
              border: 'none',
              borderRadius: '8px',
              cursor: page === totalPages ? 'not-allowed' : 'pointer',
              fontSize: '14px',
              fontWeight: '500',
              transition: 'all 0.3s ease'
            }}
          >
            Következő →
          </button>
        </div>
      )}
    </div>
  );
};

const ReservationEditForm = ({ reservation, onSave, onCancel }) => {
  const [formData, setFormData] = useState({
    full_name: '',
    email: '',
    phone: '',
    address: '',
    people_count: 1,
    note: '',
  });

  useEffect(() => {
    if (reservation) {
      setFormData({
        full_name: reservation.full_name || '',
        email: reservation.email || '',
        phone: reservation.phone || '',
        address: reservation.address || '',
        people_count: reservation.people_count || 1,
        note: reservation.note || '',
      });
    }
  }, [reservation]);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.type === 'number' ? parseInt(e.target.value) : e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSave(reservation.id, formData);
  };

  return (
    <div style={{ padding: '24px', fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif' }}>
      <div style={{ 
        display: 'flex', 
        justifyContent: 'space-between', 
        alignItems: 'center', 
        marginBottom: '32px',
        paddingBottom: '16px',
        borderBottom: '2px solid #e0e0e0'
      }}>
        <h2 style={{ margin: 0, color: '#333', fontSize: '28px', fontWeight: '600' }}>
          Foglalás szerkesztése
        </h2>
        <button
          onClick={onCancel}
          style={{
            padding: '12px 24px',
            backgroundColor: '#6c757d',
            color: 'white',
            border: 'none',
            borderRadius: '8px',
            cursor: 'pointer',
            fontSize: '14px',
            fontWeight: '500'
          }}
        >
          Mégse
        </button>
      </div>

      <form onSubmit={handleSubmit} style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '20px', maxWidth: '800px' }}>
        <div>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Teljes név *
          </label>
          <input
            type="text"
            name="full_name"
            value={formData.full_name}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Email *
          </label>
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Telefonszám
          </label>
          <input
            type="tel"
            name="phone"
            value={formData.phone}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Létszám *
          </label>
          <input
            type="number"
            name="people_count"
            value={formData.people_count}
            onChange={handleChange}
            min="1"
            required
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box'
            }}
          />
        </div>

        <div style={{ gridColumn: '1 / -1' }}>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Cím
          </label>
          <input
            type="text"
            name="address"
            value={formData.address}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box'
            }}
          />
        </div>

        <div style={{ gridColumn: '1 / -1' }}>
          <label style={{ display: 'block', marginBottom: '8px', color: '#333', fontSize: '14px', fontWeight: '500' }}>
            Megjegyzés
          </label>
          <textarea
            name="note"
            value={formData.note}
            onChange={handleChange}
            rows={4}
            style={{
              width: '100%',
              padding: '12px',
              border: '2px solid #e0e0e0',
              borderRadius: '8px',
              fontSize: '14px',
              boxSizing: 'border-box',
              resize: 'vertical'
            }}
          />
        </div>

        <div style={{ gridColumn: '1 / -1', display: 'flex', gap: '12px', marginTop: '20px' }}>
          <button
            type="submit"
            style={{
              padding: '14px 28px',
              backgroundColor: '#4caf50',
              color: 'white',
              border: 'none',
              borderRadius: '8px',
              cursor: 'pointer',
              fontSize: '16px',
              fontWeight: '500',
              transition: 'all 0.3s ease'
            }}
            onMouseOver={(e) => {
              e.target.style.backgroundColor = '#45a049';
            }}
            onMouseOut={(e) => {
              e.target.style.backgroundColor = '#4caf50';
            }}
          >
            💾 Mentés
          </button>
          <button
            type="button"
            onClick={onCancel}
            style={{
              padding: '14px 28px',
              backgroundColor: '#6c757d',
              color: 'white',
              border: 'none',
              borderRadius: '8px',
              cursor: 'pointer',
              fontSize: '16px',
              fontWeight: '500'
            }}
          >
            Mégse
          </button>
        </div>
      </form>
    </div>
  );
};

export default EnhancedReservations;
