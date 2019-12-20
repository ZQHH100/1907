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
	<h3>品牌列表</h3><a href="{{url('admin/create')}}">添加</a><hr/>
	<b>{{session('msg')}}</b>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>管理员编号</th>
			<th>管理员账号</th>
			<th>管理员头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_account}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->admin_logo}}"style="width:50px"></td>
			<td><a href="{{url('admin/delete/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
				<a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
	</table>
		{{$data->appends($query)->links()}}
</body>
</html>