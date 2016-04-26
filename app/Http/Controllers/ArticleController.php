<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //
    public function index(){
        $articles =Article::latest()->get();

        return view("article.index",compact('articles'));
    }
    public function show($id){
        $article = Article::findOrFail($id);
        if(is_null($article)){
            abort(404);
        }
        return view('article.view',compact('article'));
    }
    public function create(){

        return view('article.add');
    }
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required|min:3',
            'into' => 'required'
        ]);
        print_r($validator->errors()->all());
/*

        $input = $request->all();
        $title = $request->get("title");
        $content = $request->get("content");
        $input['publish_at'] = time();
        Article::create($input);
        return redirect('/');
  */
    }
    public function saveAll(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
                'title' => 'required|min:3',
                'into' => 'required'
        ]);
       // Article::create($input);
        //return redirect('/');
       // print_r($validator);
    }
}
