<?php

namespace App\Http\Controllers;

use App\Models\aulas;
use App\Models\institucions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAulas extends Controller
{
    public function index_aulas(Request $request)
    {
        $user = Auth::user();
        $instituciones = institucions::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $cantidad = aulas::where(
            'user_id',
            $user->id
        )->count();
        $totales = $cantidad;
        $aulas = aulas::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        $array = [];
        if ($aulas) {
            $inst = institucions::where('id', $aulas->institucion)->first();
            $element = [
                'id' => $aulas->id,
                'grado' => $aulas->grado,
                'seccion' => $aulas->seccion,
                'nivel' => $aulas->nivel,
                'institucion' => $inst->nombre
            ];
            $array[] = $element;
        } else {
            $element = [
                'id' => "",
                'grado' => "",
                'seccion' => "",
                'nivel' => "",
                'institucion' => ""
            ];
            $array[] = $element;
        }



        return view('aulas/subirAula', ['total' => $totales, 'aulas' => $array, 'ins' => $instituciones, 'user' => $user]);
    }



    public function save_Aula(Request $request)
    {
        try {
            $user = Auth::user();
            $seccion = $request->input('seccion');
            $grado = $request->input('grado');
            $nivel = $request->input('nivel');
            $id_institucion = $request->input('institucion');
            $institucion = institucions::where('user_id', $user->id)->where('id', $id_institucion)->first();
            if ($institucion) {
                $objeto_aula = aulas::create([
                    'user_id' => $user->id,
                    'grado' => $grado, 'seccion' => $seccion, 'nivel' => $nivel, 'institucion' => $institucion->id
                ]);
                return response()->json(['aula' => $objeto_aula]);
            } else {
                return response()->json(['aula' => 'error', 'ex' => 'No Existe la Institución']);
            }
        } catch (\Exception $e) {
            return response()->json(['aula' => 'error', 'ex' => $e->getMessage()]);
        }
    }


    public function all_Classrooms(Request $request)
    {
        $user = Auth::user();
        $aulas = aulas::where('user_id', $user->id)->get();
        $array = [];
        foreach ($aulas as $key => $aulas) {
            $inst = institucions::where('id', $aulas->institucion)->first();
            $element = [
                'id' => $aulas->id,
                'grado' => $aulas->grado,
                'seccion' => $aulas->seccion,
                'tipo' => $aulas->nivel,
                'estado' => $aulas->estado,
                'institucion' => $inst->nombre,
            ];
            $array[] = $element;
        }
        $instituciones = institucions::where('estado', 'Activo')->where('user_id', $user->id)->get();
        return view('aulas/allClassrooms', ['data' => $array, 'instituciones' => $instituciones, 'user' => $user]);
    }

    public function InstitucionSeleccionada(Request $request, $id)
    {
        $user = Auth::user();
        $chosen_institution = institucions::where('id', $id)->where('user_id', $user->id)->first();
        $data = aulas::where('institucion', $chosen_institution->id)->where('user_id', $user->id)->get();
        $array = [];
        foreach ($data as $key => $data) {
            $inst = institucions::where('id', $data->institucion)->first();
            $element = [
                'id' => $data->id,
                'grado' => $data->grado,
                'seccion' => $data->seccion,
                'tipo' => $data->nivel,
                'estado' => $data->estado,
                'institucion' => $inst->nombre,
            ];
            $array[] = $element;
        }
        $instituciones = institucions::where('user_id', $user->id)->get();

        return view('aulas/chosenInstitution', ['data' => $array, 'instituciones' => $instituciones]);
    }

    public function  delete_aula(Request $request, $id)
    {

        $user = Auth::user();
        $aula = aulas::where('id', $id)->where('user_id', $user->id)->delete();
        if ($aula) {
            return response()->json(['response' => 'success']);
        } else {
            return response()->json(['response' => 'success']);
        }
    }


    public function cambiar_estado(Request $request, $id)
    {

        $user = Auth::user();
        $model = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $new = "";
        if ($model) {
            if ($model->estado == 'Activo') {
                $new = 'Inactivo';
            } else {

                $new = 'Activo';
            }
            $model->estado = $new;
            $model->save();
            return response()->json(['response' => $new]);
        } else {
            return response()->json(['response' => 'error']);
        }
    }

    public function update_aula(Request $request, $id)
    {
        $user = Auth::user();
        $model = aulas::where('user_id', $user->id)->where('id', $id)->first();
        if ($model) {
            $model->grado = $request->input('grado');
            $model->seccion = $request->input('seccion');
            $model->nivel = $request->input('nivel');
            $model->save();

            return response()->json(['response' => $model]);
        } else {
            return response()->json(['response' => 'error']);
        }
    }
}
