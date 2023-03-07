<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'translation' => 'array',
    ];
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
