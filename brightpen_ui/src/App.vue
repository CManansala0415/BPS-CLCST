<script setup>
import { ref, onMounted, computed } from 'vue';
import { getUserID } from "./routes/user";
import { useRouter, useRoute } from 'vue-router'

const user = ref('')
const userID = ref('')
const router = useRouter();
const route = useRoute();
const path = computed(() => route.path)

onMounted(() => {
  //get user here
  getUserID().then((results) => {
    user.value = results.data.name
    userID.value = results.data.id
  }).catch((err) => {
    alert('Unauthorized Session, Please Log In')
    router.push("/");
  })
})

const lightType = ref(false)
const def_class = ref("flex items-center justify-center w-full rounded-lg cursor-pointer hover:bg-emerald-600 hover:text-gray-100");
const active_class = ref("flex items-center justify-center w-full rounded-lg cursor-pointer bg-emerald-600 hover:bg-emerald-500 text-gray-100");

</script>



<template>
  <div class="relative flex flex-col min-w-full min-h-screen bg-gray-100">
    <div v-if="path !='/'" class="bg-medium-green text-gray-100 fixed top-0 z-10 flex flex-col md:flex-row gap-2 p-5 shadow-md shadow-gray-500 w-full h-auto md:h-24">
      <div class="basis-full md:basis-1/4 flex items-center md:justify-start sm:justify-center justify-between">
        <div class="flex gap-3">
          <p class="text-md font-bold text-gray-200">BRIGHTPEN</p>
          <p class="text-xs font-light px-4 py-1 rounded-lg text-gray-200 bg-emerald-800">Tertiary</p>
        </div>
        <div class="flex md:hidden sm:hidden item-center justify-center hover:bg-gray-200 cursor-pointer">
          <i class="fa-solid fa-bars"></i>
        </div>
      </div>
      <div class=" basis-full md:basis-3/4 hidden sm:flex justify-evenly gap-2 items-center p-2">
        <router-link to="/home" :class="path == '/home' ? active_class : def_class">
          <i class="m-2 fa-solid fa-house"></i>
          <p class="m-2 text-xs font-semibold">Home</p>
        </router-link>
        <router-link to="/academics" :class="path == '/academics' ? active_class : def_class">
          <i class="m-2 fa-solid fa-flag"></i>
          <p class="m-2 text-xs font-semibold">Registrar</p>
        </router-link>
        <router-link to="" :class="path == '' ? active_class : def_class">
          <i class="m-2 fa-solid fa-chalkboard-user"></i>
          <p class="m-2 text-xs font-semibold">Faculty</p>
        </router-link>
        <router-link to="" :class="path == '' ? active_class : def_class">
          <i class="m-2 fa-solid fa-users"></i>
          <p class="m-2 text-xs font-semibold">Administrative</p>
        </router-link>
        <router-link to="" :class="path == '' ? active_class : def_class">
          <i class="m-2 fa-solid fa-graduation-cap"></i>
          <p class="m-2 text-xs font-semibold">Student</p>
        </router-link>
        <router-link to="" :class="path == '' ? active_class : def_class">
          <i class="m-2 fa-solid fa-gears"></i>
          <p class="m-2 text-xs font-semibold">System</p>
        </router-link>
      </div>
      <div class=" hidden md:flex md:basis-1/4 gap-2 items-center justify-end">
        <div class="flex flex-col items-end">
          <p class="text-xs">Welcome</p>
          <p class="text-sm">{{ user }}</p>
        </div>
        <div class="flex items-center justify-center">
          <!-- <button @click="lightType=!lightType" type="button" class=" px-3 py-1 bg-black text-xs text-gray-100 rounded-md hover:bg-gray-900">Dark Mode</button> -->
          <button @click="" type="button" class=" px-3 py-1 bg-red-500 text-xs text-gray-100 rounded-md hover:bg-red-700"><i class="fa-solid fa-power-off"></i></button>
        </div>
      </div>
      
    </div>

    <RouterView v-slot="{ Component }">
      <Transition name="fade" mode="out-in">
        <component :is="Component"/>
      </Transition>
    </RouterView>

  </div>
</template>

<style>
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-outer-active,
.fade-leave-active {
  transition: opacity 0.2s ease-out;
}
</style>