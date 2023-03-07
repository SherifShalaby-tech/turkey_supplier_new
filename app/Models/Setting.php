<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded =[];

    protected $casts = [
        'currency_id' => 'integer',
        'client_id' => 'integer',
        'warehouse_id' => 'integer',
    ];
    protected $appends = ['profit_percent'];
    public function Currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function getProfitPercentAttribute(){
        return number_format($this->rate,2);
    }

}
