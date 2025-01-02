<template>
  <v-dialog v-model="isVisible" max-width="500px">
    <v-card>
      <v-card-title>
        <span class="headline text-primaryColor">Presence Details</span>
      </v-card-title>

      <v-card-subtitle>
        <v-row>
          <v-col cols="6">
            <v-text-field :value="presence?.fullname ?? 'N/A'" label="Full Name" readonly />
          </v-col>
          <v-col cols="6">
            <v-text-field :value="presence?.username ?? 'N/A'" label="Username" readonly />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="6">
            <v-text-field :value="presence?.status ?? 'N/A'" label="Status" readonly />
          </v-col>
          <v-col cols="6">
            <v-text-field :value="presence?.marked_at ?? 'N/A'" label="Marked At" readonly />
          </v-col>
        </v-row>
      </v-card-subtitle>

      <v-card-actions>
        <v-btn color="primary" @click="closeModal">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script setup lang="ts">
import { ref, defineProps, defineEmits } from 'vue';
import type { PresenceRequest } from '@/api/presence/presenceTypes';

const props = defineProps({
  visible: {
    type: Boolean,
    required: true
  },
  presenceData: {
    type: Object as () => PresenceRequest | null,
    required: true
  }
});

const emit = defineEmits(['update:visible']);
const isVisible = ref(props.visible);
const presence = props.presenceData;

const closeModal = () => {
  isVisible.value = false;
  emit('update:visible', false);
};
</script>
