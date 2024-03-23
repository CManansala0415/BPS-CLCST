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
export {
    getStudent,
    getStudentByCourse,
    getQuarter,
    getGradelvl,
    getProgram,
    getProgramList,
    uploadProfile,
    uploadLink
}