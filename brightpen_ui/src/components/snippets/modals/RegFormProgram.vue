<script setup>
import { ref, onMounted, computed } from 'vue';
import { addProgram } from '../../Academics/Courses/CoursesFunction.js'
const props = defineProps({
    program: {
    },    
    degree: {
    },
    semester: {
    },
})

defineEmits(['close-modal', 'add-new']);

const program = computed(() => {
  return props.program
});
const degree = computed(() => {
  return props.degree
});
const semester = computed(() => {
  return props.semester
});


const dtype = ref(false)
const programEncode = ref({
    prog_code:'',
    prog_name:'',
    prog_desc:'',
    prog_degree:'',
    prog_progtype: '',
    prog_semcount:'',
    prog_semtype:'',
    prog_year:'',
})

const saving = ref(false)
const save = ()=>{
    saving.value =true
    programEncode.value.prog_semtype == 1? programEncode.value.prog_semcount=2 : programEncode.value.prog_semcount=3
    programEncode.value.prog_degree == 4? programEncode.value.prog_year = 4 : programEncode.value.prog_year = 2
    console.log(programEncode.value)

    addProgram(programEncode.value).then((results)=>{
        alert('Successfully Registered')
    }).catch((err) => {
        alert('error loading saving program')
    })
}

const resetter = () =>{
    programEncode.value.prog_degree = ''
    programEncode.value.prog_semtype = ''
}
onMounted(async () => {


})

</script>

<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-1/2">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">New Program</p>   
                    <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>
            <form @submit.prevent="save" class="flex flex-col md:flex-row gap-4">
                <div class="basis-full flex flex-col gap-2 justify-evenly">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Code</p> 
                        <input type="text" v-model="programEncode.prog_code" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Name</p> 
                        <input type="text" v-model="programEncode.prog_name" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Description</p> 
                        <textarea v-model="programEncode.prog_desc" class="w-full p-5 text-justify overflow-auto h-auto border border-gray-200 rounded-md disabled:shadow-inner disabled:bg-gray-50 text-xs disabled:cursor-not-allowed " cols="42" rows="5" title="Click Edit to modify details" required>
                        </textarea>
                    </div>  
                    
                </div>
                <div class="basis-full flex flex-col gap-2 justify-evenly">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Type</p> 
                        <select v-model="programEncode.prog_progtype" @change="resetter"
                            class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed "  title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Degree --</option>
                            <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                        </select>
                    </div>  

                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Degree</p> 
                        <select v-model="programEncode.prog_degree" :disabled="!programEncode.prog_progtype? true:false"
                            class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Degree --</option>
                            <option v-for="(d, index) in degree" :value="d.deg_id" :disabled="programEncode.prog_progtype!=d.deg_type">{{ d.deg_desc }}</option>
                        </select>
                    </div>  

                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Program Semester</p> 
                        <select v-model="programEncode.prog_semtype" :disabled="programEncode.prog_progtype == 1? true:false || !programEncode.prog_progtype? true:false"
                            class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " title="Click Edit to modify details" :required="programEncode.prog_progtype==2? true:false">
                            <option value="" disabled>-- Select Semester --</option>
                            <option v-for="(s, index) in semester" :value="s.sem_id">{{ s.sem_desc }}</option>
                        </select>
                    </div>  
                    <div class="flex flex-col border">
                        <button type="submit" class=" bg-emerald-500 hover:bg-emerald-400 p-2 rounded-sm text-xs text-white">Register Item</button>  
                    </div>  
                </div>
            </form>    
        </div>
    </div>
</template>