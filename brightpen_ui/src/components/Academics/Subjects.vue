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
            <input type="text" class=" p-2 border-0 text-xs" placeholder="Search Subject here..."/>
            <button type="button" class=" px-3.5 py-2 bg-blue-700 text-xs text-gray-200 hover:bg-blue-600" 
                @click="$emit('toggle-back')"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

    <div class="w-full flex p-3">
        <div class="flex md:flex-row flex-col gap-3 bg-gray-200 w-full p-4">
            <div class="relative w-full md:basis-3/4 bg-gray-100 flex flex-col shadow-md">
                <div class="p-5 overflow-auto min-h-80">
                    <div class="overflow-auto">
                        <h3 class="mb-3 text-md font-extrabold">Computer Programming 1</h3>
                        <p class="mb-3 text-xs italic text-gray-600">CC01</p>
                        <p class="text-sm text-gray-800">
                            Computer programming is the process of designing and writing computer programs. 
                            As a skill set, it includes a wide variety of different tasks and techniques, 
                            but our tutorials are not intended to teach you everything. Instead, 
                            they are meant to provide basic, practical skills to help you understand and write 
                            computer code that reflects things you see and use in the real world. 
                        </p>
                    </div>
                </div>
                <div class=" bg-gray-300 p-2 flex w-full justify-between gap-2">
                    <div>
                        <!-- <span class="px-3 py-1 rounded-md text-gray-200 bg-red-500 text-xs font-semibold">Inactive</span> -->
                        <span class="px-3 py-1 rounded-md text-gray-200 bg-green-500 text-xs font-semibold">Active</span>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="px-4 py-1 bg-cyan-700 hover:bg-cyan-600 text-gray-200 text-xs"><i class="fa-solid fa-pen-to-square"></i></button> 
                        <button type="button" class="px-4 py-1 bg-red-700 hover:bg-red-600 text-gray-200 text-xs"><i class="fa-solid fa-ban"></i></button> 
                    </div>
                </div>
                
            </div>
            <div class="w-full md:basis-1/2 bg-gray-100">
                <div class="p-5 flex flex-col gap-3">
                    <div class="flex flex-col text-center">
                        <p class="text-xs font-semibold">Subject Settings</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Subject Title</p>
                        <input type="text" class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Subject Code</p>
                        <input type="text" class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300"/>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-xs mb-1">Subject Description</p>
                        <textarea class="text-xs p-1 border border-gray-400 rounded-md shadow-md shadow-gray-300">
                        </textarea>
                    </div>
                    <div class="flex flex-col gap-2">
                        <button type="button" class="px-4 py-2 bg-green-500 hover:bg-green-400 text-gray-200 text-xs"><i class="fa-solid fa-floppy-disk mr-2"></i>Register Subject</button> 
                        <button type="button" class="px-4 py-2 bg-blue-700 hover:bg-blue-600 text-gray-200 text-xs"><i class="fa-solid fa-pen-to-square mr-2"></i>Save Changes</button> 
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</template>
