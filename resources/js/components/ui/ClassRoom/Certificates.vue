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
                              
                              <router-link class="btn_2 text-uppercase" :to="'/introexam/'+event.course.id">start Exam</router-link>
                               <a class="btn_2 text-uppercase" :to="'/Certificates/'+event.course.id" v-if="event.course.certificate.result == 100">my Certificates</a>
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
       axios.get('/getcertificate')
  .then((res) => {
                    this.events = res

                    
                })
}


        },

    created() {
        
        this.tel();
            },

        
       
    }
</script>
