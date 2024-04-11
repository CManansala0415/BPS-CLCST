<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router'

import Programs from './Programs/Programs.vue';
import Sections from './Sections/Sections.vue';
import YearLevels from './YearLevels/YearLevels.vue';
import Classrooms from './Classrooms/Classrooms.vue';
import Subjects from './Subjects/Subjects.vue';
import Faculties from './Faculties/Faculties.vue';
import Departments from './Departments/Departments.vue';
import Courses from './Courses/Courses.vue';
import Curriculum from './Curriculum/Curriculum.vue';
import AddNewProgram from '../snippets/modals/RegFormProgram.vue';
import AddNewSection from '../snippets/modals/RegFormSection.vue';
import AddNewYearLevel from '../snippets/modals/RegFormYearLevel.vue';
import AddNewClassroom from '../snippets/modals/RegFormClassroom.vue';
import AddNewSubject from '../snippets/modals/RegFormSubject.vue';
import AddNewDepartment from '../snippets/modals/RegFormDepartment.vue';
import AddNewCurriculum from '../snippets/modals/RegFormCurriculum.vue';
import AddNewApplicant from '../snippets/modals/RegFormApplicant.vue';
import Enrollment from '../snippets/modals/Enrollment.vue';
import Applicant from './Applicants/ApplicantForm.vue';

import PrintForms from '../snippets/modals/PrintForms.vue';
import Taggings from '../snippets/modals/Taggings.vue';
import Students from './Students/Students.vue';


const def_class = ref("flex items-center w-full rounded-lg cursor-pointer hover:bg-emerald-400 hover:text-gray-100 p-2");
const active_class = ref("flex items-center w-full rounded-lg cursor-pointer bg-emerald-600 hover:bg-emerald-500 text-gray-100 p-2");
const content = ref(1)
const modal = ref(false)

// for courses
const co_prog = ref([])
const co_deg = ref([])
const co_sem = ref([])

//for classrooms
const cl_rms = ref([])
const cl_buil = ref([])

//for curriculum
const cu_prog = ref([])
const cu_grdlvl = ref([])
const cu_quar = ref([])
const cu_cour = ref([])

// for adding new applicant modal defaults
const genderData = ref([])
const nationalityData = ref([])
const regionData = ref([])
const cityData = ref([])
const provinceData = ref([])
const barangayData = ref([])
const civilstatusData = ref([])

const route = useRoute();  
onMounted(async () => {
   // console.log(route.params.id)
})

const showModal = (co_1, co_2, co_3, cl_1, cl_2, cu_1, cu_2, cu_3, cu_4 )=>{
   modal.value = !modal.value

   // for courses
   co_prog.value = co_1
   co_deg.value = co_2
   co_sem.value = co_3

   //for classrooms
   cl_rms.value = cl_1
   cl_buil.value = cl_2

   //for curriculum
   cu_prog.value = cu_1
   cu_grdlvl.value = cu_2
   cu_quar.value = cu_3
   cu_cour.value = cu_4
}

const showApplicantModal = (gender, nationality, region, civilstatus, province, city, barangay)=>{

   modal.value = !modal.value

   genderData.value =  gender
   nationalityData.value =  nationality
   regionData.value =  region
   cityData.value =  city
   provinceData.value =  province
   barangayData.value =  barangay
   civilstatusData.value =  civilstatus

}

const enroll = ref(false)
const personData = ref([])
const personAttainment = ref([])
const showEnrollmentModal = (data, attainment)=>{

   modal.value = !modal.value
   personData.value=data
   personAttainment.value=attainment
   enroll.value = !enroll.value

}

const setPage = (page) =>{
   if(page==content.value){
      console.log('')
   }else{
      window.stop() // stop request
      content.value = page
   }
}


// student module, print forms
const studentData = ref([])
const studentInfo = ref([])
const curriculum = ref([])
const section = ref([])
const subject = ref([])
const printForm = ref(false)
const taggingForm = ref(false)

const showPrintFormModal = (data) =>{
   studentData.value = data
   printForm.value = !printForm.value
}
// student module, taggings
const showTaggingsModal = (data, info, currData, secData, subjData) =>{
   studentData.value = data // personal
   studentInfo.value = info // academics, desc nung mga program, course etc
   taggingForm.value = !taggingForm.value
   curriculum.value = currData
   section.value = secData
   subject.value = subjData
   
}

