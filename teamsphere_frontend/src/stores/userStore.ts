import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';
import CryptoJS from 'crypto-js';
import * as UserService from './UserService';

const decryptFunction = (): string => {
  const storedData = localStorage.getItem('encrypteduserdatacni');
  if (storedData) {
    const parsedData = JSON.parse(storedData);
    const decryptedId = CryptoJS.AES.decrypt(parsedData.userId, import.meta.env.VITE_LOCAL_SECRET_KEY).toString(CryptoJS.enc.Utf8);
    const decryptedToken = CryptoJS.AES.decrypt(parsedData.token, import.meta.env.VITE_LOCAL_SECRET_KEY).toString(CryptoJS.enc.Utf8);
    return decryptedToken;
  }
  return 'assas';
};

interface User {
  id: number;
  name: string;
  email: string;
  full_name: string;
  role: number;
  password: string;
}

interface AuthenticateUser {
  jwt: string;
}

interface UserStoreState {
  user: User[];
  users: User[];
  authenticateuser: AuthenticateUser;
  UserInfo: any;
  filteruser: User[];
  loading: boolean;
}

export const useUserStore = defineStore('user', {
  state: (): UserStoreState => ({
    user: [],
    users: [],
    authenticateuser: { jwt: '' },
    UserInfo: null,
    filteruser: [],
    loading: false,
  }),
  persist: true,
  actions: {
    async getOneUser(id: number) {
      console.log('user id', id);
      console.log('users', this.users);
      const user = this.users.filter((user) => user.id === id);
      if (user.length < 1) {
        const router = useRouter();
        router.push('/notfound');
        return;
      }
      console.log(user);
      return user[0];
    },

    async getUsers() {
      console.log('users', this.authenticateuser.jwt);
      this.loading = true;
      try {
        const response = await UserService.getUsers(this.authenticateuser.jwt);
        this.users = response.data.reverse();
        this.filteruser = this.users;
      } catch (error) {
        console.error('Error fetching users', error);
      } finally {
        this.loading = false;
      }
    },

    getRole(roles: number): number {
      const entity = this.users.filter((user) => user.role === roles);
      return entity.length;
    },

    getUserRole(roles: number): User[] {
      if (roles === 4) {
        this.filteruser = this.users;
        return this.users;
      }
      const entity = this.users.filter((user) => user.role === roles);
      this.filteruser = entity;
      return entity;
    },

    async DeleteUser(id: number) {
      try {
        const response = await UserService.deleteUser(id, this.authenticateuser.jwt);
        return response.data;
      } catch (error) {
        console.error('Error deleting user', error);
      }
    },

    hideUser(id: number) {
      this.users = this.users.filter((user) => user.id !== id);
      console.log(this.users);
    },

    async AddUser(name: string, email: string, full_name: string, role: number, password: string) {
      const userData: User = { name, email, full_name, role, password };
      try {
        const response = await UserService.createUser(userData, this.authenticateuser.jwt);
        console.log('User created', response.data);
        return response.data;
      } catch (error) {
        console.error('Error adding user', error);
      }
    },

    createUserStore(name: string, email: string, full_name: string, role: number, password: string) {
      this.users.unshift({ name, email, full_name, role, password });
    },

    async EditUser(id: number, name: string, email: string, full_name: string, role: number, password: string) {
      const userData: User = { name, email, full_name, role, password };
      try {
        const response = await UserService.editUser(id, userData, this.authenticateuser.jwt);
        console.log('User updated', response.data);
        return response.data;
      } catch (error) {
        console.error('Error updating user', error);
      }
    },

    filterStore(value: string): User[] {
      this.filteruser = this.users.filter(
        (user) =>
          user.name.toLowerCase().includes(value.toLowerCase()) ||
          user.email.toLowerCase().includes(value.toLowerCase()) ||
          user.full_name.toLowerCase().includes(value.toLowerCase())
      );
      return this.filteruser;
    },

    authenticate(data: AuthenticateUser) {
      this.authenticateuser = data;
    },
  },
});
