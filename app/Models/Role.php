<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use Nicolaslopezj\Searchable\SearchableTrait;
class Role extends LaratrustRole
{
    public $guarded = [];
    public function created_at()
    {
        return $this->created_at->format('Y-m-d') ;
    }
}
