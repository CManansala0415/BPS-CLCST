import { createRouter, createMemoryHistory, createWebHashHistory } from "vue-router";
import Home from '../components/Dashboard/Home.vue';
import Academics from '../components/Academics/Academics.vue';
const routes = [
     
    {
        path: '/', name:'Login', component: () => import("../components/Login.vue")
    },
    {
        path: '/home', name:'Home', component: Home
    },
    {
        path: '/academics', name:'Academics', component: Academics
    },
];


const router = createRouter({
    history:createWebHashHistory(),
    routes
})

export default router;