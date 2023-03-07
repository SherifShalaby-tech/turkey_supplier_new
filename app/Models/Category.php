<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $dates = ['deleted_at'];
    protected $casts = ['translation' => 'array'];
    protected $guarded = [];
    // protected $fillable = [
    //     'code', 'name',
    // ];

    public function products(){
        return $this->hasMany('App\Models\Product','category_id');
    }

    public function subCategories(){
        return $this->hasMany('App\Models\SubCategories','category_id');
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


    
}
