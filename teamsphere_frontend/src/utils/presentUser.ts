import { decryptData } from '@/api/tokenEncryption';
import { ref } from 'vue';
import { useUserStore } from "@/stores/userStore";

export const PresentUser = () => {

  const userStore = useUserStore();

  const decryptDatas = decryptData();
  const userID = decryptDatas ? decryptDatas[1] : null;
  const userPresent = ref(userStore.getOneUser(Number(userID)));
  return userPresent
}
