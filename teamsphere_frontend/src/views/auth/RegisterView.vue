<script setup lang="ts">
import LogoImage from '@/components/LogoImage.vue';
import PrimaryButton from '@/components/PrimaryButton.vue';

</script>

<template>

  <div class="relative grid  bg-primaryColor lg:bg-transparent lg:grid-cols-2  min-h-screen h-full px-1 lg:px-0">
    <div class="bg-primaryColor hidden md:flex flex-col gap-9 justify-center items-center ">

      <LogoImage color="#fff" size="200" class="hidden lg:flex" />
      <LogoImage color="#fff" size="100" class="hidden md:flex lg:hidden" />
      <div class="text-white hidden text-center md:flex flex-col gap-2">
        <h1 class="font-sans text-3xl font-semibold">Rejoignez TeamSphere !</h1>
        <p class="font-serif text-xl"> Optimisez votre gestion de présence et vos permissions.</p>

      </div>


    </div>
    <LogoImage color="#ff7a21" size="30" class="absolute left-3 top-3 flex lg:hidden" />
    <div
      class="flex flex-col items-center justify-center h-full lg:items-start bg-white shadow lg:shadow-none gap-5 w-full lg:w-4/5 py-4 px-4 md:px-8 rounded-lg mx-auto ">

      <div class="flex flex-col items-center lg:items-start  gap-1 ">
        <h1 class="font-sans text-xl  md:text-3xl font-semibold">
          Créer un compte
        </h1>
        <p class="text-sm font-serif">Vous avez déjà un compte ? <strong> <router-link to="/auth/login">Se
              connecter.</router-link>
          </strong></p>

      </div>
      <form action="" class="flex flex-col gap-4 lg:gap-3 w-full">
        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans"> Nom d'utilisateur</label>
          <input type="text" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>

        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans">Adresse e-mail</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>
        <div class="flex flex-col gap-2 w-full">
          <label for="username" class="font-sans">Mot de passe</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>
        <div class="flex flex-col gap-2 w-full">
          <label for="username font-sans">Confirmer le mot de passe</label>
          <input type="email" id=""
            class="w-full rounded-inputRadius text-gray-900 py-3 px-2 outline-none border border-borderColor   focus:ring focus:ring-primaryColor focus:ring-opacity-30 hover:outline-blue  ">

        </div>


        <p class="text-sm text-center mt-2 md:text-start font-serif">En créant un compte, vous acceptez nos
          <strong>Termes et
            Conditions</strong> et notre
          <strong>Politique
            de Confidentialité</strong> .
        </p>

        <div class="grid  mt-2 md:mt-5 ">
          <div class="grid md:grid-cols-2 gap-4 items-center   w-full">

            <PrimaryButton css="bg-primaryColor px-3 py-3 md:-0 font-bold text-xl " title="Créer un compte" />


            <div class="flex  justify-center md:justify-end  gap-2 items-center">
              <p>
                <svg width="60px" height="60px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <title>github</title>
                  <rect width="24" height="24" fill="none" />
                  <path
                    d="M12,2A10,10,0,0,0,8.84,21.5c.5.08.66-.23.66-.5V19.31C6.73,19.91,6.14,18,6.14,18A2.69,2.69,0,0,0,5,16.5c-.91-.62.07-.6.07-.6a2.1,2.1,0,0,1,1.53,1,2.15,2.15,0,0,0,2.91.83,2.16,2.16,0,0,1,.63-1.34C8,16.17,5.62,15.31,5.62,11.5a3.87,3.87,0,0,1,1-2.71,3.58,3.58,0,0,1,.1-2.64s.84-.27,2.75,1a9.63,9.63,0,0,1,5,0c1.91-1.29,2.75-1,2.75-1a3.58,3.58,0,0,1,.1,2.64,3.87,3.87,0,0,1,1,2.71c0,3.82-2.34,4.66-4.57,4.91a2.39,2.39,0,0,1,.69,1.85V21c0,.27.16.59.67.5A10,10,0,0,0,12,2Z" />
                </svg>

              </p>
              <p>
                <svg width="50px" height="50px" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg"
                  preserveAspectRatio="xMidYMid">
                  <path
                    d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                    fill="#4285F4" />
                  <path
                    d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                    fill="#34A853" />
                  <path
                    d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                    fill="#FBBC05" />
                  <path
                    d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                    fill="#EB4335" />
                </svg>

              </p>

            </div>


          </div>


        </div>


      </form>
      <div>

      </div>

    </div>

  </div>

</template>
