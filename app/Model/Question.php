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
    protected $guarded = [];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getPathAttribute() {
        return asset("api/question/$this->slug");
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
