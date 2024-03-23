<script setup>
import { ref, onMounted, computed } from 'vue';
import BirthplaceAddress from '../../snippets/Address/BirthplaceAddress.vue';

const props = defineProps({
    genderData: {
    },   
    nationalityData: {
    },  
    civilstatusData: {
    },
    provinceData: {
    },
    cityData: {
    },

})

const gender = computed(() => {
  return props.genderData
});

const nationality = computed(() => {
  return props.nationalityData
});

const civilstatus = computed(() => {
  return props.civilstatusData
});

const province = computed(() => {
  return props.provinceData
});

const city = computed(() => {
  return props.cityData
});

onMounted(async () => {
     
})

const page1Data = ref({
    per_firstname:'',
    per_middlename:'',
    per_lastname:'',
    per_suffixname:'',
    per_gender:'',
    per_birthday: '',
    per_birth_province:'',
    per_birth_city:'',
    per_birth_zipcode:'',
    per_civilstatus:'',
    per_nationality:'',
})


const page = ref(2)
const emit = defineEmits(['page1-data'])
const transferData = () =>{

    if(
        (!page1Data.value.per_firstname)||
        (!page1Data.value.per_lastname)||
        (!page1Data.value.per_gender)||
        (!page1Data.value.per_birth_province)||
        (!page1Data.value.per_birth_city)||
        // (!page1Data.value.per_birth_zipcode)||
        (!page1Data.value.per_civilstatus)||
        (!page1Data.value.per_nationality)
    ){
        alert('Please Fill out all fields with *')
    }else{
        emit('page1-data', page1Data.value, page.value, 'update')
    }

}

const setBirthplace = (data) =>{
    page1Data.value.per_birth_province = data.per_birth_province
    page1Data.value.per_birth_city = data.per_birth_city
    page1Data.value.per_birth_zipcode = data.per_birth_zipcode
}



</script>
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Primary Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">First Name
                            <span v-if="!page1Data.per_firstname.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page1Data.per_firstname"
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Middle Name</p> 
                        <input type="text" v-model="page1Data.per_middlename"
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Last Name
                            <span v-if="!page1Data.per_lastname.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page1Data.per_lastname"
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Suffix Name</p> 
                        <input type="text" v-model="page1Data.per_suffixname"
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           maxlength="3"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Contact Number
                            <span v-if="!page1Data.per_contact" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span> 
                        </p> 
                        <input type="number" v-model="page1Data.per_contact" 
                                             class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Email Address
                            <span v-if="!page1Data.per_email" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="email" v-model="page1Data.per_email" 
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Birth Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Birthday
                            <span v-if="!page1Data.per_birthday" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="date" v-model="page1Data.per_birthday" 
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div>
                    <BirthplaceAddress  :provinceData="province" :cityData="city" @birthplace="setBirthplace"/>
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Civil Status
                            <span v-if="!page1Data.per_civilstatus" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <select v-model="page1Data.per_civilstatus" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                title="Click Edit to modify details" >
                            <option value="" disabled>-- Select Civil Status --</option>
                            <option v-for="(c, index) in civilstatus" :value="c.cv_id">{{ c.cv_desc }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Gender
                            <span v-if="!page1Data.per_gender" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <select v-model="page1Data.per_gender" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                title="Click Edit to modify details" >
                            <option value="" disabled>-- Select Gender --</option>
                            <option v-for="(g, index) in gender" :value="g.gen_id" >{{ g.gen_desc }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Nationality
                            <span v-if="!page1Data.per_nationality" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <select v-model="page1Data.per_nationality" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                title="Click Edit to modify details" >
                            <option value="" disabled>-- Select Nationality --</option>
                            <option v-for="(n, index) in nationality" :value="n.nat_id" >{{ n.nat_desc }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-1 flex justify-end">
            <button type="button" @click="transferData" class="w-auto bg-gray-700 hover:bg-gray-600 p-2 rounded-md text-xs text-white" >Next</button>  
    </div> 
</template>