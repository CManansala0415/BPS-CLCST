<script setup>
import { ref, onMounted, computed } from 'vue';
import ShsForm from './ShsForm.vue';
import CollegeForm from './CollegeForm.vue';
import Loader from '../../snippets/Loading1.vue';
import { getProgram, getProgramList } from "./CourseFunction.js";

const showForm = ref(false)


const ptype = ref(1)
const programType = ref([])
const programList = ref([])
const isLoading = ref(false)

onMounted(async () => {

    isLoading.value = true
    getProgram().then((results) => {
        programType.value=results

        getProgramList().then((results) => {

            programList.value=results
            isLoading.value = false

        }).catch((err) => {
            alert('error loading the list programs')
        })

    }).catch((err) => {
        alert('error loading programs')
    })

   
    

})


</script>


<template>
    <div v-if="!showForm" class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col sm:flex-row sm:items-center justify-between">
            <p class="text-xl text-emerald-600 font-bold">Programs</p>
            <div class="flex gap-2">
                <div class="flex">
                    <button type="button" :disabled="isLoading" @click="showForm = true" class="px-5 bg-emerald-500 text-xs text-white rounded-md hover:bg-emerald-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-plus mr-2"></i> Add New</button>
                </div>
                <div class="flex">
                    <input type="text" :disabled="isLoading" class="p-2 border-0 shadow-md text-xs disabled:bg-gray-200 disabled:cursor-not-allowed" placeholder="Search Course Here..."/>
                    <button type="button" :disabled="isLoading" class="p-2 bg-emerald-400 shadow-md disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-magnifying-glass text-white"></i></button>
                </div>
            </div>
            
        </div>

        <div v-if="!Object.keys(programList).length && !isLoading" class="gap-4 flex flex-col justify-center items-center p-3 h-96  bg-white rounded-md shadow-md ">
            <i class="text-4xl font-bold text-gray-600 fa-solid fa-link-slash"></i>
            <p class="text-2xl font-bold text-gray-600">Empty List</p>
            <p class="text-sm font-semibold text-gray-500">No Data Found, here's what to do:</p>
            <ul class="list-disc text-xs text-gray-500">
                <li>
                    Try refreshing the page.
                </li>
                <li>
                    Check your internet connection.
                </li>
                <li>
                    Contact your system administrator.
                </li>
            </ul>
        </div>

        <div v-if="!Object.keys(programList).length && isLoading" class="gap-4 flex flex-col justify-center items-center p-3 h-96  bg-white rounded-md shadow-md ">
            <Loader></Loader>
            <p class="text-2xl font-bold text-gray-600">Loading List</p>
            <p class="text-sm font-semibold text-gray-500">retrieving data from the server please wait...</p>
        </div>

        <div v-if="Object.keys(programList).length && !isLoading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
            
            <div v-for="(p, index) in programList" class="flex flex-col justify-evenly p-3 h-96  bg-white rounded-md shadow-md ">
                <div class="border-0 border-b-2 border-gray-300 p-2 flex justify-between">
                    <p class="text-md font-semibold">{{ p.prog_code }}</p>
                </div>
                <div class="p-2 flex flex-col">
                    <span class="text-gray-400 italic text-xs">Course Name:</span> 
                    <p class="text-xs font-semibold">
                    {{ p.prog_name }}</p>
                </div>
                <div class="p-2 flex flex-col overflow-auto bg-gray-50 border rounded-lg text-justify">
                    <p class="text-xs">
                    {{ p.prog_desc }}</p>
                </div>
                <div class="p-2 flex flex-col gap-2">
                    <span class="text-gray-400 italic text-xs">Tags:</span> 
                    <div class="flex gap-2">
                        <p v-if="p.prog_status==1" class="text-xs font-semibold px-3 py-1 rounded-lg text-white bg-emerald-500">Active</p>
                    </div>
                </div>
               

                <div class="p-2 flex justify-end">
                    <button @click="showForm = true" type="button" class="text-cyan-500 text-xs font-bold hover:underline hover:text-cyan-400">
                        View & Edit
                    </button>
                </div>
            </div>
            
        </div>
    </div>

    <!-- <FormSettings v-if="showForm" @toggle-back="showForm = !showForm" :formData="formData"></FormSettings> -->
    <div v-if="showForm" class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col sm:flex-row sm:items-center justify-between">
            <p class="text-xl text-emerald-600 font-bold">Programs Settings</p>
            <div class="flex gap-2">
                <div class="flex">
                    <button type="button" @click="showForm=false, ptype=1" class="p-3 bg-cyan-500 text-xs text-white rounded-md hover:bg-cyan-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-rotate-left mr-2"></i> Back to List</button>
                </div>
            </div>
            
        </div>

        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">
            <div class="basis-1/2 flex justify-center">
                <select class="p-2 rounded-md border border-gray-300 shadow-md text-xs" v-model="ptype">
                    <option v-for="(p, index) in programType" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                </select>
            </div>

            <ShsForm v-if="ptype==1"></ShsForm>
            <CollegeForm v-if="ptype==2"></CollegeForm>
            
        </div>
    </div>
</template>
