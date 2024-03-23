<script setup>
import { ref, onMounted, computed } from 'vue';
import EditHeader from '../../snippets/headers/EditHeader.vue';
import BirthplaceAddress from '../../snippets/Address/BirthplaceAddress.vue';
import PresentAddress from '../../snippets/Address/PresentAddress.vue';
import PermanentAddress from '../../snippets/Address/PermanentAddress.vue';
import Loader from '../../snippets/loaders/MiniLoader1.vue';

import { getFamily, getAward, getAttainment, updateApplicant } from "../../Academics/Applicants/ApplicantFunction.js";
import { getUserID } from "../../../routes/user";

const props = defineProps({
    personData: {
    },
    genderData: {
    },
    nationalityData: {
    },
    civilstatusData: {
    },
    regionData: {
    },    
    provinceData: {
    },
    cityData: {
    },
    barangayData: {
    },
})

const person = computed(() => {
  return props.personData
});

const gender = computed(() => {
  return props.genderData
});

const nationality = computed(() => {
  return props.nationalityData
});

const civilstatus = computed(() => {
  return props.civilstatusData
});

const region = computed(() => {
  return props.regionData
});
const province = computed(() => {
  return props.provinceData
});
const city = computed(() => {
  return props.cityData
});
const barangay = computed(() => {
  return props.barangayData
});


const family = ref([])
const award = ref([])
const attainment = ref([])
const familyLoading = ref(false)
const awardLoading = ref(false)
const attainmentLoading = ref(false)
const userID = ref('')


onMounted(async () => {
    window.stop()

    try{
        familyLoading.value = true
        awardLoading.value = true
        attainmentLoading.value = true
        

        getFamily(person.value.per_famid).then((results)=>{
            family.value = results
            familyLoading.value = false
        })
        getAward(person.value.per_educid).then((results)=>{
            award.value = results
            awardLoading.value = false
        })
        getAttainment(person.value.per_attainmentid).then((results)=>{
            attainment.value = results
            attainmentLoading.value = false
        })

        getUserID().then((results) => {
            userID.value = results.data.id
        }).catch((err) => {
            router.push("/");
        })
        
        
   }catch(err) {
        familyLoading.value = false
        awardLoading.value = false
        attainmentLoading.value = false
   }

   
})


const emit = defineEmits(['back-to-list', 'enroll'])

const action = () =>{
    emit('enroll', person.value, attainment.value)
}
const returnPage = () =>{
    emit('back-to-list')
}


const setBirthPlace = (data) =>{
    person.value.per_birth_province = data.per_birth_province
    person.value.per_birth_city = data.per_birth_city
    person.value.per_birth_zipcode = data.per_birth_zipcode
}

const setPresentAddress= (data) =>{
    person.value.per_curr_home = data.per_curr_home
    person.value.per_curr_region = data.per_curr_region
    person.value.per_curr_province = data.per_curr_province
    person.value.per_curr_city = data.per_curr_city
    person.value.per_curr_barangay = data.per_curr_barangay
    person.value.per_curr_zipcode = data.per_curr_zipcode
}

const setPermanentAddress= (data) =>{
    person.value.per_perm_home = data.per_perm_home
    person.value.per_perm_region = data.per_perm_region
    person.value.per_perm_province = data.per_perm_province
    person.value.per_perm_city = data.per_perm_city
    person.value.per_perm_barangay = data.per_perm_barangay
    person.value.per_perm_zipcode = data.per_perm_zipcode
}

const copyAddress = () =>{
    person.value.per_perm_home = person.value.per_curr_home
    person.value.per_perm_region = person.value.per_curr_region
    person.value.per_perm_province = person.value.per_curr_province
    person.value.per_perm_city = person.value.per_curr_city
    person.value.per_perm_barangay = person.value.per_curr_barangay
    person.value.per_perm_zipcode = person.value.per_curr_zipcode
    console.log(person.value)
}


const updatePerson = () =>{
    
    let pers = {
            ...person.value,
            per_user: userID.value
    }
    updateApplicant(pers, 1).then((results)=>{
        alert('Update Successful')
        location.reload()
    })

}

const deletePerson = () =>{
    
    let pers = {
            per_id: person.value.per_id,
            per_user: userID.value
    }

    updateApplicant(pers, 2).then((results)=>{
        alert('Delete Successful')
        location.reload()
    })

}



