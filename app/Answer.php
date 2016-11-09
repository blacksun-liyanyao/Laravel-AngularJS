<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /*添加回答api*/
    public function add(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login required');
        }
        if(!rq('question_id') || !rq('content')){
            return arrayChange(0,'question_id and content are required');
        }

        $question = question_ins()->find(rq('question_id'));
        if(!$question){
            return arrayChange(0,'question  not exits');
        }
        $where['question_id'] = rq('question_id');
        $where['user_id'] = session('user_id');
        $answered = $this->where($where)->count();
        if($answered){
            return arrayChange(0,'不能重复回答');
        }
        $this->content = rq('content');
        $this->question_id = rq('question_id');
        $this->user_id = session('user_id');

        if($this->save()){
            return arrayChange(1,'add success',array('id'=>$this->id));
        }
        return arrayChange(0,'db insert fail');
    }
    /*更新回答api*/
    public function change(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login required');
        }
        if(!rq('id') || !rq('content')){
            return arrayChange(0,'id and content are required');
        }

        $answer = $this->find(rq('id'));
        if($answer->user_id != session('user_id')){
            return arrayChange(0,'权限不够');
        }

        $answer->content = rq('content');
        if($answer->save()){
            return arrayChange(1,'修改成功');
        }
        return arrayChange(0,'db save failed');
    }

    /*查看回答api*/
    public function read(){
        if(!rq('id') && !rq('question_id')){
            return arrayChange(0,'id and question_id are required');
        }
        if(rq('id')){
            $answer = $this
                ->with('user')
                ->with('users')
                ->find(rq('id'));
            if(!$answer){
                return arrayChange(0,'answer not exits');
            }
            return arrayChange(1,'',$answer);
        }
        if(!question_ins()->find(rq('question_id'))){
            return arrayChange(0,'question not exits');
        }
        $answers = $this
            ->where('question_id',rq('question_id'))
            ->get()
            ->keyBy('id');
        return arrayChange(1,'',$answers);
    }

    public function vote(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login required');
        }
        if(!rq('id') || !rq('vote')){
            return arrayChange(0,'id and vote are required');
        }
        $answer = $this->find(rq('id'));
        if(!$answer){
            return arrayChange(0,'answer not exits');
        }
        /*1赞同，2反对,3清空*/
        $vote = rq('vote');
        if($vote != 1 && $vote !=2 && $vote != 3){
            return arrayChange(0,'invalid vote');
        }
        $answer->users()
                ->newPivotStatement()
                ->where('user_id',session('user_id'))
                ->where('answer_id',rq('id'))
                ->delete();

        if($vote == 3){
            return arrayChange(1,'');
        }
        $answer->users()->attach(session('user_id'),['vote'=>$vote]);

        return arrayChange(1,'');
    }

    public function user(){
        return $this->belongsTo('App\user');
    }

    public function users(){
        return $this
            ->belongsToMany('App\User')
            ->withPivot('vote')
            ->withTimestamps();
    }
}
