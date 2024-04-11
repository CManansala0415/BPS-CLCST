<script setup>
import { ref, onMounted, computed } from 'vue';
import { getUserID } from "../../../routes/user";

const props = defineProps({
    students: {
    }, 

})

defineEmits(['close-modal']);

const studentData = computed(() => {
  return props.students
});


const userID = ref('')
onMounted(async () => {
    window.stop()
    try{
        getUserID().then((results) => {
            userID.value = results.data.id
        })
  
   }catch(err) {
        alert('error loading the list default components')
   }
})

const forms = ref([
    {
       name:'Enrollment Form' 
    },
    {
       name:'Identification Card' 
    }, 
    {
       name:'Report Card' 
    }, 
    {
       name:'Clearance' 
    },   
])
</script>


<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center" data-modal-backdrop="static">
        <div class="p-7 bg-white rounded-md flex flex-col w-5/6 sm:w-1/2">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">Forms</p>   
                    <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>
            <div :class="Object.keys(forms).length > 4? 'flex flex-col gap-2 h-96 overflow-auto':'flex flex-col gap-2 h-auto overflow-auto'">
                <div v-for="(f, index) in forms" class="border p-4 flex justify-between items-center">
                    <p class="text-xs">{{ f.name }}</p>
                    <button type="button" class="bg-teal-500 hover:bg-teal-400 px-4 py-2 text-xs text-white shadow-md rounded-sm"><i class="fa-solid fa-print mr-2"></i> Print</button>
                </div>
            </div>
        </div>
    </div>
</template>