<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leadtime extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
