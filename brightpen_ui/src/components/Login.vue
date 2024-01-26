<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'
const router = useRouter();

const isLogging = ref(false)
const form = ref({
    email: '',
    password: ''
})

const getToken = async () => {
    await axios.get('/sanctum/csrf-cookie')
}

const handleLogin = async () => {
    isLogging.value = true
    await getToken();
    try{
        await axios({
            method: "POST",
            url: '/login',
            data:{
                email: form.value.email,
                password: form.value.password
            }
        }).then(async (results) => {
            // console.log(results.config.headers)
            isLogging.value = false
            router.push("/home");

        });
    }catch(err){
        alert('Login Failed, Please Try Again')
        isLogging.value = false
        // location.reload()
        
    }

}

</script>
<template>
    <div class="min-h-screen min-w-min w-full" id="banner">
        <div class="grid grid-cols-1 grid-rows-6 flex-col min-h-screen min-w-min  bg-medium-green bg-opacity-90">
            
            <div class="flex flex-row justify-center items-center row-span-1 text-gray-400">
                <div class="w-5/6 grid grid-cols-12 flex-row items-center justify-center gap-2">
                    <div class=" flex justify-center items-center px-5 py-3 col-span-2">
                        <p class="text-sm font-semibold text-gray-300 uppercase">Brightpen</p>
                    </div>
                    <div class=" flex justify-center items-center px-5 py-3 col-span-6">
                    </div>
                    <div class=" hover:bg-gray-400 hover:bg-opacity-20 cursor-pointer flex justify-center items-center px-5 py-3">
                        <p class="text-md">Login</p>
                    </div>
                    <div class=" hover:bg-gray-400 hover:bg-opacity-20 cursor-pointer flex justify-center items-center px-5 py-3">
                        <p class="text-md">About</p>
                    </div>
                    <div class=" hover:bg-gray-400 hover:bg-opacity-20 cursor-pointer flex justify-center items-center px-5 py-3">
                        <p class="text-md">Register</p>
                    </div>
                    <div class=" hover:bg-gray-400 hover:bg-opacity-20 cursor-pointer flex justify-center items-center px-5 py-3">
                        <p class="text-md">Contact</p>
                </div>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center row-span-4 text-gray-400">
                <form @submit.prevent="handleLogin" class="w-full flex flex-col justify-center items-center">    
                    <div class="w-86 flex flex-col gap-3 p-4 justify-center items-center">
                        <!-- <i class="fa-solid fa-pen-clip text-4xl text-white "></i> -->
                        <div class="h-32 w-32 " id="logo"></div>
                        <p class="text-md font-semibold text-gray-200"><span class="p-2 bg-emerald-600 rounded-lg">BPS</span> - CLCST</p>
                        <p class="text-xs  text-gray-200">Web-Based School Mangement System</p>
                    </div>
                    <div class="w-80 flex flex-col p-4">
                        <input v-model="form.email" type="email" class="border-none text-xs w-full px-4 py-3 text-white bg-gray-400 bg-opacity-40 pl-5 rounded-3xl focus:ring-2 focus:outline-none focus:ring-teal-300" placeholder="Email"/>
                    </div>
                    <div class="w-80 flex flex-col p-4">
                        <input v-model="form.password" type="password" class="border-none text-xs w-full px-4 py-3 text-white bg-gray-400 bg-opacity-40 pl-5 rounded-3xl focus:ring-2 focus:outline-none focus:ring-teal-300" placeholder="Password"/>
                    </div>
                    <div class="w-80 flex flex-col p-4">
                        <button :disabled="isLogging" type="submit" class="disabled:cursor-wait disabled:bg-emerald-900 text-xs w-full px-4 py-3 text-white bg-emerald-500 rounded-3xl focus:ring-2 focus:outline-none focus:ring-teal-300">
                            <span v-if="isLogging">Logging In...</span> 
                            <span v-else>Get Started</span> 
                        </button>
                    </div>
                    <div class="w-80 flex flex-col p-4 justify-center items-center">
                        <p class="text-sm">Forgot Password? Click <a href="" class="underline text-blue-400"> Here</a></p>
                    </div>
                </form>
            </div>
            <div class="flex flex-row justify-center items-center row-span-1 text-gray-400">
                <div class="w-5/6 grid grid-cols-12 flex-row items-center justify-center gap-2">

                    <div class=" flex justify-start items-start px-5 py-3 col-span-6">
                        <p class="text-xs font-semibold uppercase">Central Luzon College of Technology</p>
                    </div>
                    <div class=" flex justify-end items-end px-5 py-3 col-span-6">
                        <p class="text-xs font-semibold">2023 Key. All Rights Reserved | Design By: CG</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>