<?php 
namespace domain\Services;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentService{

    protected $student;
    public function __construct(){
        $this->student = new Student();
    }
    public function all()
    {
        return  $this->student->all();
    }

    public function create()
    {
        return Inertia::render('Students/Create');
    }

    public function store($data)
    {
        $data->validate([
            'name' => ['required', 'max:50'],
            'age' => ['required', 'max:50'],
            'status' => ['required', 'max:50'],
            'image' => ['required','mimes:jpeg,jpg,png,gif']
        ]);
        if($data->file('image')){
            $image = $data->file('image')->store('students','public');

        }else {
            $image=NULL;
        }
        
        $newStudent = $this->student->create([
            'name'=>$data->input('name'),
            'age'=>$data->input('age'),
            'status'=>$data->input('status'),
            'image'=>$image
        ]);
        if($newStudent){
            return Redirect::route('student.index')->with('message', 'Successfully Saved');
        }else{
            return Redirect::route('student.index')->with('message', 'Unable to create new student');
        }
        
    }

   
    public function show(Student $student)
    {
        //
    }

    public function edit($data)
    {
        return Inertia::render('Students/Edit',[
            'student'=> $data,
            'image'=>asset('storage/'.$data->image),
        ]);
    }

  
    public function update($data,$student_id)
    {
        //
        //$this->student->id = $id;
        $student =  $this->student->find($student_id);
       //dd(" Record Name ".$student->name);
        $data->validate([
            'name' => ['required', 'max:50'],
            'age' => ['required', 'max:50'],
            'status' => ['required', 'max:50'],
            
        ]);
        $image = $student->image;
       // dd($this->student);
        if($data->file('image')){
            Storage::delete('public/'.$student->image);
            $image = $data->file('image')->store('students','public');

        }
        //DB::enableQuerylog();
       $updateStudent =  $student->update([
            'name'=>$data->input('name'),
            'age'=>$data->input('age'),
            'status'=>$data->input('status'),
            'image'=>$image
        ]);
        
        if($updateStudent){
            return Redirect::route('student.index')->with('message', 'Successfully Updated');
        }else{
            return Redirect::route('student.index')->with('message', 'Unable Update');
        }
       // return Redirect::route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
        //
        $student =  $this->student->find($student_id);
        Storage::delete('public/'.$student->image);
        $deleteStudent = $student->delete();
        //return Redirect::route('student.index');
        if($deleteStudent){
            return Redirect::route('student.index')->with('message', 'Successfully Deleted');
        }else{
            return Redirect::route('student.index')->with('message', 'Unable Delete ');
        }
    }

}