<script setup>
import { ref, onMounted, computed } from 'vue';
import PresentAddress from '../../snippets/Address/PresentAddress.vue';
import PermanentAddress from '../../snippets/Address/PermanentAddress.vue';

const props = defineProps({
    regionData: {
    },    
    provinceData: {
    },
    cityData: {
    },
    barangayData: {
    },
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


onMounted(async () => {
    
})

const page2Data = ref({
    per_curr_home:'',
    per_curr_region:'',
    per_curr_province:'',
    per_curr_city:'',
    per_curr_barangay:'',
    per_curr_zipcode:'',
    per_perm_home:'',
    per_perm_region:'',
    per_perm_province:'',
    per_perm_city:'',
    per_perm_barangay:'',
    per_perm_zipcode:'',
})

const page = ref(3)
const emit = defineEmits(['page2-data'])
const transferData = (mode) =>{
   if(mode=='prev'){
        emit('page2-data', page2Data.value, 1, 'retain')
   }else{
        if(
            (!page2Data.value.per_curr_home)||
            (!page2Data.value.per_curr_region)||
            (!page2Data.value.per_curr_province)||
            (!page2Data.value.per_curr_city)||
            (!page2Data.value.per_curr_barangay)
            // (!page2Data.value.per_curr_zipcode)
        ){
            alert('Please Fill out all fields with *')
        }else{
            emit('page2-data', page2Data.value, 3, 'update')
        }
   }
}

const setPresentAddress= (data) =>{
    page2Data.value.per_curr_home = data.per_curr_home
    page2Data.value.per_curr_region = data.per_curr_region
    page2Data.value.per_curr_province = data.per_curr_province
    page2Data.value.per_curr_city = data.per_curr_city
    page2Data.value.per_curr_barangay = data.per_curr_barangay
    page2Data.value.per_curr_zipcode = data.per_curr_zipcode
}

const setPermanentAddress= (data) =>{
    page2Data.value.per_perm_home = data.per_perm_home
    page2Data.value.per_perm_region = data.per_perm_region
    page2Data.value.per_perm_province = data.per_perm_province
    page2Data.value.per_perm_city = data.per_perm_city
    page2Data.value.per_perm_barangay = data.per_perm_barangay
    page2Data.value.per_perm_zipcode = data.per_perm_zipcode
}


</script>
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Present Address</p>
                <PresentAddress :regionData="region" :provinceData="province" :cityData="city" :barangayData="barangay" @present-address="setPresentAddress"/>
            </div>
        </div>
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Permanent Address <input type="checkbox" class="border border-gray-400 ml-2"/></p>
                <PermanentAddress :regionData="region" :provinceData="province" :cityData="city" :barangayData="barangay"  @permanent-address="setPermanentAddress"/>
            </div>
        </div>
    </div>
    
    <div class="mt-1 flex justify-end gap-2">
        <div class="flex">
            <button type="button" @click="transferData('prev')" class="w-auto bg-gray-500 hover:bg-gray-400 p-2 rounded-md text-xs text-white">back</button>  
        </div> 
        <div class="flex">
            <button type="button" @click="transferData('next') " class="w-auto bg-gray-700 hover:bg-gray-600 p-2 rounded-md text-xs text-white">Next</button>  
        </div> 
    </div> 
</template>