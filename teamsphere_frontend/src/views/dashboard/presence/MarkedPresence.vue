<template>
  <DashboardTemplate>
    <div class="p-8">
      <h2 class="text-3xl font-semibold font-sans text-primaryColor mb-6 animated fadeIn">Marquer votre présence</h2>
      <div class="p-8 bg-white border font-serif rounded-lg">

        <!-- Section de bienvenue -->
        <div class="text-center mb-6 animated fadeIn" :class="{ 'fadeInDelay': true }">
          <h3 class="text-xl text-gray-600">Bienvenue, <strong>{{ username }}</strong>!</h3>
          <p class="text-lg text-gray-500">Nous sommes ravis de vous voir ici aujourd'hui.</p>
        </div>

        <!-- Affichage de la date et de l'heure actuelles -->
        <div class="mb-6 animated fadeIn" :class="{ 'fadeInDelay': true }">
          <p class="text-lg text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-5 h-5 inline-block mr-2 text-primaryColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4V2m0 2a9 9 0 110 18 9 9 0 010-18zm0 2a7 7 0 100 14 7 7 0 000-14z" />
            </svg>
            Aujourd'hui, nous sommes : <strong>{{ todayDate }}</strong> à <strong>{{ currentTime }}</strong>
          </p>
        </div>

        <!-- Section d'actions passées (historique) -->
        <div class="mb-6 animated fadeIn" :class="{ 'fadeInDelay': true }">
          <h4 class="text-lg font-semibold text-gray-700 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-5 h-5 inline-block mr-2 text-primaryColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 9l4-4m0 0l-4-4m4 4H3m4 4H3m14 8l-4-4m0 0l4-4m-4 4h-8" />
            </svg>
            Historique des actions
          </h4>
          <ul class="list-disc pl-6 text-gray-600">
            <li>Présence marquée le {{ lastMarkedDate }}</li>
            <li>Demande de congé en attente depuis le {{ lastLeaveRequest }}</li>
          </ul>
        </div>

        <!-- Si l'utilisateur n'a pas encore marqué sa présence -->
        <div v-if="!hasMarkedPresence" class="text-center animated fadeIn" :class="{ 'fadeInDelay': true }">
          <button
            class="bg-primaryColor font-sans font-semibold text-white py-3 px-8 rounded-lg  transition-all duration-300 transform hover:scale-105"
            @click="markPresence">
            <span class="text-xl">✔ Marquer ma présence</span>
          </button>
        </div>

        <!-- Message après avoir marqué la présence -->
        <div v-else class="text-center animated fadeIn" :class="{ 'fadeInDelay': true }">
          <div class="text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-8 h-8 inline-block mr-2 text-green-500">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <p class="text-xl">Présence marquée avec succès!</p>
            <p class="text-sm text-gray-600 mt-2">Vous avez marqué votre présence à {{ markedTime }} aujourd'hui.</p>
          </div>
        </div>

      </div>
    </div>
  </DashboardTemplate>
</template>

<script setup lang="ts">
import DashboardTemplate from "@/components/DashboardTemplate.vue";
import { ref, onMounted } from "vue";

// Fonction pour obtenir la date en lettres
const formatDateToLetters = (date: Date) => {
  const days = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
  const months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];

  const day = days[date.getDay()];
  const dayNumber = date.getDate();
  const month = months[date.getMonth()];
  const year = date.getFullYear();

  return `${day} ${dayNumber} ${month} ${year}`;
};

const username = ref("John Doe");
const todayDate = ref(formatDateToLetters(new Date())); // Date en lettres
const currentTime = ref(new Date().toLocaleTimeString()); // Heure actuelle
const lastMarkedDate = ref("01 Jan 2025");
const lastLeaveRequest = ref("15 Dec 2024");

const hasMarkedPresence = ref(false);
const markedTime = ref("");

// Fonction pour mettre à jour l'heure actuelle
const updateTime = () => {
  currentTime.value = new Date().toLocaleTimeString();
};

// Mettre à jour l'heure chaque seconde
onMounted(() => {
  setInterval(updateTime, 1000);
});

// Fonction pour marquer la présence
const markPresence = () => {
  hasMarkedPresence.value = true;
  markedTime.value = new Date().toLocaleTimeString();
};
</script>

<style scoped>
/* Animations pour les éléments */
@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }

  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.fadeIn {
  animation: fadeIn 0.5s ease-out forwards;
}

.fadeInDelay {
  animation-delay: 0.3s;
}
</style>
