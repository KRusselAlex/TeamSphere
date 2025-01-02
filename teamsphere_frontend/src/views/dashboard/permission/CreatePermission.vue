<script setup lang="ts">
import { reactive, ref } from 'vue';
// import { useRouter, useRoute } from 'vue-router';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { decryptData } from '@/api/tokenEncryption';
import { usePermissionStore } from "@/stores/permissionStore"
import type { PermissionRequest } from '@/api/permission/permissionsTypes';


const permissionStore = usePermissionStore();
const message = ref('');
const decryptDatas = decryptData();
const userID = decryptDatas ? decryptDatas[1] : null;


const validationErrors = ref<{ [key: string]: string }>({});

const formData: PermissionRequest = reactive({
  user_id: Number(userID),
  permission_type: '',
  justification: null as File | null,
  reason: '',
  start_date: '',
  end_date: '',
});


const handleFileUpload = (event: Event) => {
  const fileReader = new FileReader();
  const input = event.target as HTMLInputElement;
  const files = input.files || [];

  if (!files.length) return;

  const file = files[0];

  if (file.type !== 'application/pdf' && !file.type.startsWith('image/')) {
    validationErrors.value['justification'] = 'Only images and PDF files are allowed.';
    return;
  }

  fileReader.readAsDataURL(file);
  fileReader.addEventListener('load', () => {
    formData.justification = file;
  });
};

const validateForm = (): boolean => {
  validationErrors.value = {};

  if (!formData.permission_type) validationErrors.value['permission_type'] = 'Permission type is required.';
  if (!formData.reason) validationErrors.value['reason'] = 'reason is required.';
  if (!formData.start_date) validationErrors.value['start_date'] = 'Start date is required.';
  if (!formData.end_date) validationErrors.value['end_date'] = 'End date is required.';
  // if (!formData.justification) validationErrors.value['justification'] = 'Justification (image or PDF) is required.';


  if (formData.start_date && formData.end_date && formData.start_date > formData.end_date) {
    validationErrors.value['end_date'] = 'End date cannot be earlier than start date.';
  }

  return Object.keys(validationErrors.value).length === 0;
};


const handleSubmit = async () => {
  if (!validateForm()) {
    return;
  }


  console.log('Form submitted', formData);
  const response = await permissionStore.addPermission(formData);

  if (response) {

    formData.justification = null
    formData.permission_type=''
    formData.reason = ''
    formData.start_date=''
    formData.end_date = ''


    message.value = "Permission envoyer avec success"


  } else {
    message.value = "Erreur Reessayer"
  }


};
</script>

<template>
  <DashboardTemplate>
    <div class="mx-3 mt-8 flex flex-col gap-6">
      <h2 class="font-sans font-semibold text-primaryColor text-xl">Demande de permissions</h2>
      <form class="grid md:bg-white md:border gap-5 rounded-xl md:p-10 font-serif" @submit.prevent="handleSubmit">
        <span v-show="message" :class="{
          'bg-green-100 text-green-800': message === 'Permission envoyer avec success',
          'bg-red-100 text-red-800': message === 'Erreur Reessayer',

        }" class="text-xl text-center rounded-lg py-3 italic">{{ message }}</span>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Type de
              permission</label>
            <span v-show="validationErrors['permission_type']" class="text-red-500 text-xs italic">{{
              validationErrors['permission_type'] }}</span>
            <select v-model="formData.permission_type"
              class="w-full rounded-inputRadius text-gray-900 py-4 px-2 outline-none border bg-white border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue">
              <option value="">Choissir un type</option>
              <option value="vacation">Voyage</option>
              <option value="sick">Maladie</option>
              <option value="other">Other</option>
            </select>
          </div>


          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Justification</label>
            <span v-show="validationErrors['justification']" class="text-red-500 text-xs italic">{{
              validationErrors['justification'] }}</span>
            <input type="file" accept="image/png, image/jpeg,.pdf"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none"
              @change="handleFileUpload" />
          </div>

        </div>


        <div class="grid grid-cols-1 gap-3">
          <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Motif</label>
          <span v-show="validationErrors['reason']" class="text-red-500 text-xs italic">{{ validationErrors['reason']
            }}</span>
          <textarea v-model="formData.reason"
            class="w-full rounded-inputRadius h-24 text-gray-900 py-3 px-2 outline-none border border-borderColor focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue"
            placeholder="reason"></textarea>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Date de Debut</label>
            <span v-show="validationErrors['start_date']" class="text-red-500 text-xs italic">{{
              validationErrors['start_date'] }}</span>
            <input type="date" v-model="formData.start_date"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none" />
          </div>

          <div class="flex flex-col gap-3">
            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Date de Fin</label>
            <span v-show="validationErrors['end_date']" class="text-red-500 text-xs italic">{{
              validationErrors['end_date'] }}</span>
            <input type="date" v-model="formData.end_date"
              class="w-full py-3 px-2 rounded-lg border-2 border-gray-300 focus:ring focus:ring-primaryColor focus:ring-opacity-30 outline-none" />
          </div>
        </div>

        <div class="flex justify-center md:justify-start">
          <PrimaryButton title="Envoyer" css="bg-primaryColor px-3 py-2" type="submit" />
        </div>
      </form>
    </div>
  </DashboardTemplate>
</template>
