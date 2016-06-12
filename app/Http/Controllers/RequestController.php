<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

class RequestController extends Controller
{

    public function getUrl(Request $request){
        //匹配request/*的URL才能继续访问
        if(!$request->is('request/*')){
            // abort(404);  //设置404只需要在resource/views/errors中新建404.blade.php即可
        }
        $path = $request->path();   //获取url路径
        $url = $request->url();     //获取完整url
        echo $path;
        echo "<br/>";
        echo $url;
        echo "<br/>";

        if(!$request->isMethod('get')){   //判断请求方式
            abort(404);
        }
        $method = $request->Method();   //获取请求方式  返回GET
        echo $method;
        echo "<br/>";

    }
    public function getIndex(Request $request){
        $test = $request->input('test','xuehao');  //第二个参数为  当参数为空的时候的默认值
        echo $test;
        echo "<br/>";

        //接收参数可以支持数组形式  如下

        echo $request->input('xuehao.1.name');
        //url  http://www.laravel.com/request/?xuehao[1][name]=sb&test=123

        //has方法  判断参数名是否存在
        if($request->has('test')){
            echo "1";
        }else{
            echo "2";
        }

    }

    public function getAll(Request $request){
        $all = $request->all();   //所有参数
        $only = $request->only('test');  //仅接收某参数
        $except = $request->except('test');  //除了某参数的其余参数
        echo "<pre>";
        print_r($all);
        print_r($only);
        print_r($except);
        echo "</pre>";

    }


    /*
     * 以下两个方法感觉没多大意义   暂时不研究
     *
     */
    /*
    public function getLastRequest(Request $request){
       //$request->flash();
        return redirect('/request/current-request')->withInput();
    }

    public function getCurrentRequest(Request $request){
        $lastRequestData = $request->old();
        echo '<pre>';
        print_r($lastRequestData);
    }*/

    /*
     * cookie操作
     */
    public function getCookie(Request $request){  //获取cookie
        $cookies = $request->cookie();
        $cookie = $request->cookie('test');//指定获取某个cookie
        echo $cookie;
        echo "<br/>";
        dd($cookies);
    }
    public function getAddCookie(){  //设置cookie
        $response = new Response();
        //第一个参数是cookie名，第二个参数是cookie值，第三个参数是有效期（分钟）
        $response->withCookie(cookie('test','xuehao',1));
        //如果想要cookie长期有效使用如下方法
        //$response->withCookie(cookie()->forever('name', 'value'));
        return $response;

    }
    /*
     * 上传文件
     */
    public function getUpload(){
        $postUrl = url('request/upload');
        $csrf_field = csrf_field();
        $html = <<<CREATE
<form method="post" action="$postUrl" enctype="multipart/form-data">
    $csrf_field
    <input type="file" name="file"/><br/>
    <input type="submit" value="上传"/>
</form>
CREATE;
        return $html;
    }
    public function postUpload(Request $request){
        //判断请求中是否包含name=file的上传文件
        if(!$request->hasFile('file')){
            exit('上传文件为空！');
        }
        $file = $request->file('file');
        //判断文件上传过程中是否出错
        if(!$file->isValid()){
            exit('文件上传出错！');
        }

        $destPath = realpath(public_path('images'));

        if(!file_exists($destPath))
            mkdir($destPath,0755,true);
        $filename = $file->getClientOriginalName();
        if(!$file->move($destPath,$filename)){
            exit('保存文件失败！');
        }
        exit('文件上传成功！');
    }

}
