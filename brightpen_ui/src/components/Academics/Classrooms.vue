<script setup>
import { ref, onMounted, computed } from 'vue';
// defineProps({
//     back: {
//     },
// })

defineEmits(['toggle-back']);


</script>

<template>
    <div class="w-full flex p-3">
        <div class="w-full flex items-center justify-start">
            <button type="button" class=" px-3.5 py-2 bg-emerald-700 text-xs text-gray-200 hover:bg-emerald-600" 
                @click="$emit('toggle-back')"><i class="fa-solid fa-chevron-left mr-2"></i> Back</button>
        </div>
        <div class="w-full flex items-center justify-end">
            <input type="text" class=" p-2 border-0 text-xs" placeholder="Search Section here..."/>
            <button type="button" class=" px-3.5 py-2 bg-blue-700 text-xs text-gray-200 hover:bg-blue-600" 
                @click="$emit('toggle-back')"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <div class="w-full flex p-3">
        <div class="flex md:flex-row flex-col gap-3 bg-gray-200 w-full p-4">
            <div class="relative w-full md:basis-3/4 bg-gray-100 flex flex-col shadow-md">
                <div class="p-5 overflow-auto min-h-80">
                    <div class=" border-0 border-b border-gray-400">
                        <h3 class="mb-3 text-md font-extrabold">Classrooms</h3>
                    </div>
                    <div class="hidden sm:grid sm:grid-cols-5 bg-gray-200 p-3">
                        <p class="text-xs font-semibold">Title</p>
                        <p class="text-xs font-semibold">Building</p>
                        <p class="text-xs font-semibold">Floor</p>
                        <p class="text-xs font-semibold">Status</p>
                        <p class="text-xs font-semibold">Commands</p>
                       
                    </div>
                    <div class="flex flex-col gap-3 sm:grid sm:grid-cols-5 border-0 border-b border-gray-300 p-3">
                        <div class="flex items-center">
                            <p class="text-xs">Computer Laboratory</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-xs">Building 1</p>
                        </div>
                        <div class="flex items-center">
                            <p class="text-xs">4</p>
                        </div>
                        <div class="flex items-center">
                            <p class="px-3 py-1 rounded-md text-gray-200 bg-green-500 text-xs font-semibold">Active</p>
                        </div>
                        <div class="flex gap-2">
                            <button type="button" class="p-2 w-full bg-cyan-700 hover:bg-cyan-600 text-gray-200 text-xs"><i class="fa-solid fa-pen-to-square"></i></button> 
                            <button type="button" class="p-2 w-full bg-red-700 hover:bg-red-600 text-gray-200 text-xs"><i class="fa-solid fa-ban"></i></button> 
                        </div>
                    </div>
                    
                    
                </div>
                <div class=" bg-gray-300 p-2 flex w-full gap-2 items-center">
                        <!-- <span class="px-3 py-1 rounded-md text-gray-200 bg-red-500 text-xs font-semibold">Inactive</span> -->
                        <p class="px-3 py-1 rounded-md text-gray-200 bg-yellow-500 text-xs font-semibold">Note</p>
                        <p class="text-xs rounded-md text-gray-700 italic">Ensure all details and actions to be performed are correct.</p>
                   
                </div>
                
            </div>
            <div class="w-full md:basis-1/2 bg-gray-100">
                <div class="p-5 flex flex-col gap-3">
                    <div class="flex flex-col text-center">
                        <p class="text-xs font-semibold">Classroom Settings</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Classroom Description</p>
                        <input type="text" class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Classroom Building</p>
                        <input type="text" class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Classroom Floor</p>
                        <input type="text" class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                    </div>
                   
                    <div class="flex flex-col gap-2">
                        <button type="button" class="px-4 py-2 bg-green-500 hover:bg-green-400 text-gray-200 text-xs"><i class="fa-solid fa-floppy-disk mr-2"></i>Register Classroom</button> 
                        <button type="button" class="px-4 py-2 bg-blue-700 hover:bg-blue-600 text-gray-200 text-xs"><i class="fa-solid fa-pen-to-square mr-2"></i>Save Changes</button> 
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>
