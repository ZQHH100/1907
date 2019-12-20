<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin as Admins;
use Validator;
use Illuminate\Validation\Rule;
class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data=Admins::get();
        $data=Admins::paginate(2);
         $query=request()->all();
        return view('admin.admin.index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $request->validate([
            'admin_account' => 'required|unique:admin',
         ],[
            'admin_account.required'=>'账号名必填',
             'admin_account.unique'=>'账号已存在',
         ]);

        $post=$request->except('_token');
        if($request->hasFile('admin_logo')){
            $post['admin_logo']=$this->upload('admin_logo');
        }

        $admin=new Admins();
         $admin->admin_account=$post['admin_account'];
          $admin->admin_logo=$post['admin_logo']??'';
          $res=$admin->save();

           if($res){
            return redirect('admin')->with('msg','添加成功');
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
        $data=Admins::find($id);
         return view('admin.admin.edit',['data'=>$data]);
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
            'admin_account' => [
                'required',
                Rule::unique('admin')->ignore($id,'admin_id'),]
         ],[
            'admin_account.required'=>'账号名必填',
             'admin_account.unique'=>'账号已存在',
         ]);

         if($request->hasFile('admin_logo')){
            $post['admin_logo']=$this->upload('admin_logo');
        }
        Admins::where('admin_id',$id)->update($post);
         return redirect('admin')->with('msg','修改成功');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Admins::destroy($id);
        if($res){
             echo "<script>alert('删除成功');location.href='/admin';</script>";
        }
    }
      public function upload($file){
          $imgs = request()->file($file);
            //单文件上传
        //验证文件是否上传成功
        if ($imgs->isValid()) {
            //接受文件并上传
         $path = request()->file($file)->store('imgs');
         //返回上传文件的路径
         return $path;
        }
         exit('未获取到上传文件或上传过程出错');

     }
}
