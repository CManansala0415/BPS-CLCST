<script setup>
import { ref, onMounted, computed } from 'vue';
import { addCurriculum} from "../../Academics/Curriculum/CurriculumFunction.js";

// defineEmits(['close-modal', 'add-new']);

const props = defineProps({
    program: {
    },    
    gradelvl: {
    },
    quarter: {
    },
    course: {
    },
    
})

const program = computed(() => {
  return props.program
});
const gradelvl = computed(() => {
  return props.gradelvl
});
const quarter = computed(() => {
  return props.quarter
});
const course = computed(() => {
  return props.course
});

onMounted(async () => {

 

})



const curriculumData = ref({
    curr_code: '',
    curr_desc: '',
    curr_from: 2023,
    curr_to: 2024,
    curr_progid: '',
    curr_progtype: '',
    curr_gradelvlid: '',
    curr_semester: '',
})

const save = () =>{
    
    if(curriculumData.value.curr_from >= curriculumData.value.curr_to){
        alert('(From) cannot be equal or lower than (To)')
    }else{
        addCurriculum(curriculumData.value).then((results)=>{
            console.log(results)
            alert('Registration Saved')
            closeForm()
        }).catch((err) => {
                alert('error loading saving curriculum')
        })
    }

}

const emit = defineEmits(['close-modal', 'add-new'])
const closeForm = (data) =>{
    emit('close-modal')
}

</script>
<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-1/2">
           <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                <p class="mb-2 text-md font-semibold">New Curriculum</p>   
                <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
           </div>
           <form @submit.prevent="save" class="flex flex-col md:flex-row gap-4">
                <div class="basis-full flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Curriculum Code</p> 
                        <input type="text" v-model="curriculumData.curr_code" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Curriculum Name</p> 
                        <input type="text"  v-model="curriculumData.curr_desc" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">From</p> 
                        <input type="number" min="1900" max="2099" step="1" v-model="curriculumData.curr_from" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">To</p> 
                        <input type="number" min="1900" max="2099" step="1" v-model="curriculumData.curr_to" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                </div>
                <div class="basis-full flex flex-col gap-2">
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Course</p> 
                        <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                v-model="curriculumData.curr_progid"
                                title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Program --</option>
                            <option v-for="(c, index) in course" :value="c.prog_id">{{ c.prog_name }}</option>

                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Program</p> 
                        <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                v-model="curriculumData.curr_progtype"
                                :disabled="!curriculumData.curr_progid? true:false"
                                title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Program --</option>
                            <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>

                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Grade Level</p> 
                        <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                v-model="curriculumData.curr_gradelvlid"
                                title="Click Edit to modify details" 
                                :disabled="!curriculumData.curr_progtype? true:false"
                                required>
                            <option value="" disabled>-- Select Grade Level --</option>
                            <option v-for="(g, index) in gradelvl" :value="g.grad_id" :disabled="curriculumData.curr_progtype!=g.grad_dtypeid? true:false">{{ g.grad_name }}</option>
                            
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-xs">Semester</p> 
                        <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                v-model="curriculumData.curr_semester"
                                :disabled="!curriculumData.curr_progtype || !curriculumData.curr_gradelvlid? true:false? true:false"
                                title="Click Edit to modify details" required>
                            <option value="" disabled>-- Select Semester --</option>
                            <option v-for="(s, index) in quarter" :value="s.quar_id" :disabled="curriculumData.curr_progtype!=s.quar_dtypeid? true:false">{{ s.quar_desc}}</option>
                        </select>
                    </div>
                    <div class="h-full flex justify-end">
                        <button type="submit" class="w-auto bg-emerald-500 hover:bg-emerald-400 p-2 rounded-sm text-xs text-white">Register Item</button>  
                    </div> 
                </div>
                
            </form>
        </div>
    </div>
</template>