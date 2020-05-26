<template>
    <div >
        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list" v-if="events.data.length > 0"  >
                                        <li class="dd-item" v-for="event in events.data" :key="event.id" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div >{{event.title}}</div>
                                                <div class="dd-nodrag btn-group ml-auto">
                                                    
                                                    <router-link :to="'/editCourses/'+event.id" class="btn btn-sm btn-outline-light">Edit</router-link>
                                                    <button class="btn btn-sm btn-outline-light" @click="deleted(event.id)">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        </ol>


   <div class="card" v-else>
                                       
                                        <div class="card-body">
                                         
        <h5 class="card-header">we havent courses</h5>

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
			axios.get('/indexCOUR?page=' + page)
				.then(response => {
                    
              this.events =  response.data.data
                });
                





        },
        
deleted(id){
    this.succ = false;
axios.post('/deleteTC/'+id).then(
    this.success = true,
this.tel()


 );




},

tel(){
       axios.get('/indexCOUR')
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



