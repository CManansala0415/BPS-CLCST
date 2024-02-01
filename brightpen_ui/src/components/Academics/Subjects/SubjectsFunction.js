import axios from 'axios';

let subjects = {}
const getSubjects = async (type) => {
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
    getSubjects
}