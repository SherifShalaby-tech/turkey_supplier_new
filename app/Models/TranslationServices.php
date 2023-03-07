<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TranslationServices extends Model
{
    // protected $dates = ['deleted_at'];

    protected $guarded = [];
    protected $casts = [
      'translation' => 'array',
    ];
    protected $table = "translation_services";
    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }

}
