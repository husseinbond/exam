<template>

 <section class="blog_area single-post-area section_padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
               <div class="single-post">
<div class="vi">
<router-link class="btn_2 text-uppercase" :to="'/myLesson/'+events.lesson_id">back to lesson</router-link>
</div>
                  <div class="feature-img">
<h2>{{events.name}}
</h2>
 <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
    <iframe class="embed-responsive-item" :src="'https://www.youtube.com/embed/'+events.Link" allowfullscreen></iframe>
  </div>
                  </div>
                  <div class="blog_details">
                     <h2>{{events.note}}
                     </h2>
                
            
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
                slug:0,
                slugs:0,
                  events:[],
          success:false
              
            }
        },
    
        methods:{
       
         

tel(){
       axios.get('/videoroom/'+this.slug)
  .then((res) => {
                    this.events = res.data.data
this.slugs = res.data.slug
                    
                })
}


        },

    created() {
        this.slug = this.$route.params.slug;
        
        this.tel();
            },

        
       
    }
</script>
