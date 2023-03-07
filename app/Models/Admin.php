<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Traits\LaratrustUserTrait;
class Admin extends Authenticatable {
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    protected $table = "admins";
    protected $guard = 'admin';
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'status',
    //     'visibility',
    //     'admin_id',
    // ];
    protected $guarded = [];
    public $timestamps = true;
    const ACTIVE = 1, NOT_ACTIVE = 0;



    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name'        =>  'array',
    ];
}
