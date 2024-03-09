<script setup>
import { ref, onMounted, computed } from 'vue';
import {  getGender, getNationality, getCivilStatus, getRegion, getProvince, getCity, getBarangay, getApplicant, getQuarter } from "../../Academics/Applicants/ApplicantFunction.js";
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
import Loader from '../../snippets/loaders/Loading1.vue';
import ViewPage from './ViewPage.vue'

const preLoading = ref(false)
const editForm = ref(false)
const applicant = ref([])
const gender = ref([])
const nationality = ref([])
const region = ref([])
const city = ref([])
const province = ref([])
const barangay = ref([])
const civilstatus = ref([])
const quarter = ref([])

const booting = ref('')
const bootingCount = ref(0)
const booter = async() =>{

    getQuarter().then((results)=>{
        quarter.value = results
        booting.value = 'Loading Quarters...'
        bootingCount.value += 1
    })

    getGender().then((results)=>{
        gender.value = results
        booting.value = 'Loading Genders...'
        bootingCount.value += 1
    })

    getNationality().then((results)=>{
        nationality.value = results
        booting.value = 'Loading Nationalities...'
        bootingCount.value += 1
    })

    getRegion().then((results)=>{
        region.value = results
        booting.value = 'Loading Regions'
        bootingCount.value += 1
    })

    getCivilStatus().then((results)=>{
        civilstatus.value = results
        booting.value = 'Loading Civil Status...'
        bootingCount.value += 1
    })

    getProvince().then((results)=>{
        province.value = results
        booting.value = 'Loading Provinces...'
        bootingCount.value += 1
    })

    getCity().then((results)=>{
        city.value = results
        booting.value = 'Loading Cities...'
        bootingCount.value += 1
    })

    getBarangay().then((results)=>{
        barangay.value = results
        booting.value = 'Loading Barangays...'
        bootingCount.value += 1

    })

}
onMounted(async () => {
    try{
        preLoading.value = true
        await booter().then((results)=>{
            
            booting.value = 'Loading Applicants...'
            bootingCount.value += 1
            getApplicant().then((results)=>{
                applicant.value = results
                console.log(applicant.value )
                preLoading.value = false
            })
        })
       
        
   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
   
})


const save = () =>{
    console.log(currDetails.value)
}

const emit = defineEmits(['add-modal'])
const registerData = (data) =>{
    emit('add-modal', gender.value, nationality.value, region.value, civilstatus.value, province.value, city.value, barangay.value)
}

const viewDetails = ref(false)
const viewData = ref([])

</script>

<template>
    <div v-if="!viewDetails" class="w-full h-full">
        <div :class="!Object.keys(applicant).length && preLoading? 'relative cursor-wait':''">
            <div :class="!Object.keys(applicant).length && preLoading? 'pointer-events-none':'pointer-events-auto '">
                <SearchHeader headerTitle="Applicants" :searchData="''" @toggle-search="" @add-new="registerData"/>
            </div>
        </div>
        
        <div class="flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

                <NoDataFound v-if="!Object.keys(applicant).length && !preLoading"/>
                <Loader v-if="!Object.keys(applicant).length && preLoading">
                    <p class="text-xs"> {{ booting }} {{bootingCount}} out of 9</p>
                </Loader>

               
                <div v-if="Object.keys(applicant).length && !preLoading" class="p-3 flex flex-col gap-3">
                    <div class="basis-full grid grid-cols-1 sm:grid-cols-3 gap-2 mb-4">
                        <div class="flex flex-col gap-1">
                            <p class="text-xs">Quarter</p> 
                            <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                    title="Click Edit to modify details" >
                                <option value="" disabled>-- Select Quarter --</option>
                                <option v-for="(q, index) in quarter" :value="q.quar_id">{{ q.quar_desc }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-xs">Applicant Type</p> 
                            <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                    title="Click Edit to modify details" >
                                <option value="" disabled>-- Select Grade Level --</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-xs">Year</p> 
                            <input type="number" min="1900" max="2099" step="1" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                        </div>
                    </div>
                    <div class="border-0 border-b p-2 flex gap-1">
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs font-semibold">ID</p>
                        </div>
                        <div class="p-2 flex items-center basis-2/3">
                            <p class="text-xs font-semibold">Name</p>
                        </div>
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs font-semibold">Date Applied</p>
                        </div>
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs font-semibold">Options</p>
                        </div>
                    </div>
                    <div v-for="(a, index) in applicant" class="border-0 border-b p-2 flex gap-1">
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs font-semibold text-emerald-600">2223-A-0045</p>
                        </div>
                        <div class="p-2 flex items-center basis-2/3">
                            <p class="text-xs">{{ a.per_lastname }}, {{ a.per_firstname }} {{ a.per_middlename }} {{ a.per_suffixname }}</p> 
                        </div>
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs">{{ a.per_dateapplied }}</p>
                        </div>
                        <div class="p-2 flex items-center basis-1/3">
                            <p class="text-xs font-semibold text-cyan-500 hover:text-cyan-400 cursor-pointer" @click="viewDetails = true, viewData = a">view details &#8594;</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div v-else>
        <ViewPage :personData="viewData" @back-to-list="viewDetails = false"
                  :genderData="gender"
                  :civilstatusData="civilstatus"
                  :nationalityData="nationality"
                  :regionData="region"
                  :provinceData="province"
                  :cityData="city"
                  :barangayData="barangay"/>
    </div>
    
</template>
