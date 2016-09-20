<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Request;
use Hash;

class User extends Model
{
    /*注册API*/
    public function signup(){
        $has_username_and_password = $this->has_username_and_password();
        //检查用户名密码是否为空
        if(!$has_username_and_password){
            return ['status' => 0, 'msg' => '用户名和密码不能为空'];
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
            return ['status' => 0, 'msg' => '用户名已存在'];
        }
        //加密密码
        $hashed_password = bcrypt($password);
        //存入数据库
        $user = $this;
        $user->password = $hashed_password;
        $user->username = $username;
        if($user->save()){
            return ['status' => 1, 'id' => $user->id];
        }else{
            return ['status' => 0, 'id' => 'DB insert failed'];
        }
    }
    /*登录API*/
    public function login(){
        //检查用户名和面是否存在
        $has_username_and_password = $this->has_username_and_password();

        if(!$has_username_and_password){
            return ['status' => 0, 'msg' => '用户名和密码不能为空'];
        }
        $username = $has_username_and_password[0];
        $password = $has_username_and_password[1];

        $user = $this->where('username',$username)->first();
        //检查用户是否存在
        if(!$user){
            return ['status' => 0,'msg' => '用户不存在'];
        }
        //检查密码是否正确
        $hashed_password = $user->password;
        if(!Hash::check($password,$hashed_password)){
            return ['status' => 0,'msg' => '密码错误'];
        }
        //将用户信息写入session
        session()->put('username',$user->username);
        session()->put('user_id',$user->id);
        return ['status' => 1,'id' => $user->id];
    }

    public function has_username_and_password(){
        $username = Request::get('username');
        $password = Request::get('password');
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

}
