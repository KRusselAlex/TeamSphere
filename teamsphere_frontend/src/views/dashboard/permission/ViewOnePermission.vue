<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

// Configuration de l'état réactif et des références
const route = useRoute();
const router = useRouter();

const permissionData = reactive({
  userId: route.params.id,
  userName: 'John Doe', // Supposons que vous obtenez cela via une API
  department: 'Ingénierie', // Nouveau champ pour le département
  permissionType: 'Maladie',
  startDate: '2025-01-01',
  endDate: '2025-01-10',
  motif: 'Maladie personnelle',
  justificationFile: null as File | null,
  status: 'En attente', // Statut de la demande de permission
});

// Gérer l'approbation
const handleApprove = () => {
  permissionData.status = 'Approuvée';
  alert('Permission approuvée');
  console.log('Permission approuvée', permissionData);
};

// Gérer le rejet
const handleReject = () => {
  permissionData.status = 'Rejetée';
  alert('Permission rejetée');
  console.log('Permission rejetée', permissionData);
};
</script>

<template>
  <DashboardTemplate>
    <div class="mx-3 mt-8 flex flex-col gap-6">
      <h2 class="font-sans font-semibold text-primaryColor text-xl">Détails de la Permission</h2>

      <div class="bg-white p-8 rounded-xl border">
        <div class="flex flex-col sm:flex-row sm:justify-between">

          <div>
            <h3 class="text-2xl font-sans font-semibold text-primaryColor">{{ permissionData.userName }}</h3>
            <p class="text-sm text-gray-500 font-serif">Département {{ permissionData.department }}</p>
          </div>
          <!-- Section droite avec le statut -->
          <div class="mt-4 sm:mt-0 sm:text-right">
            <span :class="{
              'bg-green-100 text-green-800': permissionData.status === 'Approuvée',
              'bg-red-100 text-red-800': permissionData.status === 'Rejetée',
              'bg-yellow-100 text-yellow-800': permissionData.status === 'En attente'
            }" class="px-3 py-1 text-xs font-semibold rounded-full">
              {{ permissionData.status }}
            </span>
          </div>
        </div>

        <!-- Détails de la permission -->
        <div class="mt-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <p class="font-semibold text-gray-600 font-sans">Type de Permission :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.permissionType }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Motif :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.motif }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de début :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.startDate }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de fin :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.endDate }}</p>
            </div>
            <div class="sm:col-span-2">
              <p class="font-semibold text-gray-600 font-sans">Justification :</p>
              <a href="#" class="text-primaryColor text-sm font-serif">Voir le fichier de justification</a>
            </div>
          </div>
        </div>

        <div class="flex justify-between gap-4 mt-5">
          <PrimaryButton title="Approuver"
            css="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
            @click="handleApprove" />
          <PrimaryButton title="Rejeter"
            css="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
            @click="handleReject" />
        </div>
      </div>
    </div>
  </DashboardTemplate>
</template>
