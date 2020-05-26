<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;
use App\lesson;
use App\answer;
use App\video;
use App\question;
use App\counterq;
use App\user;
use App\order;
use App\userans;
use App\fullanswer;
use App\result;
use App\fullanswet;
use App\counterc;
use Auth;
class uiextraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

//courses

   public function coursesindex(){

    
    return view('ui.courses.index');

   }




public function openClassRoom(){

    return view('myclassroom');

}

public function getdatainMyClassRoom(){
$auth =  auth::user()->id;

$order = order::where('user_id',$auth)->with('course')->get();

return response()->json(['data',$order]);

}





// lessons




public function lesson(){
    $lesson = lesson::get();
    return response()->json(['data'=>$lesson]); 

}






public function video($id){

    $lesson = lesson::With('video')->where('id',$id)->first();
    $course = course::where('id',$lesson->course_id)->get()->first();

if($course->selected > 0){

   $order =  order::Where('user_id',auth::id(),'course_id',$course->id)->get()->first();

    if($order !== null){
       
        return response()->json(['data'=>$lesson]);       

    }
}

else{
  
    return response()->json(['data'=>$lesson]);
}
  
}

public function quiz($id){
    $lesson = lesson::where('id',$id)->first();


if($lesson !== null){

    
    

    


 $checkaboutQuestionifThereoldANswerOrNot =  fullanswer::where('lesson_id',$lesson->id)->where('user_id',auth::id())->orderBy('created_at', 'DESC')->get()->first();


 

    




$course = course::where('id',$lesson->course_id)->get()->first();

    if($course->selected > 0){
        
        $order =  order::Where('course_id',$course->id)->where('user_id',auth::id())->get()->first();
        
         if($order !== null){

            if($checkaboutQuestionifThereoldANswerOrNot !== null){

                $page   = question::with('answer')->where('id',$checkaboutQuestionifThereoldANswerOrNot->question_id)->get()->first();
   
                $next_page = question::where('id' , '>' ,$page->id)->min('id');
                
                $Questions  = question::with('answer')->where('id',$next_page)->get()->first();
            
                if($next_page == null){
                    $res = userans::Where('user_id',auth::id())->where('lesson_id',$id)->get()->first();
                    if($res){
                        return response()->json(['done'=>1 , 'result'=>$res->result]);
                    }
                   
                }
            
                if($Questions !== null){
                    return response()->json(['data'=>$Questions]);
                }
                

            }
            
            else{
              
               

                $Questions  = question::with('answer')->where('lesson_id',$lesson->id)->get()->first();
            
                if($Questions == null){
                    return response()->json(['done'=>1 ]);
                }

            
                return response()->json(['data'=>$Questions]);

            }


}



         
     
     }
     
     
     else{
        $order =  order::Where('course_id',$course->id)->where('user_id',auth::id())->get()->first();
if($order){


        if($checkaboutQuestionifThereoldANswerOrNot !== null){
            

            $page   = question::with('answer')->where('id',$checkaboutQuestionifThereoldANswerOrNot->question_id)->get()->first();

            $next_page = question::where('id' , '>' ,$page->id)->min('id');
            
            $Questions  = question::with('answer')->where('id',$next_page)->get()->first();
          
            if($next_page == NULL){
                $res = userans::Where('user_id',auth::id())->where('lesson_id',$id)->get()->first();
                if($res){
                    return response()->json(['done'=>1 , 'result'=>$res->result]);
                }
                
            }
        
            return response()->json(['data'=>$Questions]);

        }else{
          
            
            $Questions  = question::with('answer')->where('lesson_id',$lesson->id)->get()->first();
        
            if($Questions == null){
                return response()->json(['done'=>1 ]);
            }

        
            return response()->json(['data'=>$Questions]);

        }



     }
    }


    }
     
    





}

