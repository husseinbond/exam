<template>

  <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-10">

    <div >
        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list" >
      <div v-if="events.length > 0">
                                        <li class="dd-item" v-for="event in events" :key="event.id" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div >{{event.name}} 
                                                
                                                </div>
                                                <div class="dd-nodrag btn-group ml-auto">
                                                    
                                                 
                                                    <button class="btn btn-sm btn-outline-light" @click="deleted(event.id)">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>

                                                     <button class="btn btn-sm btn-outline-light" @click="admin(event.id)" v-if="event.admin == 0">
                                                        Add admin
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
      </div>

  <div class="card" v-else>
                                       
                                        <div class="card-body">
                                         
        <h5 class="card-header">we havent users</h5>

</div>

</div>
 
                                        </ol>
    
   

 
         </div>

</div>
</div>

</div>                              




     
    </div>
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
       
        
deleted(id){
    this.succ = false;
axios.post('/deleteUser/'+id).then(
    this.success = true,
this.tel()


 );




},


admin(id){
    this.succ = false;
axios.post('/addadmin/'+id).then(
    this.success = true,
this.tel()


 );




},



tel(){
  
       axios.get('/users')
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



