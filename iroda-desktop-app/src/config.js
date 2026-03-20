// Configuration file for the SmartVoyager Iroda Desktop App
export const CONFIG = {
  // API Configuration
  API_BASE_URL: process.env.REACT_APP_API_URL || 'http://localhost:8000',
  API_VERSION: 'v1',
  API_PREFIX: 'iroda',
  
  // Pagination
  DEFAULT_PAGE_SIZE: 10,
  DASHBOARD_PAGE_SIZE: 1000,
  
  // Reservation Statuses
  RESERVATION_STATUSES: {
    PENDING: 'pending',
    CONFIRMED: 'confirmed', 
    CANCELLED: 'cancelled'
  },
  
  // Status Labels (Hungarian)
  STATUS_LABELS: {
    pending: 'Függőben',
    confirmed: 'Megerősítve',
    cancelled: 'Lemondott'
  },
  
  // Status Colors
  STATUS_COLORS: {
    pending: '#ff9800',
    confirmed: '#4caf50',
    cancelled: '#f44336'
  },
  
  // Test Accounts (for development only)
  TEST_ACCOUNTS: {
    iroda: {
      email: 'test@igazi.email',
      password: 'password'
    },
    admin: {
      email: 'admin@igazi.email', 
      password: 'password'
    }
  }
};

// Helper function to build API URLs
export const buildApiUrl = (endpoint) => {
  return `${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}${endpoint}`;
};
