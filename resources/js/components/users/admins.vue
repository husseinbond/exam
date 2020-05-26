<template>
    <div >
          <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-10">

        <div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

  <ol class="dd-list" v-if="events.data.length > 0">
                                        <li class="dd-item" v-for="event in events.data" :key="event.id" data-id="13">
                                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                                <div ><a  >{{event.name}} </a></div>
                                                <div class="dd-nodrag btn-group ml-auto">
                                                    
                                                    
                                                    <button class="btn btn-sm btn-outline-light" @click="remove(event.id)">
                                                       remove Admin
                                                    </button>

                                                     
                                                </div>
                                            </div>
                                        </li>
                                        </ol>


   <div class="card" v-else>
                                       
                                        <div class="card-body">
                                         
        <h5 class="card-header">we havent admins</h5>

</div>

</div>


      <pagination :data="events" @pagination-change-page="getResults"></pagination>
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
                
                  events:{},
          success:false
              
            }
        },
    
        methods:{
      



remove(id){
    this.succ = false;
axios.post('/removeAdmin/'+id).then(
    this.success = true,
this.tel()


 );




},



tel(){
       axios.get('/getadmins')
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



