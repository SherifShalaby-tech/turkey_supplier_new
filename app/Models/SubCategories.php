<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ['translation' => 'array'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','sub_category_id');
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
    //scope
    public function scopeWhenCatId($query, $catId)
    {
        return $query->when($catId, function ($q) use ($catId) {
            return $q->whereHas('category', function ($qu) use ($catId) {
                return $qu->where('id', $catId);
            });
        });
    }// end of scopeWhenCatId
}
