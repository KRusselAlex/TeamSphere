<template>
  <div class="container">
    <div class="message-box">
      <h2>Vérification d'email requise</h2>
      <p>Avant de pouvoir effectuer cette action, vous devez d'abord vérifier votre adresse email.</p>
      <p>Un lien de vérification a été envoyé à votre adresse email. Veuillez vérifier votre boîte de réception.</p>
      <button @click="resendVerificationEmail" class="btn">Renvoyer l'email de vérification</button>
      <router-link to="/dashboard" class="btn-link">Retour au tableau de bord</router-link>
    </div>
  </div>
</template>

<script setup lang="ts">


const resendVerificationEmail = () => {

  console.log('Renvoyer l\'email de vérification...');
  alert('L\'email de vérification a été renvoyé.');
};

</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f9f9f9;
}

.message-box {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 80%;
  max-width: 400px;
}

h2 {
  color: #ff6f61;
}

p {
  color: #333;
  margin-bottom: 20px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  display: inline-block;
  margin-top: 10px;
}

.btn:hover {
  background-color: #45a049;
}

.btn-link {
  color: #007bff;
  text-decoration: none;
  display: inline-block;
  margin-top: 20px;
}

.btn-link:hover {
  text-decoration: underline;
}
</style>
