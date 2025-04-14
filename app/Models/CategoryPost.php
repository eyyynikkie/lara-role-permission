<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    protected $table = 'category_post';
    public $timestamps = false;

    protected $fillable = [
        'post_id',
        'category_id'
    ];
}
