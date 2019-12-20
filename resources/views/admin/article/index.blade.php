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
	<h3>文章列表</h3><a href="{{url('article/create')}}">添加</a><hr/>
	<b>{{session('msg')}}</b>
	<form action="" method="">
		<input type="text" name="art_name" value="{{$query['art_name']??''}}" placeholder="请输入作品名">
		<button>搜索</button>
	</form>
	<table class="table table-hover">
	<thead>
		<tr>
			<th>编号</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>上传图片</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@if($data)
		@foreach($data as $v)
		<tr>
			<td>{{$v->art_id}}</td>
			<td>{{$v->art_name}}</td>
			<td>{{$v->arts_id}}</td>
			<td>{{$v->art_sign==1?'√':'×'}}</td>
			<td>{{$v->art_show==1?'√':'×'}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->art_img}}"style="width:50px"></td>
			<td><a href="{{url('article/delete/'.$v->art_id)}}" class="btn btn-danger">删除</a>
				<a href="{{url('article/edit/'.$v->art_id)}}" class="btn btn-info">编辑</a>
			</td>
		</tr>
		@endforeach
		@endif
	</tbody>
	</table>
		{{$data->appends($query)->links()}}
</body>
</html>