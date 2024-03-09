import axios from 'axios';



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
const getApplicant = async () => {

    try{
        await axios({
            method: "GET",
            url: 'api/get-applicant/',
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


export {
    addApplicant,
    getApplicant,
    getGender,
    getNationality,
    getCivilStatus,
    getRegion,
    getProvince,
    getCity,
    getBarangay,
    getQuarter,
    getFamily,
    getAward,
    getAttainment
}