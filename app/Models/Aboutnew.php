<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutnew extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
      'translation' => 'array'
    ];
    public $table = "aboutnews";
    public function status()
    {
        return $this->status ? __('aboutnew.active') : __('aboutnew.unactive');
    }
    public function created_at()
    {
        return $this->created_at->diffforhumans();
    }
    public function updated_at()
    {
        return $this->updated_at->diffforhumans();
    }

    public function getSubjectAttribute($value)
    {
        if(!is_null($this->translation))
        {
            if(isset($this->translation['subject'][app()->getLocale()]))
            {
                return $this->translation['subject'][app()->getLocale()];
            }
            return $value;
        }
        return $value;
    }
}
