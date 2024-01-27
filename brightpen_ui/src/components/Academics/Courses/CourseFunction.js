import axios from 'axios';

let degree = {}
const getDegree = async (type) => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-degree/'+type,
        }).then(async (results) => {
            // console.log(results.data)
            degree = results.data
        })
        return degree
    }catch(err){
        return err
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

let semester = {}
const getSemester = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-semester/',
        }).then(async (results) => {
            // console.log(results.data)
            semester = results.data
        })
        return semester
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


let status = ''
const saveCollegeForm = async (data) => {

    try{
        await axios({
            method: "POST",
            url: 'api/save-course-college/',
            data:data
        }).then(async (results) => {
            // console.log(results.data)
            status = results.data
        })
        return status
    }catch(err){
        return err
    }
}



export {
    getDegree,
    getProgram,
    getQuarter,
    getSemester,
    getProgramList,
    saveCollegeForm
}