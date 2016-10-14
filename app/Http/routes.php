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
function paginate($page=1){
    $limit = rq('limit')?:16;
    $skip = (($page?:1) -1) * $limit;
    return [$limit,$skip];
}
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
    return view('index');
});

Route::any('api',function(){
   return ['version' => 0.1];
});

Route::any('api/user/read',function(){
    return userins()->read();
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

Route::any('api/user/change_password',function(){
    return userins()->change_password();
});

Route::any('api/user/reset_password',function(){
    return userins()->reset_password();
});

Route::any('api/user/validate_reset_password',function(){
    return userins()->validate_reset_password();
});

Route::any('api/answer/vote',function(){
    return answer_ins()->vote();
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

Route::any('api/comment/read',function(){
    return comment_ins()->read();
});

Route::any('api/comment/remove',function(){
    return comment_ins()->remove();
});

Route::any('api/timeline','CommonController@timeline');

Route::any('test',function(){
    dd(userins()->is_logged_in());
});