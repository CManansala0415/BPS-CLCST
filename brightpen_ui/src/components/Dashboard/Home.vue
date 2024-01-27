<script setup>
import { ref, onMounted, computed } from 'vue';

const def_class = ref("flex items-center w-full rounded-lg cursor-pointer hover:bg-emerald-600 hover:text-gray-100 p-2");
const active_class = ref("flex items-center w-full rounded-lg cursor-pointer bg-emerald-600 hover:bg-emerald-500 text-gray-100 p-2");
const content = ref(1)

</script>
<template>
   <div class="flex flex-col w-full h-full">
      <div class="h-28"></div>
      <div class="flex gap-2 w-full h-full">
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
            
            <div class="flex flex-col gap-2 p-1">
               <div :class="content == 1? active_class:def_class" @click="content = 1">
                  <p class="text-xs">Academic Years</p>
               </div>
               <div :class="content == 2? active_class:def_class" @click="content = 2">
                  <p class="text-xs">Evaluations</p>
               </div>
               <div :class="content == 3? active_class:def_class" @click="content = 3">
                  <p class="text-xs">Performances</p>
               </div>
               <div :class="content == 4? active_class:def_class" @click="content = 4">
                  <p class="text-xs">Faculty Hub</p>
               </div>
               <div :class="content == 5? active_class:def_class" @click="content = 5">
                  <p class="text-xs">Campus</p>
               </div>
               <div :class="content == 6? active_class:def_class" @click="content = 6">
                  <p class="text-xs">Reports</p>
               </div>
            </div>
           
         </div>
         <div class=" basis-full border-x border-gray-300 flex flex-col">
            <div class="h-96">
               <div class="h-3/4 w-full"  id="banner">
                  <div class="bg-gray-50 bg-opacity-90 h-full w-full flex flex-col gap-2 justify-start items-center ">
                        <p class="text-md mt-10">Hello Celtians! welcome to</p>
                        <p class="text-3xl font-bold text-emerald-600">ACADEMIC YEAR <span class="px-4 py-1 bg-emerald-500 rounded-lg text-white">2024</span> </p>
                  </div>
               </div>

               <div class="relative bg-gray-100 h-1/4 w-full flex gap-3 justify-center border ">
                  <div class="absolute -top-40 grid grid-cols-3  gap-3 h-64 w-full p-5">
                     <div class=" bg-white bg-opacity-80 shadow-md rounded-lg flex flex-col p-5 text-center border-0 border-b-4 border-emerald-400">
                        <p class="text-md font-bold text-gray-600">First Semester</p>
                        <p class="text-4xl font-extrabold mt-5 text-pink-500">1,302</p>
                        <p class="text-sm font-semibold text-gray-700">Enrollees</p>
                        <div class="flex items-center justify-around  mt-5">
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold text-purple-500">852</p>
                              <p class="text-xs text-gray-700">olongapo Campus</p>
                           </div>
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold  text-red-500">450</p>
                              <p class="text-xs text-gray-700">San Fernando Campus</p>
                           </div>
                        </div>
                     </div>  
                     <div class=" bg-white bg-opacity-80 shadow-md rounded-lg flex flex-col p-5 text-center  border-0 border-b-4 border-emerald-400">
                        <p class="text-md font-bold text-gray-600">Second Semester</p>
                        <p class="text-4xl font-extrabold mt-5 text-cyan-500">1,506</p>
                        <p class="text-sm font-semibold text-gray-700">Enrollees</p>
                        <div class="flex items-center justify-around  mt-5">
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold text-purple-500">954</p>
                              <p class="text-xs text-gray-700">olongapo Campus</p>
                           </div>
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold  text-red-500">552</p>
                              <p class="text-xs text-gray-700">San Fernando Campus</p>
                           </div>
                        </div>
                     </div>  
                     <div class=" bg-white bg-opacity-80 shadow-md rounded-lg flex flex-col p-5 text-center  border-0 border-b-4 border-emerald-400">
                        <p class="text-md font-bold text-gray-600">Third Semester</p>
                        <p class="text-4xl font-extrabold mt-5 text-emerald-500">0</p>
                        <p class="text-sm font-semibold text-gray-700">Enrollees</p>
                        <div class="flex items-center justify-around  mt-5">
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold text-purple-500">0</p>
                              <p class="text-xs text-gray-700">olongapo Campus</p>
                           </div>
                           <div class="flex flex-col items-center justify-around">
                              <p class="text-xl font-bold  text-red-500">0</p>
                              <p class="text-xs text-gray-700">San Fernando Campus</p>
                           </div>
                        </div>
                     </div>  
                  </div>
                 
               </div>
            </div>
   
            <div class="w-full p-5 border">
               <div class=" bg-white shadow-lg  p-5 ">
                  <div class="w-full flex">
                     <div class="bg-gray-100 basis-3/4 p-3">
                        <p class="text-xs font-bold text-gray-600">Course</p>
                     </div>  
                     <div class="bg-gray-100 basis-1/4 p-3">
                        <p class="text-xs font-bold text-gray-600">Level</p>
                     </div>    
                     <div class="bg-gray-100 basis-1/4 p-3">
                        <p class="text-xs font-bold text-gray-600">Campus</p>
                     </div>  
                     <div class="bg-gray-100 basis-1/4 p-3">
                        <p class="text-xs font-bold text-gray-600">Total</p>
                     </div>   
                  </div>
                  <div class="w-full flex">
                     <div class="border-0 border-b border-gray-200 basis-full p-3 text-center">
                        <p class="text-xs font-bold text-gray-600">No Data Found</p>
                     </div>  
                  </div>
                  
               </div>
            </div>

         </div>
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
            
         </div>
      </div>
   </div>
</template>