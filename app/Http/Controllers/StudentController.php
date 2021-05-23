<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Auth\Events\Validated;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate();
        return view('student.index', compact('students'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students',
            'school' => 'required|exists:schools,name',
        ]);
        $school_id = School::where('name', $request->input('school'))->first()->id;
        $request->request->add(['school_id' => $school_id]);
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:students',
            'school_id' => 'required'
        ]);
        $student = Student::find($id);

        if ($request->input('school_id') !== $student->school_id) {
            // Chaging school lead to drop all registered classes.
            $student->classes()->sync([]);
        }
        $student->update($request->all());
        return redirect('/student/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * register
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function register(Request $request, $id)
    {
        $student = Student::find($id);
        // check if the registering class is not a duplicate one
        $request->validate([
            'reg_class_id' => 'unique:mclass_student,mclass_id,NULL,id,student_id,' . $id
        ]);
        $student->classes()->attach($request->input('reg_class_id'));
        return redirect('/student/' . $id . '/edit');
    }

    public function drop($class_id, $id)
    {
        $student = Student::find($id);
        $student->classes()->detach($class_id);
        return redirect('/student/' . $id . '/edit');
    }
}
