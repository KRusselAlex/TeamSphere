<script setup lang="ts">
import { defineProps } from 'vue';


const props = defineProps<{
  title: string;
  size: string | number;
  css?: string;
}>();
</script>

<template>
  <div class="flex items-center bg-white font-sans justify-around py-4  border rounded-lg overflow-hidden ">
     <div class="px-4 text-gray-700">
      <h3 class="text-sm tracking-wider">
        {{ props.title }}
      </h3>
      <p class="text-3xl">
        {{ props.size }}
      </p>
    </div>
    <div :class="`px-4 ${props.css || ''}`">
      <slot />
    </div>

  </div>
</template>

<style>
/* Add your styles here */
</style>
