<script setup lang="ts">
import { ref } from 'vue';

// Props or API integration to fetch presence details
const presence = ref({
  id: 1,
  employee_id: 1,
  marked_at: "2024-12-30 03:24:17",
  username: "alex",
  status: "1",
  fullname: "Alex Russel Balbo",
});

// Format the status for better readability
const getStatusText = (status: string): string => {
  return status === "1" ? "Present" : "Absent";
};
</script>

<template>
  <div class="presence-details p-4 bg-white shadow-md rounded-lg max-w-md mx-auto">
    <h2 class="text-lg font-bold mb-4">Presence Details</h2>

    <div class="mb-2">
      <strong>ID:</strong> <span>{{ presence.id }}</span>
    </div>

    <div class="mb-2">
      <strong>Employee ID:</strong> <span>{{ presence.employee_id }}</span>
    </div>

    <div class="mb-2">
      <strong>Full Name:</strong> <span>{{ presence.fullname }}</span>
    </div>

    <div class="mb-2">
      <strong>Username:</strong> <span>{{ presence.username }}</span>
    </div>

    <div class="mb-2">
      <strong>Marked At:</strong> <span>{{ new Date(presence.marked_at).toLocaleString() }}</span>
    </div>

    <div class="mb-2">
      <strong>Status:</strong> <span :class="presence.status === '1' ? 'text-green-500' : 'text-red-500'">
        {{ getStatusText(presence.status) }}
      </span>
    </div>

    <div class="mt-4">
      <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
        Edit Presence
      </button>
      <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 ml-2">
        Delete Presence
      </button>
    </div>
  </div>
</template>

<style scoped>
.presence-details {
  font-family: Arial, sans-serif;
}
</style>
