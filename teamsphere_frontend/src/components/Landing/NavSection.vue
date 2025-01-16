<script setup lang="ts">
import LogoImage from '@/components/LogoImage.vue';
</script>
<template>
  <header class="flex justify-between items-center  bg-primaryColor py-8 px-16">

    <RouterLink to="/" class="flex items-center gap-3">
      <LogoImage color="#fff" size="60" />
      <div class="flex items-center text-3xl text-white font-sans font-bold">
        TeamSphere
      </div>
    </RouterLink>
    <div class="flex font-semibold text-lg text-white font-serif">
      <a class="px-4" href="#features">Functionalite</a>
      <a class="px-4" href="#features">Services</a>

    </div>
    <div class="flex justify-between gap-8 items-center">


      <div class="hidden md:flex justify-end items-center gap-x-3">

        <RouterLink to="/auth/register">
          <button type="button"
            class=" py-3 px-4 font-semibold text-gray-800 bg-[#fff]  font-sans  rounded-full  hover:bg-thirdColor hover:text-white   ">

            Rejoignez Nous
          </button>
        </RouterLink>
        <div>

          <button type="button"
            class=" py-3 px-4 font-semibold  bg-white font-sans  rounded-full hover:bg-thirdColor  text-gray-800 "
            v-if="userpp" @click="handleLogout">
            Deconnexion
          </button>

          <RouterLink to="/auth/login" v-else>
            <button type="button" class=" py-3 px-4 font-semibold  bg-white font-sans  rounded-full text-gray-800 ">
              Connexion
            </button>

          </RouterLink>

        </div>

        <a href="/dashboard" v-if="userpp">
          <button type="button" class=" py-3 px-4 font-semibold  bg-white font-sans  rounded-full text-gray-800 ">
            Votre Tableau
          </button>
        </a>
      </div>

    </div>


  </header>
</template>

    <script setup lang="ts">



    </script>

