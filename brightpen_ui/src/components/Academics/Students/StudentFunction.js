import axios from 'axios';

let gradelvl = {}
const getGradelvl = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-gradelvl/',
        }).then(async (results) => {
            // console.log(results.data)
            gradelvl = results.data
        })
        return gradelvl
    }catch(err){
        return 500
    }
}

let program = {}
const getProgram = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-program/',
        }).then(async (results) => {
            // console.log(results.data)
            program = results.data
        })
        return program
    }catch(err){
        return err
    }
}

let quarter = {}
const getQuarter = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-quarter/',
        }).then(async (results) => {
            // console.log(results.data)
            quarter = results.data
        })
        return quarter
    }catch(err){
        return err
    }
}

let programlist = {}
const getProgramList = async () => {
    
    try{
        await axios({
            method: "GET",
            url: 'api/get-program-list/',
        }).then(async (results) => {
            // console.log(results.data)
            programlist = results.data
        })
        return programlist
    }catch(err){
        return err
    }
}

let enrollment = {}
const getEnrollment = async (id) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-enrollment/'+id,
        }).then(async (results) => {
            // console.log(results.data)
            enrollment = results.data
        })
        return enrollment
    }catch(err){
        return err
    }
} 

let student = {}
const getStudent = async (limit, offset, id) => {
    let search = id
    if(!id){
        search = 204
    }
    try{
        await axios({
            method: "GET",
            url: 'api/get-student/'+limit+'/'+offset+'/'+search,
        }).then(async (results) => {
            // console.log(results.data)
            student = results.data
        })
        return student
    }catch(err){
        return err
    }
}

let studentbycourse = {}
const getStudentByCourse = async (limit, offset, id) => {
    let search = id
    if(!id){
        search = 204
    }
    try{
        await axios({
            method: "GET",
            url: 'api/get-student-by-course/'+limit+'/'+offset+'/'+search,
        }).then(async (results) => {
            // console.log(results.data)
            studentbycourse = results.data
        })
        return studentbycourse
    }catch(err){
        return err
    }
}

let uploadprofile = {}
const uploadProfile = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/upload-profile/',
            data:data

        }).then(async (results) => {
            uploadprofile = results.data
        })
        return uploadprofile
    }catch(err){
        return 500
    }
}

let uploadlink = {}
const uploadLink = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/upload-link/',
            data:data

        }).then(async (results) => {
            uploadlink = results.data
        })
        return uploadlink
    }catch(err){
        return 500
    }
}

let curriculum = {}
const getCurriculum = async (prog, type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-curriculum-student/'+prog+'/'+type,
        }).then(async (results) => {
            // console.log(results.data)
            curriculum = results.data
        })
        return curriculum
    }catch(err){
        return 500
    }
}

let subjects = {}
const getSubject = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-subject/',
        }).then(async (results) => {
            // console.log(results.data)
            subjects = results.data
        })
        return subjects
    }catch(err){
        return 500
    }
}

let currsubj = {}
const getCurriculumSubject = async (curr) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-curriculum-subject/'+curr,
        }).then(async (results) => {
            // console.log(results.data)
            currsubj = results.data
        })
        return currsubj
    }catch(err){
        return 500
    }
}

let section = {}
const getSection = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-section/',
        }).then(async (results) => {
            // console.log(results.data)
            section = results.data
        })
        return section
    }catch(err){
        return 500
    }
}

let milestone = {}
const getMilestone = async (id) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-milestone/'+id,
        }).then(async (results) => {
            // console.log(results.data)
            milestone = results.data
        })
        return milestone
    }catch(err){
        return 500
    }
}

let addmilestone = {}
const addMilestone = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-milestone/',
            data:data

        }).then(async (results) => {
            addmilestone = results.data
        })
        return addmilestone
    }catch(err){
        return 500
    }
}

let updateenrollment = {}
const updateEnrollment = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/update-enrollment/',
            data:data

        }).then(async (results) => {
            updateenrollment = results.data
        })
        return updateenrollment
    }catch(err){
        return 500
    }
}

let updatemilestone = {}
const updateMilestone = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/update-milestone/',
            data:data

        }).then(async (results) => {
            updatemilestone = results.data
        })
        return updatemilestone
    }catch(err){
        return 500
    }
}

export {
    getStudent,
    getStudentByCourse,
    getQuarter,
    getGradelvl,
    getProgram,
    getProgramList,
    uploadProfile,
    uploadLink,
    getCurriculum,
    getSubject,
    getSection,
    getCurriculumSubject,
    getEnrollment,
    getMilestone,
    addMilestone,
    updateEnrollment,
    updateMilestone
}