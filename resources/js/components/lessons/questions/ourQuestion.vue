<template>
    <div >
           <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-10">

                <div class="tab-regular">
                              
                 


                                   <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item">
                                           <router-link class="nav-link " id="home-tab" data-toggle="tab" to="/listQuestion" role="tab" aria-controls="home" aria-selected="true">list</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" id="profile-tab" data-toggle="tab" to="/restoreQuestion" role="tab" aria-controls="profile" aria-selected="false">Restore</router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link" id="tab-outline-three" to="/createQuestion" data-toggle="tab" href="#outline-three" role="tab" aria-controls="contact" aria-selected="false">createQuestion</router-link>
                                    </li>
                                </ul>
                           

                             </div>


 <div id="app">
<router-view></router-view>
 </div>
                    </div>
                    </div>
                    </div>
                    </div>
    </div>
</template>

<script>
    export default {

        mounted() {
        
         
        },


        data(){
            return {
                
                  id:0
              
            }
        },
      
        methods:{
          
            
        },
      
    }
</script>