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
  Chip,
  Dialog,
  DialogTitle,
  DialogContent,
  DialogActions,
  TextField,
  Select,
  MenuItem,
  FormControl,
  InputLabel,
  Pagination,
  Alert,
  CircularProgress,
  IconButton,
  Tooltip,
} from '@mui/material';
import {
  Edit,
  Delete,
  Email,
  Visibility,
} from '@mui/icons-material';
import { reservationsAPI } from '../api';

const Reservations = () => {
  const [reservations, setReservations] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [editDialog, setEditDialog] = useState({ open: false, reservation: null });
  const [statusDialog, setStatusDialog] = useState({ open: false, reservation: null });
  const [emailDialog, setEmailDialog] = useState({ open: false, reservation: null, message: '' });

  useEffect(() => {
    fetchReservations();
  }, [page]);

  const fetchReservations = async () => {
    setLoading(true);
    setError('');
    try {
      const response = await reservationsAPI.index({ page, per_page: 10 });
      setReservations(response.data.data);
      setTotalPages(response.data.pagination.last_page);
    } catch (err) {
      setError('Hiba a foglalások betöltése közben');
      console.error('Error fetching reservations:', err);
    } finally {
      setLoading(false);
    }
  };

  const handleStatusUpdate = async () => {
    try {
      await reservationsAPI.updateStatus(statusDialog.reservation.id, {
        status: statusDialog.status,
        admin_notes: statusDialog.admin_notes || '',
      });
      setStatusDialog({ open: false, reservation: null, status: '', admin_notes: '' });
      fetchReservations();
    } catch (err) {
      setError('Hiba a státusz frissítése közben');
      console.error('Error updating status:', err);
    }
  };

  const handleSendEmail = async () => {
    try {
      await reservationsAPI.sendEmail(emailDialog.reservation.id, {
        message: emailDialog.message,
      });
      setEmailDialog({ open: false, reservation: null, message: '' });
      fetchReservations();
    } catch (err) {
      setError('Hiba az email küldése közben');
      console.error('Error sending email:', err);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Biztosan törli ezt a foglalást?')) {
      try {
        await reservationsAPI.delete(id);
        fetchReservations();
      } catch (err) {
        setError('Hiba a foglalás törlése közben');
        console.error('Error deleting reservation:', err);
      }
    }
  };

  const getStatusColor = (status) => {
    switch (status) {
      case 'pending': return 'warning';
      case 'confirmed': return 'success';
      case 'cancelled': return 'error';
      default: return 'default';
    }
  };

  const getStatusLabel = (status) => {
    switch (status) {
      case 'pending': return 'Függőben';
      case 'confirmed': return 'Megerősítve';
      case 'cancelled': return 'Törölve';
      default: return status;
    }
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
      <Typography variant="h4" gutterBottom>
        Foglalások kezelése
      </Typography>

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
                <TableCell>Név</TableCell>
                <TableCell>Email</TableCell>
                <TableCell>Úti cél</TableCell>
                <TableCell>Létszám</TableCell>
                <TableCell>Státusz</TableCell>
                <TableCell>Email küldve</TableCell>
                <TableCell>Műveletek</TableCell>
              </TableRow>
            </TableHead>
            <TableBody>
              {reservations.map((reservation) => (
                <TableRow key={reservation.id}>
                  <TableCell>{reservation.full_name}</TableCell>
                  <TableCell>{reservation.email}</TableCell>
                  <TableCell>
                    {reservation.destination?.title || '-'}
                  </TableCell>
                  <TableCell>{reservation.people_count}</TableCell>
                  <TableCell>
                    <Chip
                      label={getStatusLabel(reservation.status)}
                      color={getStatusColor(reservation.status)}
                      size="small"
                    />
                  </TableCell>
                  <TableCell>
                    {reservation.email_sent ? (
                      <Chip label="Igen" color="success" size="small" />
                    ) : (
                      <Chip label="Nem" color="default" size="small" />
                    )}
                  </TableCell>
                  <TableCell>
                    <Box sx={{ display: 'flex', gap: 1 }}>
                      <Tooltip title="Részletek">
                        <IconButton
                          size="small"
                          onClick={() => setEditDialog({ open: true, reservation })}
                        >
                          <Visibility />
                        </IconButton>
                      </Tooltip>
                      <Tooltip title="Státusz módosítása">
                        <IconButton
                          size="small"
                          onClick={() => setStatusDialog({ 
                            open: true, 
                            reservation, 
                            status: reservation.status,
                            admin_notes: reservation.admin_notes || ''
                          })}
                        >
                          <Edit />
                        </IconButton>
                      </Tooltip>
                      <Tooltip title="Email küldése">
                        <IconButton
                          size="small"
                          onClick={() => setEmailDialog({ 
                            open: true, 
                            reservation, 
                            message: '' 
                          })}
                        >
                          <Email />
                        </IconButton>
                      </Tooltip>
                      <Tooltip title="Törlés">
                        <IconButton
                          size="small"
                          color="error"
                          onClick={() => handleDelete(reservation.id)}
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

      {/* Status Update Dialog */}
      <Dialog open={statusDialog.open} onClose={() => setStatusDialog({ open: false, reservation: null, status: '', admin_notes: '' })}>
        <DialogTitle>Státusz módosítása</DialogTitle>
        <DialogContent>
          <Box sx={{ pt: 2, minWidth: 400 }}>
            <FormControl fullWidth sx={{ mb: 2 }}>
              <InputLabel>Új státusz</InputLabel>
              <Select
                value={statusDialog.status}
                onChange={(e) => setStatusDialog({ ...statusDialog, status: e.target.value })}
              >
                <MenuItem value="pending">Függőben</MenuItem>
                <MenuItem value="confirmed">Megerősítve</MenuItem>
                <MenuItem value="cancelled">Törölve</MenuItem>
              </Select>
            </FormControl>
            <TextField
              fullWidth
              multiline
              rows={3}
              label="Admin megjegyzés"
              value={statusDialog.admin_notes}
              onChange={(e) => setStatusDialog({ ...statusDialog, admin_notes: e.target.value })}
            />
          </Box>
        </DialogContent>
        <DialogActions>
          <Button onClick={() => setStatusDialog({ open: false, reservation: null, status: '', admin_notes: '' })}>
            Mégse
          </Button>
          <Button onClick={handleStatusUpdate} variant="contained">
            Mentés
          </Button>
        </DialogActions>
      </Dialog>

      {/* Email Dialog */}
      <Dialog open={emailDialog.open} onClose={() => setEmailDialog({ open: false, reservation: null, message: '' })}>
        <DialogTitle>Email küldése</DialogTitle>
        <DialogContent>
          <Box sx={{ pt: 2, minWidth: 400 }}>
            <TextField
              fullWidth
              multiline
              rows={6}
              label="Üzenet"
              value={emailDialog.message}
              onChange={(e) => setEmailDialog({ ...emailDialog, message: e.target.value })}
              placeholder="Írja meg az üzenetet az ügyfélnek..."
            />
          </Box>
        </DialogContent>
        <DialogActions>
          <Button onClick={() => setEmailDialog({ open: false, reservation: null, message: '' })}>
            Mégse
          </Button>
          <Button onClick={handleSendEmail} variant="contained">
            Küldés
          </Button>
        </DialogActions>
      </Dialog>

      {/* Details Dialog */}
      <Dialog open={editDialog.open} onClose={() => setEditDialog({ open: false, reservation: null })}>
        <DialogTitle>Foglalás részletei</DialogTitle>
        <DialogContent>
          <Box sx={{ pt: 2, minWidth: 400 }}>
            <Typography variant="body1" gutterBottom>
              <strong>Név:</strong> {editDialog.reservation?.full_name}
            </Typography>
            <Typography variant="body1" gutterBottom>
              <strong>Email:</strong> {editDialog.reservation?.email}
            </Typography>
            <Typography variant="body1" gutterBottom>
              <strong>Telefon:</strong> {editDialog.reservation?.phone || '-'}
            </Typography>
            <Typography variant="body1" gutterBottom>
              <strong>Cím:</strong> {editDialog.reservation?.address || '-'}
            </Typography>
            <Typography variant="body1" gutterBottom>
              <strong>Létszám:</strong> {editDialog.reservation?.people_count}
            </Typography>
            <Typography variant="body1" gutterBottom>
              <strong>Úti cél:</strong> {editDialog.reservation?.destination?.title || '-'}
            </Typography>
            {editDialog.reservation?.note && (
              <Typography variant="body1" gutterBottom>
                <strong>Megjegyzés:</strong> {editDialog.reservation.note}
              </Typography>
            )}
          </Box>
        </DialogContent>
        <DialogActions>
          <Button onClick={() => setEditDialog({ open: false, reservation: null })}>
            Bezárás
          </Button>
        </DialogActions>
      </Dialog>
    </Box>
  );
};

export default Reservations;
