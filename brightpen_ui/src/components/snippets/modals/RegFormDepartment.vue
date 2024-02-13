<script setup>
import { ref, onMounted, computed } from 'vue';
import { addDepartment } from '../../Academics/Departments/DepartmentsFunction.js'

defineEmits(['close-modal', 'add-new']);

onMounted(async () => {


})

const departmentEncode = ref({
    dep_code:'',
    dep_name:'',
})

const saving = ref(false)
const save = ()=>{
    saving.value =true
    console.log(departmentEncode.value)

    addDepartment(departmentEncode.value).then((results)=>{
        alert('Successfully Registered')
    }).catch((err) => {
        alert('error loading saving department')
    })
}

</script>
<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-1/2">
           <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                <p class="mb-2 text-md font-semibold">New Department</p>   
                <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
           </div>
           <form @submit.prevent="save" class="flex flex-col md:flex-row gap-4">
                <div class="basis-full flex flex-col gap-2 justify-evenly">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Department Code</p> 
                        <input type="text" v-model="departmentEncode.dep_code" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Department Name</p> 
                        <input type="text" v-model="departmentEncode.dep_name" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="w-auto bg-emerald-500 hover:bg-emerald-400 p-2 rounded-sm text-xs text-white">Register Item</button>  
                    </div> 
                </div>
            </form>
        </div>
    </div>
</template>