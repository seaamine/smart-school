<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'regi_no',
        'class_id',
        'group',
        'academic_year_id',
        'status',
        'is_promoted',
    ];
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }
}
