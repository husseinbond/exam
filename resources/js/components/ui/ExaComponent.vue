<template>
    
   <section class="special_cource padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <p>popular courses</p>
                        <h2>Special Courses</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4" v-for="event in events.data" :key="event.id">
                    <div class="single_special_cource">
                        <a :href="'/course/'+event.id">      <img  :src="event.image" class="special_img" alt=""></a>
                        <div class="special_cource_text">
                           <a :href="'/course/'+event.id" class="btn_4">{{event.title}}</a>
                          
                           <h4 v-if="event.selected == 1">{{event.price}}</h4>
                            <h4 v-else>free</h4>
                         <a  :href="'/course/'+event.id"><h3>{{event.title}}</h3></a>
                            <p>{{event.introduction}}</p>
                        </div>

                    </div>
                </div>
               
              
            </div>
        </div>
        <pagination :data="events" @pagination-change-page="getResults"></pagination>
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
       
             getResults(page = 1) {
			axios.get('/sendcourses?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },




tel(){
       axios.get('/sendcourses')
  .then((res) => {
                    this.events = res.data.data

                    
                })
}


        },

    created() {
        this.tel();
            },

        
       
    }
</script>
