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
                                    <h5 class="card-header">Create Courses</h5>
                                    <div class="card-body">
                                    <form v-on:submit.prevent="suba()" enctype="multipart/form-data">
                                          
                                            <div class="form-group">
                                                <label for="inputEmail">title</label>
                                                <input id="inputEmail" v-model="name" type="text" placeholder="title" class="form-control">
                                                                                                                                             <span v-if="allerros.name" :class="['label label-danger']">@{{ allerros.title[0] }}</span>
                                            </div>


                                         
                                     
                               
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">introduction</label>
                                                <textarea v-model="introduction"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.introduction" :class="['label label-danger']">@{{ allerros.introduction[0] }}</span>
                                            </div>


   <div class="custom-file mb-3">
       <label class="custom-file-label" for="customFile">image</label>
                                      <input type="file"  name="image" v-on:change="onImageChange" >
                                      
                                             <span v-if="allerros.image" :class="['label label-danger']">@{{ allerros.image[0] }}</span>
   </div>

   <div class="form-group">
        <label class="custom-file-label" for="customFile">course</label>
    <select  class="form-control" id="exampleFormControlSelect1" v-model="course_id" >
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
                                
                                </div>
                            </div>
                        </div>
                         
                         
                        
                            
                           

    
</template>

<script>
    export default {
          mounted() {
         this.id = this.$route.params.id;
          this.tel()
        },



data(){
    return{

course_id:'',
name:'',

image:'',
introduction:'',
questions:'',
allerros:[],
els:[],
id:0,
success:false
    }
},

methods:{




    
     onImageChange(e) {
         console.log(e.target.files[0]);
        this.image = e.target.files[0]; 

             
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

 const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

 

                let formData = new FormData();

                formData.append('image', this.image);
 

formData.append('introduction', this.introduction);
formData.append('name', this.name);
formData.append('course_id', this.id);
formData.append('course_id', this.course_id);
axios.post('/createless', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
this.name='',

this.image='',
this.introduction=''


}).catch((error) => {
    if (error.response.status == 422){
                        this.allerros = error.response.data.errors;
}
                   });

},





}



    }
</script>
