<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class toperator extends Model
{
    protected $guarded = [];
    use SoftDeletes;
}
