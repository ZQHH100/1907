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
	<h3>品牌列表</h3><a href="{{url('category/create')}}">添加</a><hr/>
	<b>{{session('msg')}}</b>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>分类名称</th>
			<th>是否展示</th>
			<th>是否展示导航栏</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->cate_show==1?'是':'否'}}</td>
			<td>{{$v->cate_nav_show==1?'是':'否'}}</td>
			<td><a href="{{url('category/delete/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
				<a href="{{url('category/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
	</table>
</body>
</html>