<template>
    
 <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                     
                    </div>
                    <div class="content_wrapper">
                      
                    <div v-for="event in events" :key="event.id">



                        <h4 class="title">{{event.course.title}}</h4>
                        <div class="content">
                            <ul class="course_list">
                                <li class="justify-content-between align-items-center d-flex" v-for="eve in event.course.lessons" :key="eve.id">
                                    <h5>{{eve.name}}</h5>
                                  <router-link class="btn_2 text-uppercase" :to="'/myLesson/'+eve.id">Start Lesson</router-link>
                                  
                                </li>
                              <router-link class="btn_2 text-uppercase" :to="'/introexam/'+event.course.id">start Exam</router-link>
                           
                            </ul>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>

             

</div>
              
            </div>
       
    </section>

</template>

<script>
    export default {
        data(){
            return {
                
                  events:[],
          success:false
              
            }
        },
    
        methods:{
       
        



tel(){
       axios.get('/getdatainMyClassRoom')
  .then((res) => {
                    this.events = res.data[1]

                    
                })
}


        },

    created() {
        
        this.tel();
            },

        
       
    }
</script>
