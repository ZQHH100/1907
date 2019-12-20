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
	<h3>品牌列表</h3><a href="{{url('brand/create')}}">添加</a><hr/>
	<b>{{session('msg')}}</b>
	<form action="" method="">
		<input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入品牌名">
		<input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入网址">
		<button>搜索</button>
	</form>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌LoGo</th>
			<th>多条件上传LoGo</th>
			<th>品牌介绍</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}"style="width:50px"></td>
		<td>
		@foreach($v->brand_logo2 as $vv)
			<img src="{{env('UPLOAD_URL')}}{{$vv}}"  width="50px" height="50px">
		@endforeach
		</td>
			<td>{{$v->brand_desc}}</td>
			<td><a href="{{url('brand/delete/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
				<a href="{{url('brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
	</table>
		{{$data->appends($query)->links()}}
</body>
</html>
