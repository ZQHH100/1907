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
	<h3>分类添加</h3><a href="{{url('category')}}">列表</a><hr/>
		@if ($errors->any())
		 <div class="alert alert-danger">
		 <ul>
		 @foreach ($errors->all() as $error)
		 <li>{{ $error }}</li>
		 @endforeach
		 </ul>
		 </div>
		@endif
	 <form class="form-horizontal" action="{{url('category/store')}}" role="form"  method="post" >
	 	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="cate_name" id="firstname" 
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  name="cate_show" value="1"  >是
		    <input type="radio" name="cate_show" value="2"  >否

		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示导航栏</label>
		<div class="col-sm-10">
			<input type="radio" name="cate_nav_show" value="1" 
				   >是
		    <input type="radio" name="cate_nav_show" value="2" 
				   >否
		</div>
	</div>


		<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-10">
			<select name="parent_id">
			<option value="0">--请选择--</option>
			@foreach($cateInfo as $v)
			<option value="{{$v['cate_id']}}">@php echo str_repeat('&nbsp;&nbsp;',$v['level']*4)@endphp {{$v['cate_name']}}</option>
			@endforeach 

			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>
</body>
</html>