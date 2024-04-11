<script setup>
import { ref, onMounted, computed } from 'vue';
import {  getStudent, getQuarter, getProgram, getGradelvl, getProgramList, uploadProfile, uploadLink, getStudentByCourse, getCurriculum, getSection, getSubject } from "../../Academics/students/StudentFunction.js";
import NoDataFound from '../../snippets/informational/NoDataFound.vue';
import SearchHeader from '../../snippets/headers/SearchHeader.vue';
import Loader from '../../snippets/loaders/Loading1.vue';

const preLoading = ref(false)
const student = ref([])
const quarter = ref([])
const gradelvl = ref([])
const program = ref([])
const course = ref([])
const curriculum = ref([])
const section = ref([])
const subject = ref([])

const booting = ref('')
const bootingCount = ref(0)

const booter = async() =>{
    getProgram().then((results)=>{
        program.value = results
        booting.value = 'Loading Program...'
        bootingCount.value += 1
    })
    getProgramList().then((results)=>{
        course.value = results
        filteredCourse.value = course.value
        booting.value = 'Loading Courses...'
        bootingCount.value += 1
    })
    getGradelvl().then((results)=>{
        gradelvl.value = results
        booting.value = 'Loading Levels...'
        bootingCount.value += 1
    })
    getQuarter().then((results)=>{
        quarter.value = results
        booting.value = 'Loading Quarters...'
        bootingCount.value += 1
    })
    getSection().then((results)=>{
        section.value = results
        booting.value = 'Loading Sections...'
        bootingCount.value += 1
    })
    getSubject().then((results)=>{
        subject.value = results
        booting.value = 'Loading Subjects...'
        bootingCount.value += 1
    })
    
}

const emit = defineEmits(['printform-modal', 'taggings-modal'])
const showPrintForm = (data) =>{
    emit('printform-modal', data)
}
const showTaggingsModal = (data, index) =>{
    // get yung mga description text ng html select para ipasa sa modal ng taggings
    var program = document.getElementById(index+"program");
    var course = document.getElementById(index+"course");
    var gradelvl = document.getElementById(index+"gradelvl");
    var quarter = document.getElementById(index+"quarter");

    var programValue= program.options[program.selectedIndex].text;
    var courseValue= course.options[course.selectedIndex].text;
    var gradelvlValue= gradelvl.options[gradelvl.selectedIndex].text;
    var quarterValue= quarter.options[quarter.selectedIndex].text;

    let info = {
        per_program_desc: programValue,
        per_course_desc: courseValue,
        per_gradelvl_desc: gradelvlValue,
        per_quarter_desc: quarterValue
    }

    getCurriculum( student.value[index].enr_course, student.value[index].enr_program).then((results)=>{
        curriculum.value = results
        emit('taggings-modal', data, info, curriculum.value, section.value, subject.value)

    })

}

const limit = ref(10)
const offset = ref(0)
const studentCount = ref(0)
onMounted(async () => {
    try{
        preLoading.value = true
        await booter().then((results)=>{

            booting.value = 'Loading Students...'
            bootingCount.value += 1
            getStudent(limit.value, offset.value).then((results)=>{
                student.value = results.data
                studentCount.value = results.count
                preLoading.value = false
            })
        })
       
        
   }catch(err) {
        preLoading.value = false
        alert('error loading the list default components')
   }
   
})

const view = () =>{
    window.stop()
    viewDetails.value = false
}

const paginate = (mode) =>{
    switch(mode){
        case 'prev':
            if(offset.value <= 0){
                offset.value = 0     
            }else{
                student.value = []
                offset.value-=10
                studentCount.value = 0
                preLoading.value = true
                getStudent(limit.value, offset.value).then((results)=>{
                    student.value = results.data
                    studentCount.value = results.count
                    preLoading.value = false
                })
            }
        break;
        case 'next':
            
            if(offset.value >= studentCount.value){
                offset.value = studentCount.value     
            }else{
                student.value = []
                offset.value+=10
                studentCount.value = 0
                preLoading.value = true
                getStudent(limit.value, offset.value, null).then((results)=>{
                    student.value = results.data
                    studentCount.value = results.count
                    preLoading.value = false
                })
            }
        break;
        case 'search':
            searchValue.value = searchValue.value.trim()
            if(searchValue.value || searchValue.value == ''){
                student.value = []
                offset.value = 0
                studentCount.value = 0
                preLoading.value = true
                getStudent(limit.value, offset.value, searchValue.value).then((results)=>{
                    student.value = results.data
                    studentCount.value = results.count
                    preLoading.value = false
                }).catch((err)=>{
                    console.log(err)
                })    
            }else{
                alert('Please search a valid record')
                preLoading.value = false
            }
        break;
        case 'course':
                student.value = []
                offset.value = 0
                studentCount.value = 0
                preLoading.value = true
                getStudentByCourse(limit.value, offset.value, courseId.value).then((results)=>{
                    student.value = results.data
                    studentCount.value = results.count
                    preLoading.value = false
                }).catch((err)=>{
                    console.log(err)
                })    
           
        break;

    }
}

