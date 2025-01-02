<script setup lang="ts">
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { ref } from 'vue';
import { useToast } from 'vue-toast-notification';
import { PresentUser } from '@/utils/presentUser';

const Api_url = import.meta.env.VITE_API_URL_EM
const user = ref(PresentUser());
const toast = useToast();
const profileData = ref({
  username: user.value?.username,
  fullName: user.value?.fullname? user.value.fullname : "",
  email: user.value?.email,
  password: '',
  confirmPassword: '',
  newPassword: '',
  profileImage: user.value?.image? Api_url + user.value?.image : null,
});
;


const handleFileUpload = (e: Event) => {
  const fileReader = new FileReader();
  const input = e.target as HTMLInputElement;
  const files = input.files || [];

  if (!files.length) return;

  fileReader.readAsDataURL(files[0]);
  fileReader.onload = () => {
    profileData.value.profileImage = files[0];
  };
};


const handleSubmit = () => {

  if (!profileData.value.username || !profileData.value.fullName || !profileData.value.email) {
    toast.error('Tous les champs sont obligatoires!');
    return;
  }

  if (profileData.value.newPassword !== profileData.value.confirmPassword) {
    toast.error('Le mot de passe et la confirmation du mot de passe ne correspondent pas!');
    return;
  }


  toast.success('Profil mis à jour avec succès!');

};

</script>

<template>
  <DashboardTemplate>
    <div class="mx-auto p-8">
      <h2 class="text-2xl font-semibold text-primaryColor mb-6 text-sans">Profil utilisateur</h2>
      <div class="  p-8 bg-white border rounded-lg">


        <form @submit.prevent="handleSubmit">

          <div class="grid grid-cols-1 grid-cols-2">
            <div class="flex items-center mb-6">
              <label for="profile-image" class="mr-4">
                <img v-if="profileData.profileImage" :src="profileData.profileImage"
                  alt="Image de profil" class="w-20 h-20 rounded-full object-cover" />
                <div v-else class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-500">
                  <span class="text-xl">👤</span>
                </div>
              </label>
              <input id="profile-image" type="file" accept="image/*" class="hidden" @change="handleFileUpload" />
              <button type="button"
                class="bg-primaryColor bg-opacity-50 text-white py-2 px-4 rounded-full hover:bg-opacity-90"
                >
                Changer l'image
              </button>

            </div>
            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Nom d'utilisateur</label>
              <input v-model="profileData.username" type="text"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Nom d'utilisateur" />
            </div>

          </div>



          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Email</label>
              <input v-model="profileData.email" type="email"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Email" />
            </div>

            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Nom complet</label>
              <input v-model="profileData.fullName" type="text"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Nom complet" />
            </div>


            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Département</label>
              <input v-model="profileData.email" type="email"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Département" />
            </div>
            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Mot de passe actuel</label>
              <input v-model="profileData.confirmPassword" type="password"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Mot de passe actuel" />
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Nouveau mot de passe</label>
              <input v-model="profileData.newPassword" type="password"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Nouveau mot de passe" />
            </div>

            <div class="flex flex-col">
              <label class="text-sm font-semibold text-gray-600 mb-1">Confirmer le mot de passe</label>
              <input v-model="profileData.confirmPassword" type="password"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primaryColor"
                placeholder="Confirmer le mot de passe" />
            </div>

          </div>


          <div class="flex justify-center md:justify-start">
            <PrimaryButton type="submit" title=" Enregistrer" css="bg-primaryColor text-white py-3 px-6 ">
            </PrimaryButton>

          </div>
        </form>
      </div>

    </div>


  </DashboardTemplate>

</template>

