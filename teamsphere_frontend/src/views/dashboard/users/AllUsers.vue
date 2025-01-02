<script setup lang="ts">
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import CardDash from '@/components/CardDash.vue';
import DataTableUsers from '@/components/Users/DataTableUsers.vue';
// import { ref } from 'vue';
import { useUserStore } from '@/stores/userStore';

import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

const userStore = useUserStore();




ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const chartData = {
  labels: ['Informatique', 'Ressources Humaines', 'Marketing', 'Finance', 'Administration'],
  datasets: [
    {
      label: 'Nombre d\'utilisateurs',
      data: [12, 7, 15, 9, 5],
      backgroundColor: '#4CAF50',
      borderColor: '#388E3C',
      borderWidth: 1
    }
  ]
};

// Options du graphique
const chartOptions = {
  responsive: true,
  plugins: {
    legend: {
      position: 'top',
    },
    title: {
      display: true,
      text: 'Nombre d\'utilisateurs par département',
    },
  },
  scales: {
    x: {
      beginAtZero: true,
    },
    y: {
      beginAtZero: true,
    }
  }
};
</script>

<template>
  <DashboardTemplate>
    <div class="flex flex-col gap-2 py-4">
      <div class="grid md:grid-cols-2 gap-3 ">
        <div class="p-4 rounded-lg bg-white border ">

          <Bar :data="chartData" :options="chartOptions" />
        </div>
        <div class="grid md:grid-cols-2 gap-3">
          <CardDash title="Nombre total" :size="userStore.users.length">
            <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
              <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" />
              <path
                d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
            </svg>
          </CardDash>
          <CardDash title="Nombre total" :size="userStore.users.length">
            <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
              <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" />
              <path
                d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
            </svg>
          </CardDash>
          <CardDash title="Nombre total" :size="userStore.users.length">
            <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
              <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" />
              <path
                d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
            </svg>
          </CardDash>

          <CardDash title="Nombre total" :size="userStore.users.length">
            <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
              <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor" stroke-width="1.5"
                stroke-linecap="round" />
              <path
                d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
              <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
              <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor"
                stroke-width="1.5" stroke-linecap="round" />
            </svg>
          </CardDash>

        </div>




      </div>

      <DataTableUsers />
    </div>
  </DashboardTemplate>
</template>
