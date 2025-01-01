<script setup lang="ts">
import NavbarUser from '@/components/NavbarUser.vue';
import SideBar from '@/components/SideBar.vue';


</script>

<template>

<div class="flex">
  <SideBar />
  <div class=" w-full h-screen bg-sideColor bg-opacity-70 rounded-2xl pt-8 flex flex-col overflow-hidden">
    <NavbarUser />
    <main class="px-3 rounded-lg min-w-full w-full  flex-grow overflow-x-auto overflow-y-auto md:overflow-y-auto">
      <slot></slot>
    </main>
  </div>
</div>

</template>
