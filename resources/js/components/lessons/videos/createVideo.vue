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
                                    <h5 class="card-header">Create video</h5>
                                    <div class="card-body">
                                    <form v-on:submit.prevent="suba()" enctype="multipart/form-data">

                                      <div class="form-group">
                                                <label for="inputEmail">Video Name</label>
                                                <input id="inputEmail" v-model="name" type="text" placeholder="Video Name" class="form-control">
                                                                   <span v-if="erros.name" :class="['label label-danger']">@{{ erros.name[0] }}</span>                                                                     
                                            </div>
                                          
                                            <div class="form-group">
<p> before Before placing the link look at this qk5PLwYvIqk  Follow the steps correctly until the link works</p>



                                                <label for="inputEmail">Link</label>
                                                <input id="inputEmail" v-model="Link" type="text" placeholder="example: qk5PLwYvIqk"> 
                                                                   <span v-if="erros.Link" :class="['label label-danger']">@{{ erros.Link[0] }}</span>                                                                     
                                            </div>


                                       
                                     
                               
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">note</label>
                                                <textarea v-model="note"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
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
Link:'',
note:'',
name:'',
img:'',
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

 onImageChange(e) {
         console.log(e.target.files[0]);
        this.img = e.target.files[0]; 

             
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

                
 formData.append('image', this.img);
formData.append('Link', this.Link);
formData.append('note', this.note);
formData.append('lesson_id', this.lesson_id);
formData.append('name', this.name);
axios.post('/AddVideo', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
this.Link='',
this.lesson_id = '',
this.note='',
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
