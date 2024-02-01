<script setup>
import { ref, onMounted, computed } from 'vue';
import Saved from '../../snippets/toasts/AlertSaved.vue';
import Error from '../../snippets/toasts/AlertError.vue';
import Loader from '../../snippets/loaders/Loading1.vue';

import { getDegree, getSemester, getProgramList, saveProgram } from "./ProgramsFunctions.js";

const props = defineProps({
    prog_id: {
    },
    access_type: {
    },
})

const propID = computed(() => {
  return props.prog_id
});
const accessType = computed(() => {
  return props.access_type
});


const degreeType= ref([])
const preLoading= ref(false)

onMounted(async () => {
    
    preLoading.value =true
    getDegree(1).then((results) => {
        degreeType.value=results
        if(accessType.value == 2){
            getProgramList(propID.value).then((results) => {
                loadData(results)
                preLoading.value =false
            }).catch((err) => {
                alert('error loading the list programs')
            })
        }else{
            preLoading.value =false
        }
    }).catch((err) => {
        alert('error loading departments')
    })

   
    
    
})

// to load data if update yung accessType
const loadData = (data) =>{
    // console.log(data)
    items.value.prog_code = data[0].prog_code
    items.value.prog_name = data[0].prog_name
    items.value.prog_desc = data[0].prog_desc
    items.value.prog_degree = data[0].prog_degree

    items.value.dprog_y1.quarter_1_units = data[0].dprog_q1
    items.value.dprog_y1.quarter_2_units = data[0].dprog_q2
    items.value.dprog_y1.quarter_3_units = data[0].dprog_q3
    items.value.dprog_y1.quarter_4_units = data[0].dprog_q4
    items.value.dprog_y1.year1_id = data[0].dprog_progid

    items.value.dprog_y2.quarter_1_units = data[1].dprog_q1
    items.value.dprog_y2.quarter_2_units = data[1].dprog_q2
    items.value.dprog_y2.quarter_3_units = data[1].dprog_q3
    items.value.dprog_y2.quarter_4_units = data[1].dprog_q4
    items.value.dprog_y1.year2_id = data[1].dprog_progid

    items.value.mode = 2 // 2 means update

}


const items = ref({
    mode:1, //1 means add new, 2 means update
    prog_code: '',
    prog_name: '',
    prog_desc: '',
    prog_degree:'',
    prog_year: 2,
    prog_progtype: 1, // 2 means college
    prog_semtype: 1,
    prog_semcount: 4,
    dprog_y1:{
        year1_id: '',
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',

        quarter_1_units: '',
        quarter_2_units: '',
        quarter_3_units: '',
        quarter_4_units: '',
    },
    dprog_y2:{
        year2_id: '',
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',

        quarter_1_units: '',
        quarter_2_units: '',
        quarter_3_units: '',
        quarter_4_units: '',
    },
    dprog_y3:{
        year3_id: '',
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    },
    dprog_y4:{
        year4_id: '',
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    }
})


const isLoading = ref(false)
const done = ref(false)
const saved = ref(false)
const error = ref(false)
const save = ()=>{

    isLoading.value =true
    saveProgram(items.value).then((results) => {
        results==204? saved.value = true: error.value = true
        isLoading.value = false
        done.value = true

    }).catch((err) => {
        alert('error saving items')
    })
}

</script>

<template>
    <Saved v-if="saved" data="Program" @toggle-close="saved=false"/>
    <Error v-if="error" data="Program" @toggle-close="error=false"/>

    <Loader v-if="preLoading"></Loader>
       
    <div v-if="!preLoading">
        <form @submit.prevent="save" class="flex flex-col gap-2">
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-purple-500 text-white">SHS Primary Information</p>
                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Program Code</p>
                        <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            placeholder="ex. BSMT" v-model="items.prog_code" required/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Track</p>
                        <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs"
                            placeholder="ex. Bachelor of Science in Maritime Transportation" v-model="items.prog_name" required/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Strand</p>
                        <select class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.prog_degree" required>
                            <option value="" disabled>-- Select Here --</option>
                            <option v-for="(d, index) in degreeType" :value="d.deg_id">{{ d.deg_desc }}</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div>
                <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                    <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 1 Expected Units</p>
                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 1</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y1.quarter_1_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 2</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y1.quarter_2_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 3</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y1.quarter_3_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 4</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y1.quarter_4_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                    </div>
                </div>
                <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                    <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   Expected Units</p>
                    <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 1</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y2.quarter_1_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div>
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 2</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y2.quarter_2_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 3</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y2.quarter_3_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                        <div class="flex flex-col gap-2">
                            <p class="text-xs">Quarter 4</p>
                            <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                            v-model="items.dprog_y2.quarter_4_units"
                                placeholder="ex. 4" required min="0" max="50"/>
                        </div> 
                    </div>
                </div>
            </div>   

            <div class="flex flex-col gap-2">
                <p class="text-xs">Course Description</p>
                <textarea class="p-2 h-24 rounded-md border border-gray-300 shadow-md text-xs" required v-model="items.prog_desc"></textarea>
            </div>
            <div class="flex justify-end gap-2">
                <button v-if="!isLoading && !done" type="submit" class="px-5 py-2 bg-emerald-500 text-xs text-white rounded-lg hover:bg-emerald-400">Save Information</button>
                <button v-if="isLoading && !done" type="button" class="px-5 py-2 bg-emerald-300 text-xs text-white rounded-lg" disabled>Saving...</button>
            </div>

        </form>
    </div>

</template>
