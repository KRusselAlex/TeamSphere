import axios from 'axios';
import type { UserRequest } from './userTypes';

const API_URL = import.meta.env.VITE_API_URL + "/users/";

axios.defaults.withCredentials = true;
const token = localStorage.getItem('auth_token');



if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export const createUser = async (data: UserRequest) => {
  try {
    const response = await axios.post(API_URL, data);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

export const updateUser = async (id: number, data: UserRequest) => {
  try {
    const response = await axios.put(API_URL + id , data);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

export const deleteUser = async (id: number) => {
  try {
    const response = await axios.delete(API_URL + id);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};

export const getUsers = async () => {
  try {
    const response = await axios.get(API_URL);
    return response.data;
  } catch (error) {
    console.log(error);
    return error;
  }
};
