<script setup>
import { ref, onMounted, computed } from 'vue';
import FormSettings from './FormSettings.vue';

const showForm = ref(false)
const formData=ref([
    {
        title:'Section Name',
        type:'text',
        placeholder:'ex. Alpha',
        validation:'required',
    },
    {
        title:'Section Code',
        type:'text',
        placeholder:'ex. A-1',
        validation:'required',
    },
])
</script>


<template>
    <div v-if="!showForm" class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col sm:flex-row sm:items-center justify-between">
            <p class="text-xl text-emerald-600 font-bold">Sections</p>
            <div class="flex">
                <input type="text" class="p-2 border border-gray-300 shadow-md text-xs" placeholder="Search Course Here..."/>
                <button type="button" class="px-3 bg-emerald-400"><i class="fa-solid fa-magnifying-glass text-gray-100"></i></button>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">

            <div class="flex flex-col justify-evenly p-3 h-52  bg-white rounded-md shadow-md ">
                <div class="border-0 border-b-2 border-gray-300 p-2 flex flex-col">
                    <p class="text-md font-semibold">Alpha</p>
                </div>
                <div class="p-2 flex flex-col">
                    <span class="text-gray-400 italic text-xs">Section Code:</span> 
                    <p class="text-xs">A-1</p>
                </div>
                <div class="p-2 flex justify-end">
                    <button @click="showForm = true" type="button" class="text-cyan-500 text-xs font-bold hover:underline hover:text-cyan-400">
                        View & Edit
                    </button>
                </div>
            </div>
            <div class="flex flex-col justify-evenly p-3 h-52  bg-white rounded-md shadow-md ">
                <div class="border-0 border-b-2 border-gray-300 p-2 flex flex-col">
                    <p class="text-md font-semibold">Bravo</p>
                </div>
                <div class="p-2 flex flex-col">
                    <span class="text-gray-400 italic text-xs">Section Code:</span> 
                    <p class="text-xs">B-2</p>
                </div>
                <div class="p-2 flex justify-end">
                    <button @click="showForm = true" type="button" class="text-cyan-500 text-xs font-bold hover:underline hover:text-cyan-400">
                        View & Edit
                    </button>
                </div>
            </div>
            <div class="flex flex-col justify-evenly p-3 h-52  bg-white rounded-md shadow-md ">
                <div class="border-0 border-b-2 border-gray-300 p-2 flex flex-col">
                    <p class="text-md font-semibold">Charlie</p>
                </div>
                <div class="p-2 flex flex-col">
                    <span class="text-gray-400 italic text-xs">Section Code:</span> 
                    <p class="text-xs">C-3</p>
                </div>
                <div class="p-2 flex justify-end">
                    <button @click="showForm = true" type="button" class="text-cyan-500 text-xs font-bold hover:underline hover:text-cyan-400">
                        View & Edit
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <FormSettings v-if="showForm" @toggle-back="showForm = !showForm" :formData="formData"></FormSettings>
</template>
