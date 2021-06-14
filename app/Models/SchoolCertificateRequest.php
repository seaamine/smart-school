<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolCertificateRequest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ="school_certificate_request";


    protected $fillable=['student_id','class_id','academic_year_id','qr_code',
        'regi_no','certificate_no','level'];
}
