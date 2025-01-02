import * as CryptoJS from 'crypto-js';


const SECRET_KEY = 'alex-secret-key';

export const encryptData = (data: string, id: number): boolean => {
  try {
    const encryptedToken = CryptoJS.AES.encrypt(JSON.stringify(data), SECRET_KEY).toString();
    const encryptedId = CryptoJS.AES.encrypt(JSON.stringify(id), SECRET_KEY).toString();
    localStorage.setItem('userToken', encryptedToken);
    localStorage.setItem('userId', encryptedId);
    return true

  } catch (error) {

   console.log(error);
   return false

  }

};


export const decryptData = (): string[] | null => {
  try {
    const encryptedData = localStorage.getItem("userToken") ? localStorage.getItem("userToken") : null ;
    const encryptedId = localStorage.getItem("userId") ? localStorage.getItem("userId") : null;
    if (encryptedData && encryptedId){
      const bytes = CryptoJS.AES.decrypt(encryptedData, SECRET_KEY);
      const bytesId = CryptoJS.AES.decrypt(encryptedId, SECRET_KEY);
      const decryptedToken= bytes.toString(CryptoJS.enc.Utf8);
      const decryptedId = bytesId.toString(CryptoJS.enc.Utf8);
      return [decryptedToken ,decryptedId];
    }

    return null

  } catch (error) {
    console.error('Error decrypting data', error);
    return null;
  }
};