</script>

<template>
    <div class="w-full h-full">
        <div :class="!Object.keys(person).length && preLoading? 'relative cursor-wait':''">
            <div :class="!Object.keys(person).length && preLoading? 'pointer-events-none':'pointer-events-auto '">
                <EditHeader headerTitle="Registry" @return="returnPage"/>
            </div>
        </div>

        <form  @submit.prevent="updatePerson">
        <div class="flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">
                
                <!-- personal details -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Primary Information</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">First Name
                                    <span v-if="!person.per_firstname.length" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="text" v-model="person.per_firstname" 
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Middle Name</p> 
                                <input type="text" v-model="person.per_middlename" 
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed "/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Last Name
                                    <span v-if="!person.per_lastname.length" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="text" v-model="person.per_lastname" 
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Suffix Name</p> 
                                <input type="text" v-model="person.per_suffixname" 
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                maxlength="3"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed "/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Contact Number
                                    <span v-if="!person.per_contact" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span> 
                                </p> 
                                <input type="number" v-model="person.per_contact" 
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Email Address
                                    <span v-if="!person.per_email" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="email" v-model="person.per_email" 
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            
                        </div>
                    </div>
                </div>
               

                <!-- personal details -->

                <!-- birth details -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Birth Information</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Birthday
                                    <span v-if="!person.per_birthday" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="date" v-model="person.per_birthday"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div>
                            <BirthplaceAddress  :provinceData="province" :cityData="city" :bdayProvince="person.per_birth_province" :bdayCity="person.per_birth_city" @birthplace="setBirthPlace"/>
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Civil Status
                                    <span v-if="!person.per_civilstatus" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <select v-model="person.per_civilstatus" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        title="Click Edit to modify details" >
                                    <option value="" disabled>-- Select Civil Status --</option>
                                    <option v-for="(c, index) in civilstatus" :value="c.cv_id">{{ c.cv_desc }}</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Gender
                                    <span v-if="!person.per_gender" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <select v-model="person.per_gender" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        title="Click Edit to modify details" >
                                    <option value="" disabled>-- Select Gender --</option>
                                    <option v-for="(g, index) in gender" :value="g.gen_id" >{{ g.gen_desc }}</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Nationality
                                    <span v-if="!person.per_nationality" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <select v-model="person.per_nationality" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                        title="Click Edit to modify details" >
                                    <option value="" disabled>-- Select Nationality --</option>
                                    <option v-for="(n, index) in nationality" :value="n.nat_id" >{{ n.nat_desc }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- birth details -->

                <!-- present address -->
                <div class="py-3">
                    
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Present Address</p>
                        <PresentAddress :regionData="region" 
                                        :provinceData="province" 
                                        :cityData="city" 
                                        :barangayData="barangay" 
                                        
                                        :presentHome="person.per_curr_home"
                                        :presentRegion="person.per_curr_region"
                                        :presentProvince="person.per_curr_province"
                                        :presentCity="person.per_curr_city"
                                        :presentBarangay="person.per_curr_barangay"
                                        @present-address="setPresentAddress"/>
                    </div>
                </div>
                <!-- present address -->
                <!-- permanent address -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Permanent Address 
                            <input type="checkbox" class="border border-gray-400 ml-2" @click="copyAddress()"/></p>
                        <PermanentAddress :regionData="region" 
                                          :provinceData="province" 
                                          :cityData="city" 
                                          :barangayData="barangay"
                                          
                                          :permanentHome="person.per_perm_home"
                                          :permanentRegion="person.per_perm_region"
                                          :permanentProvince="person.per_perm_province"
                                          :permanentCity="person.per_perm_city"
                                          :permanentBarangay="person.per_perm_barangay"
                                          @permanent-address="setPermanentAddress"/>
                    </div>
                </div>
                

                
                <!-- permanent address -->

                <!-- family members -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Family Table</p>
                        <div class="flex flex-col gap-2 ">

                            <Loader v-if="!Object.keys(family).length && familyLoading">
                                <p class="text-xs">Loading Family Members</p>
                            </Loader>
                            
                            <div v-else-if="!Object.keys(family).length" class="text-center">
                                <p class="text-sm font-bold text-red-600">Empty List</p>
                                <p class="text-xs">No Family Members Added</p>
                            </div>

                            <div v-else v-for="(f, index) in family" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                                <div class=" p-3 flex flex-col h-full">
                                    <p class="text-xs">Name:</p>
                                    <span class="text-xs italic font-semibold">{{ f.fam_firstname }} {{ f.fam_middlename }}, {{ f.fam_lastname }} {{ f.fam_suffixname }}</span>
                                </div>
                                <div class=" p-3 flex flex-col h-full">
                                    <p class="text-xs">Relationship:</p>
                                    <span class="text-xs italic font-semibold">{{ f.fam_relationship }}</span>
                                </div>
                                <div class=" p-3 flex flex-col h-full">
                                    <p class="text-xs">Contacts:</p>
                                    <span class="text-xs italic font-semibold">{{ f.fam_contact }} : {{ f.fam_email }}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- family members -->

                <!-- awards -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Awards Table</p>
                        <div class="flex flex-col gap-2">
                            <Loader v-if="!Object.keys(award).length && familyLoading">
                                <p class="text-xs">Loading Awards</p>
                            </Loader>
                            <div v-else-if="!Object.keys(award).length" class="text-center">
                                <p class="text-sm font-bold text-red-600">Empty List</p>
                                <p class="text-xs">No Award Added</p>
                            </div>
                            <div v-else v-for="(a, index) in award" class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-7 gap-3">
                                <div class=" col-span-3 p-3 flex flex-col h-full">
                                    <p class="text-xs">Recognition: </p>
                                    <span class="text-xs italic font-semibold">{{ a.awr_desc }} </span>
                                </div>
                                <div class=" col-span-3 p-3 flex flex-col h-full">
                                    <p class="text-xs">Year Received:</p>
                                    <span class="text-xs italic font-semibold">{{ a.awr_year }}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- awards -->

                <!-- educational Attainment -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Educational Attainment Table</p>
                        <div class="flex flex-col gap-2">
                            <Loader v-if="!Object.keys(attainment).length && familyLoading">
                                <p class="text-xs">Loading Educationl Attainment</p>
                            </Loader>
                            <div v-else-if="!Object.keys(attainment).length" class="text-center">
                                <p class="text-sm font-bold text-red-600">Empty List</p>
                                <p class="text-xs">No Educational Attainment Added</p>
                            </div>
                            <div v-else v-for="(a, index) in attainment" class="grid grid-cols-1 md:grid-cols-5 gap-3">
                                <div class=" md:col-span-2 p-3 flex flex-col h-full">
                                    <p class="text-xs">School: </p>
                                    <span class="text-xs italic font-semibold">{{ a.pered_school }} </span>
                                </div>
                                <div class=" p-3 flex flex-col h-full">
                                    <p class="text-xs">Year From:</p>
                                    <span class="text-xs italic font-semibold">{{ a.pered_from }}</span>
                                </div>
                                <div class=" p-3 flex flex-col h-full">
                                    <p class="text-xs">Year To:</p>
                                    <span class="text-xs italic font-semibold">{{ a.pered_to }}</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- Educational Attainment -->

                <div v-if=" !familyLoading &&
                            !awardLoading &&
                            !attainmentLoading" class="py-3 grid grid-cols-1 md:grid-cols-3 justify-end gap-2">
                    <button  @click="deletePerson" type="button" class="disabled:bg-red-300 bg-red-500 px-4 py-2 text-xs text-white rounded-md hover:bg-red-400"><i class="fa-solid fa-ban mr-2"></i>Remove Applicant</button>
                    <button  type="submit"  class="disabled:bg-teal-300 bg-teal-500 px-4 py-2 text-xs text-white rounded-md hover:bg-teal-400"><i class="fa-solid fa-wrench mr-2"></i>Update Applicant</button>
                    <button  @click="action" type="button" class="disabled:bg-emerald-300 bg-emerald-500 px-4 py-2 text-xs text-white rounded-md hover:bg-emerald-400"><i class="fa-solid fa-floppy-disk mr-2"></i>Enroll Applicant</button>
                </div>
                <div v-else class="py-3 grid grid-cols-1 md:grid-cols-3 justify-end gap-2">
                    <button type="button" class="mt-4 w-full p-2 bg-gray-200 shadow-md text-xs text-white rounded-md hover:bg-gray-300 cursor-wait">Checking Details</button>
                </div>

            </div>
        </div>
    </form>
        
    </div>
    
</template>
