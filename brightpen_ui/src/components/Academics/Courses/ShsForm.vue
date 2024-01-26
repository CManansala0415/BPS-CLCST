<script setup>
import { ref, onMounted, computed } from 'vue';
import { getDegree, getQuarter } from "./CourseFunction.js";


const degreeType= ref([])
const quarterType= ref([])

onMounted(async () => {

    getDegree(1).then((results) => {
        console.log(results)
        degreeType.value=results

    }).catch((err) => {
        alert('error loading departments')
    })

    getQuarter().then((results) => {
        console.log(results)
        quarterType.value=results

    }).catch((err) => {
        alert('error loading departments')
    })
    
    
})

const items = ref({
    program_type: 1,
    program_years: 2,
    program_code: '',
    program_name: '',
    program_degree: '',
    program_description: '',
    year_1:{
        quarter_1_units: '',
        quarter_2_units: '',
        quarter_3_units: '',
        quarter_4_units: '',
    },
    year_2:{
        quarter_1_units: '',
        quarter_2_units: '',
        quarter_3_units: '',
        quarter_4_units: '',
    }
})

const save = ()=>{
    console.log(items.value)
}

</script>

<template>
    <form @submit.prevent="save" class="flex flex-col gap-2">
        <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
            <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-purple-500 text-white">SHS Primary Information</p>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Program Code<span class="text-red-500">*</span></p>
                    <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        placeholder="ex. MAWD-11" v-model="items.program_code" required/>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Program Name<span class="text-red-500">*</span></p>
                    <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs"
                        placeholder="ex. Mobile and Web Development" v-model="items.program_name" required/>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Degree Type<span class="text-red-500">*</span></p>
                    <select class="p-2 rounded-md border border-gray-300 shadow-md text-xs" v-model="items.program_degree" required>
                        <option value="" disabled>-- Select Here --</option>
                        <option v-for="(d, index) in degreeType" :value="d.deg_id">{{ d.deg_desc }}</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
            <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 1 Expected Units</p>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 1<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_1.quarter_1_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 2<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_1.quarter_2_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 3<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_1.quarter_3_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 4<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_1.quarter_4_units"
                        placeholder="ex. 4" required />
                </div>
            </div>
        </div>   
        <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
            <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 2 Expected Units</p>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 1<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_2.quarter_1_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 2<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_2.quarter_2_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 3<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_2.quarter_3_units"
                        placeholder="ex. 4" required />
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Quarter 4<span class="text-red-500">*</span></p>
                    <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.year_2.quarter_4_units"
                        placeholder="ex. 4" required />
                </div>
            </div>
        </div>   
    


        <div class="flex flex-col gap-2">
            <p class="text-xs">Course Description<span class="text-red-500">*</span></p>
            <textarea class="p-2 h-24 rounded-md border border-gray-300 shadow-md text-xs" required v-model="items.program_description"></textarea>
        </div>
        <div class="flex justify-end gap-2">
            <button  type="submit" class="px-5 py-2 bg-emerald-500 text-xs text-white rounded-lg hover:bg-emerald-400"><i class="fa-solid fa-floppy-disk mr-2"></i>Save Information</button>
        </div>

    </form>

</template>