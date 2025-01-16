<script setup lang="ts">
import FooterSection from '@/components/Landing/FooterSection.vue';
import HeroSection from '@/components/Landing/HeroSection.vue';
import CallToActionSection from "@/components/Landing/CallToActionSection.vue"

import FeaturesSection from '@/components/Landing/FeaturesSection.vue';
import TestimonialsSection from '@/components/Landing/TestimonialsSection.vue';
import NavSection from '@/components/Landing/NavSection.vue';




</script>

<template>
  <div class="">
    <NavSection />
    <main class="">
      <HeroSection />
      <CallToActionSection />
      <FeaturesSection />
      <TestimonialsSection />
    </main>
    <FooterSection />
  </div>
</template>

<style scoped></style>
