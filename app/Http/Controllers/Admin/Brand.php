<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Brand as Brands;
use App\Http\Requests\StoreBrandPost;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //showMeg();
       // session(['name'=>'zqhh']);//设置
       //  request()->session()->save();//存储到服务器
        // session(['name'=>null]);//删除
        // request()->session()->save();
        // $name=session('name');//获取
        // dump($name);
        //request 实例
        // request()->session()->put('age', '18');//设置
        // request()->session()->save();//存储到服务器
        // $age =request()->session()->get('age');//获取
        // dump($age);

        // $age = request()->session()->pull('age');//获取后删除
        // dump($age);


        // request()->session()->forget('age');//删除单个session
        // $age =request()->session()->get('age');//获取
        // dd($age);
        
        // request()->session()->flush();//清空所以session
        //  $name=session('name');//获取
        // dump($name);
        //  $age =request()->session()->get('age');//获取
        // dd($age);
        //$data=DB::table('brand')->get();
       // dd($data);
         // $data=Brands::get();
         $brand_name=request()->brand_name;
         $where=[];
         if($brand_name){
            $where[]=['brand_name','like',"%$brand_name%"];
         }
         $brand_url=request()->brand_url;
         if($brand_url){
            $where[]=['brand_url','like',"%$brand_url%"];
         }



         $page=request()->page;

         //Redis::del('data_'.$page.'_'.$brand_name.'_'.$brand_url);
         // $data=Cache::get('data_'.$page.'_'.$brand_name.'_'.$brand_url);
         // echo 'data_'.$page.'_'.$brand_name.'_'.$brand_url;
         $data=Redis::get('data_'.$page.'_'.$brand_name.'_'.$brand_url);
        // dump($data);die;
         $data=unserialize($data);
         //dd($data);
         if(!$data){
                echo 'DB';
         $pageSize=config('app.pageSize');
        // DB::connection()->enableQueryLog();
         $data=Brands::where($where)->orderBy('brand_id','desc')->paginate($pageSize);
        // Cache::put(['data_'.$page.'_'.$brand_name.'_'.$brand_url=>$data],20);
        // dd($data);
         Redis::setex('data_'.$page.'_'.$brand_name.'_'.$brand_url,20,serialize($data));
         }
         //dd($data);
         foreach($data as $k=>$v){
            $data[$k]->brand_logo2=explode('|',$v->brand_logo2);
         }
        //dd($data);

         // $logs = DB::getQueryLog();
      //  dump($logs);

         $query=request()->all();
         // dd($query);
         return view('admin.brand.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.;
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     // 第二种验证
     // public function store(StoreBrandPost $request)
    {
        //第一种验证
        // $request->validate([
        //  'brand_name' => 'required|unique:brand|max:12|min:2',
        //  //                //为空  //唯一性验证   最长   最短 
        //  'brand_url' => 'required',
        // ],[
        //     'brand_name.required'=>'品牌名称必填',
        //     'brand_name.unique'=>'品牌名称已存在',
        //     'brand_name.max'=>'品牌名称最大长度为12位',
        //     'brand_name.min'=>'品牌名称最小长度为2位',
        //     'brand_url.required'=>'网址必填',
        // ]);
        // 接受所有值
        $post=$request->except('_token');

         // dd($post);
          $validator = Validator::make($post, [
              'brand_name' => 'required|unique:brand|max:12|min:2',
              'brand_url' => 'required',
             ],[
                'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最大长度为12位',
            'brand_name.min'=>'品牌名称最小长度为2位',
            'brand_url.required'=>'网址必填',
             ]);
          if ($validator->fails()) {
             return redirect('brand/create')
             ->withErrors($validator)
             ->withInput();
             }
         //$post=$request->only(['brand_name']);
         //$res = DB::table('brand')->insert($post);
        // dump($post);
         //单文件上传
         if($request->hasFile('brand_logo')){
              $post['brand_logo']= $this->upload('brand_logo');
         }
         //多文件上传
        if ($request->hasFile('brand_logo2')) {  
             $imgs =$this->upload('brand_logo2');
             $post['brand_logo2']=implode('|',$imgs);
        }

         //ORM
         //$res=Brands::create($post);
            $brand=new Brands();
            $brand->brand_name=$post['brand_name'];
              $brand->brand_url=$post['brand_url'];
                $brand->brand_logo=$post['brand_logo']??'';
                $brand->brand_logo2=$post['brand_logo2']??'';
                  $brand->brand_desc=$post['brand_desc'];
                    $res=$brand->save();
              //$res=Brands::insert($post);
        if($res){
            return redirect('brand');
        }
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
        
        //$data=DB::table('brand')->where('brand_id',$id)->first();
       //ORM
        $data=Brands::find($id);
        return view('admin.brand.edit',['data'=>$data]);
       // echo $id;
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

        $validator = Validator::make($post, [
            //'brand_name' => 'required|unique:brand|max:12|min:2',
            'brand_name' => [
                'required',
                Rule::unique('brand')->ignore($id,'brand_id'),
                'max:12',
                'min:2'
            ],
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_name.max'=>'品牌名称最大长度为12位',
            'brand_name.min'=>'品牌名称最小长度为2位',
            'brand_url.required'=>'品牌网址必填',
        ]);
        //文件上传
             if($request->hasFile('brand_logo')){
              $post['brand_logo']= $this->upload('brand_logo');
         }
        // dd($post);
  
        //DB::table('brand')->where('brand_id',$id)->update($post);
        //ORM
        // $brand=Brands::find($id);
        //   $brand->brand_name=$post['brand_name'];
        //       $brand->brand_url=$post['brand_url'];
        //         $brand->brand_logo=$post['brand_logo']??'';
        //           $brand->brand_desc=$post['brand_desc'];
        //             $brand->save();
        Brands::where('brand_id',$id)->update($post);
        return redirect('brand')->with('msg','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$res= DB::table('brand')->where('brand_id',$id)->delete();
        //$res=Brands::destroy($id);
        $res=Brands::where('brand_id',$id)->delete();
        if($res){
            echo "<script>alert('删除成功');location.href='/brand';</script>";
           // return redirect('brand')->with('msg','删除成功');
        }
    }
    public function checkonly(){
        $brand_name=request()->post();
        $where=[];
        if($brand_name){
            $where['brand_name']=$brand_name;
        }
        $count=Brands::where($where)->count();
        echo $count;
    
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
}
