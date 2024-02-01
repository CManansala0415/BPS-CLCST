<script setup>
import { ref, onMounted, computed } from 'vue';
defineProps({
    searchData: {
    },    
    headerTitle: {
    },
})
defineEmits(['toggle-search']);

</script>

<template>
    <div class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col sm:flex-row sm:items-center justify-between">
            <p class="text-xl text-emerald-600 font-bold">{{ headerTitle }}</p>
            <div class="flex gap-2">
                <div class="flex">
                    <button type="button" class="px-5 bg-emerald-500 text-xs text-white rounded-md hover:bg-emerald-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-plus mr-2"></i> Add New</button>
                </div>
                <div class="flex">
                    <input type="text" class="p-2 border-0 shadow-md text-xs disabled:bg-gray-200 disabled:cursor-not-allowed" placeholder="Search Course Here..."/>
                    <button type="button" class="p-2 bg-cyan-400 shadow-md disabled:bg-gray-200 disabled:cursor-not-allowed text-xs text-white">Clear</button>
                </div>
            </div>
        </div>
    </div>
</template>