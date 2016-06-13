<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//view视图
Route::controller('testView','ViewController');
//request请求
Route::controller('request','RequestController');

Route::controller('testResponse','ResponseController');
Route::resource('post','PostController');

Route::group(['middleware'=>'test'],function(){
        Route::get('/view',function(){
            return "view successful";
        });
        Route::get('/read',function(){
            return "read successful";
        });

});
Route::get('/http/refuse',['as'=>'refuse',function(){
    return  "禁止上网";
}]);

//CSRF攻击
Route::get('/testCsrf/{id}',['as'=>'csrf',function($id){
    $csrf_field = csrf_field();
    $html = <<<GET
    <form action="/testCsrf" method="post">
    {$id}
    {$csrf_field}
    <input type="submit" value="test">
    </form>
GET;
    return $html;
    //return $csrf_field;
}]);
Route::post('/testCsrf',function(){

    return "successful";
});



Route::get('/', 'ArticleController@index');
Route::get('/article/create','ArticleController@create');
Route::post('/article/store','ArticleController@store');
Route::get('/article/{id}', 'ArticleController@show');
Route::get('/article/edit/{id}', 'ArticleController@edit');
Route::post('/article/update', 'ArticleController@update');

