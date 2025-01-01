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
        <h1 class="font-sans text-3xl font-semibold">Sécurité sur TeamSphere</h1>
        <p class="font-serif text-xl">Réinitialisez votre mot de passe en un clic.</p>
      </div>


    </div>
    <div
      class="flex flex-col items-center justify-center lg:items-start bg-white shadow lg:shadow-none gap-8 w-full lg:w-4/5 py-4 px-4 md:px-8 rounded-lg mx-auto ">

      <div class="flex flex-col items-center lg:items-start  gap-2 ">
        <h1 class="font-sans text-xl  md:text-3xl font-semibold">
          Réinitialiser le mot de passe
        </h1>
        <p class="text-sm font-serif">
          Saisissez votre adresse e-mail ainsi que votre nouveau mot de passe pour mettre à jour votre compte.</p>


      </div>
      <form action="" class="flex flex-col gap-4 lg:gap-3 w-full">


        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans">Adresse e-mail</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>
        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans">Mot de passe</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>
        <div class="flex flex-col gap-2 w-full">
          <label for="username font-sans">Confirmer le mot de passe</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>



        <div class="grid  mt-2 md:mt-5 ">
          <div class="grid md:grid-cols-2 gap-4 items-center   w-full">

            <PrimaryButton css="bg-primaryColor px-3 py-3  font-bold text-xl " title="Réinitialiser" />



          </div>


        </div>


      </form>
      <div>

      </div>

    </div>

  </div>

</template>
