<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    regionData: {
    },    
    provinceData: {
    },
    cityData: {
    },
    barangayData: {
    },
    presentHome:{
    },
    presentRegion:{
    },
    presentProvince:{
    },
    presentCity:{
    },
    presentBarangay:{
    }

})

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

// if may laman and to be refleted sa mga box
const prHome = computed(() => {
  return props.presentHome
});
const prRegion = computed(() => {
  return props.presentRegion
});
const prProvince = computed(() => {
  return props.presentProvince
});
const prCity = computed(() => {
  return props.presentCity
});
const prBarangay = computed(() => {
  return props.presentBarangay
});

const homeDisabler = ref(false)
const regionDisabler = ref(false)
const provinceDisabler = ref(true)
const cityDisabler = ref(true)
const barangayDisabler = ref(true)
const zipcodeDisabler = ref(false)

const filteredProvince = ref([])
const filteredCity = ref([])
const filteredBarangay = ref([])
const presentAddress = ref({
    per_curr_home:'',
    per_curr_region:'',
    per_curr_province:'',
    per_curr_city:'',
    per_curr_barangay:'',
    per_curr_zipcode:'',
})

onMounted(async () => {
    filteredProvince.value = province.value
    filteredCity.value = city.value
    filteredBarangay.value = barangay.value

    if(
        (prHome.value) ||
        (prRegion.value) ||
        (prProvince.value) ||
        (prCity.value) ||
        (prBarangay.value)
    ){
        presentAddress.value.per_curr_home = prHome.value
        presentAddress.value.per_curr_region = prRegion.value
        presentAddress.value.per_curr_province = prProvince.value
        presentAddress.value.per_curr_city = prCity.value
        presentAddress.value.per_curr_barangay = prBarangay.value
        homeDisabler.value = true
        regionDisabler.value = true
        provinceDisabler.value = true
        cityDisabler.value = true
        barangayDisabler.value = true
        zipcodeDisabler.value = true

    }
})

const updateAddress = (type,data) =>{
    switch(type){
        case 'home':
            //set home update
            transferData()
        break;
        case 'region':
            if(data){
                filteredProvince.value = province.value.filter(prov => {
                    if(prov.regCode == data){
                        return prov
                    }
                })
                provinceDisabler.value = false
                transferData()
            }
        break;
        case 'province':
            if(data){
                filteredCity.value = city.value.filter(ct => {
                    if(ct.provCode == data){
                        return ct
                    }
                })
                cityDisabler.value = false
                transferData()
            }
        break;
        case 'city':
            if(data){
                filteredBarangay.value = barangay.value.filter(bg => {
                    if(bg.citymunCode == data){
                        return bg
                    }
                })
                barangayDisabler.value = false
                transferData()
            }
        break;
        case 'barangay':
            if(data){
                // filteredBarangay.value = barangay.value.filter(bg => {
                //     if(bg.citymunCode == data){
                //         return bg
                //     }
                // })
                barangayDisabler.value = false
                transferData()
            }
        break;

    }
    
} 
const emit = defineEmits(['present-address'])
const transferData = () =>{
    emit('present-address', presentAddress.value)
}
</script>
<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Home
                <span v-if="!presentAddress.per_curr_home" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <input @focusout="updateAddress('home',presentAddress.per_curr_home)"  
                    :disabled="homeDisabler?true:false"
                    type="text" v-model="presentAddress.per_curr_home" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Region
                <span v-if="!presentAddress.per_curr_region" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <select @change="updateAddress('region',presentAddress.per_curr_region)" 
                    v-model="presentAddress.per_curr_region" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Click Edit to modify details" 
                    :disabled="regionDisabler?true:false">
                <option value="" disabled>-- Select region --</option>
                <option v-for="(r, index) in region" :value="r.regCode">{{ r.regDesc }}</option>
            </select>
        </div>
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Province
                <span v-if="!presentAddress.per_curr_province" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <select @change="updateAddress('province',presentAddress.per_curr_province)" 
                    v-model="presentAddress.per_curr_province" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select Region First" 
                    :disabled="provinceDisabler?true:false">
                <option value="" disabled>-- Select Province --</option>
                <option v-for="(p, index) in filteredProvince" :value="p.provCode">{{ p.provDesc }}</option>
            </select>
        </div>
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">City
                <span v-if="!presentAddress.per_curr_city" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <select @change="updateAddress('city',presentAddress.per_curr_city)" 
                    v-model="presentAddress.per_curr_city" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select City First" 
                    :disabled="cityDisabler?true:false">
                <option value="" disabled>-- Select City --</option>
                <option v-for="(c, index) in filteredCity" :value="c.citymunCode">{{ c.citymunDesc }}</option>
            </select>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Barangay
                <span v-if="!presentAddress.per_curr_barangay" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <select @change="updateAddress('barangay',presentAddress.per_curr_barangay)"
                    v-model="presentAddress.per_curr_barangay" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select Barangay First" 
                    :disabled="barangayDisabler?true:false">
                <option value="" disabled>-- Select Barangay --</option>
                <option v-for="(b, index) in filteredBarangay" :value="b.id">{{ b.brgyDesc }}</option>
                
            </select>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Zip Code
                <span v-if="!presentAddress.per_curr_zipcode" class="text-xs text-red-500">*</span>
                <span v-else class="text-xs text-emerald-500">&#x2714;</span>
            </p> 
            <select v-model="presentAddress.per_curr_zipcode" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Click Edit to modify details" 
                    :disabled="zipcodeDisabler?true:false">
                <option value="" disabled>-- Select zip code --</option>
            </select>
        </div> 
    </div>
</template>