const searchValue = ref('')
const search = (data) =>{
    searchValue.value = data
    paginate('search')
}


// image uploading
const showLink = ref(false)
const linkId = ref('')
const holdSubmit = ref(false)


const formData = new FormData
const upload = (personID) =>{
    holdSubmit.value = true

    formData.set('image', image.value)
    uploadProfile(formData).then((results)=>{
        showLink.value = !showLink.value, linkId.value = ''
        image.value=''
        if(results.status == 200){
            let data = {
                profile: results.link,
                personid: personID
            }
            uploadLink(data).then((results)=>{
                if(results.status == 200){
                    alert('Upload Successful')
                    location.reload()
                    holdSubmit.value = false
                }else{
                    alert('Upload Successful but Linking Failed')
                    holdSubmit.value = false
                }
            })
        }else{
            alert('Upload Failed')
            holdSubmit.value = false
        }
    }).catch((err)=>{
        console.log(err)
    })
}


const getImageFile = (file) => {
    return file.split('/')[1];
}

const image = ref('')
const handleImage = (e) =>{
    image.value = e.target.files[0]
}
// image uploading


// for typing search input
// interval for focusout, need ng interval para kapag nag select sa dropdown mahabol nya
const filteredCourse = ref([])
const searchCourse = ref('')
const showItems = ref(false)
const courseId = ref('')

let hiding = ref()
const doneInterval = ref(150)
const interval = () => { 
    clearTimeout(hiding.value);
    hiding.value = setTimeout(() => setFalse(), doneInterval.value);          
}
const setFalse = () => { 
    showItems.value = false
    if(!courseId.value || !searchCourse.value){
        courseId.value = ''
        paginate('course')
    } 
}
const filterCourse = ()=>{
    filteredCourse.value = course.value.filter(e => {
      if(
            (e.prog_name.toUpperCase().includes(searchCourse.value.toUpperCase()))||
            (e.prog_code.toUpperCase().includes(searchCourse.value.toUpperCase()))
        ){
          return e
      }
    })
    
}
// for typing search input
</script>

