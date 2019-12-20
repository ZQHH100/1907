<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Article as Art;
use Validator;
use Illuminate\Validation\Rule;
class Article extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $art_name=request()->art_name;
        $where=[];
        if($art_name){
            $where[]=['art_name','like',"%$art_name%"];
        }
        $data=Art::where($where)->paginate(2);
        $query=request()->all();
        return view('admin.article.index',['data'=>$data,'query'=>$query]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');   

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
            'art_name' => 'required|unique:article',
            'arts_id' => 'required',
            'art_sign' => 'required',
            'art_show' => 'required',
         ],[
            'art_name.required'=>'作品名称必填',
             'art_name.unique'=>'作品名称已存在',
             'arts_id.required'=>'文章分类不能为空',
             'art_sign.required'=>'文章重要性必填',
             'art_show.required'=>'是否显示不能为空',
         ]);

         
        $post=$request->except('_token');
         //单文件上传
         if($request->hasFile('art_img')){
              $post['art_img']= $this->upload('art_img');
         }

          $article=new Art();
            $article->art_name=$post['art_name'];
                $article->arts_id=$post['arts_id'];
                  $article->art_sign=$post['art_sign'];
                    $article->art_show=$post['art_show'];
                      $article->art_author=$post['art_author'];
                        $article->art_email=$post['art_email'];
                          $article->art_keyword=$post['art_keyword'];
                             $article->art_desc=$post['art_desc'];
                                $article->art_img=$post['art_img']??'';
                 
                    $res=$article->save();

       // $res=Art::create($post);
        if($res){
            return redirect('article')->with('msg','添加成功');
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
         $data=Art::find($id);
        return view('admin.article.edit',['data'=>$data]);
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
            'art_name' => [
                'required',  Rule::unique('article')->ignore($id,'art_id'),],
            'arts_id' => 'required',
            'art_sign' => 'required',
            'art_show' => 'required',
         ],[
            'art_name.required'=>'作品名称必填',
             'art_name.unique'=>'作品名称已存在',
             'arts_id.required'=>'文章分类不能为空',
             'art_sign.required'=>'文章重要性必填',
             'art_show.required'=>'是否显示不能为空',
         ]);
      
         if($request->hasFile('art_img')){
              $post['art_img']= $this->upload('art_img');
         }
         
        Art::where('art_id',$id)->update($post);
          return redirect('article')->with('msg','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Art::destroy($id);
        if($res){
             echo "<script>alert('删除成功');location.href='/article';</script>";
        }
    }
     public function upload($file){
          $imgs = request()->file($file);
            //单文件上传
        //验证文件是否上传成功
        if ($imgs->isValid()) {
            //接受文件并上传
         $path = request()->file($file)->store('uploads');
         //返回上传文件的路径
         return $path;
        }
         exit('未获取到上传文件或上传过程出错');

     }
}
