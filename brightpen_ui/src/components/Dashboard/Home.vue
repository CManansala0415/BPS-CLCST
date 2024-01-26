<script setup>
import { ref, onMounted, computed } from 'vue';

</script>
<template>
   <div class="flex flex-col w-full h-full">
      <div class="h-28"></div>
      <div class="flex gap-2 w-full h-full">
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
            
           
         </div>
         <div class=" basis-full border-x border-gray-300 flex flex-col gap-2">
            <div class="h-96">
               <div class="h-3/4 w-full "  id="banner">
                  <div class="bg-gray-50 bg-opacity-85 h-full w-full flex flex-col gap-2 justify-start items-center ">
                        <p class="text-md font-semidbold mt-5">Hello Celtians! welcome to</p>
                        <p class="text-3xl font-bold text-emerald-700">ACADEMIC YEAR <span class="px-4 py-1 bg-emerald-500 rounded-lg text-white">2024</span> </p>
                  </div>
               </div>

               <div class="relative bg-gray-100 h-1/4 w-full flex gap-3 justify-center ">
                  <div class="absolute -top-48 grid grid-cols-3  gap-3 h-64 w-full p-5">
                     <div class=" bg-white bg-opacity-60 shadow-md rounded-lg flex flex-col p-5 text-center">

                     </div>  
                     <div class=" bg-white bg-opacity-60 shadow-md rounded-lg flex flex-col p-5">
                        
                     </div>  
                     <div class=" bg-white bg-opacity-60 shadow-md rounded-lg flex flex-col p-5">
                        
                     </div>  
                  </div>
                 
               </div>
            </div>
   
            <div class="w-full p-5">
              
               <div class="w-full p-5 text-center">
                  <p class="text-xl font-semibold text-emerald-700 border-0">Announcements</p>
               </div>
               <div class="w-full p-5 border bg-white shadow-lg grid grid-cols-3 gap-3 ">
                  <div class=" flex flex-col gap-3 items-center justify-center p-5 text-center">
                     <p class="text-4xl font-extrabold mt-5 text-purple-500">231</p>
                     <p class="text-sm font-bold text-gray-600 mt-5">Senior High-School Students</p>
                     <!-- <p class="text-xs text-gray-600 ">BSMT - 77 Students</p>
                     <p class="text-xs text-gray-600 ">BSIT - 77 Students</p>
                     <p class="text-xs text-gray-600 ">BSC - 77 Students</p> -->
                  </div>  
                  <div class=" flex flex-col items-center justify-center p-5 text-center">
                     <p class="text-4xl font-extrabold mt-5 text-cyan-500">901</p>
                     <p class="text-sm font-bold text-gray-600 mt-5">College Students</p>
                  </div>    
                  <div class=" flex flex-col items-center justify-center p-5 text-center">
                     <p class="text-4xl font-extrabold mt-5 text-emerald-500">1,132</p>
                     <p class="text-sm font-bold text-gray-600 mt-5">CLCST Students</p>
                  </div>   
               </div>
            </div>

         </div>
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
           
         </div>
      </div>
   </div>
</template>