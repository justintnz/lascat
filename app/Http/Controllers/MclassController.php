<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mclass;
use App\Models\School;

class MclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = Mclass::find($id);
        return view('class.edit', compact('class'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);
        $class = Mclass::find($id);
        $class->update($request->all());
        return redirect('/school/' . $class->school_id . '/edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($school_id)
    {

        $school = School::find($school_id);
        return view('class.new', compact('school'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $school_id)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);
        Mclass::create([
            'name' => $request->input('name'),
            'school_id' => $school_id
        ]);
        return redirect('/school/' . $school_id . '/edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $class =  Mclass::find($id);
        $school_id = $class->school_id;
        // drop all registered students 
        $class->students()->sync([]);
        Mclass::destroy($id);
        return redirect('/school/' . $school_id . '/edit');
    }
}
