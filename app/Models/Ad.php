<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    // protected $dates = ['deleted_at'];

    protected $guarded = [];
    // protected $dates = ['start_date', 'end_date'];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function start_date()
    {
        return $this->start_date->format('Y-m-d');
    }
    public function end_date()
    {
        return $this->end_date->format('Y-m-d');
    }

}
