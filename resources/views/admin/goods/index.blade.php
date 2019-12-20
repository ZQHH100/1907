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
<h3><a style= href="{{url('/brand/index')}}">品牌表 | </a><a  href="{{url('/cate/index')}}">分类表 | </a><a  href="{{url('/admin/index')}}">管理员表</a></h3>
<h2>商品列表</h2>
<h3><a href="{{url('/goods/create')}}">添加</a></h3>
<b >{{session('msg')}}</b>
	<table border="7">
	<tr>
	<td>商品名</td>
	<td>商品价格</td>
	<td>商品数量</td>
	<td>商品图片</td>
	<td>商品相册</td>
	<td>所属分类</td>
	<td>所属品牌</td>
	<td>操作</td>
	</tr>
	  @if($data)
	  @foreach ($data as $v)
	<tr>
	<td>{{$v->goods_name}}</td>
	<td>{{$v->goods_price}}</td>
	<td>{{$v->goods_num}}</td>
	<td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="80"></td>
	<td>
		@foreach ($v->goods_imgs as $vv)
		<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="80">
		@endforeach
	</td>
	<td>{{$v->cate_name}}</td>
	<td>{{$v->brand_name}}</td>
	
	<td>
<a href="{{url('/goods/delete/'.$v->goods_id)}}"  class="btn btn-danger">删除</a>
<a href="{{url('/goods/edit/'.$v->goods_id)}}"  class="btn btn-danger">修改</a>
	</td>

	</tr>
  @endforeach
  @endif
	</table>
	{{$data->appends($query)->links()}}

</body>
</html>