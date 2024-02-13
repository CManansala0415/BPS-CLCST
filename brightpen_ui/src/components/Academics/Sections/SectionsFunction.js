import axios from 'axios';

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

let response = {}
const saveSection = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-section/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addSection = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-section/',
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
    getSection,
    saveSection,
    addSection
}