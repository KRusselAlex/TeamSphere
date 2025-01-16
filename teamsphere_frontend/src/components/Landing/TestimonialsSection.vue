<template>
  <section class="testimonials-section px-16 py-36">
    <div class="text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-8 font-sans ">
        Ce que disent nos utilisateurs
      </h2>
      <div class="grid grid-cols-1 font-serif md:grid-cols-3 gap-8">
        <div v-for="(testimonial, index) in testimonials" :key="index"
          class="testimonial-item bg-white shadow-lg rounded-lg p-6">
          <p class="text-lg italic  mb-4">
            "{{ testimonial.quote }}"
          </p>
          <div class="flex items-center justify-center">
            <img src="../../assets/testy.png" alt="Avatar de l'utilisateur"
              class="w-12 h-12 rounded-full border-2 border-gray-300 mr-4" />
            <div>
              <h4 class="text-md font-semibold text-gray-800">
                {{ testimonial.name }}
              </h4>
              <p class="text-sm text-gray-500">{{ testimonial.role }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</template>

<script setup lang="ts">
import { ref } from 'vue';

const testimonials = ref([
  {
    name: "Jane Doe",
    role: "Responsable de projet",
    quote:
      "TeamSphere a transformé la manière dont nous gérons nos projets et suivons la présence de l'équipe. C'est une véritable révolution !",
    avatar: "https://depositphotos.com/photo/portrait-female-owner-gift-store-standing-front-shelves-cosmetics-candles-420021494.html", // Remplacez par de vrais URL d'avatar
  },
  {
    name: "John Smith",
    role: "Chef d'équipe",
    quote:
      "La fonctionnalité de gestion des permissions est incroyablement intuitive. Les approbations n'ont jamais été aussi rapides !",
    avatar: "../../assets/testy.png",
  },
  {
    name: "Sarah Johnson",
    role: "Spécialiste RH",
    quote:
      "Les outils de TeamSphere ont rationalisé nos processus RH et considérablement amélioré la collaboration au sein de l'équipe.",
    avatar: "https://via.placeholder.com/150",
  },
])

</script>

<style scoped>
.testimonials-section {
  background-color: #f9fafb;
}
</style>
