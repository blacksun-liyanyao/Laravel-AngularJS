<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
function arrayChange($status,$msg,$data=array()){
    return ['status'=>$status,'msg'=>$msg,'data'=>$data];
}
function rq($key=null,$default=null){
    if(!$key){
        return Request::all();
    }
    return Request::get($key,$default);
}
function comment_ins(){
    return new App\comment;
}
function answer_ins(){
    return new App\Answer;
}
function userins(){
    return new App\User;
}

function question_ins(){
    return new App\Question;
}

Route::get('/', function () {
    return view('welcome');
});

Route::any('api',function(){
   return ['version' => 0.1];
});

Route::any('api/signup',function(){
    return userins()->signup();
});

Route::any('api/login',function(){
    return userins()->login();
});

Route::any('api/logout',function(){
    return userins()->logout();
});

Route::any('api/question/add',function(){
    return question_ins()->add();
});

Route::any('api/question/change',function(){
    return question_ins()->change();
});

Route::any('api/question/read',function(){
    return question_ins()->read();
});

Route::any('api/question/remove',function(){
    return question_ins()->remove();
});

Route::any('api/answer/add',function(){
    return answer_ins()->add();
});

Route::any('api/answer/change',function(){
    return answer_ins()->change();
});

Route::any('api/answer/read',function(){
    return answer_ins()->read();
});

Route::any('api/comment/add',function(){
    return comment_ins()->add();
});

Route::any('test',function(){
    dd(userins()->is_logged_in());
});