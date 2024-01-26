<script setup>
import { ref, onMounted, computed } from 'vue';
defineProps({
    formData: {
    },
})

defineEmits(['toggle-back']);


</script>
<template>
    <div class="flex flex-col h-full w-full">
        <div class="mb-2 flex items-center justify-between">
            <p class="text-xl text-emerald-600 font-bold">Course Settings</p>
            <div class="flex">
                <button @click="$emit('toggle-back')" type="button" class="px-5 py-2 bg-cyan-500 text-xs text-white rounded-lg hover:bg-cyan-400">Back</button>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 p-5 gap-2 bg-white rounded-md shadow-md">
            <div v-for="(f, index) in formData" class="flex flex-col gap-2">
                <p class="text-xs">{{ f.title }} <span class="text-red-500">*</span></p>
                
                <select v-if="f.type == 'select'" class="p-2 rounded-md border border-gray-300 shadow-md text-xs">
                    <option v-for="(o, index) in f.options" :value="o.value">{{ o.title }}</option>
                </select>

                <textarea v-else-if="f.type == 'textarea'" class="p-2 h-24 rounded-md border border-gray-300 shadow-md text-xs" ></textarea>
            
                <input v-else :type="f.type" class="p-2 rounded-md border border-gray-300 shadow-md text-xs" :placeholder="f.placeholder"/>
                
            </div>
        </div>
    </div>
</template>