<script setup lang="ts">
import NavbarUser from '@/components/NavbarUser.vue';
import SideBar from '@/components/SideBar.vue';


</script>

<template>

  <div class="flex h-full">
    <SideBar />
    <div class="w-full h-full  flex flex-col ">
      <NavbarUser />
      <main class="md:py-6 mb-10 px-3 xl:px-10 2xl:px-20  lg:border lg:mx-10  2xl:mx-20 rounded-lg">
        <slot ></slot>
      </main>
    </div>
  </div>
</template>
