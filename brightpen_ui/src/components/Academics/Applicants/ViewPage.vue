<script setup>
import { ref, onMounted, computed } from 'vue';
import EditHeader from '../../snippets/headers/EditHeader.vue';
import BirthplaceAddress from '../../snippets/Address/BirthplaceAddress.vue';
import PresentAddress from '../../snippets/Address/PresentAddress.vue';
import PermanentAddress from '../../snippets/Address/PermanentAddress.vue';
import { getFamily, getAward, getAttainment } from "../../Academics/Applicants/ApplicantFunction.js";
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

const update = () =>{
    alert('x')
}

const emit = defineEmits(['back-to-list']);
const returnPage = () =>{
    emit('back-to-list')
}

const family = ref([])
const award = ref([])
const attainment = ref([])
onMounted(async () => {
    try{
        await getFamily(person.value.per_famid).then((results)=>{
            family.value = results
        })
        await getAward(person.value.per_educid).then((results)=>{
            award.value = results
        })
        await getAttainment(person.value.per_attainmentid).then((results)=>{
            attainment.value = results
        })
        
        
   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
   
})

</script>

<template>
    <div class="w-full h-full">
        <div :class="!Object.keys(person).length && preLoading? 'relative cursor-wait':''">
            <div :class="!Object.keys(person).length && preLoading? 'pointer-events-none':'pointer-events-auto '">
                <EditHeader headerTitle="Registry" @update-data="update" @return="returnPage"/>
            </div>
        </div>
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
                                <input type="text" v-model="person.per_firstname" disabled
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Middle Name</p> 
                                <input type="text" v-model="person.per_middlename" disabled
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Last Name
                                    <span v-if="!person.per_lastname.length" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="text" v-model="person.per_lastname" disabled
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Suffix Name</p> 
                                <input type="text" v-model="person.per_suffixname" disabled
                                                onkeydown="return /[a-z, ]/i.test(event.key)"
                                                maxlength="3"
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Contact Number
                                    <span v-if="!person.per_contact" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span> 
                                </p> 
                                <input type="number" v-model="person.per_contact" disabled
                                                    class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div> 
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Email Address
                                    <span v-if="!person.per_email" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="email" v-model="person.per_email" disabled
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
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Birthday
                                    <span v-if="!person.per_birthday" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <input type="date" v-model="person.per_birthday" disabled
                                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                            </div>
                            <BirthplaceAddress  :provinceData="province" :cityData="city" :bdayProvince="person.per_birth_province" :bdayCity="person.per_birth_city"/>
                            <div class="flex flex-col gap-1 h-full">
                                <p class="text-xs">Civil Status
                                    <span v-if="!person.per_civilstatus" class="text-xs text-red-500">*</span>
                                    <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                                </p> 
                                <select v-model="person.per_civilstatus" disabled class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
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
                                <select v-model="person.per_gender" disabled class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
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
                                <select v-model="person.per_nationality" disabled class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
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
                                        :presentBarangay="person.per_curr_barangay"/>
                    </div>
                </div>
                <!-- present address -->

                <!-- permanent address -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Permanent Address</p>
                        <PermanentAddress :regionData="region" 
                                          :provinceData="province" 
                                          :cityData="city" 
                                          :barangayData="barangay"
                                          
                                          :permanentHome="person.per_perm_home"
                                          :permanentRegion="person.per_perm_region"
                                          :permanentProvince="person.per_perm_province"
                                          :permanentCity="person.per_perm_city"
                                          :permanentBarangay="person.per_perm_barangay"/>
                    </div>
                </div>
                <!-- permanent address -->

                <!-- family members -->
                <div class="py-3">
                    <div class="border rounded-md border-gray-400 relative p-5">
                        <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Family Table</p>
                        <div class="flex flex-col gap-2 ">
                            <div v-if="!Object.keys(family).length" class="text-center">
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
                            <div v-if="!Object.keys(award).length" class="text-center">
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
                            <div v-if="!Object.keys(attainment).length" class="text-center">
                                <p class="text-sm font-bold text-red-600">Empty List</p>
                                <p class="text-xs">No Award Added</p>
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

            </div>
        </div>
        
        
    </div>
    
</template>
