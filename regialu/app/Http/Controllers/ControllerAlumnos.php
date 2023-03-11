<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\aulas;
use App\Models\institucions;
use App\Models\periodos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAlumnos extends Controller
{
    public function indexAlumnos(Request $request)
    {
        $user = Auth::user();

        $periods = periodos::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $students_amount = alumnos::where('user_id', $user->id)->get()->count();

        return view('alumnos/studentsload', ['cantidadAlumnos' => $students_amount, 'periods' => $periods, 'user' => $user]);
    }



    public function students_all(Request $request)
    {
        $user = Auth::user();
        $institutions = institucions::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $students2 = alumnos::where('user_id', $user->id)->get();
        $students3 = []; // declarar la variable fuera del bucle

        foreach ($students2 as $key => $value) {
            $s = aulas::where('id', $value->aula_id)->first();
            $in = institucions::where('id', $s->institucion)->first();

            $e = ['id' => $value->id, 'apellidos' => $value->apellidos, 'nombres' => $value->nombres, 'grado' => $value->grado, 'seccion' => $value->seccion, 'aula-gr' => $s->grado, 'aula-se' => $s->seccion, 'aula-nivel' => $s->nivel, 'institucion' => $in->nombre];
            $students3[] = $e;
        }
        return view('alumnos/studentsAll', ['institucions' => $institutions, 'students' => $students3, 'user' => $user]);
    }
    public function institution_selected(Request $request, $id)
    {
        $user = Auth::user();
        $institutions = institucions::where('id', $id)->where('user_id', $user->id)->first();
        $aulas = aulas::where('estado', 'Activo')->where('institucion', $institutions->id)->get();
        $data = [];
        foreach ($aulas as $key => $value) {

            $students = alumnos::where('aula_id', $value->id)->where('user_id', $user->id)->get();
            foreach ($students as $key => $value) {
                $s = aulas::where('id', $value->aula_id)->first();
                $in = institucions::where('id', $s->institucion)->first();
                $e = ['id' => $value->id, 'apellidos' => $value->apellidos, 'nombres' => $value->nombres, 'grado' => $value->grado, 'seccion' => $value->seccion, 'aula-gr' => $s->grado, 'aula-se' => $s->seccion, 'aula-nivel' => $s->nivel, 'institucion' => $in->nombre];
                $data[] = $e;
            }
        }


        return view('alumnos/institutionSelected', ['aulas' => $aulas, 'institutions' => $institutions, 'students' => $data, 'user' => $user]);
    }

    public function students_save(Request $request)
    {

        $user = Auth::user();
        $archivo = $request->file('file');
    }

    public function classroom_all(Request $request)
    {
        $user = Auth::user();

        $classrooms = aulas::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $data = [];
        foreach ($classrooms as $obj) {
            $name = institucions::where('id', $obj->institucion)->first();
            $data[$obj->id] = $obj->grado + " " + $obj->seccion + " " + $name->nombre;
        }
        return response()->json(['response' => $data]);
    }
    public function save_student(Request $request)
    {

        $user = Auth::user();

        $surnames = $request->input('surnames');
        $names = $request->input('names');
        $grade = $request->input('grade');
        $idClassroom = $request->input('idClassroom');
        $student_exists = alumnos::where('user_id', $user->id)->where('apellidos', $surnames)->where('nombres', $names)->where('grado', $grade)->where('aula_id', $idClassroom)->get()->count();
        if ($student_exists) {

            return response()->json(['response' => 'existe']);
        } else {
            $aulas = aulas::where('id', $idClassroom)->where('user_id', $user->id)->first();
            $alumno = alumnos::create(['aula_id' => $aulas->id, 'user_id' => $user->id, 'apellidos' => $surnames, 'nombres' => $names, 'grado' => $grade, 'seccion' => $aulas->seccion]);
            if ($alumno) {
                return response()->json(['response' => 'success']);
            } else {
                return response()->json(['response' => 'error']);
            }
        }
    }



    public function delete_student(Request $request, $id)
    {
        $user = Auth::user();

        alumnos::where('id', $id)->where('user_id', $user->id)->delete();

        return response()->json(['response' => 'success']);
    }

    public function update_student(Request $request, $id)
    {

        $user = Auth::user();

        $names = $request->input('names');
        $surnames = $request->input('surnames');
        $object_student = alumnos::where('id', $id)->where('user_id', $user->id)->first();
        $object_student->apellidos = $surnames;
        $object_student->nombres = $names;
        $object_student->save();
        if ($object_student) {
            return response()->json(['response' => 'success']);
        } else {
            return response()->json(['response' => 'error']);
        }
    }
}
