// authService.ts

import * as authApi from './authApi';
import type { LoginRequest, RegisterRequest, ForgotPasswordRequest, ResetPasswordRequest } from './authTypes';

export const loginUser = async (data: LoginRequest) => {
  try {
    const response = await authApi.login(data);
    localStorage.setItem('token', response.token);
    return response;
  } catch (error) {
    throw error;
  }
};

export const registerUser = async (data: RegisterRequest) => {
  try {
    const response = await authApi.register(data);
    localStorage.setItem('token', response.token);
    return response;
  } catch (error) {
    throw error;
  }
};

export const logoutUser = async () => {
  try {
    await authApi.logout();
    localStorage.removeItem('token');
  } catch (error) {
    throw error;
  }
};

export const forgotPasswordUser = async (data: ForgotPasswordRequest) => {
  try {
    const response = await authApi.forgotPassword(data);
    return response;
  } catch (error) {
    throw error;
  }
};

export const resetPasswordUser = async (data: ResetPasswordRequest) => {
  try {
    const response = await authApi.resetPassword(data);
    return response;
  } catch (error) {
    throw error;
  }
};
