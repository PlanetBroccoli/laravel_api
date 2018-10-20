<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'userId','file', 'latitude', 'longitude', 'type', 'description'
    ];
}
