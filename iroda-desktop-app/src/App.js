import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { ThemeProvider, createTheme } from '@mui/material/styles';
import { CssBaseline, Box } from '@mui/material';
import Login from './components/Login';
import Dashboard from './components/Dashboard';
import Reservations from './components/Reservations';
import Destinations from './components/Destinations';
import Navbar from './components/Navbar';
import { authAPI } from './api';

// Create theme
const theme = createTheme({
  palette: {
    primary: {
      main: '#1976d2',
    },
    secondary: {
      main: '#dc004e',
    },
  },
});

function App() {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    checkAuth();
  }, []);

  const checkAuth = async () => {
    const token = localStorage.getItem('iroda_token');
    const userData = localStorage.getItem('iroda_user');
    
    if (token && userData) {
      try {
        const response = await authAPI.me();
        setUser(response.data.user);
      } catch (error) {
        // Token invalid, clear storage
        localStorage.removeItem('iroda_token');
        localStorage.removeItem('iroda_user');
      }
    }
    setLoading(false);
  };

  const login = (userData, token) => {
    setUser(userData);
    localStorage.setItem('iroda_token', token);
    localStorage.setItem('iroda_user', JSON.stringify(userData));
  };

  const logout = async () => {
    try {
      await authAPI.logout();
    } catch (error) {
      console.error('Logout error:', error);
    }
    
    setUser(null);
    localStorage.removeItem('iroda_token');
    localStorage.removeItem('iroda_user');
  };

  if (loading) {
    return <div>Betöltés...</div>;
  }

  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <Router>
        <Box sx={{ display: 'flex', flexDirection: 'column', height: '100vh' }}>
          {user && <Navbar user={user} onLogout={logout} />}
          <Box component="main" sx={{ flexGrow: 1, p: 3 }}>
            <Routes>
              <Route 
                path="/login" 
                element={!user ? <Login onLogin={login} /> : <Navigate to="/dashboard" />} 
              />
              <Route 
                path="/dashboard" 
                element={user ? <Dashboard user={user} /> : <Navigate to="/login" />} 
              />
              <Route 
                path="/reservations" 
                element={user ? <Reservations /> : <Navigate to="/login" />} 
              />
              <Route 
                path="/destinations" 
                element={user ? <Destinations /> : <Navigate to="/login" />} 
              />
              <Route 
                path="/" 
                element={<Navigate to={user ? "/dashboard" : "/login"} />} 
              />
            </Routes>
          </Box>
        </Box>
      </Router>
    </ThemeProvider>
  );
}

export default App;
