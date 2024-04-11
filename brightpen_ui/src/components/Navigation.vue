
<script setup>
import { ref, onMounted, computed } from 'vue';
import { getUserID } from "../routes/user";
import { useRouter,useRoute } from 'vue-router'


const user = ref('')
const userID = ref('')
const router = useRouter();
const route=useRoute();
const path = computed(() =>route.path)

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

const navStat = ref(false)

const isNavActive = ref(0)
const navTitle = ref('Dashboard')
const navList = ref(
  [
    {   
        description: 'Dashboard',
        def_class: 'hover:bg-green-900 cursor-pointer p-3',
        active_class:'hover:bg-green-700 cursor-pointer bg-green-800 p-3',
        icon:'fa-solid fa-gauge mr-3',
        router_link:'/home'
    },
    {   
        description: 'Administration',
        def_class: 'hover:bg-green-900 cursor-pointer p-3',
        active_class:'hover:bg-green-700 cursor-pointer bg-green-800 p-3',
        icon:'fa-solid fa-gauge mr-3',
        router_link:'/administration'
    },
    {   
        description: 'Academe',
        def_class: 'hover:bg-green-900 cursor-pointer p-3',
        active_class:'hover:bg-green-700 cursor-pointer bg-green-800 p-3',
        icon:'fa-solid fa-gauge mr-3',
        router_link:'/academics/1'
    },
  ]
);


const goToRoute = (link) =>{
    router.push(link)
}

const handleLogout = async () => {
    await axios.post('/logout');
    alert('Logged Out')
    router.push("/");
}

</script>


<template>
    <div class="hidden sm:block  bg-medium-green shadow-lg shadow-dark-green w-72 h-full">
      <div class="p-5  h-1/5 flex justify-center items-center flex-col">
        <p class="text-lg font-bold text-gray-300">BRIGHTPEN</p>
        <p class="text-xs text-gray-300 bg-green-700 px-3 py-1 rounded-md">Tertiary</p>
      </div>  
      <router-link :to="n.router_link" class="w-full" v-for="(n, index) in navList" @click="isNavActive = index, goToRoute(n.router_link)">
            <div :class="isNavActive == index? n.active_class : n.def_class">
              <p class="text-sm text-gray-300"><i :class="n.icon"></i>{{ n.description }}</p>
            </div>
      </router-link>
    </div>

    <div class="block relative sm:hidden bg-medium-green shadow-lg shadow-dark-green w-full h-auto transition-all">
        <div class="w-full p-3" @click="navStat = !navStat">
            <p class="text-md font-bold text-gray-300"><i class="fa-solid fa-bars mr-3"></i> {{ navTitle }}</p>
        </div>
    </div>
    <Transition name="wipe" >
            <div class=" flex flex-col gap-1 w-full h-auto bg-medium-green shadow-lg shadow-dark-green"  v-if="navStat">
              <router-link :to="n.router_link" class="w-full" v-for="(n, index) in navList" @click="isNavActive = index, navTitle = n.description">
                  <div :class="isNavActive == index? n.active_class : n.def_class">
                    <p class="text-xs text-gray-300">{{ n.description }}</p>
                  </div>
              </router-link>
            </div>
    </Transition>
</template>
<style>
.wipe-enter-active,
.wipe-leave-active {
  transition: opacity 0.2s ease;

}

.wipe-enter-from,
.wipe-leave-to {
  opacity: 0;
}
</style>

