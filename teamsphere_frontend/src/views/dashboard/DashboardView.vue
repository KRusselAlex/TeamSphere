<template>
  <DashboardTemplate>
    <div class="mx-auto flex flex-col gap-4 p-6">
      <h2 class="text-2xl font-semibold text-primaryColor mb-6">Analyse et Statistiques</h2>

      <!-- Utilisation de Tailwind CSS pour afficher les graphiques côte à côte -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Graphique Taux de présence -->
        <div class="bg-white border p-8 rounded-xl">
          <h3 class="text-xl font-semibold mb-4">Taux de présence par semaine/mois</h3>
          <Line :data="presenceData" :options="chartOptions" />
        </div>

        <!-- Graphique Permissions -->
        <div class="bg-white border p-8 rounded-xl">
          <h3 class="text-xl font-semibold mb-4">Permissions (Accordées, En attente, Rejetées)</h3>
          <Bar :data="permissionsData" :options="chartOptions" />
        </div>
      </div>
      <DataTablePermission />
    </div>
  </DashboardTemplate>

</template>

<script setup lang="ts">
import { Line, Bar } from 'vue-chartjs';
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, PointElement, LineElement, Title, Tooltip, Legend } from 'chart.js';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import DataTablePermission from '@/components/permissionsComponents/DataTablePermission.vue';

// Enregistrement des composants de Chart.js
ChartJS.register(CategoryScale, LinearScale, BarElement, PointElement, LineElement, Title, Tooltip, Legend);

// Données pour le graphique de taux de présence
const presenceData = {
  labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4', 'Mois 1', 'Mois 2'],
  datasets: [
    {
      label: 'Taux de présence',
      data: [75, 85, 80, 95, 90, 88], // Exemple de données
      borderColor: '#1D4ED8', // Couleur de la ligne
      backgroundColor: 'rgba(29, 78, 216, 0.2)', // Couleur de fond
      fill: true,
      tension: 0.4, // Courbe lisse
    },
  ],
};

// Données pour le graphique des permissions
const permissionsData = {
  labels: ['Accordées', 'En attente', 'Rejetées'],
  datasets: [
    {
      label: 'Permissions',
      data: [120, 50, 30], // Exemple de données
      backgroundColor: ['#4CAF50', '#FFC107', '#F44336'], // Couleurs pour chaque état
      borderColor: ['#388E3C', '#FF9800', '#D32F2F'],
      borderWidth: 1,
    },
  ],
};

// Options des graphiques
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
