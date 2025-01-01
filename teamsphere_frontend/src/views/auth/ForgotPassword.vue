<script setup lang="ts">
import LogoImage from '@/components/LogoImage.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

</script>

<template>

  <div class="grid  bg-primaryColor lg:bg-transparent lg:grid-cols-2  min-h-screen h-full px-1 lg:px-0">
    <div class="relative bg-primaryColor flex flex-col gap-9 justify-center items-center ">

      <LogoImage color="#fff" size="200" class="hidden lg:flex" />
      <LogoImage color="#fff" size="100" class="hidden md:flex lg:hidden" />
      <LogoImage color="#fff" size="50" class="flex md:hidden" />
      <div class="text-white hidden text-center md:flex flex-col gap-2">
        <h1 class="font-sans text-3xl font-semibold">Recevez un email de réinitialisation !</h1>
        <p class="font-serif text-xl">Un lien pour réinitialiser votre mot de passe vous sera <span class="block">envoyé
            immédiatement.</span> </p>




      </div>


    </div>
    <div
      class="flex flex-col items-center justify-center lg:items-start bg-white shadow lg:shadow-none gap-8 w-full lg:w-4/5 py-4 px-4 md:px-8 rounded-lg mx-auto ">

      <router-link to="/auth/login" class="text-sm font-serif flex gap-2 justify-center items-center"> <svg width="20px"
          height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM13.79 15C14.08 15.29 14.08 15.77 13.79 16.06C13.64 16.21 13.45 16.28 13.26 16.28C13.07 16.28 12.88 16.21 12.73 16.06L9.2 12.53C8.91 12.24 8.91 11.76 9.2 11.47L12.73 7.94C13.02 7.65 13.5 7.65 13.79 7.94C14.08 8.23 14.08 8.71 13.79 9L10.79 12L13.79 15Z"
            fill="#ff7a21" />
        </svg>
        <strong class="mt-1">Retour à la connexion
        </strong>

      </router-link>

      <div class="flex flex-col items-center lg:items-start  gap-2 ">
        <h1 class="font-sans text-xl  md:text-3xl font-semibold">
          Mot de passe oublié
        </h1>
        <p class="text-sm font-serif">
          Si votre adresse email est associée à un compte, vous recevrez un email avec les instructions pour
          réinitialiser votre mot de passe.</p>


      </div>
      <form action="" class="flex flex-col gap-4 lg:gap-3 w-full">


        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans">Adresse e-mail</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>


        <div class="grid  mt-2 md:mt-5 ">
          <div class="grid md:grid-cols-2 gap-4 items-center   w-full">

            <PrimaryButton css="bg-primaryColor px-3 py-3  font-bold text-xl " title="Envoyer le lien" />



          </div>


        </div>


      </form>
      <div>

      </div>

    </div>

  </div>

</template>
