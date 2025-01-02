
<script setup lang="ts">
import { ref } from 'vue';
import { defineProps } from 'vue';
import PrimaryButton from '../PrimaryButton.vue';
import type { PresenceRequest } from '@/api/presence/presenceTypes';
import { formatDateEtHeure, formatDateEtHeureDeux } from '@/utils/DateConverter';

const selectedDate = ref('');



const props = defineProps<{
  presences: PresenceRequest[];
}>();

console.log(props.presences)
</script>

<template>
  <div class="flex flex-col gap-6 bg-white border rounded-lg p-8">

    <div class="flex justify-between">

      <RouterLink to="/dashboard/attendances/mark">
        <PrimaryButton type="button" title="Marquer la présence"
          css="bg-primaryColor font-semibold text-2xl  px-4 py-4" />
      </RouterLink>


      <div class="flex gap-x-4 items-center">

        <div
          class="flex px-4 py-3 rounded-inputRadius border bg-white overflow-hidden font-sans-serif border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px"
              class="fill-gray-600 mr-3 rotate-90 cursor-pointer">
              <path
                d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z" />
            </svg>
          </span>
          <input type="text" placeholder="Recherche..." class="outline-none text-black w-4 md:w-32 bg-white text-sm" />
        </div>

        <!-- Date Picker -->
        <input type="date" v-model="selectedDate"
          class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue" />
      </div>
    </div>

    <!-- Permissions Table -->
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
      <thead class="bg-gray-50 rounded-xl">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nom Utilisateur
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Date
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(presence, index) in props.presences" :key="presence.id">

          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
          </td>


          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ presence?.username }}</div>
          </td>


          <td class="px-6 py-4 whitespace-nowrap">

            <div class="text-sm font-medium text-gray-900">{{ formatDateEtHeure(presence?.marked_at) }}</div>

          </td>

          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ formatDateEtHeureDeux(presence?.marked_at) }}</div>
          </td>

          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center items-center">

            <RouterLink :to="`/dashboard/attendances/${presence?.id}`" class="ml-2 text-red-600 hover:text-red-900">
              <svg width="28px" height="28px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="m16 0c8.836556 0 16 7.163444 16 16s-7.163444 16-16 16-16-7.163444-16-16 7.163444-16 16-16zm1.3 20.5h-2.6v2.6h2.6zm-1.3-11.5c-2.209139 0-4 1.790861-4 4h2l.0054857-.1492623c.0763492-1.0348599.9401525-1.8507377 1.9945143-1.8507377 1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2h-1v4h2l.0006624-2.126188c1.7248911-.4442732 2.9993376-2.0109264 2.9993376-3.873812 0-2.209139-1.790861-4-4-4z"
                  fill="#000" />
              </svg>
            </RouterLink>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
