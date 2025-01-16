<script setup lang="ts">
import PrimaryButton from '../PrimaryButton.vue';


</script>

<template>
  <section class="call-to-action  flex flex-col justify-center items-center text-[#000]  py-40 ">
    <div class=" text-center  w-1/2">
      <h2 class="text-3xl md:text-4xl font-bold mb-6  font-sans">
        Prêt à transformer la productivité de votre équipe ?
      </h2>
      <p class="text-lg md:text-xl mb-8 font-serif">
        Commencez dès aujourd'hui avec TeamSphere et profitez d'une gestion d'équipe fluide.
      </p>
      <div class="flex justify-center gap-4">
        <PrimaryButton title=" Commencer" type="button"
          css="bg-primaryColor font-sans font-semibold py-3 px-6 rounded-full shadow-lg hover:bg-thirdColor transition duration-200" />

        <button @click="navigateToDemo"
          class="bg-transparent border-2 font-sans text-[#000]   border-white  font-semibold py-3 px-6 rounded-full hover:bg-white hover:text-purple-600 transition duration-200">
          Demander une Démo
        </button>
      </div>
    </div>
  </section>

</template>


<style scoped>
.call-to-action {
  background-size: cover;
  background-position: center;
}
</style>
