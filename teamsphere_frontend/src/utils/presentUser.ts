import { decryptData } from '@/api/tokenEncryption';
import { ref } from 'vue';
import { useUserStore } from "@/stores/userStore";
import type { PermissionRequest } from '@/api/permission/permissionsTypes';

export const PresentUser = () => {

  const userStore = useUserStore();
  const decryptDatas = decryptData();
  const userID = decryptDatas ? decryptDatas[1] : null;
  const userPresent = ref(userStore.getOneUser(Number(userID)));
  return userPresent
}

export const toFormData = (permissionRequest: PermissionRequest): FormData => {
  const formData = new FormData();

  Object.entries(permissionRequest).forEach(([key, value]) => {
    if (value !== undefined && value !== null) {
      if (key === 'justification' && value instanceof File) {
        formData.append(key, value);
      } else if (value instanceof Date) {
        formData.append(key, value.toISOString());
      } else {
        formData.append(key, value.toString());
      }
    }
  });

  return formData;
}
