<template>

  

                              <div>


 
             




      <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header" id="top">
                                
                               

<div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


     <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                 

                                <div class="card">
                                    <h5 class="card-header">Create Question</h5>
                                    <div class="card-body">
                                    <form v-on:submit.prevent="suba()" enctype="multipart/form-data">

                                      <div class="form-group">
                                                <label>Question</label>
                                                <input  v-model="Question" type="text" placeholder="Question" class="form-control">
                                              <span v-if="allerros.Question" :class="['label label-danger']">@{{ allerros.Question[0] }}</span>                                                                 
                                            </div>
                                          
                                             
                               
                 <div class="form-group">
            <label for="exampleFormControlTextarea1">type</label>
    <select  class="form-control"  id="exampleFormControlSelect1" v-model="type"  aria-placeholder="select type">
      <option :value="1" >Choose</option>
   <option :value="2" >Correct</option>
   <option :value="3" >Complete</option>
      
    </select>
<span v-if="allerros.type" :class="['label label-danger']">@{{ allerros.type[0] }}</span>
        </div>


        <div class="form-group">
            <label for="exampleFormControlTextarea1">course</label>
    <select  class="form-control" @click="tel(course_id)" id="exampleFormControlSelect1" v-model="course_id" aria-placeholder="select course" >
      <option  v-for="el in els" :key="el.id"  :value='el.id' >{{el.title}}</option>
   
      
    </select>
<span v-if="allerros.course_id" :class="['label label-danger']">@{{ allerros.course_id[0] }}</span>
        </div>



     <div class="form-group" v-if="vuls.length > 0">
         <label for="exampleFormControlTextarea1">lesson</label>
    <select  class="form-control" id="exampleFormControlSelect1" v-model="lesson_id"  aria-placeholder="select lesson">
      <option  v-for="vul in vuls" :key="vul.id"   :value='vul.id' >{{vul.name}}</option>
    
    
    </select>

        </div>
 <span v-if="allerros.lesson_id" :class="['label label-danger']">@{{ allerros.lesson_id[0] }}</span>

                      
                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </form>
                                    </div>
                                  

                                
                                </div>
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
         
         
          this.gets()

        },



data(){
    return{

Question:'',

allerros:[],
erros:[],
success:false,
lesson_id:'',
vuls:[],
course_id:'',
els:[]
    }
},

methods:{
   tel(course_id){

if(course_id > 0){
 const id = course_id;
       axios.post('/alllesson/'+id)
  .then((res) => {



this.vuls = res.data.data

                    
                })
}

      
},



gets(){
     axios.get('/Cts')
  .then((res) => {
                    this.els = res.data.data

                    
                })

},



suba(){
this.allerros=[];
this.success = false;
this.erros=[]
 const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

 

                let formData = new FormData();

                
 
formData.append('type', this.type);
formData.append('course_id', this.course_id);
formData.append('lesson_id', this.lesson_id);
formData.append('Question', this.Question);
axios.post('/questionCreate', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
this.Question='',
this.lesson_id = '',
this.type='',
this.course_id=''


}).catch(error => {
      if (error.response.status == 422){
       this.allerros = error.response.data.errors;
      }


 if (error.response.status == 500){
       this.erros = error.response.data;
      }

     })

}

}



    }
</script>
