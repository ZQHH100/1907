<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
	<script src="/static/admin/js/jquery-3.2.1.min.js"></script>
	<script src="/static/admin/js/bootstrap.min.js"></script>
</head>

<body>
	<h3>分类修改</h3><a href="{{url('article')}}">列表</a><hr/>
		@if ($errors->any())
		 <div class="alert alert-danger">
		 <ul>
		 @foreach ($errors->all() as $error)
		 <li>{{ $error }}</li>
		 @endforeach
		 </ul>
		 </div>
		@endif
	 <form class="form-horizontal" action="{{url('article/update',$data->art_id)}}" role="form"  method="post" >
	 	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"  value="{{$data->art_name}}"  name="art_name" id="firstname" 
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10"  >
			<select name="arts_id" >
			<option value="0">--请选择--</option>
			<option value="1">手机促销</option>
			<option value="2">3G资讯</option>
			<option value="3">站内快讯</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio" name="art_sign" value="1" {{($data->art_sign)==1?'checked':''}}
				   >是
		    <input type="radio" name="art_sign" value="2" {{($data->art_sign)==2?'checked':''}}
				   >否
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="art_show" value="1" {{($data->art_show)==1?'checked':''}}
			>是
		    <input type="radio" name="art_show" value="2" {{($data->art_show)==2?'checked':''}}
			 >否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="art_author" value="{{$data->art_author}}"  id="firstname" 
				   placeholder="请输入作者名称">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="art_email" value="{{$data->art_email}}"  id="firstname" 
				   placeholder="请输入作者邮箱">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="art_keyword" value="{{$data->art_keyword}}"  id="firstname" 
				   placeholder="请输入关键字">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="art_desc" id="firstname" 
				   placeholder="请输入网页描述">{{$data->art_keyword}}</textarea> 
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="art_img" id="lastname" 
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
</body>
</html>