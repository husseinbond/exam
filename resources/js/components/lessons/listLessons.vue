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
                                                <div >{{event.name}} </div>

                                                
                                                <div class="dd-nodrag btn-group ml-auto">
                                                
                                              <router-link :to="'/EditLesson/'+event.id" class="btn btn-sm btn-outline-light">Edit</router-link>
                                                    <button class="btn btn-sm btn-outline-light" @click="deleted(event.id)">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
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
      
         
           this.tel();
            },

        data(){
            return {
               
                  events:[],
          success:false
              
            }
        },
    
        methods:{
          getResults(page = 1) {
			axios.get('/getlessons?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },
        
deleted(id){
    this.succ = false;
axios.post('/softLes/'+id).then(
    this.success = true,
this.tel()


 );




},

tel(){
       axios.get('/getlessons')
  .then((res) => {
                    this.events = res.data.data

                    
                })
}


        },

  

        
       
    }
</script>



