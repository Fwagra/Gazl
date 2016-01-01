<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'images',
        'project_id',
        'author',
        'email',
        'guest',
        'private',
        'state',
    ];
}
