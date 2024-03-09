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
            console.log(results.data)
            program = results.data
        })
        return program
    }catch(err){
        return err
    }
}

let response = {}
const saveGradelvl = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-gradelvl/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addGradelvl = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-gradelvl/',
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
    getGradelvl,
    saveGradelvl,
    addGradelvl,
    getProgram
}