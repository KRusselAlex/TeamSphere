// stores/userStore.ts
import { defineStore } from 'pinia';

export interface User {
  id: string;
  name: string;
  email: string;
}

export const useUserStore = defineStore('user', {
  state: () => ({
    users: [] as User[],
    currentUser: null as User | null,
  }),
  actions: {
    addUser(user: User) {
      this.users.push(user);
    },
    removeUser(userId: string) {
      this.users = this.users.filter((user) => user.id !== userId);
    },
    setCurrentUser(userId: string) {
      this.currentUser = this.users.find((user) => user.id === userId) || null;
    },
    // Filter users by name
    filterUsersByName(name: string) {
      return this.users.filter((user) =>
        user.name.toLowerCase().includes(name.toLowerCase())
      );
    },
  },
  persist: true,
});
