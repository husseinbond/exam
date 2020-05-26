<template>



    <div >
   

     
     

  <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header" id="top">
                                
                         



        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list" v-if="events.data.length > 0">
  

                                        <li class="dd-item"  v-for="event in events.data" :key="event.id" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div >{{event.question}} </div>

                                                
                                                <div class="dd-nodrag btn-group ml-auto">
                                                
                                              <router-link :to="'/editQuestion/'+event.id" class="btn btn-sm btn-outline-light">Edit & add answer</router-link>


                                                    <button class="btn btn-sm btn-outline-light" @click="deleted(event.id)">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="container">
  <div class="row">
                                    <div class="section-block" id="buttons">
                                     
                                        
                                    </div>
                                    <div class="card">
                                        <h5 class="card-header">Answers</h5>
                                        <div class="card-body">
                                        <div class="container">
                                          <div class="row">
                                         <div v-for="eve in event.answer" :key="eve.id">
  <a href="#" v-if="eve.flag == 1" class="btn btn-success">{{eve.answer}} <i class="far fa-trash-alt" @click="deans(eve.id)"  ></i></a>
                                            <a href="#" v-if="eve.flag == 2" class="btn btn-danger">{{eve.answer}}   <i class="far fa-trash-alt" @click="deans(eve.id)"  ></i></a>
                            
</div>
</div>

</div>

</div>

</div>

</div>
                                            </div>

   </div>

                                        </li>
      <pagination :data="events" @pagination-change-page="getResults"></pagination>
                                        </ol>
<div class="card" v-else>
                                       
                                        <div class="card-body">
                                         
        <h5 class="card-header">we havent lesson</h5>

</div>

</div>


                    </div>
                </div>
            </div>
 </div>


     
   
</template>

<script>




    export default {

  created() {
      
         this.id = this.$route.params.id;
           this.tel();
            },

        data(){
            return {
                  id:0,
                  events:{},
          success:false
              
            }
        },
    
        methods:{

deans(id){
  axios.post('/deleteans/'+id
).then((response)=>{
    this.success = true;
 this.tel()
})
},


          getResults(page = 1) {
			axios.get('/getqu?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },
        
deleted(id){
    this.succ = false;
axios.post('/softquestion/'+id).then(
    this.success = true,
this.tel()


 );




},

tel(){
       axios.get('/getqu')
  .then((res) => {
                    this.events = res.data.data

                    
                })
}


        },

  

      
      

       
    }
</script>



