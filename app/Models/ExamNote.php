<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table="exams_notes";

    protected $fillable=['academic_year_id','exam_id','trimester','class_id','subject_id','student_id',
        'teacher_id','note_eval','note_devoir','note_exam','remarque'];
}
