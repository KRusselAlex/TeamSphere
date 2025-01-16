
import axios from 'axios';
import { decryptData } from '../tokenEncryption';
import type { LoginRequest, RegisterRequest, ForgotPasswordRequest, ResetPasswordRequest } from './authTypes';

const API_URL = import.meta.env.VITE_API_URL + "/auth/";

axios.defaults.withCredentials = true;
const datas: string[] | null = await decryptData();
const token = datas ? datas[0] : null;

if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}


export const login = async (data: LoginRequest) => {
  try {
    const response = await axios.post(`${API_URL}login`, data);
    return response.data;
  } catch (error) {
    console.log(error)
    return error
  }
};

export const register = async (data: RegisterRequest) => {
  try {

    const response = await axios.post(`${API_URL}register`, data);
    return response.data;

  } catch (error) {
    console.log(error)
    return error
  }
};

export const logout = async () => {
  try {
    const response = await axios.post(`${API_URL}logout`);

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
