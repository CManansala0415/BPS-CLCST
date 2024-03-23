<script setup>
import { ref, onMounted, computed } from 'vue';
import { addApplicant } from '../../Academics/Applicants/ApplicantFunction.js';
import Page1 from '../../Academics/Applicants/Page1.vue';
import Page2 from '../../Academics/Applicants/Page2.vue';
import Page3 from '../../Academics/Applicants/Page3.vue';
import Page4 from '../../Academics/Applicants/Page4.vue';
import Page5 from '../../Academics/Applicants/Page5.vue';
import Page6 from '../../Academics/Applicants/Page6.vue';
import Loader from '../loaders/Saving1.vue';
import Success from '../loaders/Success1.vue';
import { getUserID } from "../../../routes/user";

defineEmits(['close-modal', 'add-new']);

const props = defineProps({
    genderprop:{},
    nationalityprop:{},
    regionprop:{},
    cityprop:{},
    provinceprop:{},
    barangayprop:{},
    civilstatusprop:{}
})

const user = ref('')
const userID = ref('')

const gender = computed(() => {
  return props.genderprop
});
const nationality = computed(() => {
  return props.nationalityprop
});
const region = computed(() => {
  return props.regionprop
});
const city = computed(() => {
  return props.cityprop
});
const province = computed(() => {
  return props.provinceprop
});
const barangay = computed(() => {
  return props.barangayprop
});
const civilstatus = computed(() => {
  return props.civilstatusprop
});

const formPage = ref(1)

const perData = ref({
    per_firstname:'',
    per_middlename:'',
    per_lastname:'',
    per_suffixname:'',
    per_contact:'',
    per_email:'',
    per_birth_province:'',
    per_birth_city:'',
    per_birth_zipcode:'',
    per_civilstatus:'',
    per_gender:'',
    per_nationality:'',
    per_curr_home:'',
    per_curr_region :'',
    per_curr_province:'',
    per_curr_city:'',
    per_curr_barangay:'',
    per_curr_zipcode :'',
    per_perm_home:'',
    per_perm_region:'',
    per_perm_province:'',
    per_perm_city:'',
    per_perm_barangay:'',
    per_perm_zipcode:'',
})

const perInfo = ref({})
const perAddress = ref({})
const perFam = ref({})
const perAttainment = ref({})
const perAward = ref({})

const information = ref([])
const address = ref([])
const family = ref([])
const award = ref([])
const attainment = ref([])

onMounted(async () => {
    // window.stop()
    getUserID().then((results) => {
        user.value = results.data.name
        userID.value = results.data.id
        console.log(userID.value)

    }).catch((err) => {
        alert('Unauthorized Session, Please Log In')
        router.push("/");
    })
})


//params: data from pages, page to load, type of data store
const fetch = (data, page, type) =>{
    if((page==2) && (type=='update')){
        perInfo.value = data
    }
    if((page==3) && (type=='update')){
        perAddress.value = data
    }
    if((page==4) && (type=='update')){
        perFam.value = data
    }
    if((page==5) && (type=='update')){
        perAward.value = data
    }
    if((page==6) && (type=='update')){
        perAttainment.value = data

        information.value = perInfo.value
        address.value = perAddress.value
        family.value = perFam.value
        award.value = perAward.value
        attainment.value = perAttainment.value

        
    }

    formPage.value = page
}


const saving = ref(false)
const percounter = ref(0)
const famcounter = ref(0)
const awrcounter = ref(0)
const attcounter = ref(0)
const hideHeader = ref(false)
const register = (personal, address, family, award, attainment) =>{
    hideHeader.value = true
    formPage.value = 7
    let fam = JSON.parse(JSON.stringify(family))
    let awr = JSON.parse(JSON.stringify(award))
    let att = JSON.parse(JSON.stringify(attainment))
    let pers = {
        ...personal,
        per_user: userID.value,
        ...address
    }
    console.log(pers)

    var famsave = false
    var awrsave = false
    var attsave = false
    addApplicant(pers, 1).then((results)=>{
        percounter.value+=1

        fam.forEach(async (items) => {
            
            let famdata = {
                ...items,
                fam_personid: results.fam_id
            }
            addApplicant(famdata, 2).then((results)=>{
                famcounter.value+=1
            })
        })

        awr.forEach(async (items) => {
            let awrdata = {
                ...items,
                awr_personid: results.educ_id
            }
            addApplicant(awrdata, 3).then((results)=>{
                awrcounter.value+=1
            })
        })

        att.forEach(async (items) => {
            let attdata = {
                ...items,
                pered_personid: results.att_id
            }
            addApplicant(attdata, 4).then((results)=>{
                attcounter.value+=1
            })
        })

        
        
    })
 
}

