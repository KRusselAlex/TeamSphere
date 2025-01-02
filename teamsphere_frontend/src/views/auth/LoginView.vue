<script setup lang="ts">
import { ref, watch } from 'vue';
import LogoImage from '@/components/LogoImage.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { loginUser } from '@/api/auth/authServices';
import type { LoginRequest } from '@/api/auth/authTypes';
import { useRouter ,useRoute} from 'vue-router';

interface FinaleMessage {
  email?: string;
}


const router = useRouter();
const route = useRoute();
const finaleMessage = ref<FinaleMessage>({});
const email = ref('');
const password = ref('');
const passwordDisplay = ref(false);


const errors = ref({
  email: '',
  password: '',
});


const validateEmail = (value: string) => {
  const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
  if (value === '') {
    return 'L\'email est requis.';
  }
  if (!emailPattern.test(value)) {
    return 'Veuillez entrer un email valide.';
  }
  return '';
};


const validatePassword = (value: string) => {
  if (value === '') {
    return 'Le mot de passe est requis.';
  }
  return '';
};

// Watchers pour valider les champs dès qu'ils changent
watch(email, (newValue) => {
  errors.value.email = validateEmail(newValue);
});

watch(password, (newValue) => {
  errors.value.password = validatePassword(newValue);
});


const submitForm = async () => {
  const data: LoginRequest = {
    email: email.value,
    password: password.value,
  };

  if(!email.value){
    errors.value.email = "Veuillez entrer un email valide."
  }
  if (!password.value) {
    errors.value.password = "Veuillez entrer un mot de passe valide."
  }


  if (!errors.value.email && !errors.value.password) {
    console.log('Formulaire soumis avec succès');

    const response = await loginUser(data);
    console.log(response);
    if (response.success) {

      console.log("Successfully logged in");
      let redirectTo = route.query.redirect;
      if (redirectTo) {

        if (Array.isArray(redirectTo)) {
          // If it's an array, join the elements into a string, assuming it's query values
          redirectTo = redirectTo.join(',');  // Or format it as needed for a path or query string
        }

        localStorage.removeItem('redirectTo');
        router.push(redirectTo);
      } else {

        router.push({ name: 'dashboard.home' });
      }
    } else {
      finaleMessage.value = response.response.data.errors;
      if (response.response.data.errors?.email?.[0]) {
        finaleMessage.value.email = "Les indentifiants sont erronés."
      }

    }
  } else {
    console.log('Le formulaire contient des erreurs.');
  }
};
</script>

<template>
  <div class="grid bg-primaryColor lg:bg-transparent lg:grid-cols-2 min-h-screen h-full px-1 lg:px-0">
    <div class="relative bg-primaryColor flex flex-col gap-9 justify-center items-center">
      <LogoImage color="#fff" size="200" class="hidden lg:flex" />
      <LogoImage color="#fff" size="100" class="hidden md:flex lg:hidden" />
      <LogoImage color="#fff" size="50" class="flex md:hidden" />
      <div class="text-white hidden text-center md:flex flex-col gap-2">
        <h1 class="font-sans text-3xl font-semibold">Bienvenue dans TeamSphere !</h1>
        <p class="font-serif text-xl">Gérez vos présences, permissions et collaborez efficacement.</p>
      </div>
    </div>

    <div
      class="flex flex-col items-center justify-center lg:items-start bg-white shadow lg:shadow-none gap-8 w-full lg:w-4/5 py-4 px-4 md:px-8 rounded-lg mx-auto">
      <div class="flex flex-col items-center lg:items-start gap-2">
        <h1 class="font-sans text-xl md:text-3xl font-semibold">Connexion</h1>
        <p class="text-sm font-serif">Vous n'avez pas de compte ? <strong><router-link
              to="/auth/register">S'inscrire</router-link></strong></p>
        <strong class="text-sm font-serif"><router-link to="/auth/forgot-password">Mot de passe oublié
            ?</router-link></strong>
      </div>

      <form @submit.prevent="submitForm" class="flex flex-col gap-4 lg:gap-3 w-full">
        <p v-if="finaleMessage" class="text-red-500 text-center md:text-start text-xl font-sans">{{ finaleMessage.email }}</p>
        <div class="flex flex-col gap-2 w-full">
          <label for="email" class="font-sans">Adresse e-mail</label>
          <input type="email" id="email" v-model="email"
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue" />
          <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</p>
        </div>

        <div class="flex flex-col gap-2 w-full">
          <div class="flex items-center justify-between">
            <label for="password" class="font-sans">Mot de passe</label>
            <p class="cursor-pointer">
              <svg v-if="!passwordDisplay" width="26px" height="26px" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" @click="passwordDisplay = !passwordDisplay">
                <path
                  d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                  stroke="#9ea5b1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                  stroke="#9ea5b1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <svg v-else width="26px" class="pointer" height="26px" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" @click="passwordDisplay = !passwordDisplay">
                <path
                  d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                  stroke="#9ea5b1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </p>

          </div>

          <input :type="passwordDisplay ? 'text' : 'password'" id="password" v-model="password"
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue">
          <p v-if="errors.password" class="text-red-500 text-sm">{{ errors.password }}</p>
        </div>

        <div class="grid mt-2 md:mt-5">
          <div class="grid md:grid-cols-2 gap-4 items-center w-full">
            <PrimaryButton css="bg-primaryColor px-3 py-3 font-bold text-xl" type="submit" title="Connexion" />
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
