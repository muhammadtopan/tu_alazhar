<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Semester_Model;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester_Model::all();
        return view(
            'page/semester/index',
            [
                'semester' => $semester
            ]
        );
    }
    public function create()
    {
        return view(
            'page/semester/form',
            [
                'url' => 'semester.store'
            ]
        );
    }
    public function store(Request $request, Semester_Model $semester)
    {
        $validator = Validator::make($request->all(), [
            'semester'         => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('semester.create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $semester->semester = $request->input('semester');
            $semester->save();

            return redirect()
                ->route('semester')
                ->with('message', 'Data berhasil ditambahkan');
        }
    }

    public function edit(Semester_Model $semester)
    {
        return view(
            'page/semester/form',
            [
                'semester' => $semester,
                'url' => 'semester.update',
            ]
        );
    }

    public function update(Request $request, Semester_Model $semester)
    {
        $validator = Validator::make($request->all(),[
            'semester'         => 'required',
        ]);

        if($validator->fails()){
            return redirect()
                ->route('semester.update', $semester->id_semester)
                ->withErrors($validator)
                ->withInput();
        }else{

            $semester->semester = $request->input('semester');
            $semester->save();

            return redirect()
                ->route('semester')
                ->with('message', 'Data berhasil diedit');
        }
    }

    public function destroy(Semester_Model $semester)
    {
        $semester->delete();
        return redirect()
            ->route('semester')
            ->with('message', 'Data berhasil dihapus');
    }
}
