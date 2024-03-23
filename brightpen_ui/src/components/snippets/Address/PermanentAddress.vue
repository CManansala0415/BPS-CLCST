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
    permanentHome:{
    },
    permanentRegion:{
    },
    permanentProvince:{
    },
    permanentCity:{
    },
    permanentBarangay:{
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
  return props.permanentHome
});
const prRegion = computed(() => {
  return props.permanentRegion
});
const prProvince = computed(() => {
  return props.permanentProvince
});
const prCity = computed(() => {
  return props.permanentCity
});
const prBarangay = computed(() => {
  return props.permanentBarangay
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
const permanentAddress = ref({
    per_perm_home:'',
    per_perm_region:'',
    per_perm_province:'',
    per_perm_city:'',
    per_perm_barangay:'',
    per_perm_zipcode:'',
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
        permanentAddress.value.per_perm_home = prHome.value
        permanentAddress.value.per_perm_region = prRegion.value
        permanentAddress.value.per_perm_province = prProvince.value
        permanentAddress.value.per_perm_city = prCity.value
        permanentAddress.value.per_perm_barangay = prBarangay.value
        // homeDisabler.value = true
        // regionDisabler.value = true
        // provinceDisabler.value = true
        // cityDisabler.value = true
        // barangayDisabler.value = true
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
                transferData()
        break;

    }
    
}

const emit = defineEmits(['permanent-address'])
const transferData = () =>{
    emit('permanent-address', permanentAddress.value)
}

</script>
<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Home</p> 
            <input type="text" @focusout="updateAddress('home',permanentAddress.per_perm_home)"  
                                :disabled="homeDisabler?true:false"
                                v-model="permanentAddress.per_perm_home" 
                                class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Region</p> 
            <select @change="updateAddress('region',permanentAddress.per_perm_region)" 
                    v-model="permanentAddress.per_perm_region" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Click Edit to modify details" 
                    :disabled="regionDisabler?true:false">
                <option value="" disabled>-- Select region --</option>
                <option v-for="(r, index) in region" :value="r.regCode">{{ r.regDesc }}</option>
            </select>
        </div>
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Province</p> 
            <select @change="updateAddress('province',permanentAddress.per_perm_province)" 
                    v-model="permanentAddress.per_perm_province" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select Region First" 
                    :disabled="provinceDisabler?true:false">
                <option value="" disabled>-- Select Province --</option>
                <option v-for="(p, index) in filteredProvince" :value="p.provCode">{{ p.provDesc }}</option>
            </select>
        </div>
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">City</p> 
            <select @change="updateAddress('city',permanentAddress.per_perm_city)" 
                    v-model="permanentAddress.per_perm_city" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select City First" 
                    :disabled="cityDisabler?true:false">
                <option value="" disabled>-- Select City --</option>
                <option v-for="(c, index) in filteredCity" :value="c.citymunCode">{{ c.citymunDesc }}</option>
            </select>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Barangay</p> 
            <select @change="updateAddress('barangay',permanentAddress.per_perm_barangay)" 
                    v-model="permanentAddress.per_perm_barangay" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Select Barangay First" 
                    :disabled="barangayDisabler?true:false">
                <option value="" disabled>-- Select Barangay --</option>
                <option v-for="(b, index) in filteredBarangay" :value="b.id">{{ b.brgyDesc }}</option>
                
            </select>
        </div> 
        <div class="flex flex-col gap-1 h-full">
            <p class="text-xs">Zip Code</p> 
            <select v-model="permanentAddress.per_perm_zipcode"
                    :disabled="zipcodeDisabler?true:false"
                    class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                    title="Click Edit to modify details" >
                <option value="" disabled>-- Select zip code --</option>
            </select>
        </div> 
    </div>
</template>