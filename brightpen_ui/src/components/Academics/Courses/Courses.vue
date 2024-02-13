<script setup>
import { ref, onMounted, computed } from 'vue';
import Loader from '../../snippets/loaders/Loading1.vue';
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
// import Table1 from '../../snippets/tables/Table1.vue';
import { getProgram, getProgramList, getDegree, getSemester , saveProgram } from "./CoursesFunction.js";




const preLoading = ref(false)
const activeEditCell = ref(0)
const program = ref([])
const programData = ref([])
const degree = ref([])
const semester = ref([])
const degreeType = ref('')
const semesterType = ref('')
const programType = ref('')
const addNew = ref(false)



onMounted(async () => {

   try{
        preLoading.value = true
        getProgram().then((results)=>{
            program.value = results
        })
        getDegree().then((results)=>{
            degree.value = results
        })
        getSemester().then((results)=>{
            semester.value = results
        })
        getProgramList(0).then((results)=>{
            preLoading.value = false
            programData.value = results
        })

   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
})



const saveData = (data) =>{
    let items = { ...data };

    items.prog_semtype == 1? items.prog_semcount=2 : items.prog_semcount=3
    items.prog_degree == 4? items.prog_year = 4 : items.prog_year = 2
    console.log(items)
    saveProgram(items).then((results)=>{
        alert('Update Saved')
        activeEditCell.value=0
    }).catch((err) => {
        alert('error loading saving subject')
    })
}

const cancelData = (data, index) =>{
    let items = { ...data };
    activeEditCell.value=0
}

const editData = (data, id) =>{
    let items = { ...data };
    activeEditCell.value=id
}

const searchData = (data) =>{
    console.log(data)
}

const emit = defineEmits(['add-modal'])
const registerData = (data) =>{
    emit('add-modal',program.value, degree.value, semester.value)
}



</script>

<template>

    <SearchHeader headerTitle="Programs" :searchData="programData" @toggle-search="searchData" @add-new="registerData"/>

    <div class="flex flex-col h-full w-full">
        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

            <NoDataFound v-if="!Object.keys(programData).length && !preLoading"/>
            <Loader v-if="!Object.keys(programData).length && preLoading"></Loader>

            <div class="flex flex-col gap-2"> 
                <form @submit.prevent="saveData(programData[index])" v-for="(p, index) in programData" class="p-3 w-full flex flex-col md:flex-row gap-2 border border-gray-300 rounded-md">
                    <div class="w-full p-2 flex flex-col gap-2">
                        <div class="h-full flex flex-col gap-2">
                            <input type="text" class="border border-gray-300 p-2 text-xs font-extrabold rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="p.prog_code" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                            <input type="text" class="border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="p.prog_name" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                            <select @change="p.prog_degree = '', p.prog_semtype =''" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " :value="programType" v-model="p.prog_progtype" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required>
                                <option value="" :disabled="!programType">-- Select Program --</option>
                                <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                            </select>
                            <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " :value="degreeType" v-model="p.prog_degree" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required>
                                <option value="" :disabled="!degreeType">-- Select Degree --</option>
                                <option v-for="(d, index) in degree" :value="d.deg_id" :disabled="d.deg_type == p.prog_progtype? false:true">{{ d.deg_desc }}</option>
                            </select>
                            <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " :value="semesterType" v-model="p.prog_semtype" :disabled="activeEditCell==index+1 &&  p.prog_progtype==2 ? false:true " title="Click Edit to modify details">
                                <option value="" :disabled="!semesterType">-- Select Semester --</option>
                                <option v-for="(s, index) in semester" :value="s.sem_id">{{ s.sem_desc }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 justify-start items-center">
                            <button v-show="activeEditCell==index+1? false:true" @click="editData(programData[index], index+1)" type="button"  class="w-full sm:w-1/4 text-xs bg-cyan-500 px-4 py-1 rounded-md text-white hover:bg-cyan-400">Edit</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="button" @click="cancelData(programData[index],index)" class="w-full sm:w-1/4 text-xs bg-red-500 px-4 py-1 rounded-md text-white hover:bg-red-400">Cancel</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="submit" class="w-full sm:w-1/4 text-xs bg-teal-500 px-4 py-1 rounded-md text-white hover:bg-teal-400">Save</button>

                            <!-- <button @click="programData[index].prog_status = 0, saveData(programData[index])" v-if="p.prog_status==1" type="button" class="w-full sm:w-1/4 text-xs bg-emerald-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Active
                            </button>
                            <button @click="programData[index].prog_status = 1, saveData(programData[index])" v-else type="button" class="w-full sm:w-1/4 text-xs bg-gray-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Inactive
                            </button> -->
                        </div>
                    </div>
                    <textarea class="w-full p-5 text-justify overflow-auto h-auto border border-gray-200 rounded-md disabled:shadow-inner disabled:bg-gray-50 text-xs disabled:cursor-not-allowed " cols="42" rows="5" title="Click Edit to modify details"
                        v-model="p.prog_desc" :disabled="activeEditCell==index+1? false:true" required>
                    </textarea>
                </form>

            </div>

        </div>
    </div>
</template>
