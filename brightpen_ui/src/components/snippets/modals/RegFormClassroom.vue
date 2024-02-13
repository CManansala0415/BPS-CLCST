<script setup>
import { ref, onMounted, computed } from 'vue';
import { addClassroom } from '../../Academics/Classrooms/ClassroomsFunction.js'
const props = defineProps({
    roomtypes: {
    },    
    building: {
    },
})

defineEmits(['close-modal', 'add-new']);

const roomtypes = computed(() => {
  return props.roomtypes
});
const building = computed(() => {
  return props.building
});


const classroomEncode = ref({
    classr_code:'',
    classr_name:'',
    classr_rtype:'',
    classr_bid:'',
})

const saving = ref(false)
const save = ()=>{
    saving.value =true
    addClassroom(classroomEncode.value).then((results)=>{
        alert('Successfully Registered')
    }).catch((err) => {
        alert('error loading saving program')
    })
}

onMounted(async () => {


})

</script>

<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-1/2">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">New Classroom</p>   
                    <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>
            <form @submit.prevent="save" class="flex flex-col md:flex-row gap-4">
                <div class="basis-full flex flex-col gap-2 justify-evenly">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Classroom Code</p> 
                        <input type="text" v-model="classroomEncode.classr_code" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Classroom Name</p> 
                        <input type="text" v-model="classroomEncode.classr_name" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Classroom Type</p> 
                        <select v-model="classroomEncode.classr_rtype" 
                            class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed "  title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Room Type --</option>
                            <option v-for="(r, index) in roomtypes" :value="r.rmtype_id">{{ r.rmtype_name }}</option>
                        </select>
                    </div>  

                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Building</p> 
                        <select v-model="classroomEncode.classr_bid"
                            class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Building --</option>
                            <option v-for="(b, index) in building" :value="b.buil_id" >{{ b.buil_name }}</option>
                        </select>
                    </div>  
                    <div class="flex flex-col border mt-4">
                        <button type="submit" class=" bg-emerald-500 hover:bg-emerald-400 p-2 rounded-sm text-xs text-white">Register Item</button>  
                    </div> 
                    
                </div>
            </form>    
        </div>
    </div>
</template>