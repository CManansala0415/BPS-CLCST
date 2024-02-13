import axios from 'axios';

let classroom = {}
const getClassroom = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-classroom/',
        }).then(async (results) => {
            // console.log(results.data)
            classroom = results.data
        })
        return classroom
    }catch(err){
        return 500
    }
}
let roomtype = {}
const getRoomType = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-roomtype/',
        }).then(async (results) => {
            // console.log(results.data)
            roomtype = results.data
        })
        return roomtype
    }catch(err){
        return 500
    }
}
let buildingtype = {}
const getBuildingType = async (type) => {
    try{
        await axios({
            method: "GET",
            url: 'api/get-buildingtype/',
        }).then(async (results) => {
            // console.log(results.data)
            buildingtype = results.data
        })
        return buildingtype
    }catch(err){
        return 500
    }
}

let response = {}
const saveClassroom = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/save-classroom/',
            data:data

        }).then(async (results) => {
            response = results.data
        })
        return response
    }catch(err){
        return 500
    }
}
const addClassroom = async (data) => {
    try{
        await axios({
            method: "POST",
            url: 'api/add-classroom/',
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
    getClassroom,
    getRoomType,
    getBuildingType,
    saveClassroom,
    addClassroom
}