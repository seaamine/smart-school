<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $dates = ['dob'];

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'blood_group',
        'commune',
        'willaya',
        'paye',
        'photo',
        'extra_activity',
        'note',
        'father_name',
        'father_phone_no',
        'mother_full_name',
        'mother_phone_no',
        'address',
        'status',
    ];
}
