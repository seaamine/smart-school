<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SClass extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "classes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'groups',
        'level',
        'status',
    ];

    public function teachers(){
        return $this->hasMany(TeacherClass::class, 'class_id');
    }
}
