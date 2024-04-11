<script setup>
import { ref, onMounted, computed } from 'vue';
import { getUserID } from "../../../routes/user";
import { getCurriculumSubject ,getEnrollment, getMilestone, addMilestone, updateEnrollment, updateMilestone  } from "../../Academics/students/StudentFunction.js";
import Loader from '../loaders/Loading1.vue';
import { useRouter,useRoute } from 'vue-router'

const router = useRouter();
const route=useRoute();
const path = computed(() =>route.path)

const props = defineProps({
    students: {
    }, 
    descriptions:{
    },
    curriculum:{
    },
    section:{
    },
    subject:{
    }
})


const emit = defineEmits(['close-modal'])
const close = (data) =>{
    window.stop()
    emit('close-modal')
}

const studentData = computed(() => {
  return props.students
});
const studentinfo = computed(() => {
  return props.descriptions
});
const curriculumData = computed(() => {
  return props.curriculum
});
const sectionData = computed(() => {
  return props.section
});
const subjectData = computed(() => {
  return props.subject
});

const userID = ref('')
const fullName = ref('')
const contactNumber = ref('')
const email = ref('')
const programDesc = ref('')
const courseDesc = ref('')
const gradelvlDesc = ref('')
const quarterDesc = ref('')
const subjectFilter = ref([])
const preloading = ref(false)
const currSubject = ref([])
const enrolleeData = ref([])
const milestone = ref([])
const milestoneSubject = ref([])
const enr_section = ref('')
const enr_curriculum = ref('')



onMounted(async () => {
    window.stop()
    enr_section.value = studentData.value.enr_section
    enr_curriculum.value = studentData.value.enr_curriculum
    
    fullName.value = studentData.value.per_firstname + ' ' + studentData.value.per_middlename + ' ' + studentData.value.per_lastname
    contactNumber.value = studentData.value.per_contact
    email.value = studentData.value.per_email
    programDesc.value = studentinfo.value.per_program_desc
    courseDesc.value = studentinfo.value.per_course_desc
    gradelvlDesc.value = studentinfo.value.per_gradelvl_desc
    quarterDesc.value = studentinfo.value.per_quarter_desc
    subjectFilter.value = subjectData.value
    try{
        preloading.value = true
        getUserID().then((results) => {
            userID.value = results.data.id
        })
       
        getEnrollment(studentData.value.per_personid).then((results)=>{
            enrolleeData.value = results
            let curr = enrolleeData.value[0].enr_curriculum
            getCurriculumSubject(curr).then((results) => {
                currSubject.value = results

                // para to dun sa required subjects list ng milestones page
                milestoneSubject.value = currSubject.value.filter(e => {
                    if(
                        (e.currtag_gradelvl == enrolleeData.value[0].enr_gradelvl)&&
                        (e.currtag_sem == enrolleeData.value[0].enr_quarter)
                        ){
                        return e
                    }
                })
                // ginamit naten yung filtered by grade lvl and sem type para tama mag reflect sa list ng curriculum current subjects
                milestoneSubject.value.forEach( (e) =>{
                    addedSubject.value.push(e)
                    addedSubjectId.value.push(e.subj_id)
                })

                getMilestone(studentData.value.enr_id).then((results) => {
                    milestone.value = results
                    preloading.value = false
                })

                
            })
        })

        
        
  
   }catch(err) {
        alert('error loading the list default components')
   }
})

const loadCurrItems = ref(false)
const monitorCurriculum = (data) =>{
    loadCurrItems.value = true
    currSubject.value=[]
    addedSubject.value=[]
    addedSubjectId.value=[]
    getCurriculumSubject(data).then(async (results) => {
        currSubject.value = results
        currSubject.value = currSubject.value.filter(e => {
        if(
                (e.currtag_gradelvl == studentData.value.enr_gradelvl)&&
                (e.currtag_sem == studentData.value.enr_quarter)
            ){
            return e
        }
        })
       
        for await (const e of currSubject.value) {
            addedSubject.value.push(e)
        };

        loadCurrItems.value = false
    })
}

