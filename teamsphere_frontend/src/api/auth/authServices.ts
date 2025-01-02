import * as authApi from './authApi';
import { encryptData } from '../tokenEncryption';
import type { LoginRequest, RegisterRequest, ForgotPasswordRequest, ResetPasswordRequest } from './authTypes';

export const loginUser = async (data: LoginRequest) => {
  try {
    const response = await authApi.login(data);
    console.log(response.success);
    if(response.success){
      console.log("bool true or false",encryptData(response.data.token,response.data.user.id));

    }

    return response;
  } catch (error) {
    throw error;
  }
};

export const registerUser = async (data: RegisterRequest) => {
  try {
    const response = await authApi.register(data);
    return response;
  } catch (error) {
    throw error;
  }
};

export const logoutUser = async () => {
  try {
    await authApi.logout();
    localStorage.removeItem('userToken');
    localStorage.removeItem('userId');
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
