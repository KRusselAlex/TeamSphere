import { defineStore } from 'pinia';
import type { UserRequest } from '@/api/user/userTypes';
import { createUser, updateUser, deleteUser, getUsers } from '@/api/user/userApi';

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as UserRequest[],
    filteruser: [] as UserRequest[],
    loading: false,
  }),
  persist: true,
  actions: {
    getOneUser(id: number) {
      try {
        const user = this.users.find((user) => user.id === id);


        if (user) {
          return user;
        }

        return null
      } catch (error) {
        console.log('Error fetching user:', error);
        return null;
      }
    },

    async fetchUsers(): Promise<void> {
      this.loading = true;
      try {
        const response = await getUsers();
        this.users = response.data?.users?.reverse();
        // this.filteruser = [...this.users];
      } catch (error) {
        console.error('Error fetching users:', error);
      } finally {
        this.loading = false;
      }
    },
    async deleteUserById(id: number) {
      try {
        await deleteUser(id);
        this.users = this.users.filter((user) => user.id !== id);
      } catch (error) {
        console.error(`Error deleting user with ID ${id}:`, error);
      }
    },

    async addUser(data: UserRequest) {
      try {
        const response = await createUser(data);
        this.users.push(response.data);
        return response.data;
      } catch (error) {
        console.error('Error adding user:', error);
      }
    },

    async editUser(id: number, data: UserRequest) {
      try {
        const response = await updateUser(id, data);
        const index = this.users.findIndex((user) => user.id === id);
        if (index !== -1) {
          this.users[index] = response.data;
        }
        return response.data;
      } catch (error) {
        console.error(`Error updating user with ID ${id}:`, error);
      }
    },

    filterUsers(value: string): UserRequest[] {
      this.filteruser = this.users.filter(
        (user) =>
          user.username.toLowerCase().includes(value.toLowerCase()) ||
          user.email.toLowerCase().includes(value.toLowerCase()) ||
          (user.fullname || '').toLowerCase().includes(value.toLowerCase())
      );
      return this.filteruser;
    },
  },
});
