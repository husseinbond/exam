
<template>
<div>
<div class="special_cource padding_top"  v-if="this.result">
		 <div class="row justify-content-center">
            <div class="col-xl-5">
	
				

    
						<div class="vato">
                            <div class="space">
<div class="progress">
   <div class="progress-bar" role="progressbar" :style="{ width: result + '%' }" :aria-valuenow="result" aria-valuemin="0" aria-valuemax="100">{{this.result}}</div>


</div>
				
       <h3 class="text-success" v-if="this.result >= 50">You passed the test</h3>
<h3 class="text-danger" v-else>you Didn't pass the test</h3>         
                
                		</div>
					</div>
                    </div>
		</div>
						</div>


 <section class="special_cource padding_top"  v-if="!this.result">
     <div class="row justify-content-center">
            <div class="col-xl-5">
 
 <div v-if="this.true" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
                   
        <div class="container">
            <div class="row">

                       <div class="vito">

                     
            
            <div class="space">
        <h3 v-if="this.answert" class="text-dark">The correct answer is</h3>        <h3 class="text-success" v-if="this.answert"> {{this.answert}}</h3>
<button class="btn_2 text-uppercase" @click="tel()" v-if="this.nextpage">Next Question</button>
            </div>
    <div class="card" v-if="!this.nextpage  && events.type == 1  && this.answert !== null" >

                                        <h2 class="card-header">Question</h2>
                                        <div class="card-body">
                                        <div class="container">
                                            <div class="vi">
<h3>
{{events.question}}
</h3>
                                            </div>
    </div>

<div class="container" >
  <div class="row">
    <div class="col-sm" v-for="eve in events.answer" :key="eve.id" >
       <button class="btn_2 text-uppercase" @click="sub(eve.id)">{{eve.answer}}</button>


    </div>
       
   
    </div>
  
</div>








    </div>
</div>
  </div>
<div class="vito">


  <div class="card" v-if="!this.nextpage  &&  events.type == 2   && this.answert == null" >

                                        <h2 class="card-header">Question</h2>
                                        <div class="card-body">
                                        <div class="container">
                                            <div class="vi">
<h3>
{{events.question}}
</h3>
                                            </div>


    </div>


  <form v-on:submit.prevent="Correct(events.id)" enctype="multipart/form-data" >
<input type="text" v-model="Correcter" placeholder="Correct" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Correct'">
 <button type="submit" class="btn btn-success">Submit</button>
  </form>


</div>
 </div>

</div>


</div>
 </div>

</div>
</div>
    
    </section>
</div>
</template>

<script>




    export default {
        data(){
            return {
                nextpage:0,
                answert:'',
                id:0,

        done:false,

        
                true:false,
                  events:[],
          success:false,
              Correcter:''
            }
        },
    
        methods:{
       
         
tel(){
        this.true = false;
    this.nextpage = '';
    this.answert = '';
this.result = 0

       axios.get('/quiz/'+this.id)
  .then((res) => {
                            this.events = res.data.data
this.nextpage = res.data.nextpage
this.answert = res.data.answert
if(res.data.result)
{
   this.result =  res.data.result
}
                })
},



sub(id){
    this.true = false;
    this.nextpage = '';
    this.answert = '';
this.result = 0
       axios.post('/ChooseAnswer/'+id)
  .then((res) => {
                    this.events = res.data.data
this.nextpage = res.data.nextpage
this.answert = res.data.answert
if(res.data.true){
    this.true = true
}
                    
                })
},


Correct(id){

     let formData = new FormData();

        this.true = false;
    this.nextpage = '';
    this.answert = '';
    this.result = 0;
    formData.append('answer', this.Correcter);
axios.post('/CorrectAnswer/'+id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((res)=>{
     this.events = res.data.data
this.nextpage = res.data.nextpage
this.answert = res.data.answert
this.Correcter = ''
if(res.data.true){
    this.true = true
}




})

}




        },






    created() {
        this.id = this.$route.params.id;
        this.tel();
            },

        
       
    }
</script>
