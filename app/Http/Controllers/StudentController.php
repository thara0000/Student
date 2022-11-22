<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use domain\Facades\StudentFacade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\Support\Facades\Storage as FacadesStorage;
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
        $students = StudentFacade::all();
            return Inertia::render('Students/index',[
                'students'=>$students->map(function($data){
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
        return StudentFacade::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return StudentFacade::store($request);
       
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
    public function edit(Student $student_id)
    {
      
        return StudentFacade::edit($student_id);
      
    }

   
    public function update(Request $request, $student_id)
    {
      
        return StudentFacade::update($request,$student_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($student_id)
    {
       
        return StudentFacade::destroy($student_id);
       
    }
}
