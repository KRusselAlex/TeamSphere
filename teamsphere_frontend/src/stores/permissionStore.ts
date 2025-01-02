import { defineStore } from 'pinia';
import type { PermissionRequest } from '@/api/permission/permissionsTypes';
import {
  createPermission,
  updatePermission,
  deletePermission,
  getAllPermissions,
} from '@/api/permission/permissionApi';

export const usePermissionStore = defineStore('permission', {
  state: () => ({
    permissions: [] as PermissionRequest[],
    filteredPermissions: [] as PermissionRequest[],
    loading: false,
  }),
  persist: true,
  actions: {
    getOnePermission(id: number){
      try {
        const permission =  this.permissions.find((perm) => perm.id === id);
        return permission ;
      } catch (error) {
        console.error(`Error fetching permission with ID ${id}:`, error);
        return null;
      }
    },

    async fetchPermissions(): Promise<void> {
      this.loading = true;
      try {
        const response = await getAllPermissions();
        this.permissions = response.data.permissions.reverse(); // Populate permissions
        this.filteredPermissions = [...this.permissions]; // Initialize filtered permissions
      } catch (error) {
        console.error('Error fetching permissions:', error);
      } finally {
        this.loading = false;
      }
    },

    async deletePermissionById(id: number): Promise<void> {
      try {
        await deletePermission(id);
        this.permissions = this.permissions.filter((perm) => perm.id !== id);

      } catch (error) {
        console.error(`Error deleting permission with ID ${id}:`, error);
      }
    },

    async addPermission(data: PermissionRequest): Promise<PermissionRequest | undefined | null> {
      try {
        const response = await createPermission(data);
        if(response.success){
          await this.fetchPermissions();
          return response.data;

        }else{
          return null
        }

      } catch (error) {
        console.error('Error adding permission:', error);
      }
    },

    async editPermission(id: number, data: PermissionRequest): Promise<PermissionRequest | undefined | null> {
      try {
        const response = await updatePermission(id, data);
        const index = this.permissions.findIndex((perm) => perm.id === id);
        if (index !== -1) {
          this.permissions[index] = response.data;
        }
        if (response.success) {
          await this.fetchPermissions();
          return response.data;

        } else {
          return null
        }
        return response.data;
      } catch (error) {
        console.error(`Error updating permission with ID ${id}:`, error);
      }
    },

    PermissionStatus(value:string){
      const permission = this.permissions.filter((perm) => perm.status == value);
      console.log(permission);

      return permission.length

    },

    filterPermissions(value: string): PermissionRequest[] {
      const lowerCaseValue = value.toLowerCase();
      this.filteredPermissions = this.permissions.filter(
        (perm) =>
          perm.permission_type.toLowerCase().includes(lowerCaseValue) ||
          perm.reason.toLowerCase().includes(lowerCaseValue)
      );
      return this.filteredPermissions;
    },
  },
});
