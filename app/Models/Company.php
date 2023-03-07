<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class Company extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory;
    protected $casts = ['translation' => 'array'];
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }
    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }
    public function factory(){
        return $this->hasOne('App\Models\Factory','company_id');
    }

    public function products(){
        return $this->hasMany(Product::class,'company_id');
    }
    public function plan(){
        return $this->belongsTo(Plan::class,'plan_id');
    }

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

    public function getDescriptionAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['description'][app()->getLocale()]))
            {
                return $this->translation['description'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }

    // public function suppliers(){
    //     return $this->hasMany(ContactSupplier::class);
    // }

    public function users(){
        return $this->hasMany(ContactSupplier::class);
    }

    public function shipmentordernew(): HasMany
    {
        return $this->hasMany(ShipmentOrderNew::class);
    }

    public function clerks(): HasMany
    {
        return $this->hasMany(Clerk::class,'company_id');
    }

}
