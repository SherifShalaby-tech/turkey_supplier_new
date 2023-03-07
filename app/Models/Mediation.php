<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mediation extends Model
{
    protected $casts = [
        'translation' => 'array',
    ];

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    protected $table = "meditation";

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
