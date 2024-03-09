<script setup>
import { ref, onMounted, computed } from 'vue';
import { addCurriculum, getCurriculum, getGradelvl, getProgram, getQuarter, getProgramList, getSubject } from "../../Academics/Curriculum/CurriculumFunction.js";
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
import Loader from '../../snippets/loaders/Loading1.vue';


const gradelvl = ref([])
const program = ref([])
const quarter = ref([])
const courses = ref([])
const subject = ref([])
const curriculum = ref([])
const preLoading = ref(false)
const editForm = ref(false)

const currDetails = ref({
    curr_code: '',
    curr_desc: '',
    curr_from: '',
    curr_to: '',
    curr_progtype: '',
    curr_progid: '',
    curr_gradelvlid: '',
    curr_semester: '',
})

onMounted(async () => {
    try{
        preLoading.value = true

        getProgram().then((results)=>{
            program.value = results
        })
        getGradelvl().then((results)=>{
            gradelvl.value = results
        })
        getQuarter().then((results)=>{
            quarter.value = results
        })
        getProgramList().then((results)=>{
            courses.value = results
        })
        getSubject().then((results)=>{
            subject.value = results
        })
        getCurriculum().then((results)=>{
            curriculum.value = results
            preLoading.value = false
        })
   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
   
})

const showForm = (data) =>{
    editForm.value = !editForm.value
    if(data){
        currDetails.value = {
            curr_code: data.curr_code,
            curr_desc: data.curr_desc,
            curr_from: data.curr_from,
            curr_to: data.curr_to,
            curr_progtype: data.curr_progtype,
            curr_progid: data.curr_progid,
            curr_gradelvlid: data.curr_gradelvlid,
            curr_semester: data.curr_semester,
        }
    }else{
        currDetails.value={}
    }
    
}

const save = () =>{
    console.log(currDetails.value)
}

const emit = defineEmits(['add-modal'])
const registerData = (data) =>{
    emit('add-modal', '', '', '', '', '', program.value, gradelvl.value, quarter.value, courses.value)
}

</script>

<template>
    <div v-if="editForm == false" class="w-full h-full">
        <SearchHeader headerTitle="Curriculum" :searchData="''" @toggle-search="" @add-new="registerData"/>
        <div class="flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

                <NoDataFound v-if="!Object.keys(curriculum).length && !preLoading"/>
                <Loader v-if="!Object.keys(curriculum).length && preLoading"></Loader>

                <div v-if="Object.keys(curriculum).length && !preLoading" class="border flex flex-col">
                    <div class="grid grid-cols-5">
                        <div class="p-2 w-full bg-emerald-900">
                            <p class="text-xs font-semibold text-white">Code</p>
                        </div>
                        <div class="p-2 w-full bg-emerald-900">
                            <p class="text-xs font-semibold text-white">Description</p>
                        </div>
                        <div class="p-2 w-full bg-emerald-900">
                            <p class="text-xs font-semibold text-white">From</p>
                        </div>
                        <div class="p-2 w-full bg-emerald-900">
                            <p class="text-xs font-semibold text-white">To</p>
                        </div>
                        <div class="p-2 w-full bg-emerald-900">
                            <p class="text-xs font-semibold text-white">Commands</p>
                        </div>
                    </div>
                    
                    <div class="border-0 border-b grid grid-cols-5" v-for="(cr, index) in curriculum">
                        <div class="p-2 w-full flex items-center">
                            <p class="text-xs">{{ cr.curr_code }}</p>
                        </div>
                        <div class="p-2 w-full flex items-center">
                            <p class="text-xs">{{ cr.curr_desc }}</p>
                        </div>
                        <div class="p-2 w-full flex items-center">
                            <p class="text-xs">{{ cr.curr_from }}</p>
                        </div>
                        <div class="p-2 w-full flex items-center">
                            <p class="text-xs">{{ cr.curr_to }}</p>
                        </div>
                        <div class="p-2 w-full flex items-center">
                            <button @click="showForm(curriculum[index])" type="button" class="bg-cyan-500 hover:bg-cyan-400 text-xs text-white p-1 w-full rounded-md">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="w-full h-full">
        <div class="flex flex-col h-full w-full">
            <div class="mb-2 flex gap-2 flex-col md:flex-row justify-between">
                <p class="w-full text-xl text-emerald-600 font-bold">Curriculum Details</p>
                <div class="flex flex-col-reverse sm:flex-row gap-2 w-full justify-end">
                    <div class="w-full sm:w-1/2 flex justify-end">
                        <button type="button" @click="showForm()" class="px-2 py-1.5 bg-cyan-500 text-xs text-white rounded-md hover:bg-cyan-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-rotate-left mr-2"></i>Back</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">
                <div class="flex flex-col gap-2">
                    <form @submit.prevent="save()" class="p-3 w-full flex flex-col md:flex-row gap-2 border border-gray-300 rounded-md">
                        <div class="basis-full flex flex-col gap-2">
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Curriculum Code</p> 
                                <input type="text" v-model="currDetails.curr_code" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Curriculum Name</p> 
                                <input type="text"  v-model="currDetails.curr_desc" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">From</p> 
                                <input type="number" min="1900" max="2099" step="1" v-model="currDetails.curr_from" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">To</p> 
                                <input type="number" min="1900" max="2099" step="1" v-model="currDetails.curr_to" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                        </div>
                        <div class="basis-full flex flex-col gap-2">
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Course</p> 
                                <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        v-model="currDetails.curr_progid"
                                        title="Click Edit to modify details" required>
                                    <option value="" disabled>-- Select Program --</option>
                                    <option v-for="(c, index) in courses" :value="c.prog_id">{{ c.prog_name }}</option>

                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Program</p> 
                                <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        v-model="currDetails.curr_progtype"
                                        :disabled="!currDetails.curr_progid? true:false"
                                        title="Click Edit to modify details" required>
                                    <option value="" disabled>-- Select Program --</option>
                                    <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>

                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Grade Level</p> 
                                <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        v-model="currDetails.curr_gradelvlid"
                                        title="Click Edit to modify details" 
                                        :disabled="!currDetails.curr_progtype? true:false"
                                        required>
                                    <option value="" disabled>-- Select Grade Level --</option>
                                    <option v-for="(g, index) in gradelvl" :value="g.grad_id" :disabled="currDetails.curr_progtype!=g.grad_dtypeid? true:false">{{ g.grad_name }}</option>
                                    
                                </select>
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="text-xs">Semester</p> 
                                <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        v-model="currDetails.curr_semester"
                                        :disabled="!currDetails.curr_progtype || !currDetails.curr_gradelvlid? true:false? true:false"
                                        title="Click Edit to modify details" required>
                                    <option value="" disabled>-- Select Semester --</option>
                                    <option v-for="(s, index) in quarter" :value="s.quar_id" :disabled="currDetails.curr_progtype!=s.quar_dtypeid? true:false">{{ s.quar_desc}}</option>
                                </select>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-2 justify-end items-center">
                                <button type="submit"  class="w-full sm:w-1/4 text-xs bg-emerald-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mt-3 flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">
                <div class="flex flex-col gap-3 p-5 border border-gray-300 rounded-md">
                    <div class="p-1 w-full text-center">
                        <p class="text-md font-semibold text-emerald-700">List of Subjects</p>
                    </div>
                    <div class="border rounded-md p-5 w-full shadow-md shadow-gray-300">
                       <div class="flex justify-between">
                            <div class="border">
                                    <p class="text-xs font-semibold">ENG4-SHS</p>
                                    <p class="text-xs mt-3">Oral Communication</p>
                            </div>
                            <div class="border flex justify-center items-center">
                                    <i class="fa-solid fa-chevron-down text-gray-500"></i>
                            </div>
                       </div>
                       <!-- <div class="border mt-4">
                            <p class="text-xs ">Lecture Units:</p>
                            <p class="text-xs mt-3">Laboratory Units:</p>
                       </div> -->
                    </div>
                    <div class="border rounded-md p-5 w-full shadow-md shadow-gray-300 flex justify-between">
                        <div class="border">
                            <p class="text-xs font-semibold">ENG1-SHS</p>
                            <p class="text-xs mt-3">English for Academic & Professional Purposes</p>
                        </div>
                        <div class="border flex justify-center items-center">
                            <i class="fa-solid fa-chevron-down text-gray-500"></i>
                       </div>
                    </div>
                    <div class="border rounded-md p-5 w-full shadow-md shadow-gray-300 flex justify-between">
                        <div class="border">
                            <p class="text-xs font-semibold">FIL2-SHS</p>
                            <p class="text-xs mt-3">	Pagabasa at Pagsusuri ng iba't Ibang Teksto sa Pananaliksik</p>
                        </div>
                        <div class="border flex justify-center items-center">
                            <i class="fa-solid fa-chevron-down text-gray-500"></i>
                       </div>
                    </div>
                    <div class="border rounded-md p-5 w-full shadow-md shadow-gray-300 flex justify-between">
                        <div class="border">
                            <p class="text-xs font-semibold">ENG1-SHS</p>
                            <p class="text-xs mt-3">English for Academic & Professional Purposes</p>
                        </div>
                        <div class="border flex justify-center items-center">
                            <i class="fa-solid fa-chevron-down text-gray-500"></i>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>
