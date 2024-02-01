<script setup>
import { ref, onMounted, computed } from 'vue';
import Loader from '../../snippets/loaders/Loading1.vue';
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
// import Table1 from '../../snippets/tables/Table1.vue';
import { getSubjects } from "./SubjectsFunction.js";


const preLoading = ref(false)
const searchItem = ref('')
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
    getSubjects().then((results)=>{
        console.log(results)
        preLoading.value = false
        subject.value = results
    }).catch((err) => {
            alert('error loading the list subjects')
    })

})
</script>

<template>
    <SearchHeader headerTitle="Subjects" :searchData="searchItem"/>


    <div class="flex flex-col h-full w-full">
        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

            <NoDataFound v-if="!Object.keys(subject).length && !preLoading"/>
            <Loader v-if="!Object.keys(subject).length && preLoading"></Loader>
            <!-- <Table1 :data="subject" :headers="header"/> -->

            <div class="flex flex-col gap-2">
                <div v-for="(d, index) in subject" class="p-3 w-full flex gap-2 border shadow-md rounded-lg">
                    <div class="w-full p-2 flex flex-col">
                        <div class="h-full flex flex-col">
                            <p class="text-sm font-extrabold">{{ d.subj_code }}</p>
                            <p class="text-xs font-sem">{{ d.subj_name}}</p>
                        </div>
                        <div class="flex gap-2 justify-start items-center">
                            <p class="text-xs font-bold text-cyan-500 hover:text-cyan-400 underline cursor-pointer">Edit Data</p>
                            <button type="button" class="text-xs bg-emerald-500 px-4 py-1 rounded-sm text-white hover:bg-emerald-400">Active</button>
                           
                        </div>
                    </div>
                    <textarea class="w-full p-5 text-justify overflow-auto h-40 border border-gray-200 rounded-lg shadow-inner bg-gray-50 text-xs" cols="42" rows="5" 
                        :value="d.subj_desc? d.subj_desc:'No Description Found'" disabled>
                    </textarea>
                </div>

            </div>

        </div>
    </div>
</template>
