<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{

    protected $guarded = [];
    protected $casts = [
      'translation' => 'array'
    ];
    public $table = "about_us";

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User');
    // }
    public function getAboutUsAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['about_us'][app()->getLocale()]))
            {
                return $this->translation['about_us'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }

    public function getServicesAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['services'][app()->getLocale()]))
            {
                return $this->translation['services'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
    public function getShippingProductAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['shipping_products'][app()->getLocale()]))
            {
                return $this->translation['shipping_products'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
    public function getMediationAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['mediation'][app()->getLocale()]))
            {
                return $this->translation['mediation'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
}
