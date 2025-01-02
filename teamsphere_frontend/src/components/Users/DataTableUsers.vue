<script setup lang="ts">
import { ref } from 'vue';
import PrimaryButton from '../PrimaryButton.vue';
import { useUserStore } from '@/stores/userStore';




const userStore = useUserStore();
const selectedDate = ref('');



</script>

<template>
  <div class="flex flex-col gap-6 bg-white border rounded-lg p-8">

    <div class="flex justify-between">

      <RouterLink to="/dashboard/users/create">
        <PrimaryButton type="button" title="Ajouter un utilisateur" css="bg-primaryColor font-medium px-3 py-3" />
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

    <!-- users Table -->
    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
      <thead class="bg-gray-50 rounded-xl">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nom Utilisateur
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nom complet
          </th>

          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Adresse Email
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Actions
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(user, index) in userStore.users" :key="user.id">

          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ index + 1 }}</div>
          </td>


          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ user?.username }}</div>
          </td>


          <td class="px-6 py-4 whitespace-nowrap">

            <div class="text-sm font-medium text-gray-900">{{ user?.fullname }}</div>

          </td>

          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ user?.email }}</div>

          </td>

          <td class="px-6 py-4 whitespace-nowrap text-sm gap-3 font-medium flex justify-center items-center">
            <button class="text-primaryColor ">

              <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M15.4998 5.49994L18.3282 8.32837M3 20.9997L3.04745 20.6675C3.21536 19.4922 3.29932 18.9045 3.49029 18.3558C3.65975 17.8689 3.89124 17.4059 4.17906 16.9783C4.50341 16.4963 4.92319 16.0765 5.76274 15.237L17.4107 3.58896C18.1918 2.80791 19.4581 2.80791 20.2392 3.58896C21.0202 4.37001 21.0202 5.63634 20.2392 6.41739L8.37744 18.2791C7.61579 19.0408 7.23497 19.4216 6.8012 19.7244C6.41618 19.9932 6.00093 20.2159 5.56398 20.3879C5.07171 20.5817 4.54375 20.6882 3.48793 20.9012L3 20.9997Z"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <button class="text-red-600 hover:text-red-900">

              <svg width="33px" height="33px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 7H20" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                  d="M6 10L7.70141 19.3578C7.87432 20.3088 8.70258 21 9.66915 21H14.3308C15.2974 21 16.1257 20.3087 16.2986 19.3578L18 10"
                  stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#FF0000"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </button>
            <!-- <RouterLink :to="`/dashboard/users/${user?.id}`" class="ml-2 text-red-600 hover:text-red-900">

              <svg width="28px" height="28px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="m16 0c8.836556 0 16 7.163444 16 16s-7.163444 16-16 16-16-7.163444-16-16 7.163444-16 16-16zm1.3 20.5h-2.6v2.6h2.6zm-1.3-11.5c-2.209139 0-4 1.790861-4 4h2l.0054857-.1492623c.0763492-1.0348599.9401525-1.8507377 1.9945143-1.8507377 1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2h-1v4h2l.0006624-2.126188c1.7248911-.4442732 2.9993376-2.0109264 2.9993376-3.873812 0-2.209139-1.790861-4-4-4z"
                  fill="#000" />
              </svg>
            </RouterLink> -->
            <button class="ml-2 text-red-600 hover:text-red-900">

              <svg width="28px" height="28px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="m16 0c8.836556 0 16 7.163444 16 16s-7.163444 16-16 16-16-7.163444-16-16 7.163444-16 16-16zm1.3 20.5h-2.6v2.6h2.6zm-1.3-11.5c-2.209139 0-4 1.790861-4 4h2l.0054857-.1492623c.0763492-1.0348599.9401525-1.8507377 1.9945143-1.8507377 1.1045695 0 2 .8954305 2 2s-.8954305 2-2 2h-1v4h2l.0006624-2.126188c1.7248911-.4442732 2.9993376-2.0109264 2.9993376-3.873812 0-2.209139-1.790861-4-4-4z"
                  fill="#000" />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
