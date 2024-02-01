<script setup>
import { ref, onMounted, computed } from 'vue';
defineProps({
    data: {
    },
})

defineEmits(['toggle-close']);
</script>
<template>
    <div class="flex justify-between bg-red-500 rounded-md p-5 w-full">
        <p class="text-xs font-semibold text-white">Error Occured in Saving {{ data }}, Please Try Again...</p>
        <p @click="$emit('toggle-close')" class="text-xs text-white underline cursor-pointer">close</p>
    </div>
</template>