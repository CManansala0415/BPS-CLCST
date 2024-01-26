<script setup>
import { ref, onMounted, computed } from "vue";

defineProps({
    title: {
    },
    userName: {
    }
})

</script>

<template>
    <div class="w-full grid grid-cols-3" id="banner">
        <div class="col-span-2 w-full p-10 bg-medium-green bg-opacity-90 flex justify-start items-center">
            <p class="text-md font-semibold text-gray-300">{{ title }}</p>
        </div>
        <div class="cols-span-1 w-full p-10 bg-medium-green bg-opacity-90 flex justify-end items-center">
            <p class="text-xs font-light text-gray-300">{{ userName }}</p>
        </div>
    </div>
</template>