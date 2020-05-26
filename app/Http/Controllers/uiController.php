<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course;

class uiController extends Controller
{
    public function index(){
      $course = course::get()->take(3);
      return view('welcome')->with('courses',$course);
    }


public function course(){
  $course = course::paginate(15);
  return view('courses');
}


public function sendcourses(){
  $course = course::paginate(10);


  return response()->json(['data'=> $course]);
}


public function welcomz($id){

$course = course::find($id)->get()->first();
if($course !== null){
  return view('ui.course')->with('course',$course);
}
}
  


public function courses($id){

  $course = course::find($id)->get()->first();
  if($course !== null){
    return view('coursez')->with('course',$course);
  }
  
    
  }
  

 
    









public function ezt($id){
$course = course::findOrFail($id);

if($course !== null){
  return view('course')->with('course',$course);
}

}

}