<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//    echo 'hello';
// });

// Route::view('/welcome','welcome',['welcome'=>'你好']);

// Route::get('login','Index\Test@test');

//Route::get('la','Index\Test@test');

//Route::get('lag','Index\Test@login');

//Route::get('index','Index\Login@login');

//Route::view('/index','book');



//Route::get('login','Index\Login@login');

//Route::post('loginDo','Index\Login@loginDo')->name('do');



// Route::get('test/{id}',function($id){
// 		echo $id;
//});


// Route::get('test/{id}/{name}',function($id,$goodsname){
// 	echo $id."<br/>";
// 	echo $goodsname;
// });


// Route::get('test/{id?}',function($id=null){
// 		echo $id;
// });

//Route::view('/login','login');
//Route::post('/loginDo','admin\LoginCountroller@loginDo');//
// Route::post('/dologin','admin\LoginCountroller@dologin');//

Route::get('test/{id}/{name}',function($id,$name){
		echo $id."<br/>";
		echo $name;
});
Route::prefix('brand')->group(function () {
	Route::get('/','admin\brand@index');
	Route::get('create','admin\brand@create');//添加展示
	Route::post('store','admin\brand@store');//执行添加
	Route::get('delete/{id}','admin\brand@destroy');//执行删除
	Route::get('edit/{id}','admin\brand@edit');//修改页面
	Route::post('update/{id}','admin\brand@update');//执行修改
	Route::post('checkonly','admin\brand@checkonly');
});
Route::prefix('category')->middleware('checkLogin')->group(function () {
	Route::get('/','admin\category@index');//展示
	Route::get('create','admin\category@create');//添加展示
	Route::post('store','admin\category@store');//执行添加
	Route::get('delete/{id}','admin\category@destroy');//执行删除
	Route::get('edit/{id}','admin\category@edit');//修改页面
	Route::post('update/{id}','admin\category@update');//执行修改
 });

Route::prefix('admin')->middleware('checkLogin')->group(function(){
	Route::get('/','admin\admin@index');//展示
	Route::get('create','admin\admin@create');//添加展示
	Route::post('store','admin\admin@store');//执行添加
	Route::get('delete/{id}','admin\admin@destroy');//执行删除
	Route::get('edit/{id}','admin\admin@edit');//修改页面
	Route::post('update/{id}','admin\admin@update');//执行修改
});
Route::prefix('goods')->group(function(){
	Route::get('/','admin\goods@index');//展示
	Route::get('delete/{id}','admin\goods@destroy');//执行删除
	Route::get('create','admin\goods@create');//添加展示
	Route::post('store','admin\goods@store');//执行添加
	Route::get('edit/{id}','admin\goods@edit');//修改页面
	Route::post('update/{id}','admin\goods@update');//执行修改
});





Route::prefix('article')->middleware('checkLogin')->group(function(){
		Route::get('create','admin\article@create');//添加展示
		Route::post('store','admin\article@store');//执行添加
		Route::get('/','admin\article@index');//展示
		Route::get('delete/{id}','admin\article@destroy');//执行删除
		Route::get('edit/{id}','admin\article@edit');//修改页面
		Route::post('update/{id}','admin\article@update');//执行修改
});






















 Route::get('addcookie',function(){
 		Cookie::queue('echo', 'aaa', 1);
// 	$res =  response('欢迎来到 Laravel 学院')->cookie('as','ldad',1);
// 	dump($res);
// 	$as = request()->cookie('as');
// 	dd($as);
 });












Route::get('getcookie',function(){
		//Cookie::queue(Cookie::make('asa', '12907', 2));
	   //echo request()->cookie('echos');
	   Cookie::queue('echo', 'alue', 1);
		echo Cookie::get('echo');
});

// Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');




Route::get('/','Index\IndexController@index');
Route::post('/carAdd','Index\IndexController@carAdd');
Route::get('/proinfo/{id}','Index\IndexController@proinfo');
Route::get('/cartList','Index\IndexController@cartList');

Route::get('/login','Index\LoginController@login');
Route::post('/loginDo','Index\LoginController@loginDo');//
Route::get('/reg','Index\LoginController@reg');//
Route::post('/regdo','Index\LoginController@regdo');//
Route::get('/send_email','MailController@send_email');//


Route::get('/pay/{orderid}','Index\OrderController@pay');

Route::get('/return_url','Index\OrderController@return_url');
Route::get('/notify_url','Index\OrderController@notify_url');