<template>
    <div class="w-full h-full">
        <div :class="!Object.keys(student).length && preLoading? 'relative cursor-wait':''">
            <div :class="!Object.keys(student).length && preLoading? 'pointer-events-none':'pointer-events-auto '">
                <SearchHeader headerTitle="Students" :searchData="''" @toggle-search="search"/>
            </div>
        </div>
        
        <div class="flex flex-col h-full w-full">
            <div class="flex flex-col gap-2 p-5 bg-white rounded-md shadow-md">

                
                <Loader v-if="preLoading">
                    <p class="text-xs"> {{ booting }} {{bootingCount}} out of 6</p>
                </Loader>

                <div v-if="!preLoading" class="p-3 flex flex-col gap-3">
                    <div class="basis-full grid grid-cols-1 sm:grid-cols-2 gap-2 mb-4">
                        <div class="flex flex-col gap-1">
                            <p class="text-xs">Program</p> 
                            <select class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed">
                                <option value="" >-- Select Type --</option>
                                <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-xs">Program / Strand {{ courseId }}</p> 
                            <input v-model="searchCourse" class="w-full border border-gray-300 p-2 text-xs disabled:shadow-inner rounded-md disabled:bg-gray-50 disabled:cursor-not-allowed " 
                                    @focus="showItems = true"
                                    @focusout="interval()"
                                    @click="showItems = true, filterCourse()"
                                    @keyup="filterCourse()"
                                    onkeydown="return /[a-z, ]/i.test(event.key)"
                                    title="Click Edit to modify details"/>
                            <div v-if="showItems" class="relative">
                                <div :class=" Object.keys(filteredCourse).length > 1? 'w-full border p-2 flex flex-col rounded-md shadow-sm h-40 absolute bg-white z-10 overflow-auto ':
                                            'w-full border p-2 flex flex-col rounded-md shadow-sm h-auto absolute bg-white z-10 overflow-auto '
                                            ">
                                    <div v-if="Object.keys(filteredCourse).length" v-for="(c, index) in filteredCourse" @click="searchCourse=c.prog_name,courseId=c.prog_id, paginate('course')"  class="p-2 hover:bg-gray-100 cursor-pointer" >
                                        <p class="text-xs" >{{  c.prog_name  }}</p>
                                    </div>
                                    <div v-else class="p-2 hover:bg-gray-100 cursor-pointer"  @click="search='',courseId=''">
                                        <p class="text-xs">No Data Found</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-1">
                        <div class="bg-gray-100 p-2 flex items-center">
                            <p class="text-xs font-semibold">Name</p>
                        </div>
                        <div class="bg-gray-100 p-2 flex items-center">
                            <p class="text-xs font-semibold">Program / Course / Level / Quarter</p>
                        </div>
                        <div class="bg-gray-100 p-2 flex items-center">
                            <p class="text-xs font-semibold">Action / Details</p>
                        </div>
                        
                    </div>
                    <div v-if="Object.keys(student).length" v-for="(s, index) in student" class="border rounded-md shadow-md p-2 grid grid-cols-3 gap-1">
                        <div class="p-2 flex flex-col items-center justify-center">
                            <div class="flex items-center w-full justify-center">
                                <img :src="s.per_profile? 'http://localhost:8000/storage/profiles/'+s.per_profile:'/img/profile_default.png'" class="h-24 w-24 object-fit border-2 border-gray-300"/>
                            </div>
                            <div class="p-2 flex flex-col items-center w-full justify-center text-center">
                                <p class="text-xs">{{ s.per_firstname }} {{ s.per_middlename }} {{ s.per_lastname }} {{ s.per_suffixname }}</p> 
                                <p class="text-xs font-semibold">0123-456-789</p> 
                            </div>
                        </div>
                        
                        <div class="border rounded-md p-2 flex flex-col items-center">
                            <select class="border-0 h-full p-2 text-xs w-full appearance-none pointer-events-none" v-model="s.enr_program" :id="index+'program'">
                                <option v-for="(p, index) in program" :value="p.dtype_id">{{ p.dtype_desc }}</option>
                            </select>
                            <select class="border-0 h-full p-2 text-xs w-full appearance-none pointer-events-none" v-model="s.enr_course" :id="index+'course'">
                                <option v-for="(c, index) in course" :value="c.prog_id">{{ c.prog_code }}</option>
                            </select>
                            <select class="border-0 h-full p-2 text-xs w-full appearance-none pointer-events-none" v-model="s.enr_gradelvl" :id="index+'gradelvl'">
                                <option v-for="(g, index) in gradelvl" :value="g.grad_id">{{ g.grad_name }}</option>
                            </select>
                            <select class="border-0 h-full p-2 text-xs w-full appearance-none pointer-events-none" v-model="s.enr_quarter" :id="index+'quarter'">
                                <option v-for="(q, index) in quarter" :value="q.quar_id">{{ q.quar_desc }}</option>
                            </select>
                        </div>
                        <div class="border rounded-md p-2 flex flex-col gap-1 items-center">
                            <form v-if="showLink && index==linkId" @submit.prevent="upload(s.per_id)" method="post" enctype="multipart/form-data">
                                <input type="file" :id="index" class="hidden" @change="handleImage" >
                                <button type="submit" class="disabled:cursor-wait disabled:bg-blue-300 bg-blue-500 p-2 h-full text-xs text-white hover:bg-blue-400 w-full" :disabled="holdSubmit? true:false">Upload Photo</button>
                            </form>
                            <p v-if="showLink && index==linkId" class="text-xs">{{ image.name }}</p>

                            <label @click="showLink = !showLink, linkId = index " :for="index" class="cursor-pointer bg-emerald-500 p-2 h-full text-xs text-white hover:bg-emerald-400 w-full text-center">Add Picture</label>
                            <button @click="showTaggingsModal(s, index)" class="bg-teal-500 p-2 h-full text-xs text-white hover:bg-teal-400 w-full">Taggings</button>
                            <button @click="showPrintForm(s)" class="bg-cyan-500 p-2 h-full text-xs text-white hover:bg-cyan-400 w-full">Forms</button>
                            <button class="bg-red-500 p-2 h-full text-xs text-white hover:bg-red-400 w-full">Drop Student</button>
                            
                        </div>
                        
                    </div>
                    <div v-else class="border rounded-md shadow-md p-2 text-center gap-1">
                        <p class="text-xs">No Students Found</p>
                    </div>
                    <div class="py-2 flex items-center justify-between">
                        <div class="flex gap-2 ">
                            <button :disabled="offset == 0? true:false" @click="paginate('prev')" class="disabled:bg-gray-300 bg-gray-500 px-4 py-1 text-xs text-white rounded-md hover:bg-gray-400">Prev</button>
                            <button :disabled="Object.keys(student).length < offset || Object.keys(student).length < 10? true:false" @click="paginate('next')"class="disabled:bg-gray-300 bg-gray-600 px-4 py-1 text-xs text-white rounded-md hover:bg-gray-400">Next</button>
                        </div>
                        <p class="text-xs">showing total of <span class="font-semibold">({{ studentCount }})</span> items</p>
                    </div>
                </div>
                

                

            </div>
        </div>
    </div>
    
</template>
