import React, { useState, useEffect } from 'react';
import { CONFIG } from '../config';

const DestinationsList = ({ onBack }) => {
  const [destinations, setDestinations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [showCreateForm, setShowCreateForm] = useState(false);
  const [editingDestination, setEditingDestination] = useState(null);

  useEffect(() => {
    fetchDestinations();
  }, [page]);

  const fetchDestinations = async () => {
    setLoading(true);
    setError('');
    try {
      const token = localStorage.getItem('iroda_token');
      const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/destinations?page=${page}&per_page=${CONFIG.DEFAULT_PAGE_SIZE}`, {
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      });

      if (response.ok) {
        const data = await response.json();
        setDestinations(data.data);
        setTotalPages(data.pagination.last_page);
      } else {
        setError('Hiba az úticélok betöltése közben');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
      console.error('Error fetching destinations:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleSave = async (destinationData) => {
    try {
      const token = localStorage.getItem('iroda_token');
      const url = editingDestination 
        ? `${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/destinations/${editingDestination.id}`
        : `${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/destinations`;
      
      const method = editingDestination ? 'PUT' : 'POST';
      
      const response = await fetch(url, {
        method,
        headers: {
          'Authorization': `Bearer ${token}`,
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(destinationData),
      });

      if (response.ok) {
        setShowCreateForm(false);
        setEditingDestination(null);
        fetchDestinations();
      } else {
        setError('Hiba a mentés közben');
      }
    } catch (err) {
      setError('Hálózati hiba történt');
      console.error('Error saving destination:', err);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Biztosan törli ezt az úticélt?')) {
      try {
        const token = localStorage.getItem('iroda_token');
        const response = await fetch(`${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/destinations/${id}`, {
          method: 'DELETE',
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
          },
        });

        if (response.ok) {
          fetchDestinations();
        } else {
          setError('Hiba az úticél törlése közben');
        }
      } catch (err) {
        setError('Hálózati hiba történt');
        console.error('Error deleting destination:', err);
      }
    }
  };

  const handleEdit = (destination) => {
    setEditingDestination(destination);
    setShowCreateForm(true);
  };

  if (showCreateForm) {
    return <DestinationForm 
      destination={editingDestination}
      onSave={handleSave}
      onCancel={() => {
        setShowCreateForm(false);
        setEditingDestination(null);
      }}
    />;
  }

  if (loading) {
    return (
      <div style={{ textAlign: 'center', marginTop: '50px' }}>
        <div>Úticélok betöltése...</div>
      </div>
    );
  }

  return (
    <div style={{ padding: '20px' }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '30px' }}>
        <h1 style={{ margin: 0 }}>Úticélok kezelése</h1>
        <div style={{ display: 'flex', gap: '10px' }}>
          <button
            onClick={() => setShowCreateForm(true)}
            style={{
              padding: '10px 20px',
              backgroundColor: '#4caf50',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Új úticél
          </button>
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
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Cím</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Slug</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Ár (HUF)</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Kezdő dátum</th>
              <th style={{ padding: '15px', textAlign: 'left', borderBottom: '1px solid #ddd' }}>Műveletek</th>
            </tr>
          </thead>
          <tbody>
            {destinations.map((destination) => (
              <tr key={destination.id}>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>{destination.title}</td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  <code style={{ backgroundColor: '#f5f5f5', padding: '2px 4px', borderRadius: '2px' }}>
                    {destination.slug}
                  </code>
                </td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  {new Intl.NumberFormat('hu-HU').format(destination.price_huf)} Ft
                </td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  {destination.start_date ? new Date(destination.start_date).toLocaleDateString('hu-HU') : '-'}
                </td>
                <td style={{ padding: '15px', borderBottom: '1px solid #eee' }}>
                  <button
                    onClick={() => handleEdit(destination)}
                    style={{
                      padding: '5px 10px',
                      marginRight: '10px',
                      backgroundColor: '#1976d2',
                      color: 'white',
                      border: 'none',
                      borderRadius: '4px',
                      cursor: 'pointer',
                      fontSize: '12px'
                    }}
                  >
                    Szerkesztés
                  </button>
                  <button
                    onClick={() => handleDelete(destination.id)}
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

const DestinationForm = ({ destination, onSave, onCancel }) => {
  const [formData, setFormData] = useState({
    slug: '',
    title: '',
    price_huf: '',
    start_date: '',
    end_date: '',
    image_path: '',
    image2_path: '',
    detail_url: '',
    leiras: '',
  });

  useEffect(() => {
    if (destination) {
      setFormData(destination);
    }
  }, [destination]);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSave({
      ...formData,
      price_huf: parseInt(formData.price_huf),
    });
  };

  return (
    <div style={{ padding: '20px' }}>
      <h2>{destination ? 'Úticél szerkesztése' : 'Új úticél létrehozása'}</h2>
      
      <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '15px', maxWidth: '600px' }}>
        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Slug:</label>
          <input
            type="text"
            name="slug"
            value={formData.slug}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Cím:</label>
          <input
            type="text"
            name="title"
            value={formData.title}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Ár (HUF):</label>
          <input
            type="number"
            name="price_huf"
            value={formData.price_huf}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Kezdő dátum:</label>
          <input
            type="date"
            name="start_date"
            value={formData.start_date}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Vég dátum:</label>
          <input
            type="date"
            name="end_date"
            value={formData.end_date}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Kép elérési út:</label>
          <input
            type="text"
            name="image_path"
            value={formData.image_path}
            onChange={handleChange}
            required
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>2. kép elérési út:</label>
          <input
            type="text"
            name="image2_path"
            value={formData.image2_path}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Részletek URL:</label>
          <input
            type="text"
            name="detail_url"
            value={formData.detail_url}
            onChange={handleChange}
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div>
          <label style={{ display: 'block', marginBottom: '5px' }}>Leírás:</label>
          <textarea
            name="leiras"
            value={formData.leiras}
            onChange={handleChange}
            rows={4}
            style={{
              width: '100%',
              padding: '8px',
              border: '1px solid #ddd',
              borderRadius: '4px'
            }}
          />
        </div>

        <div style={{ display: 'flex', gap: '10px' }}>
          <button
            type="submit"
            style={{
              padding: '10px 20px',
              backgroundColor: '#4caf50',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Mentés
          </button>
          <button
            type="button"
            onClick={onCancel}
            style={{
              padding: '10px 20px',
              backgroundColor: '#666',
              color: 'white',
              border: 'none',
              borderRadius: '4px',
              cursor: 'pointer'
            }}
          >
            Mégse
          </button>
        </div>
      </form>
    </div>
  );
};

export default DestinationsList;
