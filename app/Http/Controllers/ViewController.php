<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ViewController extends Controller
{
   public function getIndex(){
       /*
        * 在AppServiceProvider.php的boot方法中添加
        *view()->share('sitename','xuehao');可以设置共享的变量 任何视图都能访问
        */
        return view('view.index');
   }
}
