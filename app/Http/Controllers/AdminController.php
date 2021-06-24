<?php

namespace App\Http\Controllers;


use App\Helpers\AppHelper;
use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\Registration;
use App\Models\SchoolCertificate;
use App\Models\SchoolCertificateRequest;
use App\Models\SClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherClass;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('loginAs');
        $this->middleware('role:admin')->except('loginAs');
    }

    public function userCredentials(Request $request){
        $user = User::findOrFail($request->input('id'));
        return Inertia::render('User/Credentials', ['userC'=>$user
        ]);
    }
    public function updateUserCredentials(Request $request){
        $user = User::findOrFail($request->input('id'));
        $validated = $request->validate([
            'password' => 'required',
        ]);
        $user->forceFill([
            'password' => Hash::make($request->input('password')),
        ])->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'Les identifiants de l\'utilisateur ont été mis à jour']);

        return Redirect::route('user.credentials',['id'=>$user->id]);
    }

    public function indexAcademicYear(){
        $academicYears=AcademicYear::select('id','title','start_date','end_date','status')->get();
        return Inertia::render('AcademicYear/Index', ['yearsData'=>$academicYears
        ]);
    }
    //
    public function createAcademicYear(){
        return Inertia::render('AcademicYear/Add', []);
    }
    public function storeAcademicYear(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:App\Models\AcademicYear,title|max:255',
            'sdate' => 'required|date',
            'edate' => 'required|date|after:sdate',
        ]);
        $conflictingAY=AcademicYear::where('end_date','>',$request->input('sdate'))->where('start_date','<',$request->input('sdate'))->first();
        if($conflictingAY){
            session()->flash("toast",['type'=>'error','summary'=>'Opération a échoué','detail'=>'la date de début de la nouvelle année académique est en conflit avec les dates de l\'année académique '.$conflictingAY->title]);
            return redirect()->route('academicYear.create');
        }
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
    public function changeCurrentAcademicYear(Request $request){
        $validated = $request->validate([
            'id' => 'required|exists:App\Models\AcademicYear,id',
        ]);
        AcademicYear::where('status','1')->update(['status'=>'0']);

        AcademicYear::where('id',$request->input('id'))->update(['status'=>'1']);
        return response()->json([
            'toast' => ['type'=>'success', 'summary'=>'L\'opération réussie','detail' => 'l\'année académique a été définie comme année académique active'],
            'type' => 'success',
        ]);
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
                Rule::unique('subjects',"name")->ignore($subject->id),
                ],
            'levels' => 'required|array|min:1',
            'levels.*' => 'required|in:1,2,3,4',
            'selectedType' => 'required|in:1,2',
            'subjectImage' => 'file|image|max:2048'
        ]);
        if($request->hasFile('subjectImage')){
            $subjectImage = $request->file('subjectImage');
            $file_name = time().'_'.$subjectImage->getClientOriginalName();
            $file_path = $subjectImage->storeAs('subject_images', $file_name, 'public');
            $subject->image_path = 'storage/'.$file_path;
        }

        $subject->name=$request->input('name');
        $subject->type = $request->input('selectedType');
        $subject->level = implode(',',$request->input('levels'));
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
        if(!$class){
            session()->flash("toast",['type'=>'error','summary'=>'L\'opération a échoué!','detail'=>'Désolé, la ressource que vous recherchez n\'a pas pu être trouvée.']);
            return redirect()->route('class.index');
        }
        return Inertia::render('Class/Edit', ['classe'=>$class]);
    }
    public function patchClass(Request $request){
        $class = SClass::findOrFail($request->input('id'));
        if(!$class){
            session()->flash("toast",['type'=>'error','summary'=>'L\'opération a échoué!','detail'=>'Désolé, la ressource que vous recherchez n\'a pas pu être trouvée.']);
            return redirect()->route('class.index');
        }
        $validated = $request->validate([
            'name' => ['required', 'max:255',
                Rule::unique('subjects','name')->ignore($class->id),
            ],
            'level' => 'required|in:1,2,3,4',
        ]);
        $class->name=$request->input('name');
        $class->level = $request->input('level');
        $class->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'la Classe a été modifée.']);

        return redirect()->route('class.patch',['id'=>$class->id]);
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
        $sClass = SClass::where('id', $classR['id'] )->where('status', '1')->first();
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

    public function editStudent(Request $request){
        $classes=SClass::all();
        $student = Student::findOrFail($request->input('id'));
        return Inertia::render('Student/Edit', ["classes"=>$classes,'student'=>$student]);

    }
    public function updateStudent(Request $request){
        $student = Student::findOrFail($request->input('id'));
        $studentUser = User::findOrFail($student->user_id);
        $validated = $request->validate([
            'lastName' => 'required|max:80',
            'firstName' => 'required|max:80',
            'gender' => 'required|in:m,f',
            'dob' => 'required|date',
            'commune'=>'required',
            'willaya'=>'required',
            "paye" => "required",
            "email"=>[
                'required',
                Rule::unique('students','email')->ignore($student->id),
                Rule::unique('users','email')->ignore($studentUser->id),
            ],
            'address'=> 'required|max:500',
            'fatherFirstName' => 'required|max:80',
            'fatherPhone' => "required|numeric",
            'motherName' => 'required|max:100',
            'motherPhone' => "required|numeric",
        ]);


        if($request->hasFile('photo')) {
            $imgStorePath = "student";
            $storagepath = $request->file('photo')->store($imgStorePath,'public');
            $student->photo = 'storage/'.$storagepath;
            $studentUser->profile_photo_path = $storagepath;
        }
        $studentUser->email = $request->input('email');
        $studentUser->name = $request->input('lastName')." ".$request->input('firstName');
        $studentUser->gender = $request->input('gender');
        $studentUser->save();
        $student->first_name = $request->input('firstName');
        $student->last_name = $request->input('lastName');
        $student->commune = $request->input('commune');
        $student->willaya = $request->input('willaya');
        $student->paye = $request->input('paye');
        $student->address = $request->input('address');
        $student->email = $request->input('email');
        $student->gender = $request->input('gender');
        $student->note = $request->input('note');
        $student->father_name = $request->input('fatherFirstName');
        $student->father_phone_no = $request->input('fatherPhone');
        $student->mother_full_name = $request->input('motherName');
        $student->mother_phone_no = $request->input('motherPhone');

        $student->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'les informations de l\'éleve ont été mises à jour']);
        return redirect()->route('student.edit',['id'=>$student->id]);
    }


    public function indexTeacher(){
        $teachers = Teacher::with('subject')->get();
        //dd($teachers);
        return Inertia::render('Teacher/Index', ['teachers'=>$teachers]);
    }
    public function addTeacher(){
        $subjects= Subject::where('status','1')->get();
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
        $subject = Subject::where('id', $request->input('subject') )->where('status', '1')->first();
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
    public function editTeacher(Request $request){
        $teacher = Teacher::findOrFail($request->input('id'));
        $subjects= Subject::where('status','1')->get();
        return Inertia::render('Teacher/Edit', ['subjects'=>$subjects,'teacher'=>$teacher]);
    }
    public function updateTeacher(Request $request){
        $teacher = Teacher::findOrFail($request->input('id'));
        $teacherUser = User::findOrFail($teacher->user_id);
        $validated = $request->validate([
            'lastName' => 'required|max:80',
            'firstName' => 'required|max:80',
            'gender' => 'required|in:m,f',
            'dob' => 'required|date',
            'join' => 'required|date',
            'commune'=>'required',
            'willaya'=>'required',
            "paye" => "required",
            "email"=>[
                'required',
                Rule::unique('teachers','email')->ignore($teacher->id),
                Rule::unique('users','email')->ignore($teacherUser->id),
            ],
            'address'=> 'required|max:500',
            'subject' => 'required',
            'qualification' => 'required|in:B,L,M',
        ]);
        $subject = Subject::where('id', $request->input('subject') )->where('status', '1')->first();
        if(!$subject){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'Mauvaise sélection de Matière!']);
            return redirect()->route('teacher.edit',['id'=>$teacher->id]);
        }

        if($request->hasFile('photo')) {
            $imgStorePath = "teacher";
            $storagepath = $request->file('photo')->store($imgStorePath,'public');
            $teacher->photo = 'storage/'.$storagepath;
            $teacherUser->profile_photo_path = $storagepath;
        }
        $teacherUser->email = $request->input('email');
        $teacherUser->name = $request->input('lastName')." ".$request->input('firstName');
        $teacherUser->gender = $request->input('gender');
        $teacherUser->save();
        $teacher->first_name = $request->input('firstName');
        $teacher->last_name = $request->input('lastName');
        $teacher->commune = $request->input('commune');
        $teacher->willaya = $request->input('willaya');
        $teacher->paye = $request->input('paye');
        $teacher->qualification = $request->input('qualification');
        $teacher->dob = $request->input('dob');
        $teacher->gender = $request->input('gender');
        $teacher->address = $request->input('address');
        $teacher->joining_date = $request->input('join');
        $teacher->email = $request->input('email');

        $teacher->save();
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'les informations de l\'enseignant ont été mises à jo']);
        return redirect()->route('teacher.edit',['id'=>$teacher->id]);
    }

    public function indexTeachersClasses(){
        $classes=SClass::all();
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('dashboard');
        }
        $selectedTeachersCount=DB::table('classes')
            ->leftJoin('subjects',function ($join) {
                $join->on('subjects.level', 'like',DB::raw("CONCAT('%', classes.level, '%')"))
                    ->where('subjects.status','=','1')
                    ->whereNull('subjects.deleted_at');
            })
            ->leftJoin('teacher_class',function ($join) use($academicYear){
                $join->on('teacher_class.class_id', '=', 'classes.id')
                    ->where('teacher_class.status','=','1')
                    ->where('.teacher_class.academic_year_id','=',$academicYear->id)
                    ->whereNull('teacher_class.deleted_at');
            })
            ->where('classes.status','1')
            ->whereNull('classes.deleted_at')
            ->select('classes.id',DB::raw(' count(case when teacher_class.id is NULL then 1 end) as subject_count'))
            ->groupBy('classes.id')
            ->get();
        ;
      // dd($selectedTeachersCount->groupBy('id'));
        return Inertia::render('Teacher/TeacherClasses', ['classes'=>$classes->groupBy('level'),'selectedTeachersCount'=>$selectedTeachersCount->keyBy('id'),'academicYear'=>$academicYear]);
    }
    public function updateTeachersClasses(Request $request){
        if($request->has('class_id')){
            $classe=SClass::where('id',$request->input('class_id'))->where('status','1')->first();
            if(!$classe){
                session()->flash("toast",['type'=>'danger','summary'=>'L\'opération a échoué','detail'=>'la classe n\'existe pas§']);
                return redirect()->route('teacher-class.index');
            }
        }else{
            session()->flash("toast",['type'=>'danger','summary'=>'L\'opération a échoué','detail'=>'la classe n\'existe pas']);
            return redirect()->route('teacher-class.index');
        }
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('teacher-class.index');
        }
        $subjects=Subject::where('level','like','%'.$classe->level.'%')->where('status','1')->with(['teachers' => function ($query) {
            $query->where('status', '1');
        }])->get();
        $teachersClass=TeacherClass::where('class_id',$classe->id)->where('academic_year_id',$academicYear->id)->where('status','1')->get();
        return Inertia::render('Teacher/TeacherClasses2', ['classe'=>$classe,'subjects'=>$subjects,'academicYear'=>$academicYear,'teachersClass'=>$teachersClass]);
    }
    public function storeUpdateTeachersClasses(Request $request){
        if($request->has('class_id')){
            $classe=SClass::where('id',$request->input('class_id'))->where('status','1')->first();
            if(!$classe){
                session()->flash("toast",['type'=>'danger','summary'=>'L\'opération a échoué','detail'=>'la classe n\'existe pas']);
                return redirect()->route('teacher-class.index');
            }
        }else{
            session()->flash("toast",['type'=>'danger','summary'=>'L\'opération a échoué','detail'=>'la classe n\'existe pas§']);
            return redirect()->route('teacher-class.index');
        }
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('teacher-class.index');
        }
        //$subjectsCount=Subject::where('level','like','%'.$classe->level.'%')->where('status','1')->count();
        $validated = $request->validate([
            //'selectedTeachers' => 'required|array|size:'.$subjectsCount,
            'selectedTeachers' => 'required|array',
            'selectedTeachers.*.teacher_id' => 'required|exists:teachers,id',
            'selectedTeachers.*.subject_id' => 'required|exists:subjects,id',
        ]);
        $selectedTeachers= $request->input('selectedTeachers');
        $teachersClass=[];
        foreach ($selectedTeachers as $key=>$teacher){
            $teachersClass[]=[
                'id' =>$teacher['id'],
                'teacher_id' => $teacher['teacher_id'],
                'subject_id' => $teacher['subject_id'],
                'class_id' => $classe->id,
                'academic_year_id' => $academicYear->id,
                'status' => '1',
            ];
        }
        TeacherClass::upsert($teachersClass,['id'],['teacher_id']);
        //TeacherClass::insert($teachersClass);
        session()->flash("toast",['type'=>'success','summary'=>'Opération réussie','detail'=>'Les enseignants ont été affectés à la classe '.$classe->name.' avec succès']);
        return redirect()->route('teacher-class.index');
    }

    public function indexExam(){
        $academicYear= AppHelper::getAcademicYear();
        $count = DB::table('classes')
            ->join('subjects',function ($join) {
                $join->on('subjects.level', 'like',DB::raw("CONCAT('%', classes.level, '%')"))
                    ->where('subjects.status','=','1')
                    ->whereNull('subjects.deleted_at');
                })
            ->count();
        if(!isset($academicYear)){
            session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            return redirect()->route('exam.index');
        }
        $exams=Exam::where('academic_year_id',$academicYear->id)->get();
        return Inertia::render('Exam/Index', ['totalNotes'=>$count,'exams'=>$exams,'academicYear'=>$academicYear]);
    }
    public function updateExam(Request $request){
        $academicYear= AppHelper::getAcademicYear();
        if(!isset($academicYear)){
            //session()->flash("toast",['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.']);
            //return redirect()->route('exam.index');
            return response()->json([
                'toast' => ['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'L\'année académique n\'est pas encore fixée! Veuillez aller dans les paramètres et le définir.'],
                'type' => 'error',
            ]);
        }
        $validated = $request->validate([
            'trimester' => 'required|in:1,2,3',
            'academicYear' => 'required|in:'.$academicYear->id,
            'method' => 'required|in:start,stop,publish',
        ]);
        $method = $request->input('method');
        if($method === 'start'){
            $exam = Exam::updateOrCreate(
                ['trimester' => $request->input('trimester'), 'academic_year_id' => $academicYear->id,'status'=>'1'],
                ['started_at' => now(),'stopped_at'=>null]
            );
            $msg = "l'examen du trimestre $exam->trimester est commencé pour l'année académique $academicYear->title";
        }elseif ($method === 'stop'){
            $exam = Exam::updateOrCreate(
                ['trimester' => $request->input('trimester'), 'academic_year_id' => $academicYear->id,'status'=>'1',],
                ['stopped_at'=>now()]
            );
            $msg = "l'examen du trimestre $exam->trimester est arrêté pour l'année académique $academicYear->title";

        }elseif ($method === 'publish'){
            $exam = Exam::updateOrCreate(
                ['trimester' => $request->input('trimester'), 'academic_year_id' => $academicYear->id,'status'=>'1',],
                ['published_at' => now()]
            );
            $msg = "l'examen du trimestre $exam->trimester est éte publié pour l'année académique $academicYear->title";

        }else{
            return response()->json([
                'toast' => ['type'=>'error', 'summary'=>'L\'opération a échoué!','detail' => 'Error!'],
                'type' => 'error',
            ]);
        }
        return response()->json([
            'type' => 'success',
            'toast' => ['type'=>'error', 'summary'=>'l\'opération a réussi','detail' => $msg],
            'exam' => $exam,
        ]);
        return redirect()->route('exam.index');
    }
    public function loginAs(Request $request){
        if(!$request->has('id') || !$request->has('role')){
            session()->flash("toast",['type'=>'error', 'summary'=>'Missing information']);
            return redirect()->back();
        }
        $user = User::find($request->input('id'));
        if(!$user){
            session()->flash("toast",['type'=>'error', 'summary'=>'User dosent exist']);
            return redirect()->back();
        }
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function editSchoolCertificate(){
        $certificate = SchoolCertificate::orderBy('created_at','DESC')->first();
        if($certificate){
            $template = $certificate->template;
        }else{
            $template= null;
        }
        return Inertia::render('Certificate/Edit', ['template'=>$template]);

    }

    public function updateSchoolCertificate(Request $request){
        $validated = $request->validate([
            //'selectedTeachers' => 'required|array|size:'.$subjectsCount,
            'template' => 'required',
        ]);
        $certificate = SchoolCertificate::orderBy('created_at','DESC')->first();
        if($certificate){
            $certificate->template = $request->input('template') ;
            $certificate->save();
        }else{
            SchoolCertificate::create(['template'=>$request->input('template')]);
        }
        return response()->json([
            'type' => 'success',
            'toast' => ['type'=>'error', 'summary'=>'l\'opération a réussi','detail' => 'le modèle du certificat scolaire a été mis à jour'],
        ]);
    }


}
