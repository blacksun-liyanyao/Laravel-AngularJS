<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public function add(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login require');
        }
        if(!rq('title')){
            return arrayChange(0,'require title');
        }

        $this->title = rq('title');
        $this->user_id = session('user_id');
        if(rq('desc')){
            $this->desc = rq('desc');
        }
        if($this->save()){
            return arrayChange(1,'问题发表成功',['id' => $this->id]);
        }
        return arrayChange(0,'问题发表失败');
    }

    public function change(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login require');
        }
        if(!rq('id')){
            return arrayChange(0,'id is require ');
        }
        $question = $this->find(rq('id'));
        if(!$question){
            return arrayChange(0,'description is not found');
        }
        if($question->user_id != session('user_id')){
           return arrayChange(0,'你没有权限修改');
        }
        if(rq('title')){
            $question->title = rq('title');
        }
        if(rq('desc')){
            $question->desc = rq('desc');
        }

        if($question->save()){
            return arrayChange(1,'问题修改成功');
        }
        return arrayChange(0,'问题修改失败');
    }

    public function read(){
        if(rq('id')){
            return arrayChange(1,'查询成功',$this->find(rq('id')));
        }
        list($limit,$skip) = paginate(rq('page'));
        $r =  $this
            ->orderBy('created_at')
            ->limit($limit)
            ->skip($skip)
            ->get(['id','title','desc','user_id','created_at','updated_at'])
            ->keyBy('id');

        if($r){
            return arrayChange(1,'查询成功',$r);
        }
        return arrayChange(0,'查询失败');

    }

    public function remove(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login require');
        }

        if(!rq('id')){
            return arrayChange(0,'ID不能为空');
        }
        $question = $this->find(rq('id'));
        if(!$question){
            return arrayChange(0,'查询数据不存在');
        }
        if(session('user_id') != $question->user_id){
            return arrayChange(0,'没有权限做此操作');
        }
        if($question->delete()){
            return arrayChange(1,'删除成功');
        }
        return arrayChange(0,'删除失败');
    }

}
