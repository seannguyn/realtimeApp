<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function getRouteKeyName() {
        return 'slug';
    } 

    public function getPathAttribute() {
        return asset("api/category/$this->slug");
    }

    // protected $guarded = [];
    protected $fillable = ['name', 'slug'];
}
