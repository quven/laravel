<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use App\Http\Requests;

class PostController extends Controller
{
    public function getIndex(){

        $posts = Cache::get('posts',[]);
        if(!$posts)
            exit('Nothing');

        $html = '<ul>';

        foreach ($posts as $key=>$post) {
            $html .= '<li><a href='.url('/post/show/'.$key).'>'.$post['title'].'</li>';
        }

        $html .= '</ul>';

        return $html;
    }
    public function getCreate(){

        $postUrl = url('post/storage');
        $csrf_field = csrf_field();
        $html = <<<CREATE
        <form action="$postUrl" method="POST">
            $csrf_field
            <input type="text" name="title"><br/><br/>
            <textarea name="content" cols="50" rows="5"></textarea><br/><br/>
            <input type="submit" value="提交"/>
        </form>
CREATE;
        return $html;
    }
    public function postStorage(Request $request){
        $input = $request->all();

        $post = ['title'=>$input['title'],'content'=>$input['content']];

        $posts = Cache::get('posts',[]);

        if(!Cache::get('post_id')){
            Cache::add('post_id',1,60);
        }else{
            Cache::increment('post_id',1);
        }
        $posts[Cache::get('post_id')] = $post;

        Cache::put('posts',$posts,60);

        return redirect(url('post/show/'.Cache::get('post_id')));
    }
    public function getShow($id){

        $posts = Cache::get('posts',[]);

        if(!$posts || !$posts[$id])
            exit('Nothing Found！');
        $post = $posts[$id];

        $editUrl = url('post/edit/'.Cache::get('post_id'));
        $html = <<<DETAIL
        <h3>{$post['title']}</h3>
        <p>{$post['content']}</p>
        <p>
            <a href="{$editUrl}">编辑</a>
        </p>
DETAIL;

        return $html;

    }
    public function getEdit($id){
        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id])
            exit('Nothing Found！');
        $post = $posts[$id];

        $postUrl = url('post/update/'.$id);
        $csrf_field = csrf_field();
        $html = <<<UPDATE
        <form action="$postUrl" method="POST">
            $csrf_field
            <input type="text" name="title" value="{$post['title']}"><br/><br/>
            <textarea name="content" cols="50" rows="5">{$post['content']}</textarea><br/><br/>
            <input type="submit" value="提交"/>
        </form>
UPDATE;
        return $html;
    }
    public function postUpdate(Request $request, $id){

        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id])
            exit('Nothing Found！');

        $title = $request->input('title');
        $content = $request->input('content');

        $posts[$id]['title'] = trim($title);
        $posts[$id]['content'] = trim($content);

        Cache::put('posts',$posts,60);
        return redirect('/post/show/'.Cache::get('post_id'));
    }
    public function postDestroy($id){
        $posts = Cache::get('posts',[]);
        if(!$posts || !$posts[$id])
            exit('Nothing Deleted！');

        unset($posts[$id]);
        Cache::decrement('post_id',1);

        return redirect(url('/post/index'));
    }



}
