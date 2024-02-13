import axios from 'axios';

let department = {}
const getDepartment = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-department/',
        }).then(async (results) => {
            // console.log(results.data)
            department = results.data
        })
        return department
    }catch(err){
        return 500
    }
}

let response = {}
const saveDepartment = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-department/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addDepartment = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-department/',
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
    getDepartment,
    saveDepartment,
    addDepartment
}