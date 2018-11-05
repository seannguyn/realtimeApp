<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\Reply;
use App\User;

class Like extends Model
{
    //
    public function replies()
    {
      return $this->belongsTo(Reply::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
