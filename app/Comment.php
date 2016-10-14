<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   public function add(){
       if(!userins()->is_logged_in()){
           return arrayChange(0,'login required');
       }

       if(!rq('content')){
           return arrayChange(0,'empty content');
       }

       if((!rq('question_id') && !rq('answer_id'))
           ||
           (rq('question_id') && rq('answer_id'))){
           return arrayChange(0,'question_id or answer_id is required');
       }

       if(rq('question_id')){
           $question = question_ins()->find(rq('question_id'));
           if(!$question){
               return arrayChange(0,'question not exits');
           }
           $this->question_id = rq('question_id');
       }else{
           $answer = answer_ins()->find(rq('answer_id'));
           if(!$answer){
               return arrayChange(0,'answer not exits');
           }
           $this->answer_id = rq('answer_id');
       }

       if(rq('reply_to')){
           $target = $this->find(rq('reply_to'));
           if(!$target){
               return arrayChange(0,'target comment not exits');
           }
           if($target->user_id == session('user_id')){
               return arrayChange(0,'can not reply_to yourself');
           }
           $this->reply_to = rq('reply_to');
       }

       $this->content = rq('content');
       $this->user_id = session('user_id');

       if($this->save()){
           return arrayChange(1,'',array('id'=>$this->id));
       }
       return arrayChange(0,'db insert failed');

   }

    public function read(){

        if((!rq('question_id') && !rq('answer_id'))
            ||
            (rq('question_id') && rq('answer_id'))){
            return arrayChange(0,'question_id or answer_id is required');
        }

        if(rq('question_id')){
            $question = question_ins()->find(rq('question_id'));
            if(!$question){
                return arrayChange(0,'question not exits');
            }
            $data = $this->where('question_id',rq('question_id'));
        }
        else{
            $answer = answer_ins()->find(rq('answer_id'));
            if(!$answer){
                return arrayChange(0,'answer not exits');
            }
            $data = $this->where('answer_id',rq('answer_id'));
        }
        $data = $data->get()->keyBy('id');
        return arrayChange(1,'',$data);
    }

    public function remove(){
        if(!userins()->is_logged_in()){
            return arrayChange(0,'login required');
        }
        if(!rq('id')){
            return arrayChange(0,'id is required');
        }
        $comment = $this->find(rq('id'));
        if(!$comment){
            return arrayChange(0,'comment not exits');
        }

        if($comment->user_id != session('user_id')){
            return arrayChange(0,'permission denied');
        }

        $this->where('reply_to',rq('id'))->delete();
        if($comment->delete()){
            return arrayChange(1,'delete success');
        }
        return arrayChange(0,'db removed failed');

    }
}
