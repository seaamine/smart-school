<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Exam;
use App\Models\ExamNote;
use App\Models\Registration;
use App\Models\SchoolCertificate;
use App\Models\SchoolCertificateRequest;
use App\Models\SClass;
use App\Models\Student;
use App\Models\Subject;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:student');
    }
    public function requestCertifciate(){
        return Inertia::render('Certificate/Request', []);
    }
    public function downloadSchoolCertificate(){
        $user = Auth::user();
        $academicYear=AppHelper::getAcademicYear();
        $student = Student::where('user_id',$user->id)->first();
        $certificate = SchoolCertificate::orderBy('created_at','DESC')->first();
        $registration = Registration::where('student_id',$student->id)->where('status','1')
            ->where('academic_year_id',$academicYear->id)->first();
        $class = SClass::where('id',$registration->class_id)->where('status','1')->first();
        if(!$certificate){
            return abort(404);
        }
        $certificate_request = SchoolCertificateRequest::where("student_id",$student->id)
            ->where("class_id",$class->id)
            ->where("academic_year_id",$academicYear->id)
            ->where("regi_no",$registration->regi_no)
            ->first();

        $template=$certificate->template;
        $template=str_replace("#numcert","2020/4/215",$template);
        $template=str_replace("#nom",$student->last_name,$template);
        $template=str_replace("#prenom",$student->first_name,$template);
        $template=str_replace("#dob",$student->dob,$template);
        $template=str_replace("#pob",$student->willaya,$template);
        $template=str_replace("#class",$class->name,$template);
        $template= str_replace("#ay",$academicYear->title,$template);
        $template=str_replace("#numreg",$registration->regi_no,$template);
        $template=str_replace("#date",date("Y/m/d"),$template);
        if($certificate_request){
            $qrCode=$certificate_request->qr_code;
        }else{
            $codeArray=[
                'numéro de certificat'=>2020/4/215,
                'nom'=>"$student->last_name $student->first_name",
                "année academique" => $academicYear->title,
                "date de naissance" =>$student->dob->toDateString(),
                "classe"=>$class->name,
                "numéro d'enregistrement" => $registration->regi_no,

            ];
            $qrCode = QrCode::size(200)->generate(json_encode($codeArray));
        }
        $template=str_replace("#signateur",$qrCode,$template);

        //return view('school_certificate', ['data'=>$template]);
        $pdf = PDF::loadView('school_certificate', ['data'=>$template]);
        return $pdf->download('invoice.pdf');
    }

    public function examNotes(){
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore commencé!']);
            return redirect()->route('exam.index');
        }
        $user = Auth::user();
        $student = Student::where("user_id",$user->id)->firstOrFail();
        $exams=Exam::where('academic_year_id',$academicYear->id)->get();
        $registration = Registration::where('student_id',$student->id)->where('status','1')
            ->where('academic_year_id',$academicYear->id)->firstOrFail();
        $class = SClass::where('id',$registration->class_id)->where('status','1')->firstOrFail();
        $subjects=Subject::where('status','=','1')->where('level','like','%'.$class->level.'%')->get();
        $studentNotes = ExamNote::where('student_id',$student->id)
            ->where('academic_year_id',$academicYear->id)->get();
        $studentN=[];
        foreach ($studentNotes as $note){
            $studentN[$note->trimester][$note->subject_id]=$note;
        }
        return Inertia::render('Student/Notes',
            ['studentNotes'=>$studentN,'student'=>$student,'exams'=>$exams,'subjects'=>$subjects,'classe'=>$class,'academicYear'=>$academicYear]);


    }
}
