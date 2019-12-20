<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods as Good;
use App\Model\Category as Cate;
use App\Model\Brand;
class Goods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Good::join("brand","goods.brand_id","=","brand.brand_id")
            ->join("category","goods.cate_id","=","category.cate_id")
            ->select('goods.*','brand_name','cate_name')
            ->paginate(6);
            foreach($data as $k=>$v){
                $data[$k]->goods_imgs=explode('|',$v->goods_imgs);
            }
        $query=request()->all();

        return view('admin.goods.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $BrandInfo=Brand::get();
        $CateInfo=Cate::get();
        $info=$this->get_cate($CateInfo);
        return view('admin.goods.create',['info'=>$info,'BrandInfo'=>$BrandInfo]);
    }

     function get_cate($res,$parent_id=0,$lv=1)
    {
        static  $array =[];
        foreach($res as $v){
            if($v['parent_id']==$parent_id){
                $v['lv'] =$lv;
                $array[]=$v;    
                $this->get_cate($res,$v['cate_id'],$v['lv']+1);
            }
        }
        return $array;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
    $request->validate([
    'goods_name' => 'required|unique:goods|max:17|min:2',
    'goods_price' => 'required',
    'goods_num' => 'required',

 ],[
    'goods_name.required'=>'商品名称必填',
    'goods_name.unique'=>'商品名称已存在',
    'goods_name.max'=>'商品名称最大17位',
    'goods_name.min'=>'商品名称最小2位',
    'goods_price.required'=>'商品价格必填',
    'goods_num.required'=>'商品数量必填',

    
 ]);
    //单文件上传
    if($request->hasFile('goods_img')){
        $post['goods_img']=$this->upload('goods_img');
        }
    //多文件上传
    if($request->hasFile('goods_imgs')){
        $imgs=$this->upload('goods_imgs');
        $post['goods_imgs']=implode('|',$imgs);
      
   }
        $goods=new Good;
        $goods->goods_name=$post['goods_name'];
        $goods->goods_img=$post['goods_img']??'';
        $goods->goods_imgs=$post['goods_imgs']??'';
        $goods->goods_num=$post['goods_num'];
        $goods->goods_price=$post['goods_price'];
        $goods->cate_id=$post['cate_id'];
        $goods->brand_id=$post['brand_id'];
        $res=$goods->save(); 
         if($res){
            return redirect('goods')->with('msg','添加成功');
        }
    }
        public function upload($file){
        $imgs = request()->file($file);
        if(is_array($imgs)){
            //多文件上传
            $result=[];
            foreach($imgs as $v){
                //验证文件是否上传成功
                if ($v->isValid()){
                    //接受文件并上传
                    $result[]=$v->store('uploads');
                }
            }
            return $result;
        }else{
        //单文件上传
        //验证文件是否上传成功
        if ($imgs->isValid()) {
            //接受文件并上传
         $path = request()->file($file)->store('uploads');
         //返回上传文件的路径
         return $path;
        }

         }
         exit('未获取到上传文件或上传过程出错');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Good::find($id);
        $BrandInfo=Brand::get();
        $CateInfo=Cate::get();
        $info=$this->get_cate($CateInfo);
        return view('admin.goods.edit',['data'=>$data,'info'=>$info,'BrandInfo'=>$BrandInfo]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=$request->except('_token');

         $request->validate([
    'goods_name' => 'required|unique:goods|max:17|min:2',
    'goods_price' => 'required',
    'goods_num' => 'required',

 ],[
    'goods_name.required'=>'商品名称必填',
    'goods_name.unique'=>'商品名称已存在',
    'goods_name.max'=>'商品名称最大17位',
    'goods_name.min'=>'商品名称最小2位',
    'goods_price.required'=>'商品价格必填',
    'goods_num.required'=>'商品数量必填',

    
 ]);

         //单文件上传
        if($request->hasFile('goods_img')){
        $post['goods_img']=$this->upload('goods_img');
     }
        Good::where('goods_id',$id)->update($post);
        return redirect('goods')->with('msg','修改成功');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Good::destroy($id);
        if($res){
             echo "<script>alert('删除成功');location.href='/goods';</script>";
        }
    }
}
