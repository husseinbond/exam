<template>
    <div >




        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list" v-if="events.length > 0">
  

                                        <li class="dd-item"  v-for="event in events" :key="event.id" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div >{{event.question}} </div>

                                                
                                               <div class="dd-nodrag btn-group ml-auto">
                                                        <button class="btn btn-sm btn-outline-light" @click="restore(event.id)">
                                                        <i class="fas fa-undo-alt"></i>
                                                    </button>
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
            




     
   
</template>

<script>
    export default {
 created() {
         
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
          getResults(page = 1) {
			axios.get('/trashedquestion?page='+page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },
restore(id){
    this.succ = false;
axios.post('/restorequestion/'+id).then((response)=>{
    this.success = true;
this.tel()



})
},

        
deleted(id){
    this.succ = false;
axios.post('/hdeletequestion/'+id).then(
    this.success = true,
this.tel()


 );




},

tel(){
       axios.get('/trashedquestion')
  .then((res) => {
                    this.events = res.data.data

                    
                })
}


        },

   
        
       
    }
</script>



