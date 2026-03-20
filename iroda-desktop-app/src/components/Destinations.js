import React, { useState, useEffect } from 'react';
import {
  Box,
  Paper,
  Typography,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Button,
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Pagination,
  Alert,
  CircularProgress,
  IconButton,
  Tooltip,
} from '@mui/material';
import {
  Edit,
  Delete,
  Add,
  Visibility,
} from '@mui/icons-material';
import { destinationsAPI } from '../api';

const Destinations = () => {
  const [destinations, setDestinations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [editDialog, setEditDialog] = useState({ open: false, destination: null, mode: 'view' });

  useEffect(() => {
    fetchDestinations();
  }, [page]);

  const fetchDestinations = async () => {
    setLoading(true);
    setError('');
    try {
      const response = await destinationsAPI.index({ page, per_page: 10 });
      setDestinations(response.data.data);
      setTotalPages(response.data.pagination.last_page);
    } catch (err) {
      setError('Hiba az úticélok betöltése közben');
      console.error('Error fetching destinations:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleSave = async () => {
    try {
      const formData = {
        slug: editDialog.destination.slug,
        title: editDialog.destination.title,
        price_huf: parseInt(editDialog.destination.price_huf),
        start_date: editDialog.destination.start_date || null,
        end_date: editDialog.destination.end_date || null,
        image_path: editDialog.destination.image_path,
        image2_path: editDialog.destination.image2_path || null,
        detail_url: editDialog.destination.detail_url || null,
        leiras: editDialog.destination.leiras || null,
      };

      if (editDialog.mode === 'create') {
        await destinationsAPI.store(formData);
      } else {
        await destinationsAPI.update(editDialog.destination.id, formData);
      }

      setEditDialog({ open: false, destination: null, mode: 'view' });
      fetchDestinations();
    } catch (err) {
      setError('Hiba a mentés közben');
      console.error('Error saving destination:', err);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Biztosan törli ezt az úticélt?')) {
      try {
        await destinationsAPI.delete(id);
        fetchDestinations();
      } catch (err) {
        setError('Hiba az úticél törlése közben');
        console.error('Error deleting destination:', err);
      }
    }
  };

  const handleCreate = () => {
    setEditDialog({
      open: true,
      destination: {
        slug: '',
        title: '',
        price_huf: '',
        start_date: '',
        end_date: '',
        image_path: '',
        image2_path: '',
        detail_url: '',
        leiras: '',
      },
      mode: 'create',
    });
  };

  const handleEdit = (destination) => {
    setEditDialog({
      open: true,
      destination: { ...destination },
      mode: 'edit',
    });
  };

  const handleView = (destination) => {
    setEditDialog({
      open: true,
      destination: { ...destination },
      mode: 'view',
    });
  };

  if (loading) {
    return (
      <Box display="flex" justifyContent="center" alignItems="center" height="400px">
        <CircularProgress />
      </Box>
    );
  }

  return (
    <Box>
      <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', mb: 3 }}>
        <Typography variant="h4">
          Úticélok kezelése
        </Typography>
        <Button
          variant="contained"
          startIcon={<Add />}
          onClick={handleCreate}
        >
          Új úticél
        </Button>
      </Box>

      {error && (
        <Alert severity="error" sx={{ mb: 2 }} onClose={() => setError('')}>
          {error}
        </Alert>
      )}

      <Paper sx={{ p: 2 }}>
        <TableContainer>
          <Table>
            <TableHead>
              <TableRow>
                <TableCell>Cím</TableCell>
                <TableCell>Slug</TableCell>
                <TableCell>Ár (HUF)</TableCell>
                <TableCell>Kezdő dátum</TableCell>
                <TableCell>Vég dátum</TableCell>
                <TableCell>Műveletek</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {destinations.map((destination) => (
                <TableRow key={destination.id}>
                  <TableCell>{destination.title}</TableCell>
                  <TableCell>
                    <code>{destination.slug}</code>
                  </TableCell>
                  <TableCell>
                    {new Intl.NumberFormat('hu-HU').format(destination.price_huf)} Ft
                  </TableCell>
                  <TableCell>
                    {destination.start_date ? new Date(destination.start_date).toLocaleDateString('hu-HU') : '-'}
                  </TableCell>
                  <TableCell>
                    {destination.end_date ? new Date(destination.end_date).toLocaleDateString('hu-HU') : '-'}
                  </TableCell>
                  <TableCell>
                    <Box sx={{ display: 'flex', gap: 1 }}>
                      <Tooltip title="Részletek">
                        <IconButton
                          size="small"
                          onClick={() => handleView(destination)}
                        >
                          <Visibility />
                        </IconButton>
                      </Tooltip>
                      <Tooltip title="Szerkesztés">
                        <IconButton
                          size="small"
                          onClick={() => handleEdit(destination)}
                        >
                          <Edit />
                        </IconButton>
                      </Tooltip>
                      <Tooltip title="Törlés">
                        <IconButton
                          size="small"
                          color="error"
                          onClick={() => handleDelete(destination.id)}
                        >
                          <Delete />
                        </IconButton>
                      </Tooltip>
                    </Box>
                  </TableCell>
                </TableRow>
              ))}
            </TableBody>
          </Table>
        </TableContainer>

        <Box sx={{ display: 'flex', justifyContent: 'center', mt: 2 }}>
          <Pagination
            count={totalPages}
            page={page}
            onChange={(event, value) => setPage(value)}
            color="primary"
          />
        </Box>
      </Paper>

      {/* Create/Edit/View Dialog */}
      <Dialog 
        open={editDialog.open} 
        onClose={() => setEditDialog({ open: false, destination: null, mode: 'view' })}
        maxWidth="md"
        fullWidth
      >
        <DialogTitle>
          {editDialog.mode === 'create' ? 'Új úticél létrehozása' :
           editDialog.mode === 'edit' ? 'Úticél szerkesztése' : 'Úticél részletei'}
        </DialogTitle>
        <DialogContent>
          <Box sx={{ pt: 2, display: 'flex', flexDirection: 'column', gap: 2 }}>
            <TextField
              fullWidth
              label="Slug"
              value={editDialog.destination?.slug || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, slug: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
              helperText="URL-barán használható azonosító"
            />
            <TextField
              fullWidth
              label="Cím"
              value={editDialog.destination?.title || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, title: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
            />
            <TextField
              fullWidth
              label="Ár (HUF)"
              type="number"
              value={editDialog.destination?.price_huf || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, price_huf: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
            />
            <TextField
              fullWidth
              label="Kezdő dátum"
              type="date"
              value={editDialog.destination?.start_date || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, start_date: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
              InputLabelProps={{ shrink: true }}
            />
            <TextField
              fullWidth
              label="Vég dátum"
              type="date"
              value={editDialog.destination?.end_date || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, end_date: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
              InputLabelProps={{ shrink: true }}
            />
            <TextField
              fullWidth
              label="Kép elérési út"
              value={editDialog.destination?.image_path || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, image_path: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
              helperText="/oldal/images/ mappa relatív útja"
            />
            <TextField
              fullWidth
              label="2. kép elérési út"
              value={editDialog.destination?.image2_path || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, image2_path: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
            />
            <TextField
              fullWidth
              label="Részletek URL"
              value={editDialog.destination?.detail_url || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, detail_url: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
            />
            <TextField
              fullWidth
              multiline
              rows={4}
              label="Leírás"
              value={editDialog.destination?.leiras || ''}
              onChange={(e) => setEditDialog({
                ...editDialog,
                destination: { ...editDialog.destination, leiras: e.target.value }
              })}
              disabled={editDialog.mode === 'view'}
            />
          </Box>
        </DialogContent>
        <DialogActions>
          <Button onClick={() => setEditDialog({ open: false, destination: null, mode: 'view' })}>
            {editDialog.mode === 'view' ? 'Bezárás' : 'Mégse'}
          </Button>
          {editDialog.mode !== 'view' && (
            <Button onClick={handleSave} variant="contained">
              Mentés
            </Button>
          )}
        </DialogActions>
      </Dialog>
    </Box>
  );
};

export default Destinations;
