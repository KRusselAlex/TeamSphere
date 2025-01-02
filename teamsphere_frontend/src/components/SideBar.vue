<script setup lang="ts">
import LogoImage from './LogoImage.vue';
import { PresentUser } from '@/utils/presentUser';
import { ref } from 'vue';
import { logoutUser } from '@/api/auth/authServices';
import { useRouter } from 'vue-router';


const router = useRouter();
const user = ref(PresentUser());
const widthSide = ref("18rem");
const displaySide = ref("flex");
const itemsAlign = ref('start')
const show = ref(true);


const mobileNavbar = () => {

  widthSide.value = "4rem"
  displaySide.value = "none"
  show.value = false
  itemsAlign.value = "center"

}

const desktopNavbar = () => {

  widthSide.value = "18rem"
  displaySide.value = "flex"
  show.value =  true
  itemsAlign.value = "start"

}

const handleLogout = async () =>{
  await logoutUser()
  router.push("/auth/login")
}


</script>

<template>
  <div :style="{ width: widthSide }" class=" flex flex-col gap-3 bg-white pt-8 px-3  md:px-6">
    <div class=" flex items-center gap-2 justify-between ">
      <RouterLink to="/" class="flex items-center gap-2 font-medium  font-sans">
        <LogoImage size="30" color="#ff7a21" />
        <p :style="{ display:  displaySide }" class="text-primaryColor font-semibold font-sans ">TeamSphere</p>
      </RouterLink>
      <button class="text-[#343434] hover:text-primaryColor" @click="mobileNavbar" v-if="show">
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM13.79 15C14.08 15.29 14.08 15.77 13.79 16.06C13.64 16.21 13.45 16.28 13.26 16.28C13.07 16.28 12.88 16.21 12.73 16.06L9.2 12.53C8.91 12.24 8.91 11.76 9.2 11.47L12.73 7.94C13.02 7.65 13.5 7.65 13.79 7.94C14.08 8.23 14.08 8.71 13.79 9L10.79 12L13.79 15Z"
            fill="#292D32" />
        </svg>
      </button>
      <button class="text-[#343434] hover:text-primaryColor z-10" @click="desktopNavbar" v-else>
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM14.79 12.53L11.26 16.06C11.11 16.21 10.92 16.28 10.73 16.28C10.54 16.28 10.35 16.21 10.2 16.06C9.91 15.77 9.91 15.29 10.2 15L13.2 12L10.2 9C9.91 8.71 9.91 8.23 10.2 7.94C10.49 7.65 10.97 7.65 11.26 7.94L14.79 11.47C15.09 11.76 15.09 12.24 14.79 12.53Z"
            fill="#292D32" />
        </svg>
      </button>

    </div>

    <div :style="{ 'align-items': itemsAlign }"
      class="flex flex-col h-full justify-between bg-white py-5   text-gray-900">
      <div>
        <h3 :style="{ display: displaySide }" class="text-gray-500 font-sans">Menu</h3>
        <ul :style="{ 'align-items': itemsAlign }" class="flex flex-col font-serif justify-center w-full gap-y-3 py-3 ">
          <li class="w-full" v-if="user?.role">
            <RouterLink to="/dashboard"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                    stroke="currentColor" stroke-width="1.5" />
                  <path d="M15 18H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>


              </span>

              <span :style="{ display: displaySide }">General</span>
            </RouterLink>
          </li>
          <li class="w-full">
            <RouterLink to="/dashboard/attendances"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                  mirror-in-rtl="true">
                  <path fill="currentColor"
                    d="M7 11c-1.1 0-2-.9-2-2V8c0-1.1.9-2 2-2s2 .9 2 2v1c0 1.1-.9 2-2 2zm-2 6.993L9 18c.55 0 1-.45 1-1v-2c0-1.65-1.35-3-3-3s-3 1.35-3 3v2c0 .552.448.993 1 .993zM19 18h-6c-.553 0-1-.447-1-1s.447-1 1-1h6c.553 0 1 .447 1 1s-.447 1-1 1zm0-4h-6c-.553 0-1-.448-1-1s.447-1 1-1h6c.553 0 1 .448 1 1s-.447 1-1 1zm0-4h-6c-.553 0-1-.448-1-1s.447-1 1-1h6c.553 0 1 .448 1 1s-.447 1-1 1z" />
                  <path fill="currentColor"
                    d="M22 2H2C.9 2 0 2.9 0 4v16c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 17.5c0 .28-.22.5-.5.5h-19c-.28 0-.5-.22-.5-.5v-15c0-.28.22-.5.5-.5h19c.28 0 .5.22.5.5v15z" />
                </svg>


              </span>

              <span :style="{ display: displaySide }">Presence</span>
            </RouterLink>
          </li>
          <li class="w-full">
            <RouterLink :to="{ name: 'permissions.viewAll' }"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 16 16" id="request-sent-16px">
                  <path id="Path_50" data-name="Path 50"
                    d="M-11.5,0h-11A2.5,2.5,0,0,0-25,2.5v8A2.5,2.5,0,0,0-22.5,13h.5v2.5a.5.5,0,0,0,.309.462A.489.489,0,0,0-21.5,16a.5.5,0,0,0,.354-.146L-18.293,13H-11.5A2.5,2.5,0,0,0-9,10.5v-8A2.5,2.5,0,0,0-11.5,0ZM-10,10.5A1.5,1.5,0,0,1-11.5,12h-7a.5.5,0,0,0-.354.146L-21,14.293V12.5a.5.5,0,0,0-.5-.5h-1A1.5,1.5,0,0,1-24,10.5v-8A1.5,1.5,0,0,1-22.5,1h11A1.5,1.5,0,0,1-10,2.5Zm-2.038-3.809a.518.518,0,0,1-.109.163l-2,2A.5.5,0,0,1-14.5,9a.5.5,0,0,1-.354-.146.5.5,0,0,1,0-.708L-13.707,7H-18.5A1.5,1.5,0,0,0-20,8.5a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5A2.5,2.5,0,0,1-18.5,6h4.793l-1.147-1.146a.5.5,0,0,1,0-.708.5.5,0,0,1,.708,0l2,2a.518.518,0,0,1,.109.163A.505.505,0,0,1-12.038,6.691Z"
                    transform="translate(25)" />
                </svg>

              </span>

              <span :style="{ display: displaySide }">Permissions</span>
            </RouterLink>
          </li>


        </ul>
      </div>
      <div v-if="user?.role">
        <h3 :style="{ display: displaySide }" class="text-gray-500 font-sans">Admin</h3>
        <ul :style="{ 'align-items': itemsAlign }" class="flex flex-col font-serif justify-center w-full gap-y-3 py-3 ">


          <li class="w-full">
            <RouterLink :to="{ name: 'permissions.viewAll' }"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg fill="currentColor" width="20px" height="20px" viewBox="0 0 16 16" id="request-sent-16px"
                  xmlns="http://www.w3.org/2000/svg">
                  <path id="Path_50" data-name="Path 50"
                    d="M-11.5,0h-11A2.5,2.5,0,0,0-25,2.5v8A2.5,2.5,0,0,0-22.5,13h.5v2.5a.5.5,0,0,0,.309.462A.489.489,0,0,0-21.5,16a.5.5,0,0,0,.354-.146L-18.293,13H-11.5A2.5,2.5,0,0,0-9,10.5v-8A2.5,2.5,0,0,0-11.5,0ZM-10,10.5A1.5,1.5,0,0,1-11.5,12h-7a.5.5,0,0,0-.354.146L-21,14.293V12.5a.5.5,0,0,0-.5-.5h-1A1.5,1.5,0,0,1-24,10.5v-8A1.5,1.5,0,0,1-22.5,1h11A1.5,1.5,0,0,1-10,2.5Zm-2.038-3.809a.518.518,0,0,1-.109.163l-2,2A.5.5,0,0,1-14.5,9a.5.5,0,0,1-.354-.146.5.5,0,0,1,0-.708L-13.707,7H-18.5A1.5,1.5,0,0,0-20,8.5a.5.5,0,0,1-.5.5.5.5,0,0,1-.5-.5A2.5,2.5,0,0,1-18.5,6h4.793l-1.147-1.146a.5.5,0,0,1,0-.708.5.5,0,0,1,.708,0l2,2a.518.518,0,0,1,.109.163A.505.505,0,0,1-12.038,6.691Z"
                    transform="translate(25)" />
                </svg>



              </span>

              <span :style="{ display: displaySide }">Permissions</span>
            </RouterLink>
          </li>
          <li class="w-full">
            <RouterLink to="/dashboard/users/view"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                  <path d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" />
                  <path d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" />
                  <path
                    d="M17.1973 15C17.7078 15.5883 18 16.2714 18 17C18 19.2091 15.3137 21 12 21C8.68629 21 6 19.2091 6 17C6 14.7909 8.68629 13 12 13C12.3407 13 12.6748 13.0189 13 13.0553"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                  <path d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" />
                </svg>

              </span>

              <span :style="{ display: displaySide }">Employee</span>
            </RouterLink>
          </li>

        </ul>
      </div>
      <div>
        <h3 :style="{ display: displaySide }" class="text-gray-500 font-sans">Parametre</h3>
        <ul :style="{ 'align-items': itemsAlign }" class="flex flex-col font-serif justify-center w-full gap-y-3 py-3">


          <li class="w-full">
            <RouterLink to="/dashboard/profile"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1">


                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -2159.000000)" fill="currentColor">
                      <g id="icons" transform="translate(56.000000, 160.000000)">
                        <path
                          d="M100.562548,2016.99998 L87.4381713,2016.99998 C86.7317804,2016.99998 86.2101535,2016.30298 86.4765813,2015.66198 C87.7127655,2012.69798 90.6169306,2010.99998 93.9998492,2010.99998 C97.3837885,2010.99998 100.287954,2012.69798 101.524138,2015.66198 C101.790566,2016.30298 101.268939,2016.99998 100.562548,2016.99998 M89.9166645,2004.99998 C89.9166645,2002.79398 91.7489936,2000.99998 93.9998492,2000.99998 C96.2517256,2000.99998 98.0830339,2002.79398 98.0830339,2004.99998 C98.0830339,2007.20598 96.2517256,2008.99998 93.9998492,2008.99998 C91.7489936,2008.99998 89.9166645,2007.20598 89.9166645,2004.99998 M103.955674,2016.63598 C103.213556,2013.27698 100.892265,2010.79798 97.837022,2009.67298 C99.4560048,2008.39598 100.400241,2006.33098 100.053171,2004.06998 C99.6509769,2001.44698 97.4235996,1999.34798 94.7348224,1999.04198 C91.0232075,1998.61898 87.8750721,2001.44898 87.8750721,2004.99998 C87.8750721,2006.88998 88.7692896,2008.57398 90.1636971,2009.67298 C87.1074334,2010.79798 84.7871636,2013.27698 84.044024,2016.63598 C83.7745338,2017.85698 84.7789973,2018.99998 86.0539717,2018.99998 L101.945727,2018.99998 C103.221722,2018.99998 104.226185,2017.85698 103.955674,2016.63598"
                          id="profile_round-[#1342]">

                        </path>
                      </g>
                    </g>
                  </g>
                </svg>


              </span>

              <span :style="{ display: displaySide }">Profile</span>
            </RouterLink>
          </li>
          <li class="w-full">
            <button @click="handleLogout"
              class="px-4 py-2 text-gray-900 flex flex-row items-center w-full gap-4  border-gray-300   md:hover:bg-[#fff7ed] hover:font-bold   hover:text-primaryColor bg-opacity-70  rounded-inputRadius">
              <span>
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M12.9999 2C10.2385 2 7.99991 4.23858 7.99991 7C7.99991 7.55228 8.44762 8 8.99991 8C9.55219 8 9.99991 7.55228 9.99991 7C9.99991 5.34315 11.3431 4 12.9999 4H16.9999C18.6568 4 19.9999 5.34315 19.9999 7V17C19.9999 18.6569 18.6568 20 16.9999 20H12.9999C11.3431 20 9.99991 18.6569 9.99991 17C9.99991 16.4477 9.55219 16 8.99991 16C8.44762 16 7.99991 16.4477 7.99991 17C7.99991 19.7614 10.2385 22 12.9999 22H16.9999C19.7613 22 21.9999 19.7614 21.9999 17V7C21.9999 4.23858 19.7613 2 16.9999 2H12.9999Z"
                    fill="#8B0000" />
                  <path d="M13.9999 11C14.5522 11 14.9999 11.4477 14.9999 12C14.9999 12.5523 14.5522 13 13.9999 13V11Z"
                    fill="#8B0000" />
                  <path
                    d="M5.71783 11C5.80685 10.8902 5.89214 10.7837 5.97282 10.682C6.21831 10.3723 6.42615 10.1004 6.57291 9.90549C6.64636 9.80795 6.70468 9.72946 6.74495 9.67492L6.79152 9.61162L6.804 9.59454L6.80842 9.58848C6.80846 9.58842 6.80892 9.58778 5.99991 9L6.80842 9.58848C7.13304 9.14167 7.0345 8.51561 6.58769 8.19098C6.14091 7.86637 5.51558 7.9654 5.19094 8.41215L5.18812 8.41602L5.17788 8.43002L5.13612 8.48679C5.09918 8.53682 5.04456 8.61033 4.97516 8.7025C4.83623 8.88702 4.63874 9.14542 4.40567 9.43937C3.93443 10.0337 3.33759 10.7481 2.7928 11.2929L2.08569 12L2.7928 12.7071C3.33759 13.2519 3.93443 13.9663 4.40567 14.5606C4.63874 14.8546 4.83623 15.113 4.97516 15.2975C5.04456 15.3897 5.09918 15.4632 5.13612 15.5132L5.17788 15.57L5.18812 15.584L5.19045 15.5872C5.51509 16.0339 6.14091 16.1336 6.58769 15.809C7.0345 15.4844 7.13355 14.859 6.80892 14.4122L5.99991 15C6.80892 14.4122 6.80897 14.4123 6.80892 14.4122L6.804 14.4055L6.79152 14.3884L6.74495 14.3251C6.70468 14.2705 6.64636 14.1921 6.57291 14.0945C6.42615 13.8996 6.21831 13.6277 5.97282 13.318C5.89214 13.2163 5.80685 13.1098 5.71783 13H13.9999V11H5.71783Z"
                    fill="#8B0000" />
                </svg>


              </span>

              <span :style="{ display: displaySide }">Deconnexion</span>
            </button>
          </li>

        </ul>
      </div>


    </div>


  </div>
</template>
