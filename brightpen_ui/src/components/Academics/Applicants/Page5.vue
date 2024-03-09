<script setup>
import { ref, onMounted, computed } from 'vue';

onMounted(async () => {

    
})

const page5data = ref({
    pered_school:'',
    pered_from:'',
    pered_to:'',
})

const attainment = ref([])

const addAttainment = (data) =>{
    let convert = {...data}
    
    if(
        (!convert.pered_school)||(!convert.pered_from)||(!convert.pered_to)){
            alert('Please Fillout fields with *')
    }else{
        attainment.value.push(convert)
    }

}
 
const removeAttainment = (index) =>{
    attainment.value.splice(index,1)
}

const page = ref(5)
const emit = defineEmits(['page5-data'])
const transferData = (mode) =>{
   if(mode=='prev'){
        emit('page5-data', attainment.value, 4, 'retain')
   }else{
        emit('page5-data', attainment.value, 6, 'update')
   }
}

</script>
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Educational Attainment</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                    <div class="col-span-2 flex flex-col gap-1 h-full">
                        <p class="text-xs">School Name
                            <span v-if="!page5data.pered_school.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page5data.pered_school" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Year From
                            <span v-if="!page5data.pered_from" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="number"  v-model="page5data.pered_from" min="1900" max="2099" step="1" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Year To
                            <span v-if="!page5data.pered_to" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="number"  v-model="page5data.pered_to" min="1900" max="2099" step="1" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div>
                    <div class="sm:col-span-1 flex flex-col gap-1 h-full justify-end">
                        <button @click="addAttainment(page5data)" type="button" class="w-auto bg-gray-500 hover:bg-gray-400 p-2 rounded-md text-xs text-white">Add Attainment</button>  
                    </div> 
                    
                </div>
            </div>
        </div>

        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Educational Attainments Table</p>
                <div class="flex flex-col gap-2">
                    <div v-if="!Object.keys(attainment).length" class="text-center">
                        <p class="text-sm font-bold text-red-600">Empty List</p>
                        <p class="text-xs">No Educational Attainments Added</p>
                    </div>
                    <div v-else v-for="(a, index) in attainment" class="border grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        <div class=" col-span-2 p-3 flex flex-col h-full">
                            <p class="text-xs">School: </p>
                            <span class="text-xs italic font-semibold">{{ a.pered_school }} </span>
                        </div>
                        <div class="p-3 flex flex-col h-full">
                            <p class="text-xs">Year From:</p>
                            <span class="text-xs italic font-semibold">{{ a.pered_from }}</span>
                        </div>
                        <div class="p-3 flex flex-col h-full">
                            <p class="text-xs">Year To:</p>
                            <span class="text-xs italic font-semibold">{{ a.pered_to }}</span>
                        </div>
                        <div class="sm:col-span-1 p-3 flex flex-col justify-center h-full">
                            <button @click="removeAttainment(index)" type="button" class="w-auto bg-red-500 hover:bg-red-400 p-2 rounded-md text-xs text-white">Remove</button>  
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