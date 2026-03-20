import React, { useState, useEffect } from 'react';
import {
  Grid,
  Paper,
  Typography,
  Box,
  Card,
  CardContent,
  CircularProgress,
} from '@mui/material';
import {
  Bookings,
  LocationOn,
  TrendingUp,
  People,
} from '@mui/icons-material';
import { reservationsAPI, destinationsAPI } from '../api';

const Dashboard = ({ user }) => {
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
      const [reservationsResponse, destinationsResponse] = await Promise.all([
        reservationsAPI.index({ per_page: 1 }),
        destinationsAPI.index({ per_page: 1 }),
      ]);

      const reservations = reservationsResponse.data.data;
      const destinationsTotal = destinationsResponse.data.pagination.total;

      const pendingCount = reservations.filter(r => r.status === 'pending').length;
      const confirmedCount = reservations.filter(r => r.status === 'confirmed').length;

      setStats({
        totalReservations: reservationsResponse.data.pagination.total,
        pendingReservations: pendingCount,
        confirmedReservations: confirmedCount,
        totalDestinations: destinationsTotal,
      });
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
      icon: <Bookings sx={{ fontSize: 40 }} />,
      color: '#1976d2',
    },
    {
      title: 'Függőben lévő',
      value: stats.pendingReservations,
      icon: <TrendingUp sx={{ fontSize: 40 }} />,
      color: '#ff9800',
    },
    {
      title: 'Megerősített',
      value: stats.confirmedReservations,
      icon: <People sx={{ fontSize: 40 }} />,
      color: '#4caf50',
    },
    {
      title: 'Úticélok',
      value: stats.totalDestinations,
      icon: <LocationOn sx={{ fontSize: 40 }} />,
      color: '#9c27b0',
    },
  ];

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
        Üdvözöljük, {user.name}!
      </Typography>
      <Typography variant="body1" color="text.secondary" gutterBottom>
        {user.is_iroda ? 'Iroda felhasználó' : 'Admin felhasználó'}
      </Typography>

      <Grid container spacing={3} sx={{ mt: 2 }}>
        {statCards.map((card, index) => (
          <Grid item xs={12} sm={6} md={3} key={index}>
            <Card
              sx={{
                height: '100%',
                display: 'flex',
                flexDirection: 'column',
                '&:hover': {
                  boxShadow: 4,
                  transform: 'translateY(-2px)',
                  transition: 'all 0.2s ease-in-out',
                },
              }}
            >
              <CardContent sx={{ flexGrow: 1 }}>
                <Box
                  sx={{
                    display: 'flex',
                    alignItems: 'center',
                    mb: 2,
                  }}
                >
                  <Box
                    sx={{
                      p: 1,
                      borderRadius: 1,
                      backgroundColor: `${card.color}20`,
                      color: card.color,
                      mr: 2,
                    }}
                  >
                    {card.icon}
                  </Box>
                  <Typography variant="h6" component="div">
                    {card.title}
                  </Typography>
                </Box>
                <Typography variant="h3" component="div" sx={{ fontWeight: 'bold' }}>
                  {card.value}
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        ))}
      </Grid>

      <Grid container spacing={3} sx={{ mt: 3 }}>
        <Grid item xs={12} md={6}>
          <Paper sx={{ p: 3 }}>
            <Typography variant="h6" gutterBottom>
              Gyors műveletek
            </Typography>
            <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Typography variant="body2" color="text.secondary">
                • Új foglalások kezelése
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • Státusz módosítások
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • Email küldés ügyfeleknek
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • Úticélok szerkesztése
              </Typography>
            </Box>
          </Paper>
        </Grid>
        <Grid item xs={12} md={6}>
          <Paper sx={{ p: 3 }}>
            <Typography variant="h6" gutterBottom>
              Rendszer információ
            </Typography>
            <Box sx={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Typography variant="body2" color="text.secondary">
                • SmartVoyager Iroda Desktop App
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • API kapcsolat aktív
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • Valós idejű adatszinkronizáció
              </Typography>
              <Typography variant="body2" color="text.secondary">
                • Biztonságos hitelesítés
              </Typography>
            </Box>
          </Paper>
        </Grid>
      </Grid>
    </Box>
  );
};

export default Dashboard;
