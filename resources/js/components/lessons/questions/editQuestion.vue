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



<div v-if="this.Warning" class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>This question needs only one answer, please review this</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

            <div class="row">
                        <!-- ============================================================== -->
                        <!-- basic form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Basic Form</h5>
                                <div class="card-body">
                                 <form v-on:submit.prevent="suba()" enctype="multipart/form-data">

                                      <div class="form-group">
                                                <label>Question</label>
                                                <input  v-model="Form.question" type="text" placeholder="Question" class="form-control">
                                              <span v-if="allerros.question" :class="['label label-danger']">@{{ allerros.question[0] }}</span>                                                                 
                                            </div>
                                          
                                             
                               
                 <div class="form-group">
            <label for="exampleFormControlTextarea1">type</label>
    <select  class="form-control"  id="exampleFormControlSelect1" v-model="Form.type"  aria-placeholder="select type">
      <option :value="1" >Choose</option>
   <option :value="2" >Correct</option>
   <option :value="3" >Complete</option>
      
    </select>
<span v-if="allerros.type" :class="['label label-danger']">@{{ allerros.type[0] }}</span>
        </div>


        <div class="form-group">
            <label for="exampleFormControlTextarea1">course</label>
    <select  class="form-control" @click="tel(Course_id)" id="exampleFormControlSelect1" v-model="Course_id" aria-placeholder="select course" >
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
                   

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Horizontal Form</h5>
                                <div class="card-body">
                                    <form v-on:submit.prevent="fl()" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">answer</label>
                                            <div class="col-9 col-lg-10">
                                                <input  required=""  placeholder="answer" v-model="answer" class="form-control">
                                                 <span v-if="allerros.answer" :class="['label label-danger']">@{{ allerros.answer[0] }}</span>
                                            </div>
                                        </div>
                                      
                                         <div class="form-group">
            <label for="exampleFormControlTextarea1">Answer type</label>
    <select  class="form-control" @click="tel(Course_id)" id="exampleFormControlSelect1" v-model="flag" aria-placeholder="select course" >
      <option    :value='1' >true</option>
    <option    :value='2' >false</option>
      
    </select>
<span v-if="allerros.flag" :class="['label label-danger']">@required</span>
        </div>



                                             <button type="submit" class="btn btn-space btn-primary">Submit</button>

                               </form>

   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="section-block" id="buttons">
                                     
                                        <p>The correct answer is green</p>
                                    </div>
                                    <div class="card">
                                        <h5 class="card-header">Answers</h5>
                                        <div class="card-body">
                                        <div class="container">
  <div class="row">
    <div class="col-sm" v-for="answer in answers.answer" :key="answer.id">
        <a  href="#" v-if="answer.flag == 1" class="btn btn-success">{{answer.answer}} <i class="far fa-trash-alt" @click="deans(answer.id,answer.answer)"  ></i></a>
                                            <a  href="#" v-if="answer.flag == 2" class="btn btn-danger">{{answer.answer}}   <i class="far fa-trash-alt" @click="deans(answer.id,answer.answer)"  ></i></a>
                            



    </div>
   
  </div>
</div>
    
   <div class="dd-nodrag btn-group ml-auto" > 
                                                
                                             


                                                  
                                                </div>
                                            </div>

   </div>
                                           
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                              </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end horizontal form -->
                        <!-- ============================================================== -->
                    </div>
                      </div>

                 

    
</template>

<script>
    export default {
     

  mounted() {
         this.id = this.$route.params.id;
           this.put();
        
          this.gets()

        },


data(){
    return{
   Form: new Form({
      
       question:'',
       type:'',
       

        
   }),
   success:false,
   id:0,
   allerros:[],
   image:'',
  Course_id:'',
  lesson_id:'',
vuls:[],
 lesson_id:'',
course_id:'',
Warning:'',
els:[],
answers:[],
flag:'',
answer:''
   }
},

methods:{
    


    fl(){
       let formData = new FormData();

      this.success = false;
this.allerros=[],
this.Warning='',
formData.append('answer', this.answer);
formData.append('flag', this.flag);

axios.post('/createANS/'+this.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
 this.put()
}).catch((error) => {
                           if (error.response.status == 422){
       this.allerros = error.response.data.errors;
      }

this.Warning = error.response.data.Warning



                   });

},
    

       put() {
         axios.post('/questionEdit/'+this.id)
  .then((res)=>{
      this.Form.fill(res.data.data),
this.answers = res.data.data
  })
       },





gets(){
     axios.get('/Cts')
  .then((res) => {
                    this.els = res.data.data

                    
                })

},


  tel(Course_id){

if(Course_id > 0){
 const ids = Course_id;
       axios.post('/alllesson/'+ids)
  .then((res) => {



this.vuls = res.data.data

                    
                })
}

      
},

suba(){
this.allerros=[];
this.success = false,
this.Warning =''

 

               



 let formData = new FormData();

              
formData.append('lesson_id', this.lesson_id);
formData.append('course_id', this.Course_id);
formData.append('type', this.Form.type);
formData.append('question', this.Form.question);

axios.post('/questionEdStore/'+this.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
 this.put()
}).catch((error) => {
                         if (error.response.status == 422){
       this.allerros = error.response.data.errors;
      }


      if(error.response.status == 404){
       this.Warning = error.response.data.Warning;
      }

                   });

},


deans(id,answer){

    if (confirm('do you want delete post ' + answer)) {
                    axios.post('/deleteans/'+id
).then((response)=>{
    this.success = true;
 this.put()
})
                
            }

}




},
  


    }
</script>
