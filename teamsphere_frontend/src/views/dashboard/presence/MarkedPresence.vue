<template>
  <DashboardTemplate>
    <div class="p-8">
      <h2 class="text-3xl font-semibold font-sans text-primaryColor mb-6 animated fadeIn">Marquer votre présence</h2>
      <div class="p-8 bg-white border font-serif rounded-lg">

        <span v-show="message" :class="{
          'bg-green-100 text-green-800': message === 'Vous etes Present',
          'bg-red-100 text-red-800': message === 'Erreur Reessayer',

        }" class="text-xl text-center rounded-lg py-3 italic">{{ message }}</span>
        <div class="text-center mb-6 animated fadeIn" :class="{ 'fadeInDelay': true }">
          <h3 class="text-xl text-gray-600">Bienvenue, <strong>{{ username }}</strong>!</h3>
          <p class="text-lg text-gray-500">Nous sommes ravis de vous voir ici aujourd'hui.</p>
        </div>

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
            <li>Présence marquée le {{ lastMarkedDate }} a {{ historique }}</li>

          </ul>
        </div>


        <div v-if="!hasMarkedPresence" class="text-center animated fadeIn" :class="{ 'fadeInDelay': true }">
          <button
            class="bg-primaryColor font-sans font-semibold text-white py-3 px-8 rounded-lg  transition-all duration-300 transform hover:scale-105"
            @click="markPresence">
            <span class="text-xl">✔ Marquer ma présence</span>
          </button>
        </div>


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
import { formatDate, formatDateEtHeure } from "@/utils/DateConverter";
import DashboardTemplate from "@/components/DashboardTemplate.vue";
import { ref, onMounted } from "vue";
import { usePresenceStore } from "@/stores/pressenceStore";
import { decryptData } from '@/api/tokenEncryption';
import type { PresenceRequest } from "@/api/presence/presenceTypes";
import { useUserStore } from "@/stores/userStore";
import type { UserRequest } from "@/api/user/userTypes";

const userStore = useUserStore();
const presenceStore = usePresenceStore();
const decryptDatas = decryptData();
const userID = decryptDatas ? decryptDatas[1] : null;

const todayDate = ref(formatDate(new Date()));
const currentTime = ref(new Date().toLocaleTimeString());
const lastMarkedDate = ref(formatDate(presenceStore.presences[1].marked_at));
const historique = formatDateEtHeure(presenceStore.presences[1].marked_at);
// const lastLeaveRequest = ref("15 Dec 2024");
const userPresent = ref<UserRequest | null>(null);;
const message = ref('');
const hasMarkedPresence = ref(false);
const markedTime = ref("");


  userPresent.value =   userStore.getOneUser(Number(userID));
const username = ref(userPresent.value?.username);

const updateTime = () => {
  currentTime.value = new Date().toLocaleTimeString();
};

onMounted(() => {
  setInterval(updateTime, 1000);
  checkPresenceToday();
});


const checkPresenceToday = () => {
  if (userID) {
    const userPresence = presenceStore.hasMarkedPresenceToday(Number(userID));
    if (userPresence) {
      hasMarkedPresence.value = true;
      markedTime.value = new Date().toLocaleTimeString();
    }
  }
};


const markPresence = async () => {
  if (userID) {
    const data: PresenceRequest = {
      user_id: Number(userID),
    };

    const response = await presenceStore.addPresence(data);

    if (response) {
      message.value = "Vous êtes présent";
      hasMarkedPresence.value = true;
      markedTime.value = new Date().toLocaleTimeString();
    } else {
      message.value = "Vous avez déjà marqué votre présence aujourd'hui";
    }
  }
};
</script>
