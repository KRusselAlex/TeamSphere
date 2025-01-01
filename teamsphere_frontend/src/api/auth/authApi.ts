// authApi.ts

import axios from 'axios';
import type { LoginRequest, RegisterRequest, ForgotPasswordRequest, ResetPasswordRequest } from './authTypes';

const API_URL = import.meta.env.VITE_API_URL;

// Create axios instance
// const apiClient = axios.create({
//   baseURL: API_URL,
//   headers: {
//     'Content-Type': 'application/json',
//   },
// });


export const login = async (data: LoginRequest) => {
  try {
    const response = await axios.post(`${API_URL}/auth/login`, data);
    return response.data;
  } catch (error) {
    console.log(error)
  }
};

export const register = async (data: RegisterRequest) => {
  try {
    const response = await axios.post(`${API_URL}/auth/register`, data);
    return response.data;
  } catch (error) {
    console.log(error)
  }
};

export const logout = async () => {
  try {
    const response = await axios.post(`${API_URL}/logout`);
    return response.data;
  } catch (error) {
    console.log(error)
  }
};

export const forgotPassword = async (data: ForgotPasswordRequest) => {
  try {
    const response = await axios.post(`${API_URL}/forgot-password`, data);
    return response.data;
  } catch (error) {
    console.log(error)
  }
};

export const resetPassword = async (data: ResetPasswordRequest) => {
  try {
    const response = await axios.post(`${API_URL}/reset-password`, data);
    return response.data;
  } catch (error) {
    console.log(error)
  }
};
