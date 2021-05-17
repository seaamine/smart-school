<?php

namespace App\Http\Controllers;


use App\Models\AcademicYear;
use App\Models\SClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function indexAcademicYear(){
        $academicYears=AcademicYear::select('title','start_date','end_date')->get();
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
        return Redirect::route('home');
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

    public function addStudent(){
        $classes=SClass::all();
        return Inertia::render('Student/Add', ["classes"=>$classes]);
    }
}