const searchSubject = ref('')
const filteredSubject = ()=>{
    subjectFilter.value = subjectData.value.filter(e => {
      if(
            (e.subj_code.toUpperCase().includes(searchSubject.value.toUpperCase()))||
            (e.subj_name.toUpperCase().includes(searchSubject.value.toUpperCase()))
        ){
          return e
      }
    })
    
}

const addedSubject = ref([])
const addedSubjectId = ref([])
const addSubject = (data) =>{
    let exist = addedSubject.value.filter(e => {
      if(e.subj_id == data.subj_id){
          return e
      }
    })

    Object.keys(exist).length? alert('Already Included'):addedSubject.value.push(data)
    Object.keys(exist).length? false:addedSubjectId.value.push(data.subj_id)
    console.log(addedSubject.value)
    
}
const removeSubject = (index) =>{
    addedSubject.value.splice(index,1)
    addedSubjectId.value.splice(index,1)
}

const showMilestone = ref(false)

const setData = (type, data) =>{
    switch(type){
        case 'curriculum':
            monitorCurriculum(data)
            enr_curriculum.value = data
            break;
        case 'section':
            enr_section.value = data
            break;
    }
}

const saving = ref(false)
const saveData = async() =>{
    saving.value = true
    addedSubject.value = addedSubject.value.map(itemObj => {
            return {
            ...itemObj,
            enr_id:studentData.value.enr_id,
            user_id:userID.value,
            mi_tag: itemObj.mi_tag? itemObj.mi_tag:'',
            mi_crossenr: itemObj.mi_crossenr? itemObj.mi_crossenr:''
        }
    })

    // let counter = 0
    // addedSubject.value.forEach(async (e) => {
    //     addMilestone(e).then((results) => {
    //         counter+=1
    //         counter==Object.keys(addedSubject.value).length? saving.value = false:saving.value = true
    //     })
    // })
    
    let counter = 0
    let x = {
        ...studentData.value,
        enr_updatedby: userID.value,
        enr_section: enr_section.value,
        enr_curriculum: enr_curriculum.value
    }

    for await (const e of addedSubject.value) {
        counter+=1
        addMilestone(e).then((results) => {})
    }
    if(counter==Object.keys(addedSubject.value).length){
        updateEnrollment(x).then((results) => {
            alert('Tagging Successful')
            // router.replace({ name: 'Academics', params: { id: 2}});
            location.reload()
            saving.value = false
        })
    }
    
    
}


const deleteSubject =(id, index) =>{
    let x = {
        mi_id : id,
        mi_status : 0,
        mi_updatedby : userID.value
    }
    updateMilestone(x).then((results) => {
        alert('Delete Successful')
        milestone.value.splice(index, 1)
    })
}
</script>


