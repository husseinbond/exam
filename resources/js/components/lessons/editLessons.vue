<template>

  
   <div>

     

                                                <h2>EditLesson:{{Form.name}}</h2>
                                    


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
                                                <label for="exampleFormControlTextarea1">introduction</label>
                                                <textarea v-model="Form.introduction"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.introduction" :class="['label label-danger']">@{{ allerros.introduction[0] }}</span>
                                            </div>
   <div class="custom-file mb-3">
                                      <input type="file" class="custom-file-input" name="image" v-on:change="onImageChange" >
                                      <label class="custom-file-label" for="customFile">image</label>
                                            
   </div>
        <div class="form-group">
    <select  class="form-control" id="exampleFormControlSelect1" v-model="Form.course_id" >
      <option  v-for="el in els" :key="el.id"  :value='el.id' >{{el.title}}</option>
   
     
    </select>

        </div>

                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </form>
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
       introduction:'',
     
Warning:'',
         course_id:''
   }),
   success:false,
   id:0,
   allerros:[],
   image:'',
  
  els:[]
   }
},

methods:{
     onImageChange(e) {
         console.log(e.target.files[0]);
        this.image = e.target.files[0]; 

             
            },

       put() {
         axios.get('/getlessEdit/'+this.id)
  .then((res)=>{
      this.Form.fill(res.data.data);

  })

 axios.get('/Cts')
  .then((res) => {
                    this.els = res.data.data

                    
                })



        },


tel(){
       axios.get('/Cts')
  .then((res) => {
                    this.els = res.data.data

                    
                })
},

suba(){
this.allerros=[];
this.success = false


 

               



 let formData = new FormData();

                formData.append('image', this.image);
formData.append('course_id', this.Form.course_id);

formData.append('introduction', this.Form.introduction);
formData.append('name', this.Form.name);

axios.post('/storeL/'+this.id, formData, {
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
         
        },


    }
</script>
