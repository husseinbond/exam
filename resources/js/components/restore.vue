<template>
    <div >
        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list"  v-if="events.data.length > 0">
                                        <li class="dd-item" v-for="event in events.data" :key="event.id" data-id="13">
                                                          <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div > {{event.title}} </div>
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
                                        </ol>

<div class="card" v-else>
                                       
                                        <div class="card-body">
                                         
        <h5 class="card-header">we havent lesson</h5>

</div>

</div>



      <pagination :data="events" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                
                  events:{},
          success:false
              
            }
        },
    
        methods:{
          getResults(page = 1) {
			axios.get('/trashedC?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },
restore(id){
    this.succ = false;
axios.post('/restoreC/'+id).then((response)=>{
    this.success = true;
this.tel()



})
},

        
deleted(id){
    this.succ = false;
axios.post('/hdeleteC/'+id).then(
    this.success = true,
this.tel()


 );




},

tel(){
       axios.get('/trashedC')
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



