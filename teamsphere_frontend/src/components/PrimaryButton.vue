<script setup lang="ts">
import { defineProps } from 'vue';

interface ButtonProps {
  title: string;
  css?: string;
  type: 'button' | 'submit' | 'reset' ;
}


const props = defineProps<ButtonProps>();
</script>

<template>
  <button :class="`rounded-full font-sans text-white  ${props.css}`" :type="props.type">
    {{ props.title }}
  </button>
</template>
