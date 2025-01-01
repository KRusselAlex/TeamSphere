<script setup lang="ts">
import { reactive, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import DashboardTemplate from '@/components/DashboardTemplate.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

// Setup reactive state and refs
const route = useRoute();
const router = useRouter();

const permissionData = reactive({
  userId: route.params.id,
  userName: 'John Doe', // Assume you get this from an API
  department: 'Engineering', // New field for department
  permissionType: 'Sick',
  startDate: '2025-01-01',
  endDate: '2025-01-10',
  motif: 'Personal illness',
  justificationFile: null as File | null,
  status: 'Pending', // Status of the permission request
});

// Handle approval
const handleApprove = () => {
  permissionData.status = 'Approved';
  alert('Permission Approved');
  console.log('Approved Permission', permissionData);
};


const handleReject = () => {
  permissionData.status = 'Rejected';
  alert('Permission Rejected');
  console.log('Rejected Permission', permissionData);
};
</script>

<template>
  <DashboardTemplate>
    <div class="mx-3 mt-8 flex flex-col gap-6">
      <h2 class="font-sans font-semibold text-primaryColor text-xl">Permission View</h2>


      <div class="bg-white p-8 rounded-xl border">
        <div class="flex flex-col sm:flex-row sm:justify-between">

          <div>
            <h3 class="text-2xl font-sans font-semibold text-primaryColor">{{ permissionData.userName }}</h3>
            <p class="text-sm text-gray-500 font-serif">{{ permissionData.department }} Department</p>
          </div>
          <!-- Right section with Status -->
          <div class="mt-4 sm:mt-0 sm:text-right">
            <span :class="{
              'bg-green-100 text-green-800': permissionData.status === 'Approved',
              'bg-red-100 text-red-800': permissionData.status === 'Rejected',
              'bg-yellow-100 text-yellow-800': permissionData.status === 'Pending'
            }" class="px-3 py-1 text-xs font-semibold rounded-full">
              {{ permissionData.status }}
            </span>
          </div>
        </div>

        <!-- Permission Details -->
        <div class="mt-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <p class="font-semibold text-gray-600 font-sans">Permission Type:</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.permissionType }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Motif:</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.motif }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">Start Date:</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.startDate }}</p>
            </div>
            <div>
              <p class="font-semibold text-gray-600 font-sans">End Date:</p>
              <p class="text-sm text-gray-900 font-serif">{{ permissionData.endDate }}</p>
            </div>
            <div class="sm:col-span-2">
              <p class="font-semibold text-gray-600 font-sans">Justification:</p>
              <a href="#" class="text-primaryColor text-sm font-serif">View Justification File</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-between gap-4 mt-5">
        <PrimaryButton title="Approve"
          css="bg-green-500 hover:bg-green-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
          @click="handleApprove" />
        <PrimaryButton title="Reject"
          css="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-white shadow-lg transition-all"
          @click="handleReject" />
      </div>
    </div>
  </DashboardTemplate>
</template>

