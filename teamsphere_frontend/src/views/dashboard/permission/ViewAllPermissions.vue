<script setup lang="ts">
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import DataTablePermission from '@/components/permissionsComponents/DataTablePermission.vue';
import CardDash from '@/components/CardDash.vue';
import { usePermissionStore } from "@/stores/permissionStore"
import { useUserStore } from '@/stores/userStore';
import { usePresenceStore } from '@/stores/pressenceStore';
const presenceStore = usePresenceStore();
presenceStore.fetchPresences()

const permissionStore = usePermissionStore();
permissionStore.fetchPermissions();
const userStore = useUserStore();
userStore.fetchUsers();





</script>

<template>
  <DashboardTemplate>
    <div class="flex flex-col gap-2 py-4">
      <div class="grid md:grid-cols-2 gap-3 lg:grid-cols-4">
        <CardDash title="Nombre total" :size="permissionStore.permissions?.length">
          <svg fill="currentColor" width="40px" height="40px" viewBox="0 0 16 16" id="request-sent-16px">
            <path id="Path_50" data-name="Path 50"
              d="M-11.5,0h-11A2.5,2.5,0,0,0-25,2.5v8A2.5,2.5,0,0,0-22.5,13h.5v2.5a.5.5,0,0,0,.309.462A.489.489,0,0,0-21.5,16a.5.5,0,0,0,.354-.146L-18.293,13H-11.5A2.5,2.5,0,0,0-9,10.5v-8A2.5,2.5,0,0,0-11.5,0ZM-10,10.5A1.5,1.5,0,0,1-11.5,12h-7a.5.5,0,0,0-.354.146L-21,14.293V12.5a.5.5,0,0,0-.5-.5h-1A1.5,1.5,0,0,1-24,10.5v-8A1.5,1.5,0,0,1-22.5,1h11A1.5,1.5,0,0,1-10,2.5Zm-2.038-3.809a.518.518,0,0,1-.109.163l-2,2A.5.5,0,0,1-14.5,9a.5.5,0,0,1-.354-.146.5.5,0,0,1,0-.708L-13.707,7H-18.5A1.5,1.5,0,0,0-20,8.5a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5A2.5,2.5,0,0,1-18.5,6h4.793l-1.147-1.146a.5.5,0,0,1,0-.708.5.5,0,0,1,.708,0l2,2a.518.518,0,0,1,.109.163A.505.505,0,0,1-12.038,6.691Z"
              transform="translate(25)" />
          </svg>
        </CardDash>
        <CardDash title="Approuvé" :size="permissionStore.PermissionStatus('approved')">
          <svg fill="#28A745" width="60px" height="60px" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg"
            class="cf-icon-svg">
            <path
              d="M16.417 10.283A7.917 7.917 0 1 1 8.5 2.366a7.916 7.916 0 0 1 7.917 7.917zm-4.105-4.498a.791.791 0 0 0-1.082.29l-3.828 6.63-1.733-2.08a.791.791 0 1 0-1.216 1.014l2.459 2.952a.792.792 0 0 0 .608.285.83.83 0 0 0 .068-.003.791.791 0 0 0 .618-.393L12.6 6.866a.791.791 0 0 0-.29-1.081z" />
          </svg>
        </CardDash>
        <CardDash title="Rejeté" :size="permissionStore.PermissionStatus('rejected')">
          <svg fill="#FF0000" width="60px" height="60px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm3.707,12.293a1,1,0,1,1-1.414,1.414L12,13.414,9.707,15.707a1,1,0,0,1-1.414-1.414L10.586,12,8.293,9.707A1,1,0,0,1,9.707,8.293L12,10.586l2.293-2.293a1,1,0,0,1,1.414,1.414L13.414,12Z" />
          </svg>
        </CardDash>
        <CardDash title="En attente" :size="permissionStore.PermissionStatus('pending')">
          <svg width="60px" height="60px" viewBox="0 0 1024 1024" class="icon" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M511.9 183c-181.8 0-329.1 147.4-329.1 329.1s147.4 329.1 329.1 329.1c181.8 0 329.1-147.4 329.1-329.1S693.6 183 511.9 183z m0 585.2c-141.2 0-256-114.8-256-256s114.8-256 256-256 256 114.8 256 256-114.9 256-256 256z"
              fill="#0F1F3C" />
            <path d="M548.6 365.7h-73.2v161.4l120.5 120.5 51.7-51.7-99-99z" fill="#0F1F3C" />
          </svg>
        </CardDash>
      </div>

      <DataTablePermission :permissions="permissionStore.permissions"  />
    </div>
  </DashboardTemplate>
</template>
