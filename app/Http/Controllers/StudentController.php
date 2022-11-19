<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use Inertia\Inertia;
use Redirect;
use Storage;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::all();
            return Inertia::render('Students/index',[
                'students'=>Student::all()->map(function($data){
                return [
                        'id'=>$data->id,
                        'name'=>$data->name,
                        'age'=>$data->age,
                        'image'=>asset('storage/'.$data->image),
                        'status'=>$data->status,
                ];
                })
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render('Students/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $student = Student::create($request['obj']);
        //return $request['obj'];
        if($request->file('image')){
            $image = $request->file('image')->store('students','public');

        }else {
            $image=NULL;
        }
        
        $newStudent = Student::create([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'status'=>$request->input('status'),
            'image'=>$image
        ]);
        if($newStudent){
            return Redirect::route('student.index')->with('message', 'Successfully Saved');
        }else{
            return Redirect::route('student.index')->with('message', 'Unable to create new student');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        return Inertia::render('Students/Edit',[
            'student'=> $student,
            'image'=>asset('storage/'.$student->image),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
        $image = $student->image;
        
        if($request->file('image')){
            Storage::delete('public/'.$student->image);
            $image = $request->file('image')->store('students','public');

        }
       $updateStudent =  $student->update([
            'name'=>$request->input('name'),
            'age'=>$request->input('age'),
            'status'=>$request->input('status'),
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
    public function destroy(Student $student)
    {
        //
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
