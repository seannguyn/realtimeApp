<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Model\Reply;
use App\Model\Category;
use App\Model\Like;

class Question extends Model
{
    //
    // protected $fillable = [fields...]
    // protected $guarded = [];
    protected $fillable = ['title','slug','user_id','category_id','body'];

    protected static function boot() {
        parent::boot();

        static::creating(function($question) {
            $question->slug = str_slug($question->title);
        });
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getPathAttribute() {
        return "/question/$this->slug";
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }
}
