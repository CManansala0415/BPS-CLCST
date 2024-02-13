<script setup>
import { ref, onMounted, computed } from 'vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';

onMounted(async () => {

   
})

const emit = defineEmits(['add-modal'])
const registerData = (data) =>{
    emit('add-modal')
}

</script>

<template>
     <SearchHeader headerTitle="Curriculum" :searchData="''" @toggle-search="" @add-new="registerData"/>
    <div class="flex flex-col h-full w-full">
        <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">
           
        </div>
    </div>
</template>
