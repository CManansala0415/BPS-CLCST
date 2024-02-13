<script setup>
import { ref, onMounted, computed } from 'vue';
import Loader from '../../snippets/loaders/Loading1.vue';
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
// import Table1 from '../../snippets/tables/Table1.vue';
import { getSubject, saveSubject } from "./SubjectsFunction.js";


const preLoading = ref(false)
const searchItem = ref('')
const activeEdit = ref(true)
const activeEditCell = ref(0)

const subject = ref([])
const header = ref([
    {
        title: 'ID',
        width: 'basis-1/6',
        cell: 'subj_id'
    },
    {
        title: 'Subject Code',
        width: 'basis-1/4',
        cell: 'subj_code'
    },
    {
        title: 'Subject Name',
        width: 'basis-1/2',
        cell: 'subj_name'
    },

    {
        title: 'Status',
        width: 'basis-1/6',
        cell: 'subj_status'
    },
])
onMounted(async () => {

    preLoading.value = true
    getSubject().then((results)=>{
        console.log(results)
        preLoading.value = false
        subject.value = results
    }).catch((err) => {
            alert('error loading the list subjects')
    })

})

const editData = (id) =>{
    activeEditCell.value=id
}

const saveData = (data) =>{
    saveSubject(data).then((results)=>{
        console.log(results)
        alert('Update Saved')
        activeEditCell.value=0
    }).catch((err) => {
            alert('error loading saving subject')
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
    <SearchHeader headerTitle="Subjects" :searchData="subject" @toggle-search="searchData" @add-new="registerData"/>


    <div class="flex flex-col h-full w-full">
        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

            <NoDataFound v-if="!Object.keys(subject).length && !preLoading"/>
            <Loader v-if="!Object.keys(subject).length && preLoading"></Loader>
            <!-- <Table1 :data="subject" :headers="header"/> -->

            <div class="flex flex-col gap-2"> 
                <form @submit.prevent="saveData(subject[index])" v-for="(d, index) in subject" class="p-3 w-full flex flex-col md:flex-row gap-2 border border-gray-300 rounded-md">
                    <div class="w-full p-2 flex flex-col gap-2">
                        <div class="h-full flex flex-col gap-2">
                            <input type="text" class="border border-gray-300 p-2 text-xs font-extrabold rounded-md disabled:shadow-inner disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="d.subj_code" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                            <input type="text" class="border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " v-model="d.subj_name" :disabled="activeEditCell==index+1? false:true" title="Click Edit to modify details" required/>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-2 justify-start items-center">
                            <button v-show="activeEditCell==index+1? false:true" @click="editData(index+1)" type="button"  class="w-full sm:w-1/4 text-xs bg-cyan-500 px-4 py-1 rounded-md text-white hover:bg-cyan-400">Edit</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="button" @click="cancelData(subject[index])" class="w-full sm:w-1/4 text-xs bg-red-500 px-4 py-1 rounded-md text-white hover:bg-red-400">Cancel</button>
                            <button v-show="activeEditCell!=index+1? false:true" type="submit" class="w-full sm:w-1/4 text-xs bg-teal-500 px-4 py-1 rounded-md text-white hover:bg-teal-400">Save</button>

                            <!-- <button @click="subject[index].subj_status = 0" v-if="d.subj_status==1" type="submit" class="w-full sm:w-1/4 text-xs bg-emerald-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Active
                            </button>
                            <button @click="subject[index].subj_status = 1" v-else type="submit" class="w-full sm:w-1/4 text-xs bg-gray-500 px-4 py-1 rounded-md text-white hover:bg-emerald-400">
                                Inactive
                            </button> -->
                        </div>
                    </div>
                    <textarea class="w-full p-5 text-justify overflow-auto h-40 border border-gray-200 rounded-md disabled:shadow-inner disabled:bg-gray-50 text-xs disabled:cursor-not-allowed " cols="42" rows="5" title="Click Edit to modify details"
                        v-model="d.subj_desc" :disabled="activeEditCell==index+1? false:true" required>
                    </textarea>
                </form>

            </div>

        </div>
    </div>
</template>
