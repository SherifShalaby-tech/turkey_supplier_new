<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSupplier extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function supplier(){
                return $this->belongsTo('App\Models\Company','user_id');

    }

    public function user(){
                return $this->belongsTo('App\Models\Company','supplier_id');

    }
    public function visitor(){
        return $this->belongsTo(Visitor::class,'visitor_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
