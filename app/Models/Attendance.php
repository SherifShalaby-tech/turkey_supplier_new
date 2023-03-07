<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            if(auth()->check() && auth()->user()->type !=1){
                $employee=Employee::where('user_id',auth()->user()->id)->first();
                if($employee){
                    $builder->where('employee_id', $employee->id); //  if in header return $query->where('field', request()->field);
                }
            }
        });
    }

    protected $fillable = [
        'user_id','employee_id','company_id','date','clock_in',
        'clock_in_ip','clock_out_ip',
        'clock_in_out','depart_early','late_time','clock_out',
        'overtime','total_work','total_rest','status'

    ];

    protected $casts = [
        'user_id'    => 'integer',
        'employee_id'  => 'integer',
        'company_id'  => 'integer',
        'clock_in_out'  => 'integer',
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }


}
