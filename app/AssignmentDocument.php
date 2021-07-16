<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentDocument extends Model
{
    protected $fillable = [
        'assignment_id', 'title', 'url',
    ];
}
