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
            <input type="text" class=" p-2 border-0 text-xs" placeholder="Search Faculty here..."/>
            <button type="button" class=" px-3.5 py-2 bg-blue-700 text-xs text-gray-200 hover:bg-blue-600" 
                @click="$emit('toggle-back')"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <div class="w-full flex p-3">
        <div class="flex md:flex-row flex-col gap-3 bg-gray-200 w-full p-4">
            <div class="relative w-full bg-gray-100 flex flex-col shadow-md">
                <div class="p-5 overflow-auto min-h-80">
                    <div class="overflow-auto">
                        <h3 class="mb-3 text-md font-extrabold">Faculties</h3>
                        <p class="mb-3 text-xs italic text-gray-600">Registered Faculties on Pooling</p>
                    </div>
                    <div class="flex flex-col md:grid md:grid-cols-6 gap-1 border-0 border-b border-gray-300 p-3">
                        <div class="flex">
                            <input type="text" placeholder="First Name" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" placeholder="Middle Name" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" placeholder="Last Name" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" placeholder="Suffix Name" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <select class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="button" class="w-full p-2 bg-green-700 hover:bg-green-600 text-gray-200 text-xs"><i class="fa-solid fa-floppy-disk"></i> Register</button> 
                        </div>
                    </div>
                    <div class="hidden md:grid md:grid-cols-6 gap-1 bg-gray-200 p-3">
                        <p class="text-xs font-semibold">First Name</p>
                        <p class="text-xs font-semibold">Middle Name</p>
                        <p class="text-xs font-semibold">Last Name</p>
                        <p class="text-xs font-semibold">Suffix Name</p>
                        <p class="text-xs font-semibold">Gender</p>
                        <p class="text-xs font-semibold">Status</p>
                    </div>
                    <!-- <div class="flex flex-col md:grid md:grid-cols-6 gap-1 border-0 border-b border-gray-300 p-3">
                        <div class="flex">
                            <input type="text" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <input type="text" class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                        </div>
                        <div class="flex">
                            <select class="text-xs w-full p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="px-3 py-1 rounded-md text-gray-200 bg-green-500 text-xs font-semibold">Active</p>
                        </div>
                    </div> -->
                    <div class="flex flex-col md:grid md:grid-cols-6 gap-1 border-0 border-b border-gray-300 p-3 hover:bg-gray-200 cursor-pointer">
                        <div class="flex items-center justify-center md:justify-start">
                           <p class="text-xs">Jane</p>
                        </div>
                        <div class="flex items-center justify-center md:justify-start">
                           <p class="text-xs">Gomez</p>
                        </div>
                        <div class="flex items-center justify-center md:justify-start">
                           <p class="text-xs">Doe</p>
                        </div>
                        <div class="flex items-center justify-center md:justify-start">
                           <p class="text-xs"></p>
                        </div>
                        <div class="flex items-center justify-center md:justify-start">
                           <p class="text-xs">Female</p>
                        </div>
                        <div class="flex items-center justify-center">
                            <p class="px-3 py-1 rounded-md text-gray-200 bg-green-500 text-xs font-semibold">Active</p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="bg-gray-300 p-2 flex w-full justify-between gap-2">
                    <div class=" flex w-full gap-2 items-center">
                        <p class="px-3 py-1 rounded-md text-gray-200 bg-yellow-500 text-xs font-semibold">Note</p>
                        <p class="text-xs rounded-md text-gray-700 italic">Ensure all details and actions to be performed are correct.</p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="px-4 py-1 bg-cyan-700 hover:bg-cyan-600 text-gray-200 text-xs"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <button type="button" class="px-4 py-1 bg-red-700 hover:bg-red-600 text-gray-200 text-xs"><i class="fa-solid fa-ban"></i></button> 
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</template>