public function ChooseAnswer($id){
$answer = answer::Where('id',$id)->get()->first();

if($answer !== null){
   

    $Question = question::where('id',$answer->question_id)->get()->first();
    
    $counterQuestionCreated = counterq::where('lesson_id',$Question->lesson_id)->get()->first();
   
    $user = userAns::where('user_id',auth::id())->where('lesson_id',$Question->lesson_id)->get()->first();
    $answert = answer::Where('flag',1)->where('question_id',$answer->question_id)->get()->first();
  
    if($user !== null){
        
    
        if($answer->flag == 1){
    $EQ = $user->counterQ + 1;
    $ER = $user->counterR +1;

     $percent =   $EQ   * 100  / $counterQuestionCreated->num;
     $result = $ER * 100  / $counterQuestionCreated->num;
     
     $user->counterQ =$EQ;
     $user->counterR =$EQ;
    $user->percent  = $percent ;


    

    
    $user->result = $result;
    
    $user->save();
    $fullanswer  = new fullanswer;
    $fullanswer->user_id = auth::id();
    
    $fullanswer->question_id = $Question->id;
    
    $fullanswer->lesson_id = $Question->lesson_id;
    $fullanswer->answer = $answer->answer;
    $fullanswer->save();
    
    return response()->json(['nextpage'=>$Question->lesson_id,'true'=>1]);
    
        }else{
    
            $ER = $user->counterR;

            $EQ = $user->counterQ + 1;
            $percent =   $user->counterQ + 1   * 100  / $counterQuestionCreated->num;
$result = $ER *100 / $counterQuestionCreated->num;
     
            $user->counterQ =$EQ;
            $user->counterR =$ER;
           $user->percent  = $percent;
           $user->result =$result; 
           
            $user->save();

            $fullanswer  = new fullanswer;

            $fullanswer->user_id = auth::id();
            
            $fullanswer->question_id = $Question->id;
            
            $fullanswer->lesson_id = $Question->lesson_id;

            $fullanswer->answer = $answer->answer;
            
            $fullanswer->save();
            



            return response()->json(['nextpage'=>$Question->lesson_id ,'answert'=>$answert->answer ]);
            
        }
    
    
    
       
    }else{
    
        $answersUser = new userans;
        $answersUser->user_id = auth::id();
        //counter result
        $answersUser->counterQ +=1;
        
        $answersUser->lesson_id = $Question->lesson_id;
    
        if($answer->flag == 1){
       
            
    
            $answersUser->counterR +=1;
            $percent =   1 * 100 / $counterQuestionCreated->num;
            $answersUser->percent  += $percent;
           $result = 1 *100 / $counterQuestionCreated->num;
           $answersUser->result += $result;
            
           $answersUser->save();
           $fullanswer  = new fullanswer;
           $fullanswer->user_id = auth::id();
           
           $fullanswer->question_id = $Question->id;
           
           $fullanswer->lesson_id = $Question->lesson_id;
           $fullanswer->answer = $answer->answer;
           $fullanswer->save();
           return response()->json(['nextpage'=>$Question->lesson_id,'true'=>1]);
          
           
        }else{
            $answersUser->result +=0; 
            $answersUser->counterR +=0;
            $percent =   1 * 100 / $counterQuestionCreated->num;
            $answersUser->percent  += $percent;
            $answersUser->save();
            $fullanswer  = new fullanswer;
            $fullanswer->user_id = auth::id();
            
            $fullanswer->question_id = $Question->id;
            $fullanswer->answer = $answer->answer;
            $fullanswer->lesson_id = $Question->lesson_id;
            
            $fullanswer->save();


           
            return response()->json(['nextpage'=>$Question->lesson_id ,'answert'=>$answert->answer ]);
          
        }
    
    
    
    }
}

}




