<template>
    
      <router-view></router-view>
    
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
axios.post('./deleteUser/'+id).then(
    this.success = true,
this.tel()


 );




},


admin(id){
    this.succ = false;
axios.post('./addadmin/'+id).then(
    this.success = true,
this.tel()


 );




},






        },

    created() {
        this.tel();
            },

        
       
    }
</script>
