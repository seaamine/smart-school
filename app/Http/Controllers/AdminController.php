<?php

namespace App\Http\Controllers;


use App\Helpers\AppHelper;
use App\Models\AcademicYear;
use App\Models\Registration;
use App\Models\SClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function indexAcademicYear(){
        $academicYears=AcademicYear::select('title','start_date','end_date','status')->get();
        return Inertia::render('AcademicYear/Index', ['yearsData'=>$academicYears
        ]);
    }
    //
    public function createAcademicYear(){
        return Inertia::render('AcademicYear/Add', []);
    }
    public function storeAcademicYear(Request $request)
    {
        $aYear = new AcademicYear;
        $aYear->title=$request->input('title');
        $aYear->start_date=$request->input('sdate');
        $aYear->end_date=$request->input('edate');
 /*       User::create(
            Request::validate([
                'first_name' => ['required', 'max:50'],
                'last_name' => ['required', 'max:50'],
                'email' => ['required', 'max:50', 'email'],
            ])
        );*/
        $aYear->save();
        return Redirect::route('academicYear.index');
    }

    public function indexSubjects(){
        $subjects= Subject::all();
        return Inertia::render('Subject/Index', ['subjects'=>$subjects
        ]);
    }
    public function addSubject(){
        return Inertia::render('Subject/Add', []);
    }

    public function storeSubject(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name|max:255',
            'levels' => 'required|array|min:1',
            'levels.*' => 'required|in:1,2,3,4',
            'selectedType' => 'required|in:1,2',
        ]);
        $subject = new Subject();
        $subject->name=$request->input('name');
        $subject->type = $request->input('selectedType');
        $subject->level = implode(',',$request->input('levels'));
        $subject->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'une nouveau Matière a été ajoutée.']);
        return redirect()->route('subject.index');
        return Inertia::render('Subject/Add', []);
    }
    public function editSubject(Request $request){
        $subject = Subject::findOrFail($request->input('id'));
        $subject->level = explode(',',$subject->level);
        return Inertia::render('Subject/Edit', ['subject'=>$subject]);
    }
    public function patchSubject(Request $request){
        $subject = Subject::findOrFail($request->input('id'));
        $validated = $request->validate([
            'name' => ['required', 'max:255',
                Rule::unique('subjects',name)->ignore($subject->id),
                ],
            'levels' => 'required|array|min:1',
            'levels.*' => 'required|in:1,2,3,4',
            'selectedType' => 'required|in:1,2',
            'subjectImage' => 'file|image|max:2048'
        ]);
        $subjectImage = $request->file('subjectImage');
        $file_name = time().'_'.$subjectImage->getClientOriginalName();
        $file_path = $subjectImage->storeAs('subject_images', $file_name, 'public');

        $subject->name=$request->input('name');
        $subject->type = $request->input('selectedType');
        $subject->level = implode(',',$request->input('levels'));
        $subject->image_path = 'storage/'.$file_path;
        $subject->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'la Matière a été modifée.']);

        return redirect()->route('subject.patch',['id'=>$subject->id]);
    }

    public function indexClass(){
        $classes = SClass::all();
        return Inertia::render('Class/Index', ['classes'=>$classes
        ]);
    }
    public function addClass(){
        return Inertia::render('Class/Add', []);
    }
    public function storeClass(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'name' => 'required|unique:subjects,name|max:255',
            'level' => 'required|in:1,2,3,4',
        ]);
        $class= new SClass();
        $name = $request->input('name');
        $startName = $request->input('level').'AM';
        $class->name=strpos($name,$startName ) === 0 ?$name: $startName.$name;
        $class->level = $request->input('level');
        $class->groups = 2;
        $class->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'une nouveau Class a été ajoutée.']);
        return redirect()->route('class.index');
    }
    public function editClass(Request $request){
        $class = SClass::findOrFail($request->input('id'));
        return Inertia::render('Class/Edit', ['classe'=>$class]);
    }
    public function patchClass(Request $request){
        $subject = Subject::findOrFail($request->input('id'));
        $validated = $request->validate([
            'name' => ['required', 'max:255',
                Rule::unique('subjects',name)->ignore($subject->id),
            ],
            'levels' => 'required|array|min:1',
            'levels.*' => 'required|in:1,2,3,4',
            'selectedType' => 'required|in:1,2',
            'subjectImage' => 'file|image|max:2048'
        ]);
        $subjectImage = $request->file('subjectImage');
        $file_name = time().'_'.$subjectImage->getClientOriginalName();
        $file_path = $subjectImage->storeAs('subject_images', $file_name, 'public');

        $subject->name=$request->input('name');
        $subject->type = $request->input('selectedType');
        $subject->level = implode(',',$request->input('levels'));
        $subject->image_path = 'storage/'.$file_path;
        $subject->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'la Matière a été modifée.']);

        return redirect()->route('subject.patch',['id'=>$subject->id]);
    }

    public function indexStudent(){
        $students=Student::all();
        return Inertia::render('Student/index', ["students"=>$students]);
    }

    public function addStudent(){
        $classes=SClass::all();
        return Inertia::render('Student/Add', ["classes"=>$classes]);
    }
    public function storeStudent(Request $request){
        $validated = $request->validate([
            'lastName' => 'required|max:80',
            'firstName' => 'required|max:80',
            'gender' => 'required|in:m,f',
            'level' => 'required|in:1,2,3,4',
            'dob' => 'required|date',
            'commune'=>'required',
            'willaya'=>'required',
            "paye" => "required",
            "email" => 'email|unique:students,email|unique:users,email',
            'fatherFirstName' => 'required|max:80',
            'fatherPhone' => "required|numeric",
            'motherName' => 'required|max:100',
            'motherPhone' => "required|numeric",
            'address'=> 'required|max:500',
            'username' => 'required||unique:users,username|max:80',
            'password' => 'required',
            'classR' => 'required',
            'group' => 'required'
        ]);
        $classR= $request->get("classR");
        $sClass = SClass::where('id', $classR['id'] )->where('status', 1)->first();
        if(!$sClass){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'Mauvaise sélection de classe!']);

            return redirect()->route('student.add');
        }
        $academic_year = AppHelper::getAcademicYear();
        if(!isset($academic_year)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('student.add');
        }
        $studentExist = Student::where('first_name',$request->input('firstName'))
            ->where('last_name',$request->input('lastName'))
            ->whereDate('dob',Date($request->input('dob')))
            ->where('gender',$request->input('gender'))
            ->where('father_name',$request->input('fatherFirstName'))
            ->where('mother_full_name',$request->input('motherName'))
            ->count();
        if($studentExist){
            session()->flash("toast",['type'=>'error','summary'=>'L\'opération a échoué!','detail' => 'Un étudiant inscrit avec les mêmes informations sur cette année académique!']);
            return redirect()->route('student.add');
        }
        if($request->hasFile('photo')) {
            $imgStorePath = "public/student/";
            $storagepath = $request->file('photo')->store($imgStorePath);
        }
        $user = User::create([
            'name' => "{$request->get('lastName')} {$request->get('firstName')}",
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'role' => 'student',
            'gender' => $request->input('gender'),
            'password' => bcrypt($request->get('password')),
            'remember_token' => null,
        ]);
        $student = Student::create([
            'user_id' => $user->id,
            'first_name' => $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'email' => $request->get('email'),
            'dob' =>  $request->get('dob'),
            'gender'=> $request->input('gender'),
            'commune' => $request->input('commune'),
            'willaya'=> $request->input('willaya'),
            'paye'=> $request->input('paye'),
            'photo'=> isset($storagepath) ? $storagepath : null,
            'note' => $request->input('note') !== null ? $request->input('note') : null,
            'father_name' => $request->input('fatherFirstName'),
            'father_phone_no' => $request->input('fatherPhone'),
            'mother_full_name' => $request->input('motherName'),
            'mother_phone_no' => $request->input('motherPhone'),
            'address' => $request->input('address') !== null ? $request->input('address') : null,
            'status' => '1',
        ]);
        $regiNo = $academic_year->start_date->format('y') . (string)$sClass->name;
        $totalStudent = Registration::where('academic_year_id', $academic_year->id)
            ->where('class_id', $sClass->id)->withTrashed()->count();
        $regiNo .= str_pad(++$totalStudent,3,'0',STR_PAD_LEFT);
        $registration =  Registration::create([
            'regi_no' => $regiNo,
            'level' => $request->input('level'),
            'student_id' => $student->id,
            'class_id' =>$sClass->id,
            'group' => $request->input('group'),
            'academic_year_id' => $academic_year->id,
        ]);
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'Nouvel étudiant inscrit avec numéro '.$regiNo]);

        return redirect()->route('student.add');
    }

    public function indexTeacher(){
        $teachers = Teacher::with('subject')->get();
        //dd($teachers);
        return Inertia::render('Teacher/Index', ['teachers'=>$teachers]);
    }
    public function addTeacher(){
        $subjects= Subject::where('status',1)->get();
        return Inertia::render('Teacher/Add', ['subjects'=>$subjects]);
    }
    public function storeTeacher(Request $request){
        $validated = $request->validate([
            'lastName' => 'required|max:80',
            'firstName' => 'required|max:80',
            'gender' => 'required|in:m,f',
            'dob' => 'required|date',
            'join' => 'required|date',
            'commune'=>'required',
            'willaya'=>'required',
            "paye" => "required",
            "email" => 'email|unique:students,email|unique:users,email',
            'address'=> 'required|max:500',
            'username' => 'required|unique:users,username|max:80',
            'password' => 'required',
            'subject' => 'required',
            'qualification' => 'required|in:B,L,M',
        ]);
        $subject = Subject::where('id', $request->input('subject') )->where('status', 1)->first();
        if(!$subject){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'Mauvaise sélection de Matière!']);
            return redirect()->route('teacher.add');
        }

        $teacherExist = Teacher::where('first_name',$request->input('firstName'))
            ->where('last_name',$request->input('lastName'))
            ->whereDate('dob',Date($request->input('dob')))
            ->where('gender',$request->input('gender'))
            ->count();
        if($teacherExist){
            session()->flash("toast",['type'=>'error','summary'=>'L\'opération a échoué!','detail' => 'Un Enseignant existe avec les mêmes informations']);
            return redirect()->route('teacher.add');
        }
        if($request->hasFile('photo')) {
            $imgStorePath = "public/teacher/";
            $storagepath = $request->file('photo')->store($imgStorePath);
        }
        $user = User::create([
            'name' => "{$request->get('lastName')} {$request->get('firstName')}",
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'role' => 'teacher',
            'gender' => $request->input('gender'),
            'password' => bcrypt($request->get('password')),
            'remember_token' => null,
        ]);
        $teacher = Teacher::create([
            'user_id' => $user->id,
            'subject_id' => $subject->id,
            'first_name' => $request->get('firstName'),
            'last_name' => $request->get('lastName'),
            'email' => $request->get('email'),
            'dob' =>  $request->get('dob'),
            'joining_date' =>  $request->get('join'),
            'gender'=> $request->input('gender'),
            'commune' => $request->input('commune'),
            'willaya'=> $request->input('willaya'),
            'paye'=> $request->input('paye'),
            'photo'=> isset($storagepath) ? $storagepath : null,
            'qualification' => $request->input('qualification'),
            'address' => $request->input('address') !== null ? $request->input('address') : null,
            'status' => '1',
        ]);

        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'Nouvel Enseignant ajouté avec succès']);

        return redirect()->route('student.add');
    }

    public function indexTeachersClasses(){
        $classes=SClass::all();
        return Inertia::render('Teacher/TeacherClasses', ['classes'=>$classes->groupBy('level')]);
    }
}
