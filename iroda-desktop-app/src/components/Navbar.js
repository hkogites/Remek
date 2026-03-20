import React from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import {
  AppBar,
  Toolbar,
  Typography,
  Button,
  Box,
  IconButton,
  Menu,
  MenuItem,
} from '@mui/material';
import {
  AccountCircle,
  Dashboard,
  Bookings,
  LocationOn,
  ExitToApp,
} from '@mui/icons-material';

const Navbar = ({ user, onLogout }) => {
  const navigate = useNavigate();
  const location = useLocation();
  const [anchorEl, setAnchorEl] = React.useState(null);

  const handleMenu = (event) => {
    setAnchorEl(event.currentTarget);
  };

  const handleClose = () => {
    setAnchorEl(null);
  };

  const handleLogout = () => {
    handleClose();
    onLogout();
  };

  const menuItems = [
    { label: 'Vezérlőpult', icon: <Dashboard />, path: '/dashboard' },
    { label: 'Foglalások', icon: <Bookings />, path: '/reservations' },
    { label: 'Úticélok', icon: <LocationOn />, path: '/destinations' },
  ];

  return (
    <AppBar position="static">
      <Toolbar>
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          SmartVoyager Iroda
        </Typography>

        <Box sx={{ display: { xs: 'none', md: 'flex' } }}>
          {menuItems.map((item) => (
            <Button
              key={item.path}
              color="inherit"
              startIcon={item.icon}
              onClick={() => navigate(item.path)}
              sx={{
                backgroundColor: location.pathname === item.path ? 'rgba(255,255,255,0.1)' : 'transparent',
              }}
            >
              {item.label}
            </Button>
          ))}
        </Box>

        <Box>
          <IconButton
            size="large"
            aria-label="account of current user"
            aria-controls="menu-appbar"
            aria-haspopup="true"
            onClick={handleMenu}
            color="inherit"
          >
            <AccountCircle />
          </IconButton>
          <Menu
            id="menu-appbar"
            anchorEl={anchorEl}
            anchorOrigin={{
              vertical: 'top',
              horizontal: 'right',
            }}
            keepMounted
            transformOrigin={{
              vertical: 'top',
              horizontal: 'right',
            }}
            open={Boolean(anchorEl)}
            onClose={handleClose}
          >
            <MenuItem disabled>
              <Typography variant="body2">{user.name}</Typography>
              <Typography variant="caption" display="block">
                {user.email}
              </Typography>
            </MenuItem>
            <MenuItem onClick={() => { navigate('/dashboard'); handleClose(); }}>
              <Dashboard sx={{ mr: 1 }} /> Vezérlőpult
            </MenuItem>
            <MenuItem onClick={() => { navigate('/reservations'); handleClose(); }}>
              <Bookings sx={{ mr: 1 }} /> Foglalások
            </MenuItem>
            <MenuItem onClick={() => { navigate('/destinations'); handleClose(); }}>
              <LocationOn sx={{ mr: 1 }} /> Úticélok
            </MenuItem>
            <MenuItem onClick={handleLogout}>
              <ExitToApp sx={{ mr: 1 }} /> Kijelentkezés
            </MenuItem>
          </Menu>
        </Box>
      </Toolbar>
    </AppBar>
  );
};

export default Navbar;
