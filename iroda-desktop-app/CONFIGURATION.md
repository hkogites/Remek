# SmartVoyager Iroda Desktop App - Configuration Guide

## Environment Configuration

The application uses a centralized configuration system to avoid hardcoded values and make it easy to deploy to different environments.

### Configuration Files

1. **`src/config.js`** - Main configuration file
2. **`.env`** - Environment-specific variables
3. **`.env.example`** - Template for environment variables

### Environment Variables

Create a `.env` file in the root directory with the following variables:

```bash
# API Configuration
REACT_APP_API_URL=http://localhost:8000

# Environment (development, production)
REACT_APP_ENV=development

# App Settings
REACT_APP_APP_NAME=SmartVoyager Iroda
REACT_APP_VERSION=1.0.0
```

### Configuration Structure

The `src/config.js` file contains:

- **API Configuration**: Base URL, version, and prefix
- **Pagination Settings**: Default page sizes for different components
- **Reservation Statuses**: Standardized status values
- **Status Labels**: Hungarian labels for UI display
- **Status Colors**: Consistent color scheme for statuses
- **Test Accounts**: Development-only test credentials

### Benefits

1. **Environment Flexibility**: Easy to switch between development, staging, and production
2. **Centralized Management**: All configuration in one place
3. **Type Safety**: Consistent usage across the application
4. **Maintainability**: Easy to update URLs, statuses, and other constants

### API Endpoints

All API calls now use the configuration:
- Base URL: `CONFIG.API_BASE_URL`
- Version: `CONFIG.API_VERSION`
- Prefix: `CONFIG.API_PREFIX`

Example: `${CONFIG.API_BASE_URL}/api/${CONFIG.API_VERSION}/${CONFIG.API_PREFIX}/reservations`

### Status Management

Status values are centralized:
- **Pending**: `CONFIG.RESERVATION_STATUSES.PENDING`
- **Confirmed**: `CONFIG.RESERVATION_STATUSES.CONFIRMED`
- **Cancelled**: `CONFIG.RESERVATION_STATUSES.CANCELLED`

Helper functions in `src/utils/statusHelpers.js` provide:
- `getStatusColor(status)` - Returns consistent colors
- `getStatusLabel(status)` - Returns Hungarian labels
- `getStatusOptions()` - Returns array for select elements
- `isValidStatus(status)` - Validates status values

### Migration Notes

Previously hardcoded values have been replaced:
- ✅ `http://localhost:8000/api/v1/iroda/...` → Dynamic API URLs
- ✅ Hardcoded status values → Configuration constants
- ✅ Duplicate status functions → Centralized helpers
- ✅ Fixed page sizes → Configurable pagination
- ✅ Test credentials → Configuration object

### Deployment

For production deployment:

1. Update `.env` file with production API URL
2. Set `REACT_APP_ENV=production`
3. The application will automatically use the production configuration

### Adding New Configuration

To add new configuration values:

1. Add to `src/config.js` in the `CONFIG` object
2. Use environment variables with `process.env.REACT_APP_*`
3. Import and use in components with `import { CONFIG } from '../config'`
