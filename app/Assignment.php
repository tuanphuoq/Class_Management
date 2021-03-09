<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'class_id', 'title', 'description', 'expired_date',
    ];
}
