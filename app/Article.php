<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model
{
    //
    protected $fillable = ['title','into','publish_at'];
    protected $dates = ['published_at'];

    public function setPublishAtAttribute($date){
        $this->attributes['publish_at'] = Carbon::createFromFormat("Y-m-d", $date);
    }
    public function scopePublishd($query){
        return $query->where('publish_at','<=',Carbon::now());
    }
    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
    public function getTagListAttribute(){
        return $this->tags->lists('id')->all();
    }
}