<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center" data-modal-backdrop="static">
        <div v-if="!showMilestone" class="p-7 bg-white rounded-md flex flex-col w-5/6">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">Tagging</p>   
                    <button type="button" @click="close" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>

            <Loader v-if="!Object.keys(currSubject).length && preloading">
                <p class="text-xs"> loading Data Please Wait...</p>
            </Loader>
            <div v-else class="flex flex-col gap-2 overflow-auto" style="height: 32rem;">


                <div class="border flex flex-col sm:flex-row gap-2 p-2 items-center bg-gray-100">
                    <div class="sm:basis-1/4 w-full h-full p-2 gap-2 flex flex-col justify-center items-center">
                        <img :src="studentData.per_profile? 'http://localhost:8000/storage/profiles/'+studentData.per_profile:'/img/profile_default.png'" class="h-40 w-40 object-fit border-2 border-gray-300"/>
                        <button type="button" @click="showMilestone = !showMilestone" class="mb-2 bg-teal-500 hover:bg-teal-400 px-3 py-2 rounded-md font-semibold text-white text-xs">View Miltestones</button>  
                    </div>
                    
                    <div class="sm:basis-3/4 w-full h-full p-2 gap-2">

                        <div class="border rounded-md border-gray-400 relative p-5 ">
                            <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-gray-100 px-2">Primary Information</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="flex flex-col gap-1 h-full col-span-2">
                                    <p class="text-xs">Full Name</p> 
                                    <input type="text" v-model="fullName" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full col-span-2 sm:col-span-1">
                                    <p class="text-xs">Contact Number</p> 
                                    <input type="text" v-model="contactNumber" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full col-span-2 sm:col-span-1">
                                    <p class="text-xs">Email</p> 
                                    <input type="text" v-model="email" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                            </div>
                        </div>

                        <div class="border rounded-md border-gray-400 relative p-5 mt-4">
                            <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-gray-100 px-2">Enrollment Information</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Program</p> 
                                    <input type="text" v-model="programDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Course</p> 
                                    <input type="text" v-model="courseDesc" disabled
                                                        class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Grade Level</p> 
                                    <input type="text" v-model="gradelvlDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Quarter / Semester</p> 
                                    <input type="text" v-model="quarterDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                
                            </div>
                        </div>
                        
                    </div>
                
                </div>

                <div class="flex flex-col sm:flex-row items-start ">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="border p-3 bg-emerald-500 text-white">
                            <p class="text-xs font-semibold">Current Academic Track Settings</p>
                        </div>
                        <div class="border flex flex-col items-center">
                            <div class="w-full border flex justify-evenly items-center gap-2 p-2">
                                <div class="flex flex-col gap-1 w-full">
                                    <p class="text-xs">Curriculum</p>
                                    <input class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                            placeholder="Search Curriculum Here..."/>
                                    <div class="w-full border flex flex-col shadow-sm h-40 bg-white z-10 overflow-auto">
                                        <div v-if="!Object.keys(curriculumData).length" class="border-0 border-b p-2">
                                            <p class="text-xs">No Data Found</p>
                                        </div>
                                        <div @click="setData('curriculum', c.curr_id)" v-else v-for="(c, index) in curriculumData" 
                                            :class="enr_curriculum == c.curr_id? 
                                            'border-0 border-b p-2 hover:bg-gray-200 cursor-pointer bg-gray-300':
                                            'border-0 border-b p-2 hover:bg-gray-200 cursor-pointer'" 
                                            title="set as active">
                                            <p class="text-xs">{{ c.curr_code }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 w-full">
                                    <p class="text-xs">Section</p>
                                    <input class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                            placeholder="Search Section Here..."/>
                                    <div class="w-full border flex flex-col shadow-sm h-40 bg-white z-10 overflow-auto">
                                        <div v-if="!Object.keys(sectionData).length" class="border-0 border-b p-2">
                                            <p class="text-xs">No Data Found</p>
                                        </div>
                                        <div @click="setData('section', s.sec_id)" v-else v-for="(s, index) in sectionData" 
                                            :class="enr_section == s.sec_id? 
                                                'border-0 border-b p-2 hover:bg-gray-200 cursor-pointer bg-gray-300':
                                                'border-0 border-b p-2 hover:bg-gray-200 cursor-pointer'"
                                                title="set as active">
                                            <p class="text-xs">{{ s.sec_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 w-full">
                                    <p class="text-xs">Type</p>
                                    <input class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                            placeholder="Search Type Here..."/>
                                    <div class="w-full border flex flex-col shadow-sm h-40 bg-white z-10 overflow-auto">
                                        <div class="border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs">Regular</p>
                                        </div>
                                        <div class="border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs">Irregular</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1 w-full">
                                    <p class="text-xs">Relevant</p>
                                    <div class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed ">
                                        <p class="text-xs">ID #: {{ studentData.per_id }}</p>
                                    </div>
                                    <div class="w-full border flex flex-col shadow-sm h-40 bg-white z-10 overflow-auto">
                                        <div class="flex justify-between border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs font-semibold">Prelims</p>
                                            <p class="text-xs">Not Taken</p>
                                        </div>
                                        <div class="flex justify-between border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs font-semibold">Midterm</p>
                                            <p class="text-xs">Not Taken</p>
                                        </div>
                                        <div class="flex justify-between border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs font-semibold">Finals</p>
                                            <p class="text-xs">Not Taken</p>
                                        </div>
                                        <div class="flex justify-between border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                            <p class="text-xs font-semibold">Payment</p>
                                            <p class="text-xs text-red-500 font-extrabold">0%</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-start gap-2">
                    <div class="flex flex-col gap-2 w-1/3">
                        <div class="border p-3 bg-emerald-500 text-white">
                            <p class="text-xs font-semibold">Add Custom Subjects</p>
                        </div>
                        <div class="p-3 flex flex-col items-center gap-2">
                            <input v-model="searchSubject" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                    @keyup="filteredSubject" placeholder="Search Subjects Here..."/>
                            <div class="w-full border flex flex-col shadow-sm h-40 bg-white overflow-auto">
                                <div v-if="!Object.keys(subjectFilter).length" class="text-center flex flex-col gap-2 border-0 border-b p-2 hover:bg-gray-100 cursor-pointer" title="set as active">
                                    <p class="text-xs">No Item Found</p>
                                </div>
                                <div v-else v-for="(s, index) in subjectFilter" 
                                    @click="addSubject(s)"
                                    :class="
                                        addedSubjectId.includes(s.subj_id)? 'flex flex-col gap-2 border-0 bg-gray-300 border-b p-2 hover:bg-gray-200 cursor-pointer':
                                        'flex flex-col gap-2 border-0 border-b p-2  hover:bg-gray-300 cursor-pointer'"
                                     title="click to add in subject list">
                                    <p class="text-xs font-semibold">{{ s.subj_code }}</p>
                                    <p class="text-xs">{{ s.subj_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 w-3/4">
                        <div class="border p-3 bg-emerald-500 text-white">
                            <p class="text-xs font-semibold">Subjects and Units Applied</p>
                        </div>
                        <div class="flex flex-col items-center h-56 overflow-auto">
                            <div v-if="!Object.keys(addedSubject).length && !loadCurrItems" class="w-full border-0 border-b flex justify-evenly items-center gap-2 p-2">
                                <div class="p-2 flex flex-col gap-2 w-full text-center">
                                    <p class="text-xs font-semibold">No Subjects Added</p> 
                                </div>
                            </div>
                            <div v-if="!Object.keys(addedSubject).length && loadCurrItems" class="w-full border-0 border-b flex justify-evenly items-center gap-2 p-2">
                                <div class="p-2 flex flex-col gap-2 w-full text-center">
                                    <p class="text-xs font-semibold">Loading Items Please Wait...</p> 
                                </div>
                            </div>
                            <div v-if="Object.keys(addedSubject).length && !loadCurrItems" v-for="(a, index) in addedSubject" class="w-full border-0 border-b flex justify-evenly items-center gap-2 p-2">
                                <div class="p-2 flex flex-col gap-2 w-full">
                                    <p class="text-xs font-semibold">{{ a.subj_code }}</p>
                                    <p class="text-xs">{{ a.subj_name }}</p>
                                </div>
                                <div class=" w-full ">
                                    <div class="flex gap-1">
                                        <div>
                                            <p class="text-xs">Lecture Units</p>
                                            <input v-model="a.currtag_lec" type="number" class="mb-2 pointer-events-none w-full border border-gray-300 p-2 text-xs bg-gray-50 cursor-not-allowed "/>
                                        </div>
                                        <div>
                                            <p class="text-xs">laboratory Units</p>
                                            <input v-model="a.currtag_lab" type="number" class="pointer-events-none w-full border border-gray-300 p-2 text-xs bg-gray-50 cursor-not-allowed "/>
                                        </div>  
                                    </div>
                                    <div>
                                        <p class="text-xs">Total Units / Hours</p>
                                        <input :value="a.currtag_lab + a.currtag_lec" type="number" class="pointer-events-none w-full border border-gray-300 p-2 text-xs bg-gray-50 cursor-not-allowed "/>
                                    </div>  
                                </div>
                                <div class=" w-full">
                                    <p class="text-xs">Cross Enrolled (School)</p> 
                                    <input type="text" v-model="addedSubject[index].mi_crossenr" class="mb-2 w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed "/>
                                    
                                    <p class="text-xs">Subject Completion</p> 
                                    <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                            v-model="addedSubject[index].mi_tag" title="Click Edit to modify details" >
                                        <option value="" >-- Select Type --</option>
                                        <option :value="1">Already Taken</option>
                                        <option :value="2">Advance</option>
                                        <option :value="3">Re-take / Back Subject</option>
                                    </select>
                                </div>
                                <div class=" w-1/4 flex justify-center items-center">
                                    <button @click="removeSubject(index)" type="button" class=" bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-start gap-2">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="border p-1 bg-gray-100 flex justify-between items-center gap-3">
                            <p class="text-xs italic ml-2">Note: Ensure that the information encoded here are correct and validations based on the actual data of the student to avoid records mismatch.</p>   
                            <button @click="saveData()" :disabled="saving || !Object.keys(addedSubject).length? true:false" type="button" class=" bg-emerald-500 hover:bg-emerald-400 px-4 py-2 text-xs rounded-sm text-white disabled:bg-emerald-300 disabled:cursor-not-allowed">Save Taggings</button> 
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div v-else class="p-7 bg-white rounded-md flex flex-col w-5/6">
            <div class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                    <p class="mb-2 text-md font-semibold">Tagging</p>   
                    <button type="button" @click="close" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
            </div>

            <div class="flex flex-col gap-2 overflow-auto" style="height: 32rem;">
                <div class="border flex flex-col sm:flex-row gap-2 p-2 items-center bg-gray-100">
                    <div class="sm:basis-1/4 w-full h-full p-2 gap-2 flex flex-col justify-center items-center">
                        <img :src="studentData.per_profile? 'http://localhost:8000/storage/profiles/'+studentData.per_profile:'/img/profile_default.png'" class="h-40 w-40 object-fit border-2 border-gray-300"/>
                        <button type="button" @click="showMilestone = !showMilestone" class="mb-2 bg-yellow-500 hover:bg-yellow-400 px-3 py-2 rounded-md font-semibold text-white text-xs">View Current Status</button>  
                    </div>
                    
                    <div class="sm:basis-3/4 w-full h-full p-2 gap-2">

                        <div class="border rounded-md border-gray-400 relative p-5 ">
                            <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-gray-100 px-2">Primary Information</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="flex flex-col gap-1 h-full col-span-2">
                                    <p class="text-xs">Full Name</p> 
                                    <input type="text" v-model="fullName" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full col-span-2 sm:col-span-1">
                                    <p class="text-xs">Contact Number</p> 
                                    <input type="text" v-model="contactNumber" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full col-span-2 sm:col-span-1">
                                    <p class="text-xs">Email</p> 
                                    <input type="text" v-model="email" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                            </div>
                        </div>

                        <div class="border rounded-md border-gray-400 relative p-5 mt-4">
                            <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-gray-100 px-2">Enrollment Information</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Program</p> 
                                    <input type="text" v-model="programDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Course</p> 
                                    <input type="text" v-model="courseDesc" disabled
                                                        class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Grade Level</p> 
                                    <input type="text" v-model="gradelvlDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                <div class="flex flex-col gap-1 h-full">
                                    <p class="text-xs">Quarter / Semester</p> 
                                    <input type="text" v-model="quarterDesc" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                                </div> 
                                
                            </div>
                        </div>
                        
                    </div>
                
                </div>

                <div class="flex flex-col sm:flex-row items-start ">
                    <div class="flex flex-col gap-2 w-full">
                        <div class="border p-3 bg-emerald-500 text-white">
                            <p class="text-xs font-semibold">Course Tracking</p>
                        </div>
                        <div class="border flex flex-col items-center">
                            <div class="w-full flex flex-col items-start">
                                <div class="flex flex-col gap-1 w-full">
                                    <div v-for="(e, index) in enrolleeData" class="w-full border grid grid-cols-3 shadow-sm bg-white">
                                        <div class="border-0 border-b p-2 col-span-3 bg-gray-200 font-semibold">
                                            <p class="text-xs">Primary Details</p>
                                        </div>
                                        <div class="border-0 border-b p-2">
                                            <p class="text-xs">{{ e.prog_name }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2" title="set as active">
                                            <p class="text-xs"><span class="font-semibold">Enrolled: </span> {{ e.enr_dateenrolled }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2" title="set as active">
                                            <p class="text-xs"><span class="font-semibold">Grade Level: </span> {{ e.grad_name }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2" title="set as active">
                                            <p class="text-xs"><span class="font-semibold">Quarter: </span> {{ e.quar_desc }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2" title="set as active">
                                            <p class="text-xs"><span class="font-semibold">Curriculum Code: </span> {{ e.curr_code? e.curr_code:'N/A' }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2" title="set as active">
                                            <p class="text-xs"><span class="font-semibold">Section: </span> {{ e.sec_name? e.sec_name:'N/A' }}</p>
                                        </div>
                                        <div class="border-0 border-b p-2 col-span-3 bg-gray-200 font-semibold">
                                                <p class="text-xs">Required Subjects</p>
                                        </div>
                                        <div class="col-span-3">
                                            <table class="border w-full">
                                                <thead class="bg-gray-900 text-white text-xs">
                                                    <th class="p-2">Subject</th>
                                                    <th class="p-2">Units</th>
                                                    <th class="p-2">Hours Per Week</th>
                                                    <th class="p-2">Tags</th>
                                                    <th class="p-2">Pre-requisites</th>
                                                    <th class="p-2">Grade</th>
                                                    <th class="p-2">Action</th>
                                                </thead>
                                                <tbody>
                                                    <tr v-if="!Object.keys(milestone).length">
                                                        <td colspan="6" class="p-2 border border-gray-200"><p class="text-xs">No Data Found</p></td>
                                                    </tr>
                                                    <tr v-else v-for="(c, index) in milestone" class="border-0 border-b border-gray-200 hover:bg-gray-300 cursor-pointer">
                                                        <td class="p-2 border border-gray-200">
                                                            <span class="text-xs font-semibold">{{ c.subj_code }}</span>
                                                            <p class="text-xs">{{ c.subj_name }}</p> 
                                                            <p v-if="c.mi_crossenr" class="mt-3 text-xs italic">Cross Enrolled to: <span class=" text-red-500"> {{ c.mi_crossenr }}</span></p> 
                                                        </td>
                                                        <td class="p-2 border border-gray-200 flex gap-1">
                                                            <div class="flex flex-col gap-1 w-full justify-evenly">
                                                                <p class="text-xs">Lecture</p> 
                                                                <p class="text-xs">Laboratory</p> 
                                                                <p class="text-xs">Total</p> 
                                                            </div>
                                                            <div class="flex flex-col gap-1 w-full justify-evenly">
                                                                <input class="text-xs p-2 w-full border border-gray-300 cursor-not-allowed"  
                                                                        :value="c.subj_lec" disabled/>
                                                                <input class="text-xs p-2 w-full border border-gray-300 cursor-not-allowed"  
                                                                        :value="c.subj_lab" disabled/>
                                                                <input class="text-xs p-2 w-full border border-gray-300 cursor-not-allowed"  
                                                                        :value="c.subj_lec + c.subj_lab " disabled/>

                                                            </div>
                                                        </td>
                                                        <td class="p-2 border border-gray-200 text-center"><p class="text-xs">{{ c.subj_lab }}</p></td>
                                                        <td class="p-2 border border-gray-200 text-center">
                                                            <p v-if="c.mi_tag == 1" class="text-xs">Already Taken</p>
                                                            <p v-else-if="c.mi_tag == 2" class="text-xs">Advance</p>
                                                            <p v-else-if="c.mi_tag == 3" class="text-xs">Re-take / Back Subject</p>
                                                            <p v-else="c.mi_tag == 3" class="text-xs">N/A</p>
                                                        </td>
                                                        <td class="p-2 border border-gray-200 text-center"><p class="text-xs">{{ c.subj_preq? c.subj_preq:'N/A' }}</p></td>
                                                        <td class="p-2 border border-gray-200 text-center"><p class="text-xs">--</p></td>
                                                        <td class="p-2 border border-gray-200 text-center">
                                                            <button type="button" @click="deleteSubject(c.mi_id, index)" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button> 
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>