# TeamSphere Frontend

An employee attendance and permission management interface built with Vue.js.

>  *Système de gestion de présence et de permissions des employés*

## Overview

TeamSphere is a comprehensive employee management system that handles attendance tracking and permission requests. The frontend provides an intuitive interface for employees, managers, and administrators to manage their daily operations.

## Features

- **User Authentication**: Secure login, registration, and profile management
- **Attendance Management**: Track and manage employee attendance records
- **Permission Requests**: Submit and process time-off requests
- **Role-based Access**: Tailored interfaces for employees, managers, and admins
- **Real-time Notifications**: Instant updates for attendance and permission changes
- **Responsive Design**: Optimized for both desktop and mobile devices

## Tech Stack

- **Frontend Framework**: Vue.js 3.x
- **UI Components**: Vuetify 2.x
- **State Management**: Pinia
- **Routing**: Vue Router
- **API Communication**: Axios
- **Authentication**: Laravel Sanctum
- **Styling**: Tailwind CSS

## Prerequisites

Make sure you have installed:
- Node.js >= 16.x
- npm or yarn
- Vue CLI
- Vuetify
- Tailwind CSS
- Pinia
- Backend API running and accessible

## Installation Guide

### 1. Clone the Repository

```bash
git clone git@github.com:KRusselAlex/TeamSphere-Frontend.git
cd TeamSphere-Frontend
```

### 2. Install Dependencies

Using npm:
```bash
npm install
```

Or using yarn:
```bash
yarn install
```

### 3. Environment Setup

Copy the example environment file:
```bash
cp .env.example .env
```

Configure your environment variables:
```env
VITE_APP_API_URL=http://localhost:8000/api/v1
VITE_APP_FRONTEND_URL=http://localhost:8080
VITE_LOCAL_SECRET_KEY=

```

### 4. Launch Application

Using npm:
```bash
npm run serve
```

Or using yarn:
```bash
yarn serve
```

The application will be available at `http://localhost:5173`

## Project Structure

```
src/
├── assets/          # Static files (CSS, images)
├── components/      # Reusable Vue components
├── views/          # Page components
├── store/          # Pinia state management
├── router/         # Vue Router configuration
├── plugins/        # Vue.js plugins
├── services/       # API services
└── utils/          # Helper functions
```

## API Integration

Example of API configuration:

```javascript
// src/services/api.js
import axios from 'axios';

const api = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
});

export default api;
```

## Authentication Implementation

Example of login functionality:

```javascript
// Example login function
import api from './services/api';

export function login(credentials) {
  return api.post('/auth/login', credentials)
    .then(response => {
      localStorage.setItem('token', response.data.token);
    });
}
```

## State Management

Example of Pinia store implementation:

```javascript
// src/store/auth.js
import { defineStore } from 'pinia';

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => ({
    user: null,
    token: localStorage.getItem('auth_token') || '',
  }),
  actions: {
    setUser(user) {
      this.user = user;
    },
    setToken(token) {
      this.token = token;
      localStorage.setItem('auth_token', token);
    },
    logout() {
      this.user = null;
      this.token = '';
      localStorage.removeItem('auth_token');
    },
  },
});
```

## API Endpoints

### Authentication
- `POST /auth/login` - User login
- `POST /auth/register` - User registration (admin only)
- `POST /auth/logout` - User logout

### Attendance
- `POST /presence` - Log attendance
- `GET /presence` - Get all attendance records
- `GET /presence/{id}` - Get specific attendance record

### Permissions
- `POST /permissions` - Create permission request
- `GET /permissions` - Get all permission requests
- `PUT /permissions/{id}` - Update permission request status

### Users
- `GET /users` - List all users (admin only)
- `PUT /users/{id}` - Update user profile
- `DELETE /users/{id}` - Delete user (admin)

