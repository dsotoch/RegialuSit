<?php

namespace App\Http\Controllers;

use App\models\institucions;
use App\models\periodos;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerInstitucions extends Controller
{
    public function index_instituciones(Request $request)
    {
        $user = Auth::user();
        $inst = institucions::where('user_id', $user->id)->get();
        $periods = periodos::where('estado', 'Activo')->where('user_id', $user->id)->get();
        $array = [];
        foreach ($inst as $key => $value) {
            $periodo = periodos::where('id', $value->id_periodo)->where('user_id', $user->id)->first();
            $elemento = [
                'id' => $value->id,
                'nombre' => $value->nombre,
                'direccion' => $value->direccion,
                'tipo' => $value->tipo,
                'estado' => $value->estado,
                'id_periodo' => $periodo->id,
                'periodo' => $periodo->descripcion,
            ];
            $array[] = $elemento;
        }


        return view('instituciones/instituciones', ['data' => $array, 'periods' => $periods, 'user' => $user]);
    }

    public function get_instituciones(Request $request)
    {

        return view("instituciones");
    }

    public function save_instituciones(Request $request)
    {
        try {

            $user = Auth::user();
            $nombres = $request->input('nombre');
            $direccion = $request->input('direccion');
            $tipo = $request->input('tipo');
            $period = $request->input('period');
            $object_period = periodos::where('id', $period)->where('user_id', $user->id)->where('estado', 'Activo')->first();
            if ($object_period) {
                $in = institucions::create([
                    'user_id' => $user->id,
                    'nombre' => $nombres, 'direccion' => $direccion, 'tipo' => $tipo, 'id_periodo' => $object_period->id
                ]);
                $in->periodo()->associate($object_period);
                return response()->json(['respuesta' => true]);
            } else {
                return response()->json(['respuesta' => false, 'ex' => "No Existen Periodos Activos"]);
            }
        } catch (\Exception  $e) {
            return response()->json(['respuesta' => false, 'ex' => $e]);
        }
    }


    public function status_change(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $model = institucions::where('user_id', $user->id)->where('id', $id)->first();
                if ($model) {
                    if ($model->estado == 'Activo') {
                        $model->estado = 'Inactivo';
                        $model->save();
                        return response()->json(['response' => 'success']);
                    } else {
                        $model->estado = 'Activo';
                        $model->save();

                        return response()->json(['response' => 'success']);
                    }
                } else {
                    return response()->json(['response' => 'error', 'ex' => 'La Institución no Existe']);
                }
            }
        } catch (\Exception $x) {
            return response()->json(['response' => 'error', 'ex' => $x->getMessage()]);
        }
    }

    public function delete_instituciones(Request $request, $id)
    {
        try {

            $user = Auth::user();

            institucions::where('id', $id)->where('user_id', $user->id)->delete();

            return response()->json(['response' => 'success']);
        } catch (\Exception $ex) {
            return response()->json(['response' => 'error', 'ex' => $ex->getMessage()]);
        }
    }

    public function update_instituciones(Request $request, $id, $period)
    {
        try {
            $user = Auth::user();
            $name = $request->input('nombre');
            $dire = $request->input('direccion');
            $tipo = $request->input('tipo');
            $object_period = periodos::where('id', $period)->where('user_id', $user->id)->first();
            if ($object_period) {
                $objeto = institucions::where('id', $id)->where('user_id', $user->id)->first();
                if ($objeto) {
                    $objeto->nombre = $name;
                    $objeto->direccion = $dire;
                    $objeto->tipo = $tipo;
                    $objeto->id_periodo = $object_period->id;
                    $objeto->save();
                    return response()->json(['response' => true]);
                } else {
                    return response()->json(['response' => 'Error', 'ex' => 'La Institucion no Existe']);
                }
            } else {
                return response()->json(['response' => 'Error', 'ex' => 'El Periodo no Existe']);
            }
        } catch (\Exception $ex) {
            return response()->json(['response' => 'Error', 'ex' => $ex->getMessage()]);
        }
    }
}
