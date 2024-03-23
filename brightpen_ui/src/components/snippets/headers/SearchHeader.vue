<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    searchData: {
    },    
    headerTitle: {
    },
})

defineEmits(['toggle-search', 'add-new']);

const searchData = computed(() => {
  return props.searchData
});

onMounted(async () => {
    
})

const searchvalue = ref('')

</script>

<template>
    <div class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col md:flex-row justify-between">
            <p class="text-xl text-emerald-600 font-bold">{{ headerTitle }}</p>
            <div class="flex flex-col-reverse sm:flex-row gap-2 w-full md:w-3/4 justify-end">
                <div class="w-full sm:w-1/2 flex justify-end">
                    <button type="button" @click="$emit('add-new',true)" class="px-2 py-1.5 bg-emerald-500 text-xs text-white rounded-md hover:bg-emerald-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-plus mr-2"></i>Add New</button>
                </div>
                <div class="w-full sm:w-1/2 flex">
                    <input type="text" @keyup.enter="$emit('toggle-search',searchvalue)" v-model="searchvalue" class="w-full p-2 border-0 shadow-md text-xs disabled:bg-gray-200 disabled:cursor-not-allowed" placeholder="Search Here..."/>
                    <button type="button" @click="$emit('toggle-search',searchvalue)" class="p-2 bg-emerald-400 shadow-md disabled:bg-gray-200 disabled:cursor-not-allowed text-xs text-white">Search</button>
                </div>
            </div>
        </div>
    </div>
</template>