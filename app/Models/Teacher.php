<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $dates = ['dob','joining_date'];

    protected $fillable = [
        'user_id',
        'subject_id',
        'first_name',
        'last_name',
        'dob',
        'email',
        'gender',
        'commune',
        'willaya',
        'paye',
        'joining_date',
        'commune',
        'willaya',
        'paye',
        'photo',
        'qualification',
        'address',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject', 'subject_id');
    }
}