public function CorrectAnswer(request $request,$id){


    $this->validate($request,[
        
        'answer'=>'required|string',
        ]);


       

$finderquestion = question::where('id',$id)->get()->first();

 if($finderquestion){



    $Question = question::where('id',$id)->get()->first();
    $answer =   answer::where('answer',$request->answer)->where('question_id',$id)->get()->first();
    $user = userAns::where('user_id',auth::id())->where('lesson_id',$Question->lesson_id)->get()->first();
    
    $counterQuestionCreated = counterq::where('lesson_id',$Question->lesson_id)->get()->first();
    if($answer !== null){
       

        
 
    

    if($user !== null){


        $ER = $user->counterR+1;

        $EQ = $user->counterQ + 1;
        $percent =   $EQ   * 100  / $counterQuestionCreated->num;
$result = $ER *100 / $counterQuestionCreated->num;
 
        $user->counterQ =$ER;
        $user->counterR =$EQ;
       $user->percent  = $percent;
       $user->result =$result; 
     
       

    
    $user->save();
    $fullanswer  = new fullanswer;
    $fullanswer->user_id = auth::id();
    
    $fullanswer->question_id = $Question->id;
    
    $fullanswer->lesson_id = $Question->lesson_id;
    $fullanswer->answer = $request->answer;
    $fullanswer->save();
    
    return response()->json(['nextpage'=>$Question->lesson_id,'true' => 1]);
    
}

else{

    $answersUser = new userans;
    $answersUser->user_id = auth::id();
    //counter result
    $answersUser->counterQ +=1;
    $answersUser->counterR +=0;
    $answersUser->lesson_id = $Question->lesson_id;

    $percent =    1   * 100  / $counteQuestionCreated->num;
            $answersUser->percent  = $percent;
           $result = 1 *100 / $counteQuestionCreated->num;
           $answersUser->result = $result;
            
           $answersUser->save();
           $fullanswer  = new fullanswer;
           $fullanswer->user_id = auth::id();
           
           $fullanswer->question_id = $Question->id;
           
           $fullanswer->lesson_id = $Question->lesson_id;
           $fullanswer->answer = $request->answer;
           $fullanswer->save();
           return response()->json(['nextpage'=>$Question->lesson_id,'true'=>1]);




}



}



else{
 
    $findtrueAnswer = answer::where('question_id',$id)->get()->first();
    
    if($user !== null ){
     
   

    $counterQuestionCreated = counterq::where('lesson_id',$Question->lesson_id)->get()->first();

    $ER = $user->counterR;


$result = $ER *100 / $counterQuestionCreated->num;

$EQ =$user->counterQ + 1;
    $percent =   $EQ   * 100  / $counterQuestionCreated->num;

     
    $user->counterQ =$EQ;
    $user->counterR =$ER;
    $user->result =$result;
         

       
        $user->percent  = $percent;
    $user->save();
    $fullanswer  = new fullanswer;
    $fullanswer->user_id = auth::id();
    
    $fullanswer->question_id = $Question->id;
    $fullanswer->answer = $request->answer;
    $fullanswer->lesson_id = $Question->lesson_id;
    
    $fullanswer->save();
    return response()->json(['nextpage'=>$Question->lesson_id,'answert' => $findtrueAnswer->answer]);
    }else{
        $answersUser = new userans;
        $answersUser->user_id = auth::id();
        //counter result
        $answersUser->counterQ +=1;
        $answersUser->counterQ +=0;
        $answersUser->lesson_id = $Question->lesson_id;

        $answersUser->result +=0; 
        $percent =   1 * 100 / $counterQuestionCreated->num;
        $answersUser->percent  += $percent;
        $answersUser->save();
        $fullanswer  = new fullanswer;
        $fullanswer->user_id = auth::id();
        
        $fullanswer->question_id = $Question->id;
        $fullanswer->answer = $request->answer;
        $fullanswer->lesson_id = $Question->lesson_id;
        
        $fullanswer->save();
        return response()->json(['nextpage'=>$Question->lesson_id]);
}


}

 }

}



public function lessonroom($id){
$lesson = lesson::where('id',$id)->get()->first();

if($lesson !==null){
    $course = course::where('id',$lesson->course_id)->get()->first();
    $video = lesson::where('id',$lesson->id)->with('video')->get()->first();
    
    
    if($course->selected == 1){
        $checkabout = order::where('user_id',auth::id())->where('course_id',$lesson->course_id)->get()->first();
    
        if($checkabout !== null){
    
        
            return response()->json(['data' => $video]);
        
        }else{
            return response()->json([
                'error' => 'not found'
            ], 404);
        }
        
    }else{
        return response()->json(['data' => $video]);
    
    }
}
else{
    return response()->json([
        'error' => 'not found'
    ], 404);
}




}


public function videoroom($id){

    $getvideo = video::where('slug',$id)->get()->first();

    if($getvideo !== null){

        $checklesson = lesson::where('id',$getvideo->lesson_id)->get()->first();

        if($checklesson !== null){
$course =   course::where('id',$checklesson->course_id)->get()->first();

if($course->selected == 1 ){

    $checkaboutorder = order::Where('course_id',$checklesson->course_id)->where('user_id',auth::id())->get()->first();

    if($checkaboutorder !== null){

        return response()->json(['data' => $getvideo,'slug' => $checklesson->slug]);

    }else{
        return response()->json([
            'error' => 'not found'
        ], 404);
    }

}else{
    return response()->json(['data' => $getvideo ,'slug' => $checklesson->slug]);
}

        }

    }

}



