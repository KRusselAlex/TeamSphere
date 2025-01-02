import * as CryptoJS from 'crypto-js';


const SECRET_KEY = import.meta.env.VITE_LOCAL_SECRET_KEY

const removeDoubleQuotes = (token: string): string => {
  return token.replace(/"/g, ''); // Remove all double quotes
}

export const encryptData = (data: string, id: number,role:boolean): boolean => {
  try {
    const encryptedToken = CryptoJS.AES.encrypt(JSON.stringify(data), SECRET_KEY).toString();
    const encryptedId = CryptoJS.AES.encrypt(JSON.stringify(id), SECRET_KEY).toString();
    const encryptedRole = CryptoJS.AES.encrypt(JSON.stringify(role), SECRET_KEY).toString();
    localStorage.setItem('userToken', encryptedToken);
    localStorage.setItem('userId', encryptedId);
    localStorage.setItem('userRole', encryptedRole);
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
    const encryptedRole = localStorage.getItem("userRole") ? localStorage.getItem("userRole") : null;
    if (encryptedData && encryptedId && encryptedRole){
      const bytes = CryptoJS.AES.decrypt(encryptedData, SECRET_KEY);
      const bytesId = CryptoJS.AES.decrypt(encryptedId, SECRET_KEY);
      const decryptedToken = removeDoubleQuotes(bytes.toString(CryptoJS.enc.Utf8));
      const decryptedId = bytesId.toString(CryptoJS.enc.Utf8);
      const decryptRole = CryptoJS.AES.decrypt(encryptedRole, SECRET_KEY).toString(CryptoJS.enc.Utf8);
      return [decryptedToken ,decryptedId,decryptRole];
    }

    return null

  } catch (error) {
    console.error('Error decrypting data', error);
    return null;
  }
};
