import axios from 'axios';
import { decryptData } from '../tokenEncryption';
import type { PresenceRequest } from './presenceTypes';

const API_URL = import.meta.env.VITE_API_URL + "/presences";

axios.defaults.withCredentials = true;


const datas: string[] | null = decryptData();
const token = datas ? datas[0] : null;


axios.defaults.headers.common['Content-Type'] = 'application/json';
if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}


export const createPresence = async (data: PresenceRequest) => {
  try {
    const response = await axios.post(API_URL, data);
    return response.data;
  } catch (error) {
    console.error('Error creating presence:', error);
    return error;
  }
};


export const updatePresence = async (id: number, data: PresenceRequest) => {
  try {
    const response = await axios.put(`${API_URL}/${id}`, data);
    return response.data;
  } catch (error) {
    console.error(`Error updating presence with ID ${id}:`, error);
    return error;
  }
};


export const deletePresence = async (id: number) => {
  try {
    const response = await axios.delete(`${API_URL}/${id}`);
    return response.data;
  } catch (error) {
    console.error(`Error deleting presence with ID ${id}:`, error);
    return error;
  }
};


export const getAllPresences = async () => {
  try {
    const response = await axios.get(API_URL);
    return response.data;
  } catch (error) {
    console.error('Error fetching presences:', error);
    return error;
  }
};
