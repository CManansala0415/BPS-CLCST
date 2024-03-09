<script setup>
import { ref, onMounted, computed } from 'vue';

onMounted(async () => {

    
})

const page4data = ref({
    awr_desc:'',
    awr_year:'',
})

const award = ref([])

const addAward = (data) =>{
    let convert = {...data}
    
    if(
        (!convert.awr_desc)||(!convert.awr_year)){
            alert('Please Fillout fields with *')
    }else{
        award.value.push(convert)
    }

}

const removeAward = (index) =>{
    award.value.splice(index,1)
}

const page = ref(4)
const emit = defineEmits(['page4-data'])
const transferData = (mode) =>{
   if(mode=='prev'){
        emit('page4-data', award.value, 3, 'retain')
   }else{
        emit('page4-data', award.value, 5, 'update')
   }
}

</script>
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Award Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-7 gap-3">
                    <div class="col-span-3 flex flex-col gap-1 h-full">
                        <p class="text-xs">Award Receive / Recognition
                            <span v-if="!page4data.awr_desc.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page4data.awr_desc" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="col-span-3 flex flex-col gap-1 h-full">
                        <p class="text-xs">Year Recognized
                            <span v-if="!page4data.awr_year" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="number"  v-model="page4data.awr_year" min="1900" max="2099" step="1" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="col-span-3 sm:col-span-1 flex flex-col gap-1 h-full justify-end">
                        <button @click="addAward(page4data)" type="button" class="w-auto bg-gray-500 hover:bg-gray-400 p-2 rounded-md text-xs text-white">Add Award</button>  
                    </div> 
                    
                </div>
            </div>
        </div>

        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Awards Table</p>
                <div class="flex flex-col gap-2">
                    <div v-if="!Object.keys(award).length" class="text-center">
                        <p class="text-sm font-bold text-red-600">Empty List</p>
                        <p class="text-xs">No Award Added</p>
                    </div>
                    <div v-else v-for="(a, index) in award" class="border grid grid-cols-1 sm:grid-cols-3 md:grid-cols-7 gap-3">
                        <div class=" col-span-3 p-3 flex flex-col h-full">
                            <p class="text-xs">Recognition: </p>
                            <span class="text-xs italic font-semibold">{{ a.awr_desc }} </span>
                        </div>
                        <div class=" col-span-3 p-3 flex flex-col h-full">
                            <p class="text-xs">Year Received:</p>
                            <span class="text-xs italic font-semibold">{{ a.awr_year }}</span>
                        </div>
                        <div class=" col-span-3 sm:col-span-1 p-3 flex flex-col justify-center h-full">
                            <button @click="removeAward(index)" type="button" class="w-auto bg-red-500 hover:bg-red-400 p-2 rounded-md text-xs text-white">Remove</button>  
                        </div>
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
            <button type="button" @click="transferData('next') " class="w-auto bg-gray-700 hover:bg-gray-600 p-2 rounded-md text-xs text-white">Next</button>  
        </div> 
    </div> 
</template>