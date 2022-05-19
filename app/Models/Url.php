<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "urls";
    protected $dates = ['deleted_at'];
}
