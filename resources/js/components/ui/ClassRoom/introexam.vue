
<template>

 <section class="blog_area section_padding">
        <div class="container">
            <div class="row">
             
                       
                       <div >
                       
<div class="vi">
    <div class="card" >
                                        <h2 class="card-header">test</h2>
                                        <div class="card-body">
                                        <div class="container">
<p>
you in Tests in Print, you are referred to the appropriate volume of Mental ... Descriptions of each test are followed by critical reviews and references to studies
</p>

    </div>
   <router-link class="btn_2 text-uppercase" :to="'/exam/'+this.id">Start exams</router-link>
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
                id:0,
                  events:[],
          success:false
              
            }
        },
  





        

    created() {
        this.id = this.$route.params.id;
       
            },

        
       
    }
</script>
