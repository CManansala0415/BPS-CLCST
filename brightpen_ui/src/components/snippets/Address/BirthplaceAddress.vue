<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
  
    provinceData: {
    },
    cityData: {
    },
    bdayProvince:{
    },
    bdayCity:{
    }

})


const province = computed(() => {
  return props.provinceData
});
const city = computed(() => {
  return props.cityData
});

const bdayProv = computed(() => {
  return props.bdayProvince
});
const bdayCity = computed(() => {
  return props.bdayCity
});




const cityDisabler = ref(true)
const provinceDisabler = ref(false)
const zipcodeDisabler = ref(false)

const filteredCity = ref([])

const birthplaceAddress = ref({
    per_birth_province:'',
    per_birth_city:'',
    per_birth_zipcode:'',
})

onMounted(async () => {
    filteredCity.value = city.value

    if(bdayProv.value && bdayCity.value){
        birthplaceAddress.value.per_birth_province = bdayProv.value
        birthplaceAddress.value.per_birth_city = bdayCity.value
        // provinceDisabler.value = true
        zipcodeDisabler.value = true
    }
 
})

const updateAddress = (type,data) =>{
    switch(type){
        case 'province':
            if(data){
                filteredCity.value = city.value.filter(ct => {
                    if(ct.provCode == data){
                        return ct
                    }
                })
                cityDisabler.value = false
            }
        break;
        case 'city':
            if(data){
                transferData()
            }
        break;    
        
    }
    
}

const emit = defineEmits(['birthplace'])
const transferData = () =>{
    emit('birthplace', birthplaceAddress.value)
}

</script>
<template>
    <div class="flex flex-col gap-1 h-full">
        <p class="text-xs">Birth Province
            <span v-if="!birthplaceAddress.per_birth_province" class="text-xs text-red-500">*</span>
            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
        </p> 
        <select @change="updateAddress('province',birthplaceAddress.per_birth_province)" 
                :disabled="provinceDisabler?true:false"
                v-model="birthplaceAddress.per_birth_province" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                title="Select Province"  required>
            <option value="" disabled>-- Select Province --</option>
            <option v-for="(p, index) in province" :value="p.provCode">{{ p.provDesc }}</option>
        </select>
    </div>
    <div class="flex flex-col gap-1 h-full">
        <p class="text-xs">Birth City
            <span v-if="!birthplaceAddress.per_birth_city" class="text-xs text-red-500">*</span>
            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
        </p> 
        <select @change="updateAddress('city',birthplaceAddress.per_birth_city)" 
                v-model="birthplaceAddress.per_birth_city" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                title="Select City First" 
                :disabled="cityDisabler?true:false" required>
            <option value="" disabled>-- Select City --</option>
            <option v-for="(c, index) in filteredCity" :value="c.citymunCode">{{ c.citymunDesc }}</option>
        </select>
    </div> 
    <div class="flex flex-col gap-1 h-full">
        <p class="text-xs">Birth Zip Code
            <span v-if="!birthplaceAddress.per_birth_zipcode" class="text-xs text-red-500">*</span>
            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
        </p> 
        <select v-model="birthplaceAddress.per_birth_zipcode" 
                :disabled="zipcodeDisabler?true:false"
                class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                title="Click Edit to modify details" >
            <option value="" disabled>-- Select zip code --</option>
        </select>
    </div> 
    
</template>