import { CONFIG } from '../config';

// Status helper functions
export const getStatusColor = (status) => {
  return CONFIG.STATUS_COLORS[status] || '#666';
};

export const getStatusLabel = (status) => {
  return CONFIG.STATUS_LABELS[status] || status;
};

export const getStatusOptions = () => {
  return Object.entries(CONFIG.STATUS_LABELS).map(([value, label]) => ({
    value,
    label
  }));
};

export const isValidStatus = (status) => {
  return Object.values(CONFIG.RESERVATION_STATUSES).includes(status);
};
