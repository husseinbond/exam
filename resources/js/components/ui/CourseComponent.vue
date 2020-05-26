
<template>

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
