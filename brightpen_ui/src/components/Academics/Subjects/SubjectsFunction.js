import axios from 'axios';

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

let response = {}
const saveSubject = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-subject/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addSubject = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-subject/',
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
    getSubject,
    saveSubject,
    addSubject
}