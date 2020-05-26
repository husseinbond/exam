<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use App\lesson;
use App\answer;
use App\video;
use App\question;
use App\counterq;
use App\counterc;
use App\user;
use App\order;
use Illuminate\Support\Str;
use Auth;
class adminsController extends Controller
{

  

public function getlessons(){
$get = lesson::paginate(15);
if($get){
    return response()->json(['data'=>$get]);
}

else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}
}

public function softLes($id){
    $del = lesson::where('id',$id)->get()->first();
    if($del){
        $del->delete();
        $del->save();
        return response(['succ'=>'done']);
    }

    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

}







public function AddVideo(request $request){
    $this->validate($request,[
        'note' => 'string','max:255',
        'lesson_id'=>'required|numeric',
        'Link' => 'string','max:255',
        'name' => 'required|max:255|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

   


$gets = lesson::Where('id',$request->lesson_id)->get()->first();

if($gets){
    $new = new video;
    $new->name = $request->name;
            $new->note = $request->note;
            $new->link = $request->Link;
            $new->img = $request->img;
            $new->lesson_id = $request->lesson_id;
            $new->slug = str_slug($request->name);
            $image_tmp = $request->image;
            if($image_tmp){
              $extension = $image_tmp->getClientOriginalExtension();
              $fileName = rand(111,9999999).'.'.$extension;
              $image_tmp->move('uploads/video', $fileName);
              $new->img = 'uploads/video/'. $fileName;
            }

            $new->save();
            return response(['succ'=>'done']);
}


     
        
      
        
    
    
    return response()->json([
        'Link'=> 'put Link'
     ],500);


}


public function deleteTC($id){
    $get = course::find($id);
if($get){
    $get->delete();
    $get->save();
    return response(['succ'=>'done']);
}

else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}

}



public function indexCOUR(){
    $get = course::latest()->paginate(15);
    return response()->json(['data'=>$get]);
}

public function Cts(){
    $get = course::get();
    return response()->json(['data'=>$get]);
}



public function ourC(){
    return view('admin.ourCourse');
}


    public function createCourse(request $request){

$this->validate($request,[
    'title' => 'required|max:255|string','max:255',
'price'=>'required|numeric|string','max:255',
'selected' => 'required|between:0,1|numeric',
  'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
 'introduction'=>'required|string',
 'whatis'=>'required|string',
 'whatuneed'=>'required|string',
 'fq'=>'required|string',
]);

  $image_tmp = $request->image;
      if($image_tmp){
        $extension = $image_tmp->getClientOriginalExtension();
        $fileName = rand(111,9999999).'.'.$extension;
        $image_tmp->move('uploads/Courses', $fileName);
      }
         
    



 $create =  new course;

 $create->title=$request->title;
 $create->image = 'uploads/Courses/'.$fileName;
 $create->introduction = $request->introduction;
$create->fq = $request->fq;
$create->whatuneed = $request->whatuneed;
$create->whatis = $request->whatis;
$create->selected  = $request->selected;
 $create->price = $request->price;

 $create->slug = str_slug($request->title);
$create->save();
        return response()->json([
            'succ' => 'Done'
        ], 201);
         
    }

public function viewcourse(){

return view('admin.index');

}

public function editcourse($id){

    $course =   course::find($id);
if($course){
    return response()->json(['data'=>$course]);
}
else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}

    
}

public function storeeditC(request $request,$id){
  
    $this->validate($request,[
        'title' => 'required|max:255|string','max:255',
    'price'=>'required|numeric',
       
    'whatis'=>'required|string',
    'whatuneed'=>'required|string',
    'fq'=>'required|string',
     'introduction'=>'required|string',
        
    
    ]);
    

    $course =   course::find($id);
    
    if($course){
        
        $image_tmp = $request->image;
        if($image_tmp){
          $extension = $image_tmp->getClientOriginalExtension();
          $fileName = rand(111,9999999).'.'.$extension;
          $image_tmp->move('uploads/Courses', $fileName);
          $course->image = 'uploads/Courses/'.$fileName;
          
        }

        

        $course->title = $request->title;
        $course->introduction = $request->introduction;
        $course->fq = $request->fq;
        $course->whatuneed = $request->whatuneed;
        $course->whatis = $request->whatis;
    $course->selected = $request->selected;
        $course->price = $request->price;
        $course->slug = str_slug($request->title);
        $course->save();
        return response()->json([
            'succ' => 'Done'
        ], 201);
    }
  

else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}



}



