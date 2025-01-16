<script setup lang="ts">
import { onMounted, ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";
import LogoImage from "@/components/LogoImage.vue";
import { decryptData } from "@/api/tokenEncryption";
import { usePermissionStore } from "@/stores/permissionStore"
import { useUserStore } from '@/stores/userStore';
import { usePresenceStore } from '@/stores/pressenceStore';
const presenceStore = usePresenceStore();
presenceStore.fetchPresences()

const permissionStore = usePermissionStore();
permissionStore.fetchPermissions();
const userStore = useUserStore();
userStore.fetchUsers();


const router = useRouter();
const route = useRoute();

const message = ref("");
const status = ref("info");
const isLoading = ref(false);

onMounted(async () => {
  const verificationToken = route.query.verification_url;
  const datas: string[] | null = decryptData();
  const localStorageToken = datas ? datas[0] : null;

  if (!verificationToken) {
    // Pas de token dans l'URL
    message.value =
      "Nous n'avons pas pu vérifier votre email. Assurez-vous d'utiliser le lien de vérification envoyé à votre adresse email.";
    status.value = "error";
    return;
  }

  if (!localStorageToken) {

    message.value =
      "Votre session a expiré. Veuillez vous reconnecter pour continuer.";
    status.value = "error";
    setTimeout(() => router.push("/auth/login"), 3000);
    return;
  }

  try {
    isLoading.value = true;

    const response = await axios.get(verificationToken as string, {
      headers: {
        Authorization: `Bearer ${localStorageToken}`,
      },
    });

    if (response.status === 200) {

      message.value =
        "Votre email a été vérifié avec succès ! Redirection en cours...";
      status.value = "success";
      setTimeout(() => router.push("/dashboard/attendances"), 3000);
    } else {

      message.value =
        "Une erreur est survenue lors de la vérification de votre email. Veuillez réessayer.";
      status.value = "error";
    }
  } catch (error) {
    console.error("Erreur lors de la vérification :", error);
    message.value =
      "La vérification a échoué. Le lien est peut-être invalide ou expiré.";
    status.value = "error";
  } finally {
    isLoading.value = false;
  }
});
</script>

<template>
  <div class="flex flex-col gap-8 items-center justify-center min-h-screen bg-primaryColor ">
    <RouterLink to="/auth/login">
      <LogoImage size="100" color="#fff" />

    </RouterLink>

    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-lg w-full">

      <div v-if="isLoading" class="flex flex-col items-center gap-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin w-16 h-16 text-blue-500" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
        </svg>
        <p class="text-gray-600 font-semibold text-lg">Vérification en cours...</p>
      </div>

      <!-- Message après chargement -->
      <div v-else>
        <div :class="{
          'text-blue-500': status === 'info',
          'text-green-500': status === 'success',
          'text-red-500': status === 'error',
        }" class="flex items-center gap-3 text-lg font-semibold">
          <!-- Success Icon -->
          <svg v-if="status === 'success'" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-500"
            fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 00-1.414 0L7 13.586 4.707 11.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l9-9a1 1 0 000-1.414z"
              clip-rule="evenodd" />
          </svg>
          <!-- Error Icon -->
          <svg v-if="status === 'error'" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500"
            fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3-10a1 1 0 10-1-1h-4a1 1 0 100 2h4a1 1 0 001-1zm-3 4a1 1 0 10-1-1 1 1 0 100 2h.01z"
              clip-rule="evenodd" />
          </svg>
          <!-- Info Icon -->
          <svg v-if="status === 'info'" xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-blue-500"
            fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2a1 1 0 102 0V7zm0 4a1 1 0 10-2 0v2a1 1 0 102 0v-2z"
              clip-rule="evenodd" />
          </svg>
          <!-- Message -->
          <span class="text-gray-700">{{ message }}</span>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
/* Animation pour le spinner */
@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.animate-spin {
  animation: spin 1s linear infinite;
}
</style>
