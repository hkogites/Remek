import axios from 'axios';
import { CONFIG, buildApiUrl } from './config';

// Create axios instance
const api = axios.create({
  baseURL: `${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}`,
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

// Request interceptor to add auth token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('iroda_token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor to handle errors
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token expired or invalid
      localStorage.removeItem('iroda_token');
      localStorage.removeItem('iroda_user');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

// Auth API
export const authAPI = {
  login: (credentials) => api.post(`/${CONFIG.API_PREFIX}/login`, credentials),
  logout: () => api.post(`/${CONFIG.API_PREFIX}/logout`),
  me: () => api.get(`/${CONFIG.API_PREFIX}/me`),
};

// Reservations API
export const reservationsAPI = {
  index: (params = {}) => api.get(`/${CONFIG.API_PREFIX}/reservations`, { params }),
  show: (id) => api.get(`/${CONFIG.API_PREFIX}/reservations/${id}`),
  updateDetails: (id, data) => api.put(`/${CONFIG.API_PREFIX}/reservations/${id}/details`, data),
  updateStatus: (id, data) => api.put(`/${CONFIG.API_PREFIX}/reservations/${id}/status`, data),
  sendEmail: (id, data) => api.post(`/${CONFIG.API_PREFIX}/reservations/${id}/email`, data),
  delete: (id) => api.delete(`/${CONFIG.API_PREFIX}/reservations/${id}`),
};

// Destinations API
export const destinationsAPI = {
  index: (params = {}) => api.get(`/${CONFIG.API_PREFIX}/destinations`, { params }),
  show: (id) => api.get(`/${CONFIG.API_PREFIX}/destinations/${id}`),
  store: (data) => api.post(`/${CONFIG.API_PREFIX}/destinations`, data),
  update: (id, data) => api.put(`/${CONFIG.API_PREFIX}/destinations/${id}`, data),
  delete: (id) => api.delete(`/${CONFIG.API_PREFIX}/destinations/${id}`),
};

export default api;
