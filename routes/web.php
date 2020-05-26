<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/


///////////////ui



Route::get('/enroll/{id}','uiextraController@enroll')->name('enroll');
Route::get('/getcertificate','uiextraController@certificate');
//main route class room
Route::get('/myclassroom', 'HomeController@index')->name('home');


Route::get('/', 'uiController@index')->name('welcome');
Route::get('/courses', 'uiController@course')->name('courses');

//course data classroom
Route::get('/course/{id}', 'uiController@ezt')->name('course');
//courses data classroom
Route::get('/getdatainMyClassRoom','uiextraController@getdatainMyClassRoom');
Route::get('/sendcourses', 'uiController@sendcourses');


//quiz
Route::get('/quiz/{id}','uiextraController@quiz');
Route::post('/CorrectAnswer/{id}','uiextraController@CorrectAnswer');
Route::post('/ChooseAnswer/{id}','uiextraController@ChooseAnswer');

//roomlesson

Route::get('/Lessonzzz/{id}','uiextraController@lessonroom');
//video room
Route::get('/videoroom/{id}','uiextraController@videoroom');
// get exam course
Route::get('/examcourse/{id}','uiextraController@examcourse');
Route::post('/chooseExam/{id}','uiextraController@chooseExam');
Route::post('/Correctexam/{id}','uiextraController@Correctexam');

////////// admin functions


Route::group(['middleware'=>['auth'=>'admin']],function(){
Route::get('/dashbord/n','adminsController@viewcourse')->name('cr');

route::post('/getCtv/{id}','adminsController@editcourse');


route::get('/indexCOUR','adminsController@indexCOUR');

route::post('/deleteTC/{id}','adminsController@deleteTC');
Route::post('/storeCourse','adminsController@createCourse')->name('create');
route::post('/storeeditC/{id}','adminsController@storeeditC');

route::get('/trashedC','adminsController@trashedC');
route::post('/hdeleteC/{id}','adminsController@hdeleteC');
route::post('/restoreC/{id}','adminsController@restoreC');

route::get('/Cts','adminsController@Cts');
//lesson section#####*********
route::post('/editL','adminsController@storeL');
route::get('/getlessEdit/{id}','adminsController@editL');
route::get('/trashedL','adminsController@trashedL');
route::post('/createless','adminsController@less');
route::post('/storeL/{id}','adminsController@storeL');
route::post('/hdeleteL/{id}','adminsController@hdeleteL');
route::post('/restoreL/{id}','adminsController@restoreL');
route::post('/softLes/{id}','adminsController@softLes');


route::post('/getLE/{id}','adminsController@getLE');


//section video#####*********



route::post('/alllesson/{id}','adminsController@alllesson');
route::post('/AddVideo','adminsController@AddVideo');
route::post('/hdVideo/{id}','adminsController@hdVideo');
route::post('/getdatavid/{id}','adminsController@getdatavid');
route::post('/softdeleteVideo/{id}','adminsController@delVideo');
route::post('/restoreVideo/{id}','adminsController@restorea');
route::get('/trashedVideo','adminsController@trashedsss');
route::post('/editVideo/{id}','adminsController@editVideo');
route::get('/returnvideo','adminsController@returnvideo');
route::get('/route/{id}','adminsController@route');

//section question#####*********
route::post('/questionCreate','adminsController@questionCreate');
route::post('/questionEdit/{id}','adminsController@questionEdit');
route::post('/questionEdStore/{id}','adminsController@questionEdStore');
route::get('/trashedquestion','adminsController@trashedquestion');
route::post('/hdeletequestion/{id}','adminsController@hdeletequestion');
route::post('/restorequestion/{id}','adminsController@restorequestion');
route::get('/getqu','adminsController@getqu');
route::post('/softquestion/{id}','adminsController@softquestion');

//section answer#####*********
route::post('/createANS/{id}','adminsController@createANS');

//get  answers questions
route::post('/deleteans/{id}','adminsController@hdeleteanswer');


//get  lessons Courses


route::get('/getlessons','adminsController@getlessons');


//get questions lessons
route::get('/getQl/{id}','adminsController@getQl');

 // admin & users
route::get('/getadmins','adminsController@getAdmins');


route::post('/deleteUser/{id}','adminsController@deleteUser');
route::post('/addadmin/{id}','adminsController@addadmin');
route::post('/removeAdmin/{id}','adminsController@removeAdmin');

route::get('/users','adminsController@users');
//order
route::get('/order','adminsController@order');
route::post('/deleteorder/{id}','adminsController@deleteorder');

});
Auth::routes();
