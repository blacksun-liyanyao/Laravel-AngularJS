<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use Hash;

class User extends Model
{
    /*获取用户信息api*/
    public function read(){
        if(!rq('id')){
            return arrayChange(0,'required id');
        }
        $get = ['id','username','avatar_url','intro'];
        $user = $this->find(rq('id'),$get);
        $data = $user->toArray();
        $answer_count = answer_ins()->where('user_id',rq('id'))->count();
        $question_count = question_ins()->where('user_id',rq('id'))->count();
        $data['answer_count'] = $answer_count;
        $data['question_count'] = $question_count;
        return arrayChange(1,'',$data);
    }
    /*注册API*/
    public function signup(){
        $has_username_and_password = $this->has_username_and_password();
        //检查用户名密码是否为空
        if(!$has_username_and_password){
            return arrayChange(0,'用户名和密码不能为空');
        }
        else{
            $username = $has_username_and_password[0];
            $password = $has_username_and_password[1];
        }
        //检查用户名是否存在
        $user_exists = $this
            ->where('username',$username)
            ->exists();
        if($user_exists){
            return arrayChange(0,'用户名已存在');
        }
        //加密密码
        $hashed_password = bcrypt($password);
        //存入数据库
        $user = $this;
        $user->password = $hashed_password;
        $user->username = $username;
        if($user->save()){
            return arrayChange(1,'注册成功',['id' => $user->id]);
        }else{
            return arrayChange(0,'注册失败');
        }
    }
    /*登录API*/
    public function login(){
        //检查用户名和面是否存在
        $has_username_and_password = $this->has_username_and_password();

        if(!$has_username_and_password){
            return arrayChange(0,'用户名和密码不能为空');
        }
        $username = $has_username_and_password[0];
        $password = $has_username_and_password[1];

        $user = $this->where('username',$username)->first();
        //检查用户是否存在
        if(!$user){
            return arrayChange(0,'用户不存在');
        }
        //检查密码是否正确
        $hashed_password = $user->password;
        if(!Hash::check($password,$hashed_password)){
            return arrayChange(0,'密码错误');
        }
        //将用户信息写入session
        session()->put('username',$user->username);
        session()->put('user_id',$user->id);
        return arrayChange(1,'登录成功',['id' => $user->id]);
    }

    public function has_username_and_password(){
        $username = rq('username');
        $password = rq('password');
        if($username && $password){
            return [$username,$password];
        }
        else{
            return false;
        }
    }
    /*登出API*/
    public function logout(){
        session()->forget('username');
        session()->forget('user_id');

        return redirect('/');
    }
    /*检测用户是否登录*/
    public function is_logged_in(){
        return session('user_id')?:false;
    }
    /*修改密码api*/
    public function change_password(){
        if(!$this->is_logged_in()){
            return arrayChange(0,'login is required');
        }

        if(!rq('old_password') || !rq('new_password')){
            return arrayChange(0,'old password and new password are required');
        }
        $user = $this->find(session('user_id'));
        if(!Hash::check(rq('old_password'),$user->password)){
            return arrayChange(0,'invaild old password');
        }
        $user->password = bcrypt(rq('new_password'));
        if($user->save()){
            return arrayChange(1,'change success');
        }
        return arrayChange(0,'db update failed');
    }
    /*找回密码*/
    public function reset_password(){
        if($this->is_robet()){
            return arrayChange(0,'connect is long time ago');
        }
        if(!rq('phone')){
            return arrayChange(0,'phone is required');
        }
        $user = $this->where('phone',rq('phone'))->first();

        if(!$user){
            return arrayChange(0,'invaild phone number');
        }
        $captcha = $this->generate_captcha();
        $user->phone_captcha = $captcha;
        if($user->save()){
            session()->set('last_active_time',time());
            return arrayChange(1,'');
        }
        return arrayChange(0,'db update failed');

    }

    public function validate_reset_password(){
        if($this->is_robet()){
            return arrayChange(0,'connect is long time ago');
        }
        if(!rq('phone') || !rq('phone_captcha') || !rq('new_password')){
            return arrayChange(0,'phone,phone_captcha and new_password are required');
        }
        $user = $this
            ->where(['phone'=>rq('phone'),'phone_captcha'=>rq('phone_captcha')])
            ->first();

        if(!$user){
            return arrayChange(0,'invalid phone or invalid phone_captcha');
        }
        $user->password = bcrypt('new_password');
        if($user->save()){
            session()->set('last_active_time',time());
            return arrayChange(1,'');
        }
        return arrayChange(0,'db update failed');

    }

    /*生成验证码*/
    public function generate_captcha(){
        return rand(1000,9999);
    }

    public function is_robet($time = 10){
        if(!session('last_active_time')){
            return false;
        }
        $current_time = time();
        $last_active_time = session('last_active_time');

        return !($current_time-$last_active_time>$time);
    }
    public function answers(){
        return $this
            ->belongsToMany('App\Answer')
            ->withPivot('vote')
            ->withTimestamps();
    }
    public function questions(){
        return $this
            ->belongsToMany('App\Question')
            ->withPivot('vote')
            ->withTimestamps();
    }
}
