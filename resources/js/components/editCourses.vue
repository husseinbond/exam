<template>

  
   <div>

     

        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-10">
     <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="page-header" id="top">
                                
                                    <div class="page-breadcrumb">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><router-link to ="/" class="breadcrumb-link">Dashboard</router-link></li>
                                                
                                                <li class="breadcrumb-item active" aria-current="page">Edit {{Form.title}}</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>


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
                                                <input id="inputEmail" v-model="Form.title" type="text" placeholder="title" class="form-control">
                                                             <span v-if="allerros.title" :class="['label label-danger']">@{{ allerros.title[0] }}</span>                                                                                   
                                            </div>
                                        
                                            <div class="form-group">
                                                <label for="inputPassword">price</label>
                                                <input id="inputPassword" v-model="Form.price" type="number" placeholder="price" class="form-control">
                                                 <span v-if="allerros.introduction" :class="['label label-danger']">@{{ allerros.price[0] }}</span>
                                            </div>
                               
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">introduction</label>
                                                <textarea v-model="Form.introduction"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.introduction" :class="['label label-danger']">@{{ allerros.introduction[0] }}</span>
                                            </div>
 <div class="custom-file mb-3">
                                      <input type="file"  name="image" v-on:change="onImageChange" >
                                      <label class="custom-file-label" for="customFile">image</label>
                                             <span v-if="allerros.image" :class="['label label-danger']">@{{ allerros.image[0] }}</span>
   </div>


      <div class="form-group">
                                                <label for="exampleFormControlTextarea1">what is your next step</label>
                                                <textarea v-model="Form.whatis"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.whatis" :class="['label label-danger']">@{{ allerros.whatis[0] }}</span>
                                            </div>


  <div class="form-group">
                                                <label for="exampleFormControlTextarea1">What do you want</label>
                                                <textarea v-model="Form.whatuneed"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.whatuneed" :class="['label label-danger']">@{{ allerros.whatuneed[0] }}</span>
                                            </div>




  <div class="form-group">
                                                <label for="exampleFormControlTextarea1">fq</label>
                                                <textarea v-model="Form.fq"  class="form-control"  id="exampleFormControlTextarea1" rows="3"></textarea>
<span v-if="allerros.fq" :class="['label label-danger']">@{{ allerros.fq[0] }}</span>
                                            </div>

   
                                                            <div class="form-group">
    <label for="exampleFormControlSelect1">type Course</label>
    <select  class="form-control" id="exampleFormControlSelect1" v-model="Form.selected" >
      <option  :value="1">paid</option>
      <option  :value="0">free</option>
     
    </select>
     <span v-if="allerros.type" :class="['label label-danger']">@{{ allerros.type[0] }}</span>
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
                            
                             </div>

    
</template>

<script>
    export default {
        mounted() {
         this.id = this.$route.params.id;
           this.put()
        },


 


data(){
    return{
   Form: new Form({
       price:'',
       title:'',
       introduction:'',
       Numberquestions:'',
       whatis:'',
whatuneed:'',
fq:'',
 selected:''
         
   }),
   success:false,
   id:0,
   allerros:[],
   image:''
  
   }
},

methods:{
     onImageChange(e) {
         console.log(e.target.files[0]);
        this.image = e.target.files[0]; 

             
            },

       put() {
         axios.post('/getCtv/'+this.id)
  .then((res)=>{

     this.Form.fill(res.data.data)
  })

        },




suba(){
this.allerros=[];
this.success = false


 

               



 let formData = new FormData();

                formData.append('image', this.image);
 formData.append('price', this.Form.price);
 formData.append('whatis', this.Form.whatis);
  formData.append('whatuneed', this.whatuneed);
  formData.append('fq', this.Form.fq);
formData.append('introduction', this.Form.introduction);
formData.append('title', this.Form.title);
formData.append('selected', this.Form.selected);
axios.post('/storeeditC/'+this.id, formData, {
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


}


    }
</script>
