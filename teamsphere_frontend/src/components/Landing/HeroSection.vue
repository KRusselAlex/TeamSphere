<template>
  <section
    class=" grid grid-cols-1 bg-thirdColor md:grid-cols-2  items-center justify-between gap-3 md:px-10 py-10  lg:px-16 ">

    <div class="md:text-start">
      <h1 class="text-4xl lg:text-5xl   md:text-start text-white font-bold font-sans ">Suivez,
        gérez et
        approuvez. </h1>
      <p class="text-xl lg:text-2xl mt-6 font-serif text-white">Maîtrisez la gestion des présences, des
        autorisations et des membres de votre équipe en toute simplicité avec TeamSphere.
      </p>
      <p class="mt-8 md:mt-12">
        <a href="/dashboard">

          <PrimaryButton title="Mon Tableau" type="submit"
            css="bg-primaryColor px-6 text-red-400 font-semibold  hover: py-4 " />


        </a>
      </p>

    </div>

    <div class="w-full flex justify-end">
      <img src="../../assets/image.png" class="w-11/12" alt="header-image">
    </div>

  </section>
</template>

<script setup lang="ts">
import PrimaryButton from '../PrimaryButton.vue';



</script>

