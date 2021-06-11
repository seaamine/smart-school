<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'exams';
    protected  $dates = ['started_at', 'stopped_at', 'published_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['trimester','started_at', 'stopped_at', 'published_at','status','numbNotes','academic_year_id'];
}
