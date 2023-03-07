<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentOrderNew extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "shipment_orders_new";

    public function buyer(){
        return $this->belongsTo(Company::class,'company_id');
    }
    // public function shipment_services(){
    //     return $this->belongsTo(ShipmentServices::class,'shipment_services_id');
    // }
}
