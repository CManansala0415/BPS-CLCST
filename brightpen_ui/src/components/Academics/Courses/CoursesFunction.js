import axios from 'axios';

let degree = {}
const getDegree = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-degree/',
        }).then(async (results) => {
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
            console.log(results.data)
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
const getProgramList = async (id) => {
    
    try{
        await axios({
            method: "GET",
            url: 'api/get-program-list/'+id,
        }).then(async (results) => {
            // console.log(results.data)
            programlist = results.data
        })
        return programlist
    }catch(err){
        return err
    }
}

let response = {}
const saveProgram = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-program/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addProgram = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-program/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}



export {
    getDegree,
    getProgram,
    getQuarter,
    getSemester,
    getProgramList,
    saveProgram,
    addProgram
}