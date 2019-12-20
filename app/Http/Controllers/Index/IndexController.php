<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;
use App\Model\Cart;

class IndexController extends Controller
{
    public function index(){
    	$IndexInfo=Goods::get();
    	$data=Category::where('parent_id','=',0)->get();
    	//dd($data);
    	//$cateInfo=$this->getCateInfo($data);
    	//dd($cateInfo);
    	//dd($data);
    	return view('index.index',['IndexInfo'=>$IndexInfo,'data'=>$data]);
 	   }

   
    public function cartList(){
        if(empty(session('user'))){
            echo " 222222";die;
        }

    	   $cartInfo = Cart::join("goods", "goods.goods_id", "=", "cart.goods_id")
                ->orderBy('add_time', 'desc')
                ->get();
//        dd($cartInfo);
            ///cache(['cartInfo' => $cartInfo], 10);
        return view('index.car',['cartInfo'=>$cartInfo]);
    }
    //加入购物车
    public function carAdd(){

         $goods_id=request()->goods_id;
        $buy_number=request()->buy_number;
    //dd($buy_number);
      $user_id=getUserId();
      dd($user_id);
      //dd($user_id);
      $user=session('user');
        $where=[
            ['goods_id','=',$goods_id],
             ['user_id','=',$user_id],
        ];

   $cartInfo=Cart::where($where)->first();
   if(empty($cartInfo)){
        //检测库存
         $result=$this->checkGoodsNum($user,$goods_id,$buy_number,$cartInfo['buy_number']);
        if(empty($result)){
            echo json_encode(['font'=>'您购买的数量已经超过库存','code'=>2]);exit;  
        }
        //累加
        $res=Cart::where($where)->update(['buy_number'=>$buy_number+$cartInfo['buy_number'],'add_time'=>time()]);
        if($res){
            echo json_encode(['font'=>'','code'=>1]);exit;      
        }else{
            echo json_encode(['font'=>'累加失败','code'=>2]);exit;  
        }
   }else{
        //添加
           $result=$this->checkGoodsNum($goods_id,$buy_number);
           if(empty($result)){
               echo json_encode(['font'=>'您购买的数量已经超过库存','code'=>2]);exit;  
           }
           $arr=['buy_number'=>$buy_number,'goods_id'=>$goods_id,'user_id'=>$user_id,'add_time'=>time()];
           $res1=Cart::create($arr);
           if($res1){
            echo json_encode(['font'=>'','code'=>1]);exit;  
        }else{
            echo json_encode(['font'=>'累加失败','code'=>2]);exit;  
        }

   }

// 检测库存

//                 $arr=['user_id'=>$user_id,'goods_id'=>$goods_id,'buy_number'=>$buy_number,'add_time'=>time()];
//                 $info=Cart::insert($arr);
//                 //dd($info);
//                 if($info){
//                     echo 1;
//                 }
// die;
//      if(empty($cartInfo)){
//         }else{
            //     $buy_number=$buy_number+$cartInfo['buy_number'];
            // $res=Cart::where('goods_id',$goods_id)->update(['buy_number'=>$buy_number,'add_time'=>time()]);

            // if($res){
            //     echo 1;
            //   }else{
            //     echo 2;
            //   }
        // }
}

    //检测库存
    public function checkGoodsNum($goods_id,$buy_number,$already_num=0){
        $goods_num=Goods::where('goods_id','=',$goods_id)->value('goods_num');
        if($buy_number+$already_num>$goods_num){
        return false;
        }else{
            return true;
        }
    }

     public function proinfo($id){
    	$IndexInfo=Goods::where('goods_id','=',$id)->first();
    	//dd($IndexInfo);
    	//dd($IndexInfo);
    	return view('index.proinfo',['IndexInfo'=>$IndexInfo]);
    }

}
