<template>

  
   <div>

     

       
     <div class="row">
                          

<div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


     <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                 

                                <div class="card">
                                    <h5 class="card-header">Edit {{Form.name}}</h5>
                                    <div class="card-body">
                                    <form v-on:submit.prevent="suba()" enctype="multipart/form-data">
                                          
                                            <div class="form-group">
                                                <label for="inputEmail">name</label>
                                                <input id="inputEmail" v-model="Form.name" type="text" placeholder="name" class="form-control">
                                                             <span v-if="allerros.name" :class="['label label-danger']">@{{ allerros.name[0] }}</span>                                                                                   
                                            </div>
                                            <div class="form-group">
                                           <p> before Before placing the link look at this  qk5PLwYvIqk  Follow the steps correctly until the link works</p>



                                                <label for="inputText4" class="col-form-label">youtube</label>
                                                <input id="inputText4" type="text" v-model="Form.Link" class="form-control" placeholder="example: qk5PLwYvIqk">
    <span v-if="allerros.Link" :class="['label label-danger']">@{{ allerros.Link[0] }}</span>
                                            </div>
                                      
                               
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">note</label>
                                                <textarea v-model="Form.note"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.note" :class="['label label-danger']">@{{ allerros.note[0] }}</span>
                                            </div>
 
         <div class="form-group">
            <label for="exampleFormControlTextarea1">course</label>
    <select  class="form-control" @click="tel(course_id)" id="exampleFormControlSelect1" v-model="course_id" >
      <option  v-for="el in els" :key="el.id"  :value='el.id' >{{el.title}}</option>
   
     
    </select>

        </div>
        
   <div class="custom-file mb-3">
       <label class="custom-file-label" for="customFile">image</label>
                                      <input type="file"  name="image" v-on:change="onImageChange" >
                                      
                                             <span v-if="allerros.image" :class="['label label-danger']">@{{ allerros.image[0] }}</span>
   </div>


     <div class="form-group" v-if="vuls.length > 0">
         <label for="exampleFormControlTextarea1">lesson</label>
    <select  class="form-control" id="exampleFormControlSelect1" v-model="lesson_id" >
      <option  v-for="vul in vuls" :key="vul.id"   :value='vul.id' >{{vul.name}}</option>
    
    
    </select>

        </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </form>
                                    </div>
                                  

                                
                                </div>
                            </div>
                        </div>
                           </div>
                   </div>
                         

    
</template>

<script>
    export default {
     

 


data(){
    return{
   Form: new Form({
      
       name:'',
       Link:'',
       note:'',

         lesson_id:''
   }),
   success:false,
   id:0,
   allerros:[],
   image:'',
  
  lesson_id:'',
vuls:[],
course_id:'',
els:[]
   }
},

methods:{
    

       put() {
         axios.post('/getdatavid/'+this.id)
  .then((res)=>{
      this.Form.fill(res.data.data);

  })
       },



     onImageChange(e) {
         console.log(e.target.files[0]);
        this.image = e.target.files[0]; 

             
            },



gets(){
     axios.get('/Cts')
  .then((res) => {
                    this.els = res.data.data

                    
                })

},


  tel(course_id){

if(course_id > 0){
 const id = course_id;
       axios.post('/alllesson/'+id)
  .then((res) => {



this.vuls = res.data.data

                    
                })
}

      
},

suba(){
this.allerros=[];
this.success = false


 

               



 let formData = new FormData();
formData.append('image', this.image);

formData.append('lesson_id', this.Form.lesson_id);
formData.append('Link', this.Form.Link);
formData.append('note', this.Form.note);
formData.append('name', this.Form.name);

axios.post('/editVideo/'+this.id, formData, {
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

                       
                   });

}


},
   mounted() {
         this.id = this.$route.params.id;
           this.put();
        
          this.gets()

        },


    }
</script>
