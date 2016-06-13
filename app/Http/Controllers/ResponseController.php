<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

class ResponseController extends Controller
{
    public function getIndex(Request $request){
        $content = "test successful";
        $status = 200;
        $value = "text/html;charset=utf-8";

        //方式1
        //return (new Response($content,$status))->header('Content-Type',$value);


        //方式2
        // return response($content,$status)->header('Content-Type',$value);  //可以用response代替response实例   一般情况下都用这种方法

        //方式3   添加cookie信息


        //return response($content,$status)
          //          ->header('Content-Type',$value)
            //        ->withCookie('xuehao','xuehao',30,'/','www.laravel.com');
        /*
         *  可以用如下方式查看cookie
         *  $cookie = $request->cookie();
           dd($cookie);
         */

        /**************************************************
         * 此外，我们还关注到该cookie是经过加密的，这一点我们在前面已经提到过，这是为了安全性考虑，如果要取消加密，在app/Http/Middleware/EncryptCookies.php文件中将对应的cookie名添加到EncryptCookies类属性$except中即可：
         */



        //////////////////
        //////视图相应/////
        //////////////////

        ///方式1
        //return response()->view('response/index',['message'=>'dashabi']);
        //方式2  可以直接省略response
        //return view('response.index',['message'=>'win']);



        //////////////////
        //////返回json/////
        //////////////////

        //方式1    返回普通json
        // return response()->json(['name'=>'xuehao','age'=>12]);
        //方式2   返回jsonp的形式
        //return response()->json(['name'=>'xuehao','age'=>12])->setCallback(request()->input('callback'));

        //////////////////
        //////文件下载/////
        //////////////////
        //return response()->download(realpath(base_path('public/images')).'/success.png','哈比.png');


        //////////////////
        //////重定向/////
        //////////////////
        //方式1  基本重定向
        //return redirect('/');

        //方式2  重定向到上一个位置
        //return back()->withInput();

        //方式3  重定向某个路由  route中的参数必须在设置路由中由as参数指定  有参数直接在后面传入
        //return redirect()->route('csrf',100);

        //方式4  重定向到控制器动作  只能用于在路由设置中为resource方式
        //return redirect()->action('PostController@index');

        //方式 5带一次性Session数据的重定向
        return redirect('/')->with('status', 'Profile updated!');
    }
}
