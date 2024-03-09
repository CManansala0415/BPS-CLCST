import axios from 'axios';

let curriculum = {}
const getCurriculum = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-curriculum/',
        }).then(async (results) => {
            // console.log(results.data)
            curriculum = results.data
        })
        return curriculum
    }catch(err){
        return 500
    }
}


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

let response = {}
const addCurriculum = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-curriculum/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
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


export {
    addCurriculum,
    getCurriculum,
    getProgram,
    getQuarter,
    getProgramList,
    getGradelvl,
    getSubject
}