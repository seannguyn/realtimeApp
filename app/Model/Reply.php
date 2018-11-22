<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Model\Question;
use App\Model\Category;
use App\Model\Like;

class Reply extends Model
{
    //

    protected static function boot() {
        parent::boot();

        static::creating(function($reply) {
            $reply->user_id = auth()->user()->id;
        });
    }

    // protected $guarded = [];

    protected $fillable = ['body'];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function like() {
        return $this->hasMany(Like::class);
    }
}
