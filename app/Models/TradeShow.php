<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TradeShow extends Model
{
    protected $dates = ['deleted_at'];
    protected $casts = [
        // 'image' => 'array',
        'translation' => 'array',
    ];

    protected $guarded = [];

    protected $table = "trade_show";
    public function firstMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable')->orderBy('file_sort', 'asc');
    }
    public function media(): MorphMany
    {
        return $this->MorphMany(Media::class, 'mediable');
    }
    public function getTitleAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['title'][app()->getLocale()]))
            {
                return $this->translation['title'][app()->getLocale()];
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
