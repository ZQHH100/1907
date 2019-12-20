<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="maincont">
     <header>

      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider" value="{{$IndexInfo->goods_img}}">
      <img src="{{env('UPLOAD_URL')}}{{$IndexInfo->goods_img}}"/>
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr goods_num="{{$IndexInfo->goods_num}}">
       <th><strong class="orange">￥{{$IndexInfo->goods_price}}</strong></th>
      <td> 
        购买数量  <button class="decrease" id="add">+</button>
           <input type="text" value="1" id="buy_number" >{{session('msg')}}
           <button class="decrease" id="less">-</button>

       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$IndexInfo->goods_name}}</strong>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="{{env('UPLOAD_URL')}}{{$IndexInfo->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id='addCart' href="javascript:;">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
  
 <!--     jq加减-->
   <!--  <script src="/static/index/js/jquery.spinner.js"></script> --> 
 <!--   <script>
	$('.spinnerExample').spinner({});
	</script> -->
  </body>
</html>
  <script src="{{asset('/static/admin/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript">
       $(function(){
            //点击+
            $(document).on("click",'#add',function(){
                var buy_number=parseInt($('#buy_number').val());
                //alert(buy_number);
                var goods_num =parseInt($(this).parents("tr").attr("goods_num"));
                //alert(goods_num);
                buy_number=parseInt(buy_number);
                if(buy_number>=goods_num){
                  $("#buy_number").val(goods_num);

                }else{
                  var buy_number=buy_number+1;
                  $("#buy_number").val(buy_number);
                }

              })
             //点击-
            $(document).on("click",'#less',function(){
                var buy_number=parseInt($('#buy_number').val());

                if(buy_number<=1){
                  $("#buy_number").val(1);

                }else{
                  var buy_number=buy_number-1;
                  $("#buy_number").val(buy_number);
                }

              })
                    //失去焦点
        $(document).on('blur','#buy_number',function () {
            var goods_num =parseInt($(this).parents("tr").attr("goods_num"));//获取库存
            var buy_number=parseInt($("#buy_number").val());//获取文本框的值

            //检测是否是数字
            var reg= /^\d+$/;
            if(!reg.test(buy_number)||parseInt(buy_number)<=0){
                $("#buy_number").val(1);
            }else if(parseInt(buy_number)>=goods_num){
                $("#buy_number").val(goods_num);
            }else{
                buy_number=parseInt(buy_number);
                $("#buy_number").val(buy_number);
            }
        })
        //加入购物车
        $(document).on("click","#addCart",function(){
          var buy_number=$("#buy_number").val();
          //console.log(buy_number);
          var goods_id="{{$IndexInfo->goods_id}}";
          $.ajaxSetup({
       headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
                    $.ajax({
                   url:"{{url('carAdd')}}",
                   type:'post',
                   data:{goods_id:goods_id,buy_number:buy_number},
                    async:false,    
                    }).done(function(res){
                      if(res.code==1){
                        alert('添加成功');
                      // location.href="{{url('/cartList')}}";
                   }else{
                        alert('添加失败');
                          //location.href="{{url('/car')}}";
                   }
                    })
        })
})
          
</script>