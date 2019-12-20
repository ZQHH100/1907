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
	<h3>分类添加</h3><a href="{{url('admin')}}">列表</a><hr/>
		@if ($errors->any())
		 <div class="alert alert-danger">
		 <ul>
		 @foreach ($errors->all() as $error)
		 <li>{{ $error }}</li>
		 @endforeach
		 </ul>
		 </div>
		@endif
	 <form class="form-horizontal" action="{{url('admin/update',$data->admin_id)}}" role="form"  method="post" enctype="multipart/form-data">
	 	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员账号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="admin_account"  value="{{$data->admin_account}}" id="firstname" 
				   placeholder="请输入分类名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="admin_logo" value="{{$data->admin_logo}}" id="lastname" 
				   >
		</div>
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