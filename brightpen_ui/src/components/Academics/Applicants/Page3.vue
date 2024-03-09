<script setup>
import { ref, onMounted, computed } from 'vue';


const props = defineProps({
    genderData: {
    },    
    civilstatusData: {
    },
})

const gender = computed(() => {
  return props.genderData
});
const civilstatus = computed(() => {
  return props.civilstatusData
});

onMounted(async () => {

   
})

const page3data = ref({
    fam_firstname:'',
    fam_middlename:'',
    fam_lastname:'',
    fam_suffixname:'',
    fam_relationship:'',
    fam_contact:'',
    fam_email:'',
})

const family = ref([])

const addMember = (data) =>{
    let convert = {...data}

    if(
        (!convert.fam_firstname)||
        (!convert.fam_lastname)||
        (!convert.fam_relationship)||
        (!convert.fam_contact) ){
            alert('Please Fillout fields with *')
    }else{
        family.value.push(convert)
    }

}

const removeMember = (index) =>{
    family.value.splice(index,1)
}

const page = ref(3)
const emit = defineEmits(['page3-data'])
const transferData = (mode) =>{
   if(mode=='prev'){
        emit('page3-data', family.value, 2, 'retain')
   }else{
        emit('page3-data', family.value, 4, 'update')
   }
}

</script>
<template>
    <div class="h-96 overflow-auto">
        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Family Information</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">First Name 
                            <span v-if="!page3data.fam_firstname.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page3data.fam_firstname" 
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Middle Name</p> 
                        <input type="text" v-model="page3data.fam_middlename" 
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " />
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Last Name
                            <span v-if="!page3data.fam_lastname.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page3data.fam_lastname" 
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Suffix Name</p> 
                        <input type="text" v-model="page3data.fam_suffixname" 
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           maxlength="3"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " />
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Relationship
                            <span v-if="!page3data.fam_relationship.length" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="text" v-model="page3data.fam_relationship" 
                                           onkeydown="return /[a-z, ]/i.test(event.key)"
                                           class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div>
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Contact Number
                            <span v-if="!page3data.fam_contact" class="text-xs text-red-500">*</span>
                            <span v-else class="text-xs text-emerald-500">&#x2714;</span>
                        </p> 
                        <input type="number" v-model="page3data.fam_contact" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " required/>
                    </div> 
                    <div class="flex flex-col gap-1 h-full">
                        <p class="text-xs">Email Address</p> 
                        <input type="email" v-model="page3data.fam_email" class="border border-gray-300 p-2 text-xs rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " />
                    </div> 
                    <div class="flex flex-col gap-1 h-full justify-end">
                        <button @click="addMember(page3data)" type="button" class="w-auto bg-gray-500 hover:bg-gray-400 p-2 rounded-md text-xs text-white">Add Member</button>  
                    </div> 
                    
                </div>
            </div>
        </div>

        <div class="py-3">
            <div class="border rounded-md border-gray-400 relative p-5">
                <p class="absolute -top-2.5 left-3 text-xs font-semibold mb-3 bg-white px-2">Family Table</p>
                <div class="flex flex-col gap-2 ">
                    <div v-if="!Object.keys(family).length" class="text-center">
                        <p class="text-sm font-bold text-red-600">Empty List</p>
                        <p class="text-xs">No Family Members Added</p>
                    </div>
                    <div v-else v-for="(f, index) in family" class="border grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
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
                        <div class=" p-3 flex flex-col justify-center h-full">
                            <button @click="removeMember(index)" type="button" class="w-auto bg-red-500 hover:bg-red-400 p-2 rounded-md text-xs text-white">Remove</button>  
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