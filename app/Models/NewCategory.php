<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
}
