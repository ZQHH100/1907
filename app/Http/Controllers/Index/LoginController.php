<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Indexs;

class LoginController extends Controller
{
     public function login(){
    	return view('index.login');
    }
    public function loginDo(){
    	

   	 	 $post=request()->except('_token');
       $where = [
            ['account','=',$post['account']],
            ['password','=',$post['password']]
       ];
    	 $user=\DB::table('indexs')->where($where)->first();
    	 if($user){
    	 	session(['user'=>$user]);
    	 		request()->session()->save();
    	 		  	return redirect('/')->with('msg','登录成功');
    	 }

    }
    public function reg(){
    	return view('index.reg');
    }
    public function regdo(){
    	$post=request()->except('_token');
    	$emailInfo=cookie('emailInfo');
   		if(empty($emailInfo)){
   			$this->error('请先获取验证码');
   		}
   		//验证邮箱
   		$reg='/^[0-9a-z]{6,16}@[0-9a-z]{1,4}\.com$/';
    	$user_model=model('User');
    	if(empty($data['user_email'])){
			$this->error('邮箱必填');exit;
    	}else if(!preg_match($reg,$data['user_email'])){
			$this->error('邮箱格式有误');exit;
    	}else{
    		$where=[
    			['user_email','=',$data['user_email']]
    		];
    		$count=$user_model->where($where)->count();
    		if($count>0){
				$this->error('此邮箱已被注册');exit;
    		}else if($emailInfo['email']!=$data['user_email']){
    			//此邮箱没有被注册过
    			$this->error('发送验证码邮箱与注册邮箱不一致');exit;
    		}
    	}

   		//验证 验证码
   		if(empty($data['user_code'])){
   				$this->error('验证码必填');exit;
   		}else if($emailInfo['code']!=$data['user_code']){
   				$this->error('验证码有误');exit;
   		}else if((time()-$emailInfo['send_time'])>300){
   				$this->error('验证码已失效，五分钟内输入有效');exit;
   		}

   		//验证密码
   		
   		//验证确认密码
   		$data['user_pwd']=md5($data['user_pwd']);
   		$result=$user_model->save($data);
   		if($result){
   			echo '注册成功';
   		}else{
   			echo '注册失败';
   		}
    }
}