</script>
<template>
   <div class="flex flex-col w-full h-full">
      <!-- applicant module -->
      <Transition name="slide-fade" mode="out-in">
         <AddNewApplicant v-if="modal && content == 1 && !enroll" @close-modal="showApplicantModal"
                                 :genderprop="genderData"
                                 :nationalityprop="nationalityData"
                                 :regionprop="regionData"
                                 :cityprop="cityData"
                                 :provinceprop="provinceData"
                                 :barangayprop="barangayData"
                                 :civilstatusprop="civilstatusData"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <Enrollment v-if="modal && content == 1 && enroll" @close-modal="showEnrollmentModal" :data="personData" :attainment="personAttainment"/>
      </Transition>
      <!-- applicant module -->

      <!-- student module -->
      <Transition name="slide-fade" mode="out-in">
         <PrintForms v-if="printForm && content == 10" @close-modal="showPrintFormModal" :students="studentData"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <Taggings v-if="taggingForm && content == 10" @close-modal="showTaggingsModal" 
                                                       :students="studentData" 
                                                       :descriptions="studentInfo"
                                                       :curriculum="curriculum"
                                                       :section="section"
                                                       :subject="subject"/>
      </Transition>
      <!-- student module -->

      <Transition name="slide-fade" mode="out-in">
         <AddNewProgram v-if="modal && content == 2" :program="co_prog" :degree="co_deg" :semester="co_sem" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewSection v-if="modal && content == 3" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewYearLevel v-if="modal && content == 4" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewClassroom v-if="modal && content == 5" :roomtypes="cl_rms" :building="cl_buil" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewSubject v-if="modal && content == 6" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewDepartment v-if="modal && content == 7" @close-modal="showModal"/>
      </Transition>
      <Transition name="slide-fade" mode="out-in">
         <AddNewCurriculum v-if="modal && content == 8" :program="cu_prog" :gradelvl="cu_grdlvl" :quarter="cu_quar" :course="cu_cour" @close-modal="showModal"/>
      </Transition>
      

      <div class="h-28"></div>
      <div class="flex gap-2 w-full h-full">
         
         <div class=" basis-3/12 hidden sm:flex flex-col gap-2 p-5">
            <div class="mt-5">
               <h3 class="text-md font-semibold">Selection</h3>
            </div>
            <div class="flex flex-col gap-2 p-1">
               <div :class="content == 1? active_class:def_class" @click="setPage(1)">
                  <p class="text-xs">Applicant</p>
               </div>
               <div :class="content == 10? active_class:def_class" @click="setPage(10)">
                  <p class="text-xs">Students</p>
               </div>
               <div :class="content == 2? active_class:def_class" @click="setPage(2)">
                  <p class="text-xs">Programs</p>
               </div>
               <div :class="content == 3? active_class:def_class" @click="setPage(3)">
                  <p class="text-xs">Section</p>
               </div>
               <div :class="content == 4? active_class:def_class" @click="setPage(4)">
                  <p class="text-xs">Grade Levels</p>
               </div>
               <div :class="content == 5? active_class:def_class" @click="setPage(5)">
                  <p class="text-xs">Classrooms</p>
               </div>
               <div :class="content == 6? active_class:def_class" @click="setPage(6)">
                  <p class="text-xs">Subjects</p>
               </div>
               <!-- <div :class="content == 6? active_class:def_class" @click="setPage(6)">
                  <p class="text-xs">Faculties</p>
               </div> -->
               <div :class="content == 7? active_class:def_class" @click="setPage(7)">
                  <p class="text-xs">Departments</p>
               </div>
               <div :class="content == 8? active_class:def_class" @click="setPage(8)">
                  <p class="text-xs">Curriculum</p>
               </div>
               
            </div>
           
         </div>
         <div class="basis-full border-x border-gray-300 flex flex-col gap-2 p-5">
            <div class="mt-5">
               <p class="text-sm font-light">Academic Component Settings</p>
            </div>
            <div class="w-full p-2">
                  <div v-if="content == 1">
                     <Applicant @add-modal="showApplicantModal" @enroll-modal="showEnrollmentModal"/>
                  </div>
                  <div v-if="content == 10">
                     <Students  @printform-modal="showPrintFormModal"
                                @taggings-modal="showTaggingsModal"/>
                  </div>
                  <div v-if="content == 2">
                     <!-- <Programs/> -->
                     <Courses @add-modal="showModal"/>
                  </div>
              
                  <div v-if="content == 3">
                     <Sections @add-modal="showModal"/>
                  </div>
          
                  <div v-if="content == 4">
                     <YearLevels @add-modal="showModal"/>
                  </div>
             
                  <div v-if="content == 5">
                     <Classrooms @add-modal="showModal"/>
                  </div>
             
                  <div v-if="content == 6">
                     <Subjects @add-modal="showModal"/>
                  </div>
                  <!-- <div v-if="content == 6">
                     <Faculties/>
                  </div> -->
                  <div v-if="content == 7">
                     <Departments @add-modal="showModal"/>
                  </div>
                  <div v-if="content == 8">
                     <Curriculum @add-modal="showModal"/>
                  </div>
                  
                  
            </div>
         </div>
         <div class=" basis-3/12 hidden md:flex flex-col gap-2 p-5">
            <div class="mt-5">
               <h3 class="text-md font-semibold">What's Here?</h3>
            </div>
            <div class="p-5">
               <ul class="list-disc">
                  <li><p class="text-xs">Register required components to be used for academe.</p></li>
                  <li><p class="text-xs">Update descriptions and correct the details needed.</p></li>
                  <li><p class="text-xs">Disable components as needed.</p></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</template>
<style>
.slide-fade-enter-active {
  transition: all 0.2s ease-in;
}

.slide-fade-leave-active {
  transition: all 0.3s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
}
</style>