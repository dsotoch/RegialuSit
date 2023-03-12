<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\areas;
use App\Models\aulas;
use App\Models\horarios;
use App\Models\institucions;
use App\Models\periodos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerGestions extends Controller
{
    public function management_view(Request $request)
    {
        $user = Auth::user();
        $current_date = Carbon::now();
        $periods = periodos::where('estado', 'Activo')->where('user_id', $user->id)->get();
        return view('gestions/managementview', ['current_date' => $current_date, 'periods' => $periods, 'user' => $user]);
    }
    public function get_institution_by_period(Request $request, $id)
    {
        $user = Auth::user();
        $object_period = periodos::where('id', $id)->where('user_id', $user->id)->first();
        $objects_institutions = institucions::where('estado', 'Activo')->where('user_id', $user->id)->where('id_periodo', $object_period->id)->get();
        if ($objects_institutions) {
            return response()->json($objects_institutions);
        } else {
            return response()->json(['response' => 'error']);
        }
    }
    public function get_aulas(Request $request, $id)
    {
        $user = Auth::user();
        $objects_institutions = institucions::where('user_id', $user->id)->where(
            'estado',
            'Activo'
        )->where('id', $id)->first();
        $classrooms = aulas::where('user_id', $user->id)->where(
            'estado',
            'Activo'
        )->where('institucion', $objects_institutions->id)->get();
        if ($classrooms) {
            return response()->json($classrooms);
        } else {
            return response()->json(['res' => 'error']);
        }
    }
    public function get_students(Request $request, $id)
    {
        $user = Auth::user();
        $object_classroom = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $object_students = alumnos::where('aula_id', $object_classroom->id)->where('user_id', $user->id)->get();
        if ($object_students) {
            return response()->json($object_students);
        } else {
            return response()->json(['response' => 'error']);
        }
    }
    public function get_students_horario(Request $request, $id)
    {

        $user = Auth::user();

        $classroom = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $schedules = horarios::where('user_id', $user->id)->where('aula_id', $classroom->id)->where('estado', 'Activo')->get();
        $dicc = [];
        foreach ($schedules as $key => $n) {
            $areas = areas::where('id', $n->area_id)->first();
            $ob = ['idHorario' => $n->id, 'area' => $areas->descripcion, 'idArea' => $areas->id, 'turno' => $n->turno, 'dia' => $n->dia, 'horaInicio' => $n->horainicio, 'horaFin' => $n->horafin];
            $dicc[] = $ob;
        }
        return response()->json($dicc);
    }
}
