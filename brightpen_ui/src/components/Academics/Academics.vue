<script setup>
import { ref, onMounted, computed } from 'vue';
import Programs from './Programs/Programs.vue';
import Sections from './Sections/Sections.vue';
import YearLevels from './YearLevels/YearLevels.vue';
import Classrooms from './Classrooms/Classrooms.vue';
import Subjects from './Subjects/Subjects.vue';
import Faculties from './Faculties/Faculties.vue';
import Departments from './Departments/Departments.vue';

const def_class = ref("flex items-center w-full rounded-lg cursor-pointer hover:bg-emerald-400 hover:text-gray-100 p-2");
const active_class = ref("flex items-center w-full rounded-lg cursor-pointer bg-emerald-600 hover:bg-emerald-500 text-gray-100 p-2");
const content = ref(1)

</script>
<template>
   <div class="flex flex-col w-full h-full">
      <div class="h-28"></div>
      <div class="flex gap-2 w-full h-full">
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
            <div class="mt-5">
               <h3 class="text-md font-semibold">Selection</h3>
            </div>
            <div class="flex flex-col gap-2 p-1">
               <div :class="content == 1? active_class:def_class" @click="content = 1">
                  <p class="text-xs">Programs</p>
               </div>
               <div :class="content == 2? active_class:def_class" @click="content = 2">
                  <p class="text-xs">Section</p>
               </div>
               <div :class="content == 3? active_class:def_class" @click="content = 3">
                  <p class="text-xs">Grade Levels</p>
               </div>
               <div :class="content == 4? active_class:def_class" @click="content = 4">
                  <p class="text-xs">Classrooms</p>
               </div>
               <div :class="content == 5? active_class:def_class" @click="content = 5">
                  <p class="text-xs">Subjects</p>
               </div>
               <div :class="content == 6? active_class:def_class" @click="content = 6">
                  <p class="text-xs">Classrooms</p>
               </div>
               <div :class="content == 7? active_class:def_class" @click="content = 6">
                  <p class="text-xs">Departments</p>
               </div>
            </div>
           
         </div>
         <div class=" basis-full border-x border-gray-300 flex flex-col gap-2 p-5">
            <div class="mt-5">
               <p class="text-sm font-light">Academic Component Settings</p>
            </div>
            <div class="w-full p-2">
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 1">
                     <Programs/>
                  </div>
                <!-- </Transition> -->
                <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 2">
                     <Sections/>
                  </div>
               <!-- </Transition> -->
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 3">
                     <YearLevels/>
                  </div>
               <!-- </Transition> -->
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 4">
                     <Classrooms/>
                  </div>
               <!-- </Transition> -->
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 5">
                     <Subjects/>
                  </div>
               <!-- </Transition> -->
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 6">
                     <Faculties/>
                  </div>
               <!-- </Transition> -->
               <!-- <Transition name="slide-fade" mode="out-in"> -->
                  <div v-if="content == 7">
                     <Departments/>
                  </div>
               <!-- </Transition> -->
            </div>
         </div>
         <div class=" basis-3/12 flex flex-col gap-2 p-5">
            <div class="mt-5">
               <h3 class="text-md font-semibold">What's Here?</h3>
            </div>
            <div class="p-5">
               <ul class="list-disc">
                  <li><p class="text-xs">Register required components to be used for academe.</p></li>
                  <li><p class="text-xs">Update descriptions and correct the details needed.</p></li>
                  <li><p class="text-xs">Disable components as needed.</p></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</template>
<style>
.slide-fade-enter-active {
  transition: all 0.2s ease-in;
}

.slide-fade-leave-active {
  transition: all 0.1s ease-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(-20px);
  opacity: 0;
}
</style>