<script setup>
import { ref, onMounted, computed } from 'vue';

const props = defineProps({
    data: {
    },
    headers: {
    },
})

const data = computed(() => {
  return props.data
});

const header = computed(() => {
  return props.headers
});

const headerClass = ref('')

onMounted(async () => {
    console.log(data.value.length)
    console.log(header.value)
    headerClass.value = 'w-full p-2 '
})

// defineEmits(['toggle-search']);


</script>

<template>
    <div class="border border-black overflow-auto">
        <div class="h-96">
            <div class="w-full flex bg-gray-100">
                <div v-for="(h, index) in header" class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ h.title }}</p>
                </div>
            </div>
            
            <div v-for="(d, index) in data" class="w-full flex bg-gray-100">
                <div class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ index+1 }}</p>
                </div>
                <div class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ d.subj_code }}</p>
                </div>
                <div class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ d.subj_code }}</p>
                </div>
                <div class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ d.subj_code }}</p>
                </div>
                <div class="w-full p-2 ">
                    <p class="text-xs font-semibold">{{ d.subj_code }}</p>
                </div>
            </div>

        </div>
    </div>
</template>