const refresh = () => {
    location.reload()
}



</script>
<template>
    <div class=" z-50 fixed h-full w-full bg-black bg-opacity-50 flex flex-col justify-center items-center">
        <div class="p-7 bg-white rounded-md flex flex-col w-3/4 sm:w-">
           <div v-if="hideHeader == false" class="border-0 border-b-2 border-gray-300 p-1 mb-4 flex justify-between items-center">
                <p class="mb-2 text-md font-semibold">New Applicant</p>   
                <button type="button" @click="$emit('close-modal')" class="mb-2 bg-red-500 hover:bg-red-400 px-3 rounded-sm font-semibold text-white">&times;</button>  
           </div>
           <form @submit.prevent="" class="flex flex-col">

                    <div v-show="formPage == 1">
                        <Page1 @page1-data="fetch" :genderData="gender" :nationalityData="nationality" :civilstatusData="civilstatus" :provinceData="province" :cityData="city" />
                    </div>
                    <div v-show="formPage == 2">
                        <Page2 @page2-data="fetch" :regionData="region" :provinceData="province" :cityData="city" :barangayData="barangay"/>
                    </div>
                    <div v-show="formPage == 3">
                        <Page3 @page3-data="fetch"/>
                    </div>
                    <div v-show="formPage == 4">
                        <Page4 @page4-data="fetch"/>
                    </div>
                    <div v-show="formPage == 5">
                        <Page5 @page5-data="fetch"/>
                    </div>
                    <div v-if="formPage == 6">
                        <Page6 @page6-data="fetch" @register-applicant="register"  
                                                    :personData="information" 
                                                    :personAddress="address" 
                                                    :personFamily="family" 
                                                    :personAward="award"
                                                    :personAttainment="attainment"
                                                    :defGender="gender"
                                                    :defNationality="nationality"
                                                    :defCivilstatus="civilstatus"
                                                    :defRegion="region" 
                                                    :defProvince="province" 
                                                    :defCity="city" 
                                                    :defBarangay="barangay"/>
                    </div>
                    <div v-if="formPage == 7">
                        <div class="h-96 overflow-auto flex flex-col items-center justify-center">
                            <div v-if=" (percounter == 1) &&
                                        (famcounter == Object.keys(family).length) &&
                                        (awrcounter == Object.keys(award).length) &&
                                        (attcounter == Object.keys(attainment).length)" class="py-3 text-center">
                                <Success :title="'Registration Successful'" :details="'Click to refresh the page and update the feed'"/>
                                <button class="px-4 py-2 bg-emerald-500 text-white text-xs rounded-md" @click="refresh()">Refresh</button>
                            </div>
                            <div v-else class="py-3 text-center">
                                <Loader :title="'Registering Applicant Information'" :details="'Saving personal details, generating Identity'"/>
                                <p class="text-xs">Registering Person <span class="font-semibold">{{ percounter }} out of 1</span></p>
                                <p class="text-xs">Updating Family <span class="font-semibold">{{ famcounter }} out of {{ Object.keys(family).length }}</span></p>
                                <p class="text-xs">Listing Awards <span class="font-semibold">{{ awrcounter }} out of {{ Object.keys(award).length }}</span></p>
                                <p class="text-xs">Listing Educational Attainments <span class="font-semibold">{{ attcounter }} out of {{ Object.keys(attainment).length }}</span></p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="mt-4 flex justify-end gap-3">
                        <!-- <div class="flex justify-end">
                            <button type="submit" class="w-auto bg-emerald-500 hover:bg-emerald-400 p-2 rounded-sm text-xs text-white">Register Item</button>  
                        </div>  -->
                    </div> 
            </form>
        </div>
    </div>
</template>