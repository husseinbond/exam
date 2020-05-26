
<template>

 <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                       
                       <div >
                       
<div class="vi">
    <div class="card" >
                                        <h2 class="card-header">Lesson {{events.name}}</h2>
                                        <div class="card-body">
                                        <div class="container">
<p>
{{events.introduction}}
</p>

    </div>
   
  </div>
</div>

</div>

                        <article class="blog_item" v-for="eve in events.video" :key="eve.id">
                            <div class="blog_item_img">
                              <router-link  :to="'/videoroom/'+eve.slug">     
                               <img class="card-img rounded-0" :src="eve.img" alt="">
                              </router-link>
                            </div>

                            <div class="blog_details">
                                <router-link class="d-inline-block" :to="'/videoroom/'+eve.slug">
                                    <h2>{{eve.name}}</h2>
                                </router-link>
                                <p>{{eve.note}}</p>
                            
                            </div>
                        </article>

                    
                     <router-link class="btn_2 text-uppercase" :to="'/introtest/'+this.id">quiz</router-link>

                      
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
                id:0,
                  events:[],
          success:false
              
            }
        },
    
        methods:{
       
             getResults(page = 1) {
			axios.get('/sendcourses?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },




tel(){
       axios.get('/Lessonzzz/'+this.id)
  .then((res) => {
                    this.events = res.data.data

                    
                })
}


        },

    created() {
        this.id = this.$route.params.id;
        this.tel();
            },

        
       
    }
</script>
