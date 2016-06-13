<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->share('sitename','xuehao');
        view()->composer('*',function($view){
            $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));
        });

        /*
         * 指定视图匹配
         *
         *  view()->composer('hello',function($view){
                $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));
            });

            view()->composer(['hello','home'],function($view){
                $view->with('user',array('name'=>'test','avatar'=>'/path/to/test.jpg'));
            });
         */

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
