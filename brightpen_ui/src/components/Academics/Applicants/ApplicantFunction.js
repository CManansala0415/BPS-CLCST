import axios from 'axios';

let updateResponse = {}
const updateApplicant = async (data, type) => {
    try{
        if(type == 1){// 1 means update, 2 means delete
            await axios({
                method: "POST",
                url: 'api/update-applicant/',
                data:data
    
            }).then(async (results) => {
                updateResponse = results.data
            })
        }else{
            await axios({
                method: "POST",
                url: 'api/delete-applicant/',
                data:data
    
            }).then(async (results) => {
                updateResponse = results.data
            })
        }
        return updateResponse
    }catch(err){
        return 500
    }
    
}

let enroll = {}
const enrollApplicant = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/enroll-applicant/',
            data:data

        }).then(async (results) => {
            enroll = results.data
        })
        return enroll
    }catch(err){
        return 500
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

let response = {}
const addApplicant = async (data, type) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-applicant/'+type,
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}

let applicant = {}
const getApplicant = async (limit, offset, id) => {
    let search = id
    if(!id){
        search = 204
    }
    try{
        await axios({
            method: "GET",
            url: 'api/get-applicant/'+limit+'/'+offset+'/'+search,
        }).then(async (results) => {
            // console.log(results.data)
            applicant = results.data
        })
        return applicant
    }catch(err){
        return err
    }
}

let gender = {}
const getGender = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-gender/',
        }).then(async (results) => {
            // console.log(results.data)
            gender = results.data
        })
        return gender
    }catch(err){
        return err
    }
}

let nationality = {}
const getNationality = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-nationality/',
        }).then(async (results) => {
            // console.log(results.data)
            nationality = results.data
        })
        return nationality
    }catch(err){
        return err
    }
}

let civilstatus = {}
const getCivilStatus = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-civilstatus/',
        }).then(async (results) => {
            // console.log(results.data)
            civilstatus = results.data
        })
        return civilstatus
    }catch(err){
        return err
    }
}

let region = {}
const getRegion = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-region/',
        }).then(async (results) => {
            // console.log(results.data)
            region = results.data
        })
        return region
    }catch(err){
        return err
    }
}

let province = {}
const getProvince = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-province/',
        }).then(async (results) => {
            // console.log(results.data)
            province = results.data
        })
        return province
    }catch(err){
        return err
    }
}

let city = {}
const getCity = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-city/',
        }).then(async (results) => {
            // console.log(results.data)
            city = results.data
        })
        return city
    }catch(err){
        return err
    }
}

let barangay = {}
const getBarangay = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-barangay/',
        }).then(async (results) => {
            // console.log(results.data)
            barangay = results.data
        })
        return barangay
    }catch(err){
        return err
    }
}

let family = {}
const getFamily = async (personid) => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-family/'+personid,
        }).then(async (results) => {
            // console.log(results.data)
            family = results.data
        })
        return family
    }catch(err){
        return err
    }
}

let award = {}
const getAward = async (personid) => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-award/'+personid,
        }).then(async (results) => {
            // console.log(results.data)
            award = results.data
        })
        return award
    }catch(err){
        return err
    }
}

let attainment = {}
const getAttainment = async (personid) => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-attainment/'+personid,
        }).then(async (results) => {
            // console.log(results.data)
            attainment = results.data
        })
        return attainment
    }catch(err){
        return err
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





export {
    updateApplicant,
    enrollApplicant,
    getEnrollment,
    addApplicant,
    getApplicant,
    getGender,
    getNationality,
    getCivilStatus,
    getRegion,
    getProvince,
    getCity,
    getBarangay,
    getFamily,
    getAward,
    getAttainment,
    getGradelvl,
    getProgram,
    getProgramList,
    getQuarter,
}