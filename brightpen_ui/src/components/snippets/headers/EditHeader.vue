<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    headerTitle: {
    },
})

defineEmits(['update-data','return']);


onMounted(async () => {
    
})

const searchvalue = ref('')

</script>

<template>
    <div class="flex flex-col h-full w-full">
        <div class="mb-2 flex gap-2 flex-col md:flex-row justify-between">
            <p class="text-xl text-emerald-600 font-bold">{{ headerTitle }}</p>
            <div class="flex flex-col-reverse sm:flex-row gap-2 w-full md:w-3/4 justify-end">
                <div class="w-full sm:w-1/2 flex justify-end gap-3">
                    <button type="button" @click="$emit('return')" class="px-2 py-1.5 bg-cyan-500 text-xs text-white rounded-md hover:bg-cyan-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-rotate-left mr-2"></i>Back</button>
                    <!-- <button type="button" @click="$emit('update-data')" class="px-2 py-1.5 bg-emerald-500 text-xs text-white rounded-md hover:bg-emerald-400 disabled:bg-gray-200 disabled:cursor-not-allowed"><i class="fa-solid fa-floppy-disk mr-2"></i>Update</button> -->
                </div>
            </div>
            
        </div>
    </div>
</template>