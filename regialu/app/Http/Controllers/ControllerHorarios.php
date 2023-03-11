<?php

namespace App\Http\Controllers;

use App\Models\areas;
use App\Models\aulas;
use App\Models\horarios;
use App\Models\institucions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerHorarios extends Controller
{
    public function index_horario(Request $request)
    {
        $user = Auth::user();

        $total = horarios::where('user_id', $user->id)->get()->count();
        $data = horarios::where('user_id', $user->id)->get();
        $areas = areas::where('estado', 'Activo')->where('user_id', $user->id)->get();

        $array = [];
        if ($data) {

            foreach ($data as $key => $value) {
                $area = areas::where('id', $value->area_id)->first();
                $element = ['id' => $value->id, 'turno' => $value->turno, 'dia' => $value->dia, 'horainicio' => $value->horainicio, 'horafin' => $value->horafin, 'estado' => $value->estado, 'area' => $area->descripcion];
                $array[] = $element;
            }
        }

        return view('horarios/horario', ['total' => $total, 'data' => $array, 'area' => $areas, 'user' => $user]);
    }

    public function horario_save(Request $request)
    {

        $user = Auth::user();
        $turno = $request->input('turno');
        $dia = $request->input('dia');
        $areas = $request->input('area');
        $horainicio = $request->input('horainicio');
        $horafin = $request->input('horafin');
        $oarea = areas::where('id', $areas)->where('user_id', $user->id)->first();


        if ($oarea) {
            $nuevoObjeto = horarios::create([
                'user_id' => $user->id,
                'turno' => $turno, 'dia' => $dia, 'area_id' => $oarea->id, 'horainicio' => $horainicio, 'horafin' => $horafin
            ]);
            if ($nuevoObjeto) {
                return response()->json(['response' => $nuevoObjeto]);
            } else {
                return response()->json(['response' => 'error']);
            }
        } else {
            return response()->json(['response' => 'error']);
        }
    }
    public function horario_delete(Request $request, $id)
    {
        $user = Auth::user();

        horarios::where('id', $id)->where('user_id', $user->id)->delete();

        return response()->json(['response' => 'success']);
    }

    public function horario_status_change(Request $request, $id)
    {
        $user = Auth::user();

        $model = horarios::where('id', $id)->where('user_id', $user->id)->first();
        $new = "";
        if ($model->estado == 'Activo') {
            $new = 'Inactivo';
        } else {
            $new = 'Activo';
        }
        $model->estado = $new;
        $model->save();
        return response()->json(['response' => $new]);
    }


    public function horario_update(Request $request, $id)
    {
        $user = Auth::user();
        $model = horarios::where('id', $id)->where('user_id', $user->id)->first();
        $turno = $request->input('turno');
        $dia = $request->input('dia');
        $areas = $request->input('area');
        $horainicio = $request->input('horainicio');
        $horafin = $request->input('horafin');
        $oarea = areas::where('id', $areas)->where('user_id', $user->id)->first();
        if ($model && $oarea) {
            $model->turno = $turno;
            $model->dia = $dia;
            $model->area_id = $oarea->id;
            $model->horainicio = $horainicio;
            $model->horafin = $horafin;
            $model->save();
            return response()->json(['response' => 'success']);
        } else {
            return response()->json(['response' => 'error']);
        }
    }

    public function classroom_assign(Request $request, $id)
    {
        $user = Auth::user();

        $modelohorario = horarios::where('id', $id)->where('user_id', $user->id)->first();
        $data = aulas::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $aulas = aulas::where('estado', 'Activo')->where('user_id', $user->id)->where('id', $modelohorario->aula_id)->first();
        $cantidad = 0;
        $data2=[];
        foreach ($data as $key => $value) {
            $is=institucions::where('id',$value->institucion)->first();
            $el=['id'=>$value->id,'grado'=>$value->grado,'seccion'=>$value->seccion,'nivel'=>$value->nivel,'institucion'=>$is->nombre];
            $data2[]=$el;
        }
        if ($aulas) {
            $ins=institucions::where('id',$aulas->institucion_id)->first();
            $cantidad = 1;
            $array = array('institucion'=>$ins,'grado' => $aulas->grado, 'seccion' => $aulas->seccion, 'nivel' => $aulas->nivel, 'id' => $aulas->id);
            $area = areas::where('id', $modelohorario->area_id)->first();
            $array_horario = array( 'turno'=>$modelohorario->turno,'dia' => $modelohorario->dia, 'area' => $area->descripcion, 'id' => $modelohorario->id, 'estado' => $modelohorario->estado, 'horainicio' => $modelohorario->horainicio, 'horafin' => $modelohorario->horafin);
            
            return view('horarios/aula', [ 'user'=>$user,'horario' => $array_horario, 'data' => $data2, 'aulas' => $array, 'cantidad' => $cantidad]);
        } else {
            $area = areas::where('id', $modelohorario->area_id)->first();
            $array_horario = array(  'turno'=>$modelohorario->turno,'dia' => $modelohorario->dia, 'area' => $area->descripcion, 'id' => $modelohorario->id, 'estado' => $modelohorario->estado, 'horainicio' => $modelohorario->horainicio, 'horafin' => $modelohorario->horafin);
            $s2 = array('institucion'=>"",'grado' => "", 'seccion' => "", 'nivel' => "", 'id' => "");

            return view('horarios/aula', ['user'=>$user,'horario' => $array_horario, 'data' => $data2, 'aulas' => $s2, 'cantidad' => $cantidad]);
        }
    }
    public function classroom_data_assign(Request $request, $id)
    {
        $user = Auth::user();

        $model = horarios::where('id', $id)->where('user_id', $user->id)->first();
        foreach ($request->input('data') as $key => $value) {
            $m_aula = aulas::where('id', $value)->where('user_id', $user->id)->first();
            $model->aula_id = $m_aula->id;
            $model->save();
        }

        return response()->json(['response' => 'success']);
    }
    public function classroom_details(Request $request, $id)
    {
        $user = Auth::user();
        $aulas = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $inst = institucions::where('user_id', $user->id)->where('id', $aulas->institucion)->first();
        if ($aulas && $inst) {
            return response()->json(['response' => $aulas, 'res' => $inst]);
        } else {
            return response()->json(['response' => 'error']);
        }
    }

    public function unlink_classroom(Request $request, $id, $idHorario)
    {
        $user = Auth::user();
        $objeto_aula = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $cambio = horarios::where('id', $idHorario)->where('aula_id', $objeto_aula->id)->where('user_id', $user->id)->first();
        if ($cambio) {
            $cambio->aula_id = null;
            $cambio->save();
            return response()->json(['response' => 'success']);
        } else {
            return response()->json(['response' => 'error']);
        }
    }
}
