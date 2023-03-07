<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'id',
            'title',
            'character_count',
            'company_picture_count',
            'product_count',
            'product_picture_count',
            'video_time',
            'video_count',
            'price',
            'speacial_customer'
        ];

}
