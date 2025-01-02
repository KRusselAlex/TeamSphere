import * as authApi from './authApi';
import { encryptData } from '../tokenEncryption';
import { useUserStore } from '@/stores/userStore';
import { usePermissionStore } from '@/stores/permissionStore';
import { usePresenceStore } from '@/stores/pressenceStore';
import type { LoginRequest, RegisterRequest, ForgotPasswordRequest, ResetPasswordRequest } from './authTypes';

export const loginUser = async (data: LoginRequest) => {
  try {
    const response = await authApi.login(data);
    console.log(response.success);
    if(response.success){
      console.log("bool true or false",encryptData(response.data.token,response.data.user.id,response.data.user.role));

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
    localStorage.removeItem('userRole');
    const presenceStore = usePresenceStore();
    presenceStore.$reset();

    const permissionStore = usePermissionStore();
    permissionStore.$reset();

    const userStore = useUserStore();
    userStore.$reset();

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
