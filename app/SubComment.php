<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    protected $fillable = [
        'parent_comment_id', 'commentor', 'content',
    ];
}