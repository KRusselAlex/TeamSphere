<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

// Setup reactive state and refs
const route = useRoute();
const router = useRouter();

const validationErrors = ref<{ [key: string]: string }>({});

const formData = reactive({
  userId: route.params.id,
  permissionType: '',
  justificationFile: null as File | null,
  motif: '',
  startDate: '',
  endDate: '',
});

// Handle file uploads
const handleFileUpload = (event: Event) => {
  const fileReader = new FileReader();
  const input = event.target as HTMLInputElement;
  const files = input.files || [];

  if (!files.length) return;

  const file = files[0];

  if (file.type !== 'application/pdf' && !file.type.startsWith('image/')) {
    validationErrors.value['justificationFile'] = 'Only images and PDF files are allowed.';
    return;
  }

  fileReader.readAsDataURL(file);
  fileReader.addEventListener('load', () => {
    formData.justificationFile = file;
  });
};

// Validate form data
const validateForm = (): boolean => {
  validationErrors.value = {};

  if (!formData.permissionType) validationErrors.value['permissionType'] = 'Permission type is required.';
  if (!formData.motif) validationErrors.value['motif'] = 'Motif is required.';
  if (!formData.startDate) validationErrors.value['startDate'] = 'Start date is required.';
  if (!formData.endDate) validationErrors.value['endDate'] = 'End date is required.';
  if (!formData.justificationFile) validationErrors.value['justificationFile'] = 'Justification (image or PDF) is required.';

  // Check if endDate is later than startDate
  if (formData.startDate && formData.endDate && formData.startDate > formData.endDate) {
    validationErrors.value['endDate'] = 'End date cannot be earlier than start date.';
  }

  return Object.keys(validationErrors.value).length === 0;
};

// Handle form submission
const handleSubmit = () => {
  if (!validateForm()) {
    return; // Stop submission if there are errors
  }

  // Here you can call your API to submit the form
  console.log('Form submitted', formData);
};
</script>

<template>
  <DashboardTemplate>
    <div class="mx-3 mt-8 flex flex-col gap-6">
      <h2 class="font-sans font-semibold text-primaryColor text-xl">Demande de permissions</h2>
      <form class="grid md:bg-white md:border gap-5 rounded-xl md:p-10 font-serif" @submit.prevent="handleSubmit">

        <!-- Permission Type and Justification File -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

          <!-- Permission Type -->
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Type de
              permission</label>
            <span v-show="validationErrors['permissionType']" class="text-red-500 text-xs italic">{{
              validationErrors['permissionType'] }}</span>
            <select v-model="formData.permissionType"
              class="w-full rounded-inputRadius text-gray-900 py-4 px-2 outline-none border bg-white border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue">
              <option value="">Select a permission type</option>
              <option value="vacation">Vacation</option>
              <option value="sick">Sick</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Justification File -->
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Justification</label>
            <span v-show="validationErrors['justificationFile']" class="text-red-500 text-xs italic">{{
              validationErrors['justificationFile'] }}</span>
            <input type="file" accept="image/*,.pdf"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none"
              @change="handleFileUpload" />
          </div>

        </div>

        <!-- Motif Textarea -->
        <div class="grid grid-cols-1 gap-3">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Motif</label>
          <span v-show="validationErrors['motif']" class="text-red-500 text-xs italic">{{ validationErrors['motif']
            }}</span>
          <textarea v-model="formData.motif"
            class="w-full rounded-inputRadius h-24 text-gray-900 py-3 px-2 outline-none border border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue"
            placeholder="Motif"></textarea>
        </div>

        <!-- Start and End Date Inputs -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <!-- Start Date -->
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Start Date</label>
            <span v-show="validationErrors['startDate']" class="text-red-500 text-xs italic">{{
              validationErrors['startDate'] }}</span>
            <input type="date" v-model="formData.startDate"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none" />
          </div>

          <!-- End Date -->
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">End Date</label>
            <span v-show="validationErrors['endDate']" class="text-red-500 text-xs italic">{{
              validationErrors['endDate'] }}</span>
            <input type="date" v-model="formData.endDate"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center md:justify-start">
          <PrimaryButton title="Envoyer" css="bg-primaryColor px-3 py-2" type="submit" />
        </div>
      </form>
    </div>
  </DashboardTemplate>
</template>
