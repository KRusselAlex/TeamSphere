<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';
import { usePermissionStore } from "@/stores/permissionStore"
import { formatDate } from '@/utils/DateConverter';
import { decryptData } from '@/api/tokenEncryption';


const decryptDatas = decryptData();
const userRole = decryptDatas ? decryptDatas[2] : null;

const permissionStore = usePermissionStore();


const route = useRoute();
const router = useRouter();

const Api_url = import.meta.env.VITE_API_URL_EM


const permission = ref(permissionStore.getOnePermission(Number(route.params.id)))
console.log(permission.value);
if (permission.value == null) {
  router.push("notfound");
}

const permissionData = reactive({
  userId: route.params.id,
  userName: permission.value?.username,
  fullname: permission.value?.fullname ? permission.value.fullname : "not yet updated",
  permissionType: permission.value?.permission_type,
  startDate: formatDate(permission.value ? permission.value.start_date.toString() : ""),
  endDate: formatDate(permission.value ? permission.value.start_date.toString() : ""),
  motif: permission.value?.reason,
  justificationFile: permission.value?.justification ? permission.value.justification : null,
  status: permission.value?.status,
  requested_at: formatDate(permission.value?.requested_at?.toString() || ""),
  responded_at: formatDate(permission.value?.responded_at?.toString() || ""),
});


const handleApprove = () => {
  permissionData.status = 'approved';
  alert('Permission approuvée');
  console.log('Permission approuvée', permissionData);
};


const handleReject = () => {
  permissionData.status = 'rejected';
  alert('Permission rejetée');
  console.log('Permission rejetée', permissionData);
};
</script>

<template>
  <DashboardTemplate>
    <div class="mx-3 mt-8 flex flex-col gap-6">
      <h2 class="font-sans font-semibold text-primaryColor text-xl">Détails de la Permission</h2>

      <div class="bg-white p-8 rounded-xl border">
        <div class="flex flex-col sm:flex-row sm:justify-between">

          <div>
            <h3 class="text-2xl font-sans font-semibold text-primaryColor">{{ permissionData.userName }}</h3>
            <p class="text-sm text-gray-500 font-serif"> {{ permissionData.fullname }}</p>
          </div>
          <div class="mt-4 sm:mt-0 sm:text-right">
            <span :class="{
              'bg-green-100 text-green-800': permissionData.status === 'approved',
              'bg-red-100 text-red-800': permissionData.status === 'rejected',
              'bg-yellow-100 text-yellow-800': permissionData.status === 'pending'
            }" class="px-3 py-1 text-xs font-semibold rounded-full">
              {{ permissionData.status }}
            </span>
          </div>
        </div>

        <div class="mt-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <p class="font-semibold text-gray-600 font-sans">Type de Permission :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.permissionType }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Motif :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.motif }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de début :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.startDate }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de fin :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.endDate }}</p>
            </div>

            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de Demande :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.requested_at }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Date de Reponse :</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.responded_at }}</p>
            </div>
            <div class="sm:col-span-2">
              <p class="font-semibold text-gray-600 font-sans">Justification :</p>

              <a v-if="permissionData.justificationFile" :href="`${Api_url + permissionData.justificationFile}`"
                target="_blank" class="text-primaryColor text-sm font-serif underline">Voir le fichier de
                justification</a>

              <p v-else class="text-red-500  text-xs italic font-serif "> Aucun ficher </p>
            </div>

          </div>
        </div>

        <div class="flex justify-between gap-4 mt-5" v-if="permissionData.status == 'pending' && userRole">
          <PrimaryButton type="button" title="Approuver"
            css="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
            @click="handleApprove" />
          <PrimaryButton type="button" title="Rejeter"
            css="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
            @click="handleReject" />
        </div>
      </div>
    </div>
  </DashboardTemplate>
</template>
