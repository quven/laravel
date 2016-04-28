<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class ArticleController extends Controller
{
    protected $dates = ['publish_at'];
    //
    public function index(){
        $articles =Article::latest()->publishd()->with('tags')->get();
        //print_r($articles);
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
        $tags = Tag::lists('name','id');


        return view('article.add',compact('tags'));
    }
    public function store(Request $request){
        $input = $request->all();

        $validator = Validator::make($input,[
            'title' => 'required|min:3',
            'into' => 'required'
        ]);
        if($validator->fails()){
            print_r($validator->errors()->all());
            die();
        }
        $input = $request->all();
        $title = $request->get("title");
        $content = $request->get("content");
        //$input['publish_at'] = time();
        $article = Article::create($input);
        $article->tags()->attach($request->input('tags'));
        return redirect('/');

    }

    /*
    public function saveAll(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
                'title' => 'required|min:3',
                'into' => 'required'
        ]);
       // Article::create($input);
        //return redirect('/');
       // print_r($validator);
    }*/
}
