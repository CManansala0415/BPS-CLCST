<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    personData: {
    },  
    personAddress: {
    },  
    personFamily: {
    },
    personAward: {
    },
    personAttainment: {
    },

    defGender: {
    },
    defNationality: {
    },
    defCivilstatus: {
    },

    defRegion: {
    },
    defProvince: {
    },
    defCity: {
    },
    defBarangay: {
    },

})

const page6data = ref({})

const perData = computed(() => {
  return props.personData
});
const perAddress = computed(() => {
  return props.personAddress
});
const perFamily = computed(() => {
  return props.personFamily
});
const perAward = computed(() => {
  return props.personAward
});
const perAttainment = computed(() => {
  return props.personAttainment
});

const dGender = computed(() => {
  return props.defGender
});
const dNationality = computed(() => {
  return props.defNationality
});
const dCivilstatus = computed(() => {
  return props.defCivilstatus
});

const dRegion = computed(() => {
  return props.defRegion
});
const dProvince = computed(() => {
  return props.defProvince
});
const dCity = computed(() => {
  return props.defCity
});
const dBarangay = computed(() => {
  return props.defBarangay
});


const personal = ref([])
const family = ref([])
const award = ref([])
const address = ref([])
const attainment = ref([])


const genderDesc = ref('')
const nationalityDesc = ref('')
const civilstatusDesc = ref('')
const birthProvinceDesc = ref('')
const birthCityDesc = ref('')
const presentRegionDesc = ref('')
const presentProvinceDesc = ref('')
const presentCityDesc = ref('')
const presentBarangayDesc = ref('')
const permanentRegionDesc = ref('')
const permanentProvinceDesc = ref('')
const permanentCityDesc = ref('')
const permanentBarangayDesc = ref('')








onMounted(async () => {
    
    personal.value = perData.value
    address.value = perAddress.value
    family.value = perFamily.value
    award.value = perAward.value
    attainment.value = perAttainment.value
    

    // string setters and filters

    //personal information
    genderDesc.value = dGender.value.filter(dg => dg.gen_id == personal.value.per_gender).map(m => m.gen_desc).toString()
    nationalityDesc.value = dNationality.value.filter(nt => nt.nat_id == personal.value.per_nationality).map(m => m.nat_desc).toString()
    civilstatusDesc.value = dCivilstatus.value.filter(cv => cv.cv_id == personal.value.per_civilstatus).map(m => m.cv_desc).toString()
    birthProvinceDesc.value = dProvince.value.filter(dp => dp.provCode == personal.value.per_birth_province).map(m => m.provDesc).toString()
    birthCityDesc.value = dCity.value.filter(ct => ct.citymunCode == personal.value.per_birth_city).map(m => m.citymunDesc).toString()

    // present address
    presentRegionDesc.value = dRegion.value.filter(rg => rg.regCode == address.value.per_curr_region).map(m => m.regDesc).toString()
    presentProvinceDesc.value = dProvince.value.filter(pr => pr.provCode == address.value.per_curr_province).map(m => m.provDesc).toString()
    presentCityDesc.value = dCity.value.filter(ct => ct.citymunCode == address.value.per_curr_city).map(m => m.citymunDesc).toString()
    presentBarangayDesc.value = dBarangay.value.filter(pr => pr.id == address.value.per_curr_barangay).map(m => m.brgyDesc).toString()
    
    //current address
    permanentRegionDesc.value = dRegion.value.filter(rg => rg.regCode == address.value.per_perm_region).map(m => m.regDesc).toString()
    permanentProvinceDesc.value = dProvince.value.filter(pr => pr.provCode == address.value.per_perm_province).map(m => m.provDesc).toString()
    permanentCityDesc.value = dCity.value.filter(ct => ct.citymunCode == address.value.per_perm_city).map(m => m.citymunDesc).toString()
    permanentBarangayDesc.value = dBarangay.value.filter(pr => pr.id == address.value.per_perm_barangay).map(m => m.brgyDesc).toString()



})


