<template>
  <DashboardTemplate>
    <div class="mx-auto flex flex-col gap-4 p-6">
      <h2 class="text-2xl font-semibold text-primaryColor mb-6">Analyse et Statistiques</h2>


      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white border p-8 rounded-xl">
          <h3 class="text-xl font-semibold mb-4">Taux de présence par semaine/mois</h3>
          <Line :data="presenceData" :options="chartOptions" />
        </div>

        <div class="bg-white border p-8 rounded-xl">
          <h3 class="text-xl font-semibold mb-4">Permissions (Accordées, En attente, Rejetées)</h3>
          <Bar :data="permissionsData" :options="chartOptions" />
        </div>
      </div>
      <DataTablePermission :permissions="permissionStore.permissions" />
    </div>
  </DashboardTemplate>

</template>

<script setup lang="ts">
import { Line, Bar } from 'vue-chartjs';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, PointElement, LineElement, Title, Tooltip, Legend } from 'chart.js';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import DataTablePermission from '@/components/permissionsComponents/DataTablePermission.vue';
import {usePermissionStore} from "@/stores/permissionStore"
import { useUserStore } from '@/stores/userStore';
import { usePresenceStore } from '@/stores/pressenceStore';
const presenceStore = usePresenceStore();
presenceStore.fetchPresences()

const permissionStore = usePermissionStore();
permissionStore.fetchPermissions();
const userStore = useUserStore();
userStore.fetchUsers();


ChartJS.register(CategoryScale, LinearScale, BarElement, PointElement, LineElement, Title, Tooltip, Legend);


const presenceData = {
  labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4', 'Mois 1', 'Mois 2'],
  datasets: [
    {
      label: 'Taux de présence',
      data: [75, 85, 80, 95, 90, 88],
      borderColor: '#1D4ED8',
      backgroundColor: 'rgba(29, 78, 216, 0.2)',
      fill: true,
      tension: 0.4,
    },
  ],
};


const permissionsData = {
  labels: ['Accordées', 'En attente', 'Rejetées'],
  datasets: [
    {
      label: 'Permissions',
      data: [permissionStore.PermissionStatus('approved'), permissionStore.PermissionStatus('pending'), permissionStore.PermissionStatus('rejected')],
      backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
      borderColor: ['#388E3C', '#FF9800', '#D32F2F'],
      borderWidth: 1,
    },
  ],
};


const chartOptions = {
  responsive: true,
  plugins: {
    title: {
      display: true,
      text: 'Statistiques générales',
    },
    tooltip: {
      enabled: true,
    },
  },
};
</script>

<style scoped>

</style>
