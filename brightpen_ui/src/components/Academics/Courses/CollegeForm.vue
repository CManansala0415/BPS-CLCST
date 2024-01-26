<script setup>
import { ref, onMounted, computed } from 'vue';
import { getDegree, getSemester ,saveCollegeForm } from "./CourseFunction.js";


const degreeType= ref([])
const semesterType= ref([])

onMounted(async () => {

    getDegree(2).then((results) => {
        degreeType.value=results

    }).catch((err) => {
        alert('error loading departments')
    })
 
    getSemester().then((results) => {
        semesterType.value=results

    }).catch((err) => {
        alert('error loading departments')
    })
    
    
})

const items = ref({
    prog_code: '',
    prog_name: '',
    prog_desc: '',
    prog_degree:'',
    prog_year: '',
    prog_progtype: 2, // 2 means college
    prog_semtype: '',
    prog_semcount: '',
    dprog_y1:{
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    },
    dprog_y2:{
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    },
    dprog_y3:{
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    },
    dprog_y4:{
        semester_1_units: '',
        semester_2_units: '',
        semester_3_units: '',
    }

})


const updateYears = () =>{
    // if bachelor's (id:4) 4 years, if Techvoc (id:5) 2 years
    switch(items.value.prog_degree){
        case 4:
            items.value.prog_year=4
            break;
        case 5:
            items.value.prog_year=2
            break;
        default:
            items.value.prog_year=0
    }

    items.value.prog_semtype = ''
    items.value.prog_semcount = ''

    items.value.dprog_y1 ={
            semester_1_units: '',
            semester_2_units: '',
            semester_3_units: '',
    } 
    items.value.dprog_y2 ={
            semester_1_units: '',
            semester_2_units: '',
            semester_3_units: '',
    } 
    items.value.dprog_y3 ={
            semester_1_units: '',
            semester_2_units: '',
            semester_3_units: '',
    } 
    items.value.dprog_y4 ={
            semester_1_units: '',
            semester_2_units: '',
            semester_3_units: '',
    } 
}
const updateSem = () =>{
    // if semester (id:1) 2 sems, if trimester (id:2) 3 sems
    console.log(items.value.prog_semtype)
    switch(items.value.prog_semtype){
        case 1:
            items.value.prog_semcount=2
            break;
        case 5:
            items.value.prog_semcount=3
            break;
        default:
            items.value.prog_semcount=0
    }

}

const save = ()=>{
    saveCollegeForm(items.value)
}

</script>

<template>
    <form @submit.prevent="save" class="flex flex-col gap-2">
        <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
            <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-cyan-500 text-white">College Primary Information</p>
            <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Program Code<span class="text-red-500">*</span></p>
                    <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        placeholder="ex. BSMT" v-model="items.prog_code" required/>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Program Name<span class="text-red-500">*</span></p>
                    <input type="text" class="p-2 rounded-md border border-gray-300 shadow-md text-xs"
                        placeholder="ex. Bachelor of Science in Maritime Transportation" v-model="items.prog_name" required/>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Degree Type<span class="text-red-500">*</span></p>
                    <select class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.prog_degree" 
                        @change="updateYears()" required>
                        <option value="" disabled>-- Select Here --</option>
                        <option v-for="(d, index) in degreeType" :value="d.deg_id">{{ d.deg_desc }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-xs">Semester Type<span class="text-red-500">*</span></p>
                    <select class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.prog_semtype" 
                        @change="updateSem()" required>
                        <option value="" disabled>-- Select Here --</option>
                        <option v-for="(s, index) in semesterType" :value="s.sem_id">{{ s.sem_desc }}</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div v-if="items.prog_degree == 4 && items.prog_semtype">
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 1 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 4 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 2 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 4 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 3 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y3.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y3.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 4 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y3.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 4 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y4.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y4.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 4 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y4.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
            
        </div>   
        
        <div v-if="items.prog_degree == 5 && items.prog_semtype">
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 1 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 5 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y1.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
            <div class="relative mt-3 flex flex-col gap-2 border border-gray-300 p-5">
                <p class="absolute -top-2.5 px-4 py-0.5 text-xs font-semibold bg-emerald-500 text-white">Year 2 Expected Units</p>
                <div :class="items.prog_semtype == 1? 'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-2':'mt-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2'">
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 1<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_1_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="text-xs">Semester 2<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_2_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                    <div v-if="items.prog_degree == 5 && items.prog_semtype == 2" class="flex flex-col gap-2">
                        <p class="text-xs">Semester 3<span class="text-red-500">*</span></p>
                        <input type="number" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" 
                        v-model="items.dprog_y2.semester_3_units"
                            placeholder="ex. 4" required min="0" max="50"/>
                    </div>
                </div>
            </div>
        </div>
        
        
    


        <div class="flex flex-col gap-2">
            <p class="text-xs">Course Description<span class="text-red-500">*</span></p>
            <textarea class="p-2 h-24 rounded-md border border-gray-300 shadow-md text-xs" required v-model="items.prog_desc"></textarea>
        </div>
        <div class="flex justify-end gap-2">
            <button  type="submit" class="px-5 py-2 bg-emerald-500 text-xs text-white rounded-lg hover:bg-emerald-400">Save Information</button>
        </div>

    </form>

</template>