public function examcourse($id){

    $course = course::where('id',$id)->get()->first();

    if($course !== null){
        $order = order::Where('user_id',auth::id())->where('course_id',$course->id)->get()->first();
if($course->selected == 1){


if($order){


    $finderifhasoldanswer = fullanswet::Where('user_id',auth::id())->where('course_id',$course->id)->orderBy('created_at', 'DESC')->get()->first();
    if($finderifhasoldanswer){

$res = result::Where('user_id',auth::id())->where('course_id')->get();


        $page   = question::with('answer')->where('id',$finderifhasoldanswer->question_id)->get()->first();
   
        $next_page = question::where('id' , '>' ,$page->id)->min('id');
        
        $Questions  = question::with('answer')->where('id',$next_page)->get()->first();
        

        if($next_page == null){

            
            $res = result::Where('user_id',auth::id())->where('course_id',$course->id)->get()->first();

            if($res){
                return response()->json(['done'=>1 , 'result'=>$res->result]);
            }
           
        }
    
        return response()->json(['data'=>$Questions]);




    }else{
          
            
        $Questions  = question::with('answer')->where('Course_id',$course->id)->get()->first();
    
        if($Questions == null){
            return response()->json(['done'=>1 ]);
        }

    
        return response()->json(['data'=>$Questions]);

}
    



}



    }else{
     
if($order){
    

    $finderifhasoldanswer = fullanswet::Where('user_id',auth::id())->where('course_id',$course->id)->orderBy('created_at', 'DESC')->get()->first();
   
    if($finderifhasoldanswer){

$res = result::Where('user_id',auth::id())->where('course_id')->get();


        $page   = question::with('answer')->where('id',$finderifhasoldanswer->question_id)->get()->first();
        
        $next_page = question::where('id' , '>' ,$page->id)->min('id');
        
        $Questions  = question::with('answer')->where('id',$next_page)->get()->first();
   
        

        if($next_page == null ){

            
            $res = result::Where('user_id',auth::id())->where('course_id',$course->id)->get()->first();
            if($res){
                return response()->json(['done'=>1 , 'result'=>$res->result]);
            }
           
        }
    if($Questions !== null){
        return response()->json(['data'=>$Questions]);

    }
        




    }else{
             
        $Questions  = question::with('answer')->where('Course_id',$course->id)->get()->first();
    
        if($Questions == null){
            return response()->json(['done'=>1 ]);
        }
    
        if($Questions !== null){
            return response()->json(['data'=>$Questions]);
        }
        
}
    
}

    }

    

    }
}


public function chooseExam($id){

    $answer = answer::Where('id',$id)->get()->first();
  

    if($answer !== null){

        $Question = question::where('id',$answer->question_id)->get()->first();
    $course= course::where('id',$Question->Course_id)->get()->first();

        $counterQuestionCreated = counterc::where('Course_id',$Question->Course_id)->get()->first();
       
        $user = result::where('user_id',auth::id())->where('course_id',$Question->Course_id)->get()->first();
        $answert = answer::Where('flag',1)->where('question_id',$answer->question_id)->get()->first();

        $fullanswet = new fullanswet;

        $fullanswet->course_id = $Question->Course_id;
        $fullanswet->question_id = $Question->id;
        $fullanswet->answer = $answer->answer;
        $fullanswet->user_id = auth::id();

        $fullanswet->save();



        if($user !== null){

            if($answer->flag == 1){


$EQ = $user->counterQ+1;

$ER = $user->counterR+1;

$percent = $EQ *100 / $counterQuestionCreated->num;

$result = $ER * 100 / $counterQuestionCreated->num;


$user->counterQ=$EQ;
$user->counterR= $ER;

$user->percent = $percent;
$user->result= $result;

$user->save();

return response()->json(['nextpage'=>$Question->course_id,'true'=>1]);


            }

            else{

                $EQ = $user->counterQ+1;

                $ER = $user->counterR;
                
                $percent = $EQ *100 / $counterQuestionCreated->num;
                $result = $ER * 100 / $counterQuestionCreated->num;
                
                
                
                $user->counterQ=$EQ;
                $user->counterR= $ER;
                
                $user->percent = $percent;
                $user->result= $result;
                
                $user->save();
                
                return response()->json(['nextpage'=>$Question->Course_id ,'answert'=>$answert->answer ]);

            }


        }
        else{

            if($answer->flag == 1){

$resultQ = new result;

$resultQ->user_id = auth::id();

              
                
                $percent = 1 *100 / $counterQuestionCreated->num;
                
                $result = 1 * 100 / $counterQuestionCreated->num;
                
                
                $resultQ->counterQ+=1;
                $resultQ->counterR+= 1;
                $resultQ->course_id = $course->id;
                $resultQ->percent = $percent;
                $resultQ->result= $result;
                $resultQ->user_name = auth::user()->name;
              
                $resultQ->slug = $course->slug;
                $resultQ->save();
                
                return response()->json(['nextpage'=>$Question->Course_id,'true'=>1]);
                
                
                            }
                
                            else{
                                $resultQ = new result;

                                $resultQ->user_id = auth::id();
                                
                                             
                                                
                                                $percent = 1 *100 / $counterQuestionCreated->num;
                                                
                                                $result = 1 * 100 / $counterQuestionCreated->num;
                                                
                                                
                                                $resultQ->counterQ+=1;
                                                $resultQ->counterR+= 0;
                                                $resultQ->course_id = $course->id;
                                                $resultQ->percent = $percent;
                                                $resultQ->result= $result;
                                                $resultQ->user_name = auth::user()->name;
                                                $resultQ->slug = $course->slug;
                                                $resultQ->save();
                                
                                return response()->json(['nextpage'=>$Question->Course_id ,'answert'=>$answert->answer ]);
                
                            }
                            
        }

       

    }


}




