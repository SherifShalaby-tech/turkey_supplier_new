<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentServices extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
      'translation' => 'array'
    ];
    protected $table = "shipment_services";
    public function getNameAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['name'][app()->getLocale()]))
            {
                return $this->translation['name'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
    public function getBasicShippingServiceAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['basic_shipping_service'][app()->getLocale()]))
            {
                return $this->translation['basic_shipping_service'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }


}