public function trashedC(){
    $course= course::onlyTrashed()->paginate(15);
    return response()->json(['data'=>$course]);
    
   
    
}





public function hdeleteC($id){
    $course= course::withTrashed()->where('id',$id)->first();
    if($course){
        $course->forceDelete();

        return response()->json([
            'succ' => 'Done'
        ], 201);

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    

    
}

public function restoreC($id){
    $course= course::withTrashed()->where('id',$id)->first();
    if($course){
        $course->restore();

        return response()->json([
            'succ' => 'Done'
        ], 201);
       

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

    
}










//lesson section#####*********

public function getLE($id){

    $get = lesson::where('id',$id)->latest()->paginate(15);

    if($get){
      

        return response()->json([
            'data' => $get
        ] );
       

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

}




public function getQl($id){
    $get = lesson::with('question')->where('id',$id)->get();
if($get){
    return response()->json([
        'data' => $get
    ], 201);
   

}

else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}



}






public function less(request $request){
    $this->validate($request,[
        'name' => 'required|max:255|string',
    'course_id'=>'required|numeric',
       
    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     'introduction'=>'required|string',
        
    
    ]);
    $lesson = new lesson;
    $image_tmp = $request->image;
    if($image_tmp){
      $extension = $image_tmp->getClientOriginalExtension();
      $fileName = rand(111,9999999).'.'.$extension;
      $image_tmp->move('uploads/lessons', $fileName);
      $lesson->img = 'uploads/lessons/'.$fileName;
    }
       


$course = course::where('id',$request->course_id)->get()->first();
if($course){
    $lesson->course_id = $request->course_id;

    $lesson->name=$request->name;
    $lesson->slug =  str_slug($request->name);
    $lesson->introduction = $request->introduction;
 
    $lesson->save();
           return response()->json([
               'succ' => 'Done'
           ], 201);
}




}
public function editL($id){
    $lesson =   lesson::find($id);
    if($lesson){
        return response()->json(['data'=>$lesson]);
    }
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
}


public function storeL(request $request,$id){
  
   
    $this->validate($request,[
        'name' => 'required|max:255|string',
    'course_id'=>'required|numeric',
     'introduction'=>'required|string',

    
    ]);

    $lesson =   lesson::where('id',$id)->get()->first();
    if($lesson){
     
$course = course::where('id',$request->course_id)->get()->first();

if($course){
    $image_tmp = $request->image;
     
    if($image_tmp){
      $extension = $image_tmp->getClientOriginalExtension();
      $fileName = rand(111,9999999).'.'.$extension;
      $image_tmp->move('uploads/lessons', $fileName);
      $lesson->image = 'uploads/lessons/'.$fileName;
    }
    $lesson->course_id = $request->course_id;
$lesson->name=$request->name;
$lesson->introduction = $request->introduction;
$lesson->slug =  str_slug($request->name);
$lesson->save();
return response()->json([
'succ' => 'Done'
], 201);


}

    }
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }


}






public function trashedL(){
    $lesson= lesson::onlyTrashed()->paginate(15);

    



    return response()->json(['data'=>$lesson]);
    
   
    
}

public function hdeleteL($id){
    $lesson= lesson::withTrashed()->where('id',$id)->first();
    if($lesson){
        $lesson->forceDelete();

        return response()->json([
            'succ' => 'Done'
        ], 201);

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    

    
}

public function restoreL($id){
    $lesson= lesson::withTrashed()->where('id',$id)->first();
    if($lesson){
        $lesson->restore();

        return response()->json([
            'succ' => 'Done'
        ], 201);
       

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

    
}


//lesson question#####*********



public function questionCreate(request $request){

  
 $this->validate($request,[
    'Question' => 'required|string',
    'course_id'=>'required|numeric',
    'lesson_id'=>'required|numeric',
    'type'=>'required|between:1,3|numeric',
    ]);



    $question = new question;


$lesson = lesson::where('id',$request->lesson_id)->where('course_id',$request->course_id)->get()->first();
if($lesson){

    $question->course_id = $request->course_id;
    $question->type = $request->type;
    $question->lesson_id = $request->lesson_id;
    $question->question = $request->Question;
    $question->slug =  str_slug($request->Question);

    $question->save();
    $seek = counterq::where('lesson_id',$request->lesson_id)->get()->first();
    $seek2 = counterc::where('course_id',$request->course_id)->get()->first();

    if(!$seek){
        $ql = new counterq;

        $ql->lesson_id = $request->lesson_id;
        $ql->num += 1;
        $ql->save();
      
    }
    else{
        $seek->num += 1;
        $seek->save();
    }
    
if(!$seek2){
    $qc = new counterc;

    $qc->course_id = $request->course_id;
    $qc->num += 1;
    $qc->save();
    

}


else{
    $seek2->num += 1;
    $seek2->save();
}


    
}



  
   
}



public function questionEdit(request $request,$id){
    $question =  question::with('answer')->where('id',$id)->get()->first();
    if($question){
        return response()->json(['data'=>$question]);
    }
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }


}

public function editVideo(request $request,$id){
    $this->validate($request,[
        'note' => 'string','max:255',
       
        'Link' => 'string','max:255',
        'name'=>'required|string'
    ]);

if($request->lesson_id){
    $getss= lesson::where('id',$request->lesson_id)->get()->first();
    if($getss){
       



            $new =  video::find($id);
            if($new !== null){
                $image_tmp = $request->image;
                 
                if($image_tmp){
                  $extension = $image_tmp->getClientOriginalExtension();
                  $fileName = rand(111,9999999).'.'.$extension;
                  $image_tmp->move('uploads/video', $fileName);
                  $new->img = 'uploads/video/'.$fileName;
                



            $new->name = $request->name;
            $new->note = $request->note;
            $new->link = $request->Link;
            $new->lesson_id = $request->lesson_id;
        
    
            $new->save();
            
            return response(['succ'=>'done']);
            
        } 
        
        return response()->json([
            'Link'=> 'put Link'
         ],500);

    }
}
    

    
        $new =  video::find($id);
        $new->name = $request->name;
        $new->note = $request->note;
        $new->link = $request->Link;
        
    

        $new->save();
        
        return response(['succ'=>'done']);
        
   
    
    return response()->json([
        'Link'=> 'put Link'
     ],500);



}
}


public function delVideo($id){
$get = video::where('id',$id)->get()->first();
if($get){
    $get->delete();
    $get->save();
    return response(['succ'=>'done']);
}
else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}


}

public function returnvideo(){
    $get = video::latest()->paginate(15);


    return response(['data'=>$get,
    
    ]);


}



public function getdatavid($id){
    $get = video::where('id',$id)->first();
    if($get){
        return response(['data'=>$get]);

    }
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
}


public function alllesson($ids){
 

        
    $get  = lesson::where('course_id',$ids)->get();
  if($get){
    return response()->json(['data'=>$get]);
  }
    
}


public function hdVideo($id){
    $get = video::withTrashed()->where('id',$id)->first();
    if($get){
        $get->forceDelete();
        $get->save();
        return response(['succ'=>'done']);
    }
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    
}



public function restorea($id){

    
    $video= video::withTrashed()->where('id',$id)->first();
    if($video){

        
        $video->restore();
       
        return response()->json([
            'succ' => '000'
        ], 201);
       

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

}



public function trashedsss(){
    $video= video::onlyTrashed()->paginate(15);
    return response()->json(['data'=>$video]);
}





public function questionEdStore(request $request,$id){
    $this->validate($request,[
        
       
        'question'=>'required|string',
        'type'=>'numeric',
        ]);
        $question =   question::find($id);
        if($question){

if($request->course_id & $request->lesson_id){
    $lesson = lesson::where('id',$request->lesson_id)->where('course_id',$request->course_id)->get()->first();

   if($lesson){
    $question->course_id = $request->course_id;
    $question->lesson_id = $request->lesson_id;
    
   }
    

}



$question->slug =  str_slug($request->question);
            $question->question = $request->question;
            $question->type = $request->type;
            $question->save();

            return response()->json([
                'succ' => 'Done'
            ], 201);
        }
        else{
            return response()->json([
                'error' => 'not found'
            ], 404);
            
        }
    


}

public function trashedquestion(){
    $question= question::onlyTrashed()->get();
    return response()->json(['data'=>$question]);
    
   
    
}




public function getqu(){
$get = question::with('answer')->paginate(15);
return response()->json(['data'=>$get]);
}


public function hdeletequestion($id){
    $question= question::withTrashed()->where('id',$id)->first();
    if($question){
        $question->forceDelete();

        return response()->json([
            'succ' => 'Done'
        ], 201);

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    

    
}

public function softquestion($id){
    $question= question::where('id',$id)->get()->first();
    if($question){

       
        $question->Delete();


        $question->save();

        $seek = counterq::where('lesson_id',$question->lesson_id)->get()->first();

        $seek2 = counterc::where('Course_id',$question->Course_id)->get()->first();
    
        
    
    $seek->num -= 1;
    $seek->save();
    
    $seek2->num -= 1;
    $seek2->save();
        
    




        return response()->json([
            'succ' => 'Done'
        ], 201);

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    

    
}



public function restorequestion($id){
    $question= question::withTrashed()->where('id',$id)->first();
    
    if($question){
        $seek = counterq::where('lesson_id',$question->lesson_id)->get()->first();
        $seek2 = counterc::where('Course_id',$question->Course_id)->get()->first();
    

       



            $seek->num += 1;
            $seek->save();
           

          
            $seek2->num += 1;
            $seek2->save();
               
        

        $question->restore();

       

      
    
    
   
    
  


        return response()->json([
            'succ' => 'Done'
        ], 201);
       

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

}


public function putAns($id){
$get = question::with('answer')->where('id',$id)->get()->first();

if($get){
    return response()->json([
        'data' => $get
    ], 201);
}


    
else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}


}



public function createANS(request $request,$id){

    $this->validate($request,[
        
        
        'answer'=>'required|string',
        'flag'=>'required|numeric',
        
        ]);

$question =  question::where('id',$id)->get()->first();

if($question){


    if($question->type == 2 or $question->type == 3){
$seekInANswerifthereManyAnswers = answer::where('question_id',$id)->get()->count();


if($seekInANswerifthereManyAnswers >= 1){
    return response()->json([
        'Warning' => 'This question needs only one answer, please review'
    ], 404);

}




    }







    $new = new answer;

    $new->question_id = $id;
    $new->answer = $request->answer;
    $new->flag = $request->flag;
$new->save();
    return response()->json([
        'succ' => 'Done'
    ], 201);
}
        
       
}





public function hdeleteanswer($id){

    $answer= answer::where('id',$id)->first();
   
    if($answer !== null){
        
        $answer->Delete();

        return response()->json([
            'succ' => 'Done'
        ], 201);

    }
    
    else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }
    

    
}


public function addadmin($id){

   $admin =  user::find($id);
    if($admin != null){
        $admin->admin = 1;
        return response()->json([
            'succ' => 'Done'
        ], 201);

    }

}
    

public function getAdmins(){

    $admin =  user::where('admin',1)->paginate(15);
    
        
         return response()->json([
             'data' => $admin
         ], 201);
 
     }
 
 

public function deleteUser($id){
    $deleteUser = Auth::user($id);
    if($deleteUser != null){
      
        user::destroy($id);
        $deleteUser->save();
        return response()->json([
            'succ' => 'Done'
        ], 201);
    }
}

public function removeAdmin($id){
$removeAdmin = user::find($id);
$removeAdmin->admin = 0;
$removeAdmin->save();
return response()->json([
    'succ' => 'Done'
], 201);
}

public function order(){
   $order = order::paginate(15);
   return response()->json([
       'data'=>$order
   ]);
}

public function deleteorder($id){
$deleteorder = order::find($id);
$deleteorder->delete();
$deleteorder->save();
return response()->json([
    'succ' => 'Done'
], 201);
}




public function users(){

$users = user::get();
return response()->json([
    'data' => $users
], 201);

}


public function getreview(){

    $review = review::get();
    return response()->json([
        'data' => $users
    ], 201);
    
    }


public function deletereview($id){
    $review = review::find($id);

    if($review !== null){
$review->delete();
$review->save();
return response()->json([
    'succ' => 'Done'
], 201);

    }
}

public function acceptreview($id){
    $review = review::find($id);

    if($review !== null){
$review->acc = 1;
$review->save();
return response()->json([
    'succ' => 'Done'
], 201);

    }
}



}