public function Correctexam(request $request,$id){


    $this->validate($request,[
        
        'answer'=>'required|string',
        ]);




        $finderquestion = question::where('id',$id)->get()->first();

        if($finderquestion){
           
$Question = question::where('id',$id)->get()->first();

            $fullanswet  = new fullanswet;
            $fullanswet->user_id = auth::id();
            
            $fullanswet->question_id = $Question->id;
            
            $fullanswet->course_id = $Question->Course_id;
            $fullanswet->answer = $request->answer;
            $fullanswet->save();


           $answer =   answer::where('answer',$request->answer)->where('question_id',$id)->get()->first();
           $user = result::where('user_id',auth::id())->where('course_id',$Question->Course_id)->get()->first();
           
           $counterQuestionCreated = counterc::where('course_id',$Question->Course_id)->get()->first();
           if($answer !== null){
              
       
               
        
           
       
           if($user !== null){
       
       
               $ER = $user->counterR+1;
       
               $EQ = $user->counterQ + 1;
               $percent =   $EQ   * 100  / $counterQuestionCreated->num;
       $result = $ER *100 / $counterQuestionCreated->num;
        
               $user->counterQ =$ER;
               $user->counterR =$EQ;
              $user->percent  = $percent;
              $user->result =$result; 
            
              
       
           
           $user->save();
        
           
           return response()->json(['nextpage'=>$Question->Course_id,'true' => 1]);
           
       }
       
       else{
       
           $answersUser = new result;
           $answersUser->user_id = auth::id();
           //counter result
           $answersUser->counterQ +=1;
           $answersUser->counterR +=0;
           $answersUser->course_id = $Question->Course_id;
       
           $percent =    1   * 100  / $counteQuestionCreated->num;
                   $answersUser->percent  = $percent;
                  $result = 1 *100 / $counteQuestionCreated->num;
                  $answersUser->result = $result;
                   
               
                  return response()->json(['nextpage'=>$Question->Course_id,'true'=>1]);
       
       
       
       
       }
       
       
       
       }
       
       
       
       else{
        
           $findtrueAnswer = answer::where('question_id',$id)->get()->first();
           
           if($user !== null ){
            
          
       
           $counterQuestionCreated = counterc::where('course_id',$Question->Course_id)->get()->first();
       
           $ER = $user->counterR;
       
       
       $result = $ER *100 / $counterQuestionCreated->num;
       
       $EQ =$user->counterQ + 1;
           $percent =   $EQ   * 100  / $counterQuestionCreated->num;
       
            
           $user->counterQ =$EQ;
           $user->counterR =$ER;
           $user->result =$result;
                
          
              
               $user->percent  = $percent;
           $user->save();
      
           return response()->json(['nextpage'=>$Question->Course_id,'answert' => $findtrueAnswer->answer]);
           }else{
               $answersUser = new result;
               $answersUser->user_id = auth::id();
               //counter result
               $answersUser->counterQ +=1;
               $answersUser->counterQ +=0;
               $answersUser->course_id = $Question->course_id;
       
               $answersUser->result +=0; 
               $percent =   1 * 100 / $counterQuestionCreated->num;
               $answersUser->percent  += $percent;
               $answersUser->save();
            
               return response()->json(['nextpage'=>$Question->course_id]);
       }
       
       
       }
       
        }


    }







    public function certificate(){
     
        $auth = auth::id();
$result = result::where('user_id',$auth)->get();
if($result !== null){
    dd($result);
    return view('certificate')->with('results',$result);
}
    }



public function enroll($id){
    $course = course::where('id',$id)->get()->first();
    if($course !== null){
$ce = order::Where('course_id',$course->id)->where('user_id',auth::id())->get()->first();
if($ce == null){
    if($course->selected == 0){
        $order = new order;
    $order->user_id = auth::id();
    $order->course_id = $id;
    $order->save();
        
    return back()->with('success_message', 'done');
}else{

    // its up to you
}
}




    }
}



}
