<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\SaleDetail','sale_id');
    }

}
