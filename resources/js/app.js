/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import hello from './components/hello'
import createcourses from './components/createcourses'
import ourCourses from './components/ourCourses'
import list from './components/list'
import { Form, HasError, AlertSuccess } from 'vform'
import editCourses from './components/editCourses'

import restore from './components/restore'
import lessons from './components/lessons/listLessons'
import ourLessons from './components/lessons/ourLessons'
import createLesson from './components/lessons/createLessons'
import Createvideo from './components/lessons/videos/createVideo'
import restoreLes from './components/lessons/restoreLessons'
import editLessons from './components/lessons/editLessons'

import Certificates from './components/ui/ClassRoom/Certificates'
import restoreVideo from './components/lessons/videos/restoreVideo'
import editvideo from './components/lessons/videos/editvideo'
import listvideo from './components/lessons/videos/listvideo'
import ourVideo from './components/lessons/videos/ourVideo'
import listuser from './components/users/listusers'
import ourQuestion from './components/lessons/questions/ourQuestion'
import editQuestion from './components/lessons/questions/editQuestion'
import createQuestion from './components/lessons/questions/createQuestion'
import listQuestion from './components/lessons/questions/listQuestion'
import restoreQuestion from './components/lessons/questions/restoreQuestion'

import admins from './components/users/admins'
import exam from './components/ui/ClassRoom/exam'
import introexam from './components/ui/ClassRoom/introexam'
import LessonComponent from './components/ui/ClassRoom/LessonComponent'
import ClassComponent from './components/ui/ClassRoom/ClassComponent'
import videoRoom from './components/ui/ClassRoom/VideoRoom'
import RadialProgressBar from 'vue-radial-progress'
import quizComponent from './components/ui/ClassRoom/quizComponent'
import introtest from './components/ui/ClassRoom/introtest'
window.Vue = require('vue');

window.Form = Form;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.use(VueRouter)

Vue.component('pagination', require('laravel-vue-pagination'));

const routes = [


  
 
   
    { path: '/ourCourses', component: ourCourses, name: 'ourCourses', redirect: '/list'  ,children: [
      { path: '/list', component: list, name: 'list' },
      { path: '/restore', component: restore, name: 'restore' },
      { path: '/createcourses', component: createcourses, name: 'createcourses', },
      { path: '/editCourses/:id', component: editCourses, name: 'editCourses', },
    ]},
  

    
   
    { path: '/ourLessons', component:ourLessons, name: 'ourLessons', redirect: '/lessons',children: [
      { path: '/lessons', component: lessons, name: 'lessons' },
        { path: '/createLesson', component: createLesson, name: 'createLesson' },
       
        { path: '/restoreLessons', component: restoreLes, name: 'restoreLes' },
        { path: '/EditLesson/:id', component: editLessons, name: 'editLessons' },
    ]},

    
 
    
    { path: '/listuser', component: listuser, name: 'listuser' },
    
    { path: '/admins', component: admins, name: 'admins' },

    { path: '/ourQuestion', component:ourQuestion, name: 'ourQuestion', redirect: '/listQuestion',children: [
       
      { path: '/listQuestion', component: listQuestion, name: 'listQuestion' },
      
      { path: '/createQuestion', component: createQuestion, name: 'createQuestion' },
      { path: '/restoreQuestion', component: restoreQuestion, name: 'restoreQuestion' },
      { path: '/editQuestion/:id', component: editQuestion, name: 'editQuestion' },
    ]},
    


       

        
     
     
      { path: '/ourVideo', component:ourVideo, name: 'ourVideo', redirect: '/Listvideo',children: [
       
        { path: '/restoreVideo', component: restoreVideo, name: 'restoreVideo' },
        
        { path: '/Createvideo', component: Createvideo, name: 'Createvideo' },
        { path: '/Listvideo', component: listvideo, name: 'Listvideo' },
        { path: '/editvideo/:id', component: editvideo, name: 'editvideo' },
      ]},
      
      
      { path: '/exam/:id', component: exam, name: 'exam' },
      { path: '/introexam/:id', component: introexam, name: 'introexam' },

      { path: '/quiz/:id', component: quizComponent, name: 'quizComponent' },
      { path: '/myLesson/:id', component: LessonComponent, name: 'LessonComponent' },
      { path: '/mycourses', component: ClassComponent, name: 'ClassComponent' },
      { path: '/myCertificates', component: Certificates, name: 'Certificates' },
      { path: '/videoroom/:slug', component: videoRoom, name: 'VideoRoom' },
      { path: '/introtest/:id', component: introtest, name: 'introtest' }
]


const router = new VueRouter({
    routes,
    
})







// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('exa-component', require('./components/ui/ExaComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    RadialProgressBar
    
});