const page = ref(6)
const emit = defineEmits(['register-applicant','page6-data'])
const transferData = (mode, type) =>{
   if(mode=='prev'){
        emit('page6-data', page6data.value, 5, 'retain')
   }else{

        if(type == 1){
            personal.value = {
                ...personal.value,
                per_regtype: 1 // applicant only
            }
        }else{
            personal.value = {
                ...personal.value,
                per_regtype: 2 // enrollee
            }
        }
    
        emit('register-applicant', personal.value, address.value, family.value, award.value, attainment.value)
   }
}
</script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3 text-center">
            <p class="text-sm font-semibold">Registrant Information</p>    
            <p class="text-xs">Please check all fields and details to be registered</p>    
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-500 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Personal Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Full Name: </p>
                            <p class="text-sm italic p-1.5"> {{ personal.per_firstname}} 
                                                {{ personal.per_middlename}} 
                                                {{ personal.per_lastname}} 
                                                {{ personal.per_suffixname}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold  bg-emerald-500 text-white p-1.5 rounded-md">Contact Number: </p>
                            <p class="text-sm italic p-1.5"> {{ personal.per_contact}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold  bg-emerald-500 text-white p-1.5 rounded-md">Email: </p>
                            <p class="text-sm italic p-1.5"> {{ personal.per_email}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold  bg-emerald-500 text-white p-1.5 rounded-md">Birhtdate: </p>
                            <p class="text-sm italic p-1.5"> {{ personal.per_birthday}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Birthplace: </p>
                            <p class="text-sm italic p-1.5"> {{ birthProvinceDesc}}, 
                                                {{ birthCityDesc}} 
                                                {{ personal.per_birth_zipcode}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Civil Status: </p>
                            <p class="text-sm italic p-1.5"> {{ civilstatusDesc}}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Gender: </p>
                            <p class="text-sm italic p-1.5"> {{ genderDesc }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Nationality: </p>
                            <p class="text-sm italic p-1.5"> {{ nationalityDesc}}</p>
                        </div>

                    
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-500 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Address Information</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Present Address: </p>
                            <p class="text-sm italic p-1.5"> {{ address.per_curr_home}}, 
                                                {{ presentRegionDesc}},  
                                                {{ presentProvinceDesc}},  
                                                {{ presentCityDesc}},  
                                                {{ presentBarangayDesc}}  
                                                {{ address.per_curr_zipcode}}</p>
                    </div>
                    <div>
                            <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Permanent Address: </p>
                            <p class="text-sm italic p-1.5"> {{ address.per_perm_home? address.per_perm_home:'' }}, 
                                                {{ permanentRegionDesc ? permanentRegionDesc:''}}, 
                                                {{ permanentProvinceDesc ? permanentProvinceDesc:''}}, 
                                                {{ permanentCityDesc ? permanentCityDesc:''}}, 
                                                {{ permanentBarangayDesc ? permanentBarangayDesc:''}}, 
                                                {{ address.per_perm_zipcode ? address.per_perm_zipcode:''}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-500 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Family Information</p>
                <div v-if="!Object.keys(family).length" class="text-center p-5">
                    <p class="text-xs">No Members Added</p>
                </div>
                <div v-else v-for="(f, index) in perFamily" class="grid grid-cols-1 md:grid-cols-4 gap-3">
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Family Name: </p>
                            <p class="text-sm italic p-1.5"> {{ f.fam_firstname}} 
                                                {{ f.fam_middlename}} 
                                                {{ f.fam_lastname}} 
                                                {{ f.fam_suffixname}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Contact: </p>
                            <p class="text-sm italic p-1.5"> {{ f.fam_contact}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Email: </p>
                            <p class="text-sm italic p-1.5  break-all"> {{ f.fam_email}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Relationship: </p>
                            <p class="text-sm italic p-1.5"> {{ f.fam_relationship}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-500 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Awards Information</p>
                <div v-if="!Object.keys(award).length" class="text-center p-5">
                    <p class="text-xs">No Awards Added</p>
                </div>
                <div v-else v-for="(a, index) in perAward" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Award Title: </p>
                            <p class="text-sm italic p-1.5"> {{ a.awr_desc}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Year Awarded: </p>
                            <p class="text-sm italic p-1.5"> {{ a.awr_year}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-500 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Educational Attainment</p>
                <div v-if="!Object.keys(attainment).length" class="text-center p-5">
                    <p class="text-xs">No Educational Attainment Added</p>
                </div>
                <div v-else v-for="(p, index) in perAttainment" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Award Title: </p>
                        <p class="text-sm italic p-1.5"> {{ p.pered_school}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Year From: </p>
                            <p class="text-sm italic p-1.5"> {{ p.pered_from}}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold bg-emerald-500 text-white p-1.5 rounded-md">Year To: </p>
                        <p class="text-sm italic p-1.5"> {{ p.pered_to}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1 flex justify-end gap-2">
        <div class="flex">
            <button type="button" @click="transferData('prev')" class="w-auto bg-gray-500 hover:bg-gray-400 p-2 rounded-md text-xs text-white">back</button>  
        </div> 
        <div class="flex">
            <button type="button" @click="transferData('next', 1) " class="w-auto bg-cyan-500 hover:bg-cyan-400 p-2 rounded-md text-xs text-white">Register Applicant</button>  
        </div> 
        <div class="flex">
            <button type="button" @click="transferData('next', 2) " class="w-auto bg-emerald-500 hover:bg-emerald-400 p-2 rounded-md text-xs text-white">Enroll Applicant</button>  
        </div> 
        
    </div> 
</template>