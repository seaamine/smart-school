<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherClass extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "teacher_class";
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
        'academic_year_id',
        'status'
    ];
    public function classe(){
        return $this->belongsTo(SClass::class,'class_id');
    }
}
