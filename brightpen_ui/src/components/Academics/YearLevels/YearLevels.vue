<script setup>
import { ref, onMounted, computed } from 'vue';
import Loader from '../../snippets/loaders/Loading1.vue';
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
// import Table1 from '../../snippets/tables/Table1.vue';
import { getGradelvl, saveGradelvl, getProgram } from "./YearLevelsFunction.js";


const preLoading = ref(false)
const searchItem = ref('')
const activeEdit = ref(true)
const activeEditCell = ref(0)

const gradelvl = ref([])
const program = ref([])
const header = ref([
    {
        title: 'ID',
        width: 'basis-1/6',
        cell: 'grad_id'
    },
    {
        title: 'Grade Level Code',
        width: 'basis-1/4',
        cell: 'grad_code'
    },
    {
        title: 'Grade Level Name',
        width: 'basis-1/2',
        cell: 'grad_name'
    },

    {
        title: 'Status',
        width: 'basis-1/6',
        cell: 'grad_status'
    },
])
onMounted(async () => {

    

    try{
        preLoading.value = true
        getGradelvl().then((results)=>{
            gradelvl.value = results
        }).catch((err) => {
                alert('error loading the list Grade Levels')
        })
        getProgram().then((results)=>{
            preLoading.value = false
            program.value = results
        })
       
   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
    

})

const editData = (id) =>{
    activeEditCell.value=id
}

const saveData = (data) =>{
    saveGradelvl(data).then((results)=>{
        console.log(results)
        alert('Update Saved')
        activeEditCell.value=0
    }).catch((err) => {
            alert('error loading saving Grade Level')
    })
}

const cancelData = (data) =>{
    activeEditCell.value=0
    console.log(data)
}

const searchData = (data) =>{
    console.log(data)
}

const emit = defineEmits(['add-modal'])
const registerData = (data) =>{
    emit('add-modal')
}

</script>

<template>
    <SearchHeader headerTitle="Grade Levels" :searchData="gradelvl" @toggle-search="searchData" @add-new="registerData"/>


    <div class="flex flex-col h-full w-full">
        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

            <NoDataFound v-if="!Object.keys(gradelvl).length && !preLoading"/>
            <Loader v-if="!Object.keys(gradelvl).length && preLoading"></Loader>
            <!-- <Table1 :data="subject" :headers="header"/> -->

            <div class="flex flex-col gap-2"> 
                <form @submit.prevent="saveData(gradelvl[index])" v-for="(g, index) in gradelvl" class="p-3 w-full flex flex-col md:flex-row gap-2 border border-gray-300 rounded-md">
                    <div class="w-full p-2 flex flex-col sm:flex-row gap-2">
                        <div class="basis-3/4 h-full flex flex-col gap-2">
                            <div class="flex flex-col md:flex-row gap-2">
                                <div class="w-full flex flex-col gap-2">
                                    <p class="text-xs font-semibold italic">Grade Level Code</p>
                                    <input type="text" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="g.grad_code" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                                </div>
                                <div class="w-full flex flex-col gap-2">
                                    <p class="text-xs font-semibold italic">Grade Level Name</p>
                                    <input type="text" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="g.grad_name" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                                </div>
                                <div class="w-full flex flex-col gap-2">
                                    <p class="text-xs font-semibold italic">Program Type</p>
                                    <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                            v-model="g.grad_dtypeid"
                                            title="Click Edit to modify details" required>
                                        <option value="" disabled>-- Select Program --</option>
                                        <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>

                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        <div class="basis-1/4 flex flex-col gap-2 justify-center items-center">
                            <button v-show="activeEditCell==index+1? false:true" @click="editData(index+1)" type="button"  class="w-full  text-xs bg-cyan-500 px-4 py-1 rounded-md text-white hover:bg-cyan-400">Edit</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="button" @click="cancelData(gradelvl[index])" class="w-full  text-xs bg-red-500 px-4 py-1 rounded-md text-white hover:bg-red-400">Cancel</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="submit" class="w-full  text-xs bg-teal-500 px-4 py-1 rounded-md text-white hover:bg-teal-400">Save</button>

                            <!-- <button @click="gradelvl[index].grad_status = 0" v-if="g.grad_status==1" type="submit" class="w-full  text-xs bg-emerald-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Active
                            </button>
                            <button @click="gradelvl[index].grad_status = 1" v-else type="submit" class="w-full  text-xs bg-gray-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Inactive
                            </button> -->
                        </div>
                    </div>
                    <!-- <textarea class="w-full p-5 text-justify overflow-auto h-40 border border-gray-200 rounded-md disabled:shadow-inner disabled:bg-gray-50 text-xs disabled:cursor-not-allowed " cols="42" rows="5" title="Click Edit to modify details"
                        :value="g.grad_desc? g.grad_desc:'No Description Found'" :disabled="activeEditCell==index+1? false:true">
                    </textarea> -->
                </form>

            </div>

        </div>
    </div>
</template>
