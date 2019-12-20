<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CategoryPost;
use App\Model\Category as Cate;
class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Cate::get();
        $data1=$this->getCateInfo($data);
        return view('admin.category.index',['data'=>$data1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Cate::get()->toArray();
        
        $cateInfo=$this->getCateInfo($data);
        //dd($cateInfo);
        
        return view('admin.category.create',['cateInfo'=>$cateInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //public function store(CategoryPost $request)
    {
        $request->validate([
            'cate_name' => 'required|unique:category|max:10|min:2',
         ],[
            'cate_name.required'=>'品牌名称必填',
             'cate_name.unique'=>'品牌名称已存在',
              'cate_name.max'=>'品牌名称最大长度为10位',
                'cate_name.min'=>'品牌名称最小长度为2位',
         ]);

        $post = $request->except('_token');
      //  $post = $request->except('parent_id');
        //dd($post);
        $res=Cate::create($post);

        //dd($res);
         if($res){
            return redirect('category');
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
        //$data=DB::table('category')->where('cate_id',$id)->first();
         $data=Cate::get();
         $cateInfo=$this->getCateInfo($data);
        //$data=Cate::first();
         $data=Cate::find($id);
         return view('admin.category.edit',['data'=>$data],['cateInfo'=>$cateInfo]);
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
        Cate::where('cate_id',$id)->update($post);
        return redirect('category')->with('msg','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //$res = DB::table('category')->where('cate_id',$id)->delete();
        //$res = Cate::destroy($id);
        $res=Cate::where('cate_id',$id)->delete();
        if($res){
            echo "<script>alert('删除成功');location.href='/category';</script>";
            //return redirect('category')->with('msg','删除成功');       
             }
       
    }
    function getCateInfo($cateInfo,$parent_id=0,$level=1){
        static $info=[];
        foreach($cateInfo as $k=>$v){
            if($v['parent_id']==$parent_id){
                $v['level']=$level;
                $info[]=$v;
                $this->getCateInfo($cateInfo,$v['cate_id'],$v['level']+1);
            }
        }
        return $info;
    }

}
