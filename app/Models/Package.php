<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status', 'products_count',
    ];


}
