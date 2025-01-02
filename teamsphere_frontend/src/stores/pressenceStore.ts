import { defineStore } from 'pinia';
import type { PresenceRequest } from '@/api/presence/presenceTypes';
import {
  createPresence,
  updatePresence,
  deletePresence,
  getAllPresences,
} from '@/api/presence/presenceApi';

export const usePresenceStore = defineStore('presence', {
  state: () => ({
    presences: [] as PresenceRequest[],
    filteredPresences: [] as PresenceRequest[],
    loading: false,
  }),
  persist: true,
  actions: {
    getOnePresence(id: number) {
      try {
        const presence = this.presences.find((pres) => pres.id === id);
        return presence;
      } catch (error) {
        console.error(`Error fetching presence with ID ${id}:`, error);
        return null;
      }
    },

    async fetchPresences(): Promise<void> {
      this.loading = true;
      try {
        const response = await getAllPresences();
        console.log(response.data.presences);
        this.presences = response.data.presences.reverse();
        this.filteredPresences = [...this.presences]; 
      } catch (error) {
        console.error('Error fetching presences:', error);
      } finally {
        this.loading = false;
      }
    },

    async deletePresenceById(id: number): Promise<void> {
      try {
        await deletePresence(id);
        this.presences = this.presences.filter((pres) => pres.id !== id);
      } catch (error) {
        console.error(`Error deleting presence with ID ${id}:`, error);
      }
    },

    async addPresence(data: PresenceRequest): Promise<PresenceRequest | undefined | null> {
      try {
        const response = await createPresence(data);
        console.log('Presence created successfully:', response.data);
        if (response.success) {
          await this.fetchPresences();
          return response.data;
        } else {
          return null;
        }
      } catch (error) {
        console.error('Error adding presence:', error);
      }
    },

    async editPresence(id: number, data: PresenceRequest): Promise<PresenceRequest | undefined | null> {
      try {
        const response = await updatePresence(id, data);
        const index = this.presences.findIndex((pres) => pres.id === id);
        if (index !== -1) {
          this.presences[index] = response.data;
        }
        if (response.success) {
          await this.fetchPresences();
          return response.data;
        } else {
          return null;
        }
      } catch (error) {
        console.error(`Error updating presence with ID ${id}:`, error);
      }
    },

    filterPresences(value: string): PresenceRequest[] {
      const lowerCaseValue = value.toLowerCase();
      this.filteredPresences = this.presences.filter(
        (pres) =>
          pres.username.toLowerCase().includes(lowerCaseValue)
      );
      return this.filteredPresences;
    },
  },
});
