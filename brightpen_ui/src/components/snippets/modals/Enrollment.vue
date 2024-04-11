<script setup>
import { ref, onMounted, computed } from 'vue';
import {  getProgram, getGradelvl, getQuarter, getProgramList, enrollApplicant, getEnrollment } from "../../Academics/Applicants/ApplicantFunction.js";
import { getUserID } from "../../../routes/user";
const userID = ref('')

const props = defineProps({
    data: {
    }, 
    attainment: {
    },    

    program: {
    },
    gradelvl: {
    },
})

defineEmits(['close-modal', 'add-new']);

const person = computed(() => {
  return props.data
});

const showItems = ref(false)
const gradelvl = ref([])
const program = ref([])
const quarter = ref([])
const course = ref([])
const filteredCourse = ref([])
const filteredQuarter = ref([])
const filteredGradelvl = ref([])
const enrollChecker = ref(false)
const enrollData = ref({
    userid:'',
    personid:'',
    gradelvl: '',
    program: '',
    quarter: '',
    course: ''
})
const enrolleeData = ref([])
onMounted(async () => {
    window.stop()
    try{
        getProgram().then((results)=>{
            program.value = results
        })
        getProgramList().then((results)=>{
            course.value = results
            filteredCourse.value = course.value
        })
        getGradelvl().then((results)=>{
            gradelvl.value = results
            filteredGradelvl.value = gradelvl.value
        })
        getQuarter().then((results)=>{
            quarter.value = results
            filteredQuarter.value = quarter.value
        })

        enrollChecker.value = true
        getEnrollment(person.value.per_personid).then((results)=>{

            if(results.length != 0){
                enrolleeData.value = results[0]
                detectCourse(enrolleeData.value.enr_course)
                enrollData.value.gradelvl = enrolleeData.value.enr_gradelvl
                enrollData.value.program = enrolleeData.value.enr_program
                enrollData.value.quarter = enrolleeData.value.enr_quarter
                enrollData.value.course = enrolleeData.value.enr_course
            }else{
                enrolleeData.value = []
            }

            enrollChecker.value = false
        })
        getUserID().then((results) => {
            userID.value = results.data.id
        }).catch((err) => {
            router.push("/");
        })
  
   }catch(err) {
        alert('error loading the list default components')
   }

})

// for typing search input

// interval for focusout, need ng interval para kapag nag select sa dropdown mahabol nya
let hiding = ref()
const doneInterval = ref(150)
const interval = () => { 
    clearTimeout(hiding.value);
    hiding.value = setTimeout(() => setFalse(), doneInterval.value);          
}
const setFalse = () => { 
    showItems.value = false
    // let prog_name = ''
    // let prog_id = ''

    // if(!filteredCourse.value.length){
    //     prog_name = ''
    //     prog_id = ''
    // }else{
    //     prog_name = filteredCourse.value[0].prog_name
    //     prog_id = filteredCourse.value[0].prog_id
    // }

    // !search.value.trim()? search.value = prog_name : search.value = prog_name
    // !enrollData.value.course? enrollData.value.course = prog_id : enrollData.value.course = prog_id
}

const search = ref('')
const filterCourse = ()=>{
    filteredCourse.value = course.value.filter(e => {
      if(
          (
            (e.prog_name.toUpperCase().includes(search.value.toUpperCase()))||
            (e.prog_code.toUpperCase().includes(search.value.toUpperCase()))
            )
          &&
          (e.prog_progtype == enrollData.value.program)

        ){
          return e
      }
    })
}
// para to sa auto load ng course if enrolled na sya, to optimized in future
const detectCourse = (data)=>{
    let x = []
    x = course.value.filter(e => {
      if(
          (e.prog_id==data)
        ){
          return e
      }
    })

    search.value = x[0].prog_name
}
// for typing search input

const filterQuarter = ()=>{
    enrollData.value.quarter=''
    filteredQuarter.value = quarter.value.filter(e => {
      if(enrollData.value.program==e.quar_dtypeid){
          return e
      }
    })
}
const filterGradelvl = ()=>{
    enrollData.value.gradelvl=''
    filteredGradelvl.value = gradelvl.value.filter(e => {
      if(enrollData.value.program==e.grad_dtypeid){
          return e
      }
    })

}
const filterCourses = ()=>{
    enrollData.value.course=''
    search.value=''
}

const enroll = () =>{
    if(
        (enrollData.value.program)&&
        (enrollData.value.quarter)&&
        (enrollData.value.course)&&
        (enrollData.value.gradelvl)
    ){
       
        enrollData.value.personid = person.value.per_personid
        enrollData.value.userid = userID.value
        console.log(enrollData.value)
        enrollApplicant(enrollData.value).then((results)=>{

            if(results.data == 500){
                alert('error enrolling applicant')
            }else{
                alert('Applicant Enrolled')
                location.reload()
            }
        })
        
    }else{
        alert('Please Fillout all the Fields')
    }
}
</script>

<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-1/2">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">Enroll Applicant</p>   
                    <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>
            <div class="flex flex-col gap-2">
                <p class="text-xs font-semibold text-emerald-600">Applicant Name</p>
                <p class="text-sm">{{ person.per_firstname  }} {{ person.per_middlename }} {{ person.per_lastname }} {{ person.per_suffixname }}</p>
                <p class="text-xs mt-3 mb-3"><span class="font-semibold text-emerald-600">Note: </span><span class="italic">Ensure that the details of the following applicant are correct.
                    To enroll this applicant, select the appropiate academic status and refresh the page.
                </span></p>
                <div class="flex flex-col gap-1">
                    <p class="text-xs">Type</p> 
                    <select v-model="enrollData.program" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                            title="Click Edit to modify details" 
                            @change="filterQuarter(), filterGradelvl(), filterCourses()"
                            :disabled="enrollChecker || enrolleeData.enr_id? true:false">
                        <option value="" disabled>-- Select Type --</option>
                        <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="text-xs">Semester / Quarter</p> 
                    <select v-model="enrollData.quarter" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                            :disabled="!enrollData.program || enrolleeData.enr_id? true:false"
                            title="Click Edit to modify details">
                        <option value="" disabled>-- Select Type --</option>
                        <option v-for="(q, index) in filteredQuarter" :value="q.quar_id">{{ q.quar_desc }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <p class="text-xs">Program / Strand</p> 
                    <input v-model="search" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                            :disabled="!enrollData.program || enrolleeData.enr_id? true:false"
                            @focus="showItems = true"
                            @focusout="interval()" 
                            @click="showItems = true, filterCourse()"
                            @keyup="filterCourse()"
                            onkeydown="return /[a-z, ]/i.test(event.key)"
                            title="Click Edit to modify details"/>
                    <div v-if="showItems" class="relative">
                        <div :class=" Object.keys(filteredCourse).length > 1? 'w-full border p-2 flex flex-col rounded-md shadow-sm h-40 absolute bg-white z-10 overflow-auto ':
                                      'w-full border p-2 flex flex-col rounded-md shadow-sm h-auto absolute bg-white z-10 overflow-auto '
                                    ">
                            <div v-if="Object.keys(filteredCourse).length" v-for="(c, index) in filteredCourse" @click="search=c.prog_name, enrollData.course=c.prog_id"  class="p-2 hover:bg-gray-100 cursor-pointer" >
                                <p  class="text-xs" >{{  c.prog_name  }}</p>
                            </div>
                            <div v-else class="p-2 hover:bg-gray-100 cursor-pointer"  @click="search='', enrollData.course=''">
                                <p  class="text-xs">No Data Found</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="flex flex-col gap-1">
                    <p class="text-xs">Program / Strand</p> 
                    <select v-model="enrollData.course" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                            :disabled="!enrollData.quarter"
                            @change="enrollData.gradelvl=''"
                            title="Click Edit to modify details" >
                        <option value="" disabled>-- Select Type --</option>
                        <option v-for="(c, index) in course" :value="c.prog_id" :disabled="enrollData.program!=c.prog_progtype? true:false">{{ c.prog_name }}</option>
                    </select>
                </div> -->
                <div class="flex flex-col gap-1">
                    <p class="text-xs">Grade / Year Level</p> 
                    <select v-model="enrollData.gradelvl" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                            :disabled="!enrollData.program || enrolleeData.enr_id? true:false"
                            title="Click Edit to modify details" >
                        <option value="" disabled>-- Select Type --</option>
                        <option v-for="(g, index) in filteredGradelvl" :value="g.grad_id" :disabled="enrollData.program!=g.grad_dtypeid? true:false">{{ g.grad_name }}</option>
                    </select>
                </div>
                <div v-if="!enrolleeData.enr_id && enrollChecker == false">
                    <button @click="enroll()" type="button" class="mt-4 w-full p-2 bg-emerald-400 shadow-md disabled:bg-gray-200 disabled:cursor-not-allowed text-xs text-white rounded-md hover:bg-emerald-300">Enroll</button>
                </div>
                <div v-if="enrolleeData.enr_id && enrollChecker == false">
                    <button type="button" class="mt-4 w-full p-2 bg-yellow-400 shadow-md disabled:bg-gray-200 cursor-not-allowed text-xs text-white rounded-md">Enrolled</button>
                </div>
                <div v-if="!enrolleeData.enr_id && enrollChecker == true">
                    <button type="button" class="mt-4 w-full p-2 bg-gray-200 shadow-md text-xs text-white rounded-md hover:bg-gray-300 cursor-wait">Checking Enrollment Status</button>
                </div>
            </div>
        </div>
    </div>
</template>