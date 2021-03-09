<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmit extends Model
{
    protected $fillable = [
        'assignment_id', 'file', 'description', 'user_id',
    ];
}