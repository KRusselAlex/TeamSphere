import axios from 'axios';
import { decryptData } from '../tokenEncryption';
import type { PermissionRequest } from './permissionsTypes';
import { toFormData } from '@/utils/presentUser';

const API_URL = import.meta.env.VITE_API_URL + "/permissions";

axios.defaults.withCredentials = true;
const datas: string[] | null =  decryptData();
const token = datas ? datas[0] : null;


axios.defaults.headers.common['Content-Type'] = 'application/json';
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export const createPermission = async (data: PermissionRequest) => {
  try {
    const response = await axios.postForm(API_URL, toFormData(data), {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

export const updatePermission = async (id: number, data: PermissionRequest) => {
  try {
    const response = await axios.put(API_URL + "/" +id, data);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

export const deletePermission = async (id: number) => {
  try {
    const response = await axios.delete(API_URL + "/" + id);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};


export const getAllPermissions = async () => {
  try {
    const response = await axios.get(API_URL);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

