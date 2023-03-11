<?php

namespace App\Http\Controllers;

use App\Models\periodos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerPeriodos extends Controller
{
    public function vista_periodo(Request $request)
    {
        $user = Auth::user();
        $periods = periodos::where('user_id', $user->id)->get();
        return view('periodos/period-view', ['periods' => $periods, 'user' => $user]);
    }


    public function crear_periodo(Request $request)
    {

        try {
            $user = Auth::user();
            $period_all = periodos::all();
            $description = $request->input('description');
            $con = 0;
            if ($period_all) {
                foreach ($period_all as $n) {
                    if ($n->descripcion == $description) {
                        $con = $con + 1;
                        return response()->json(['response' => 'existe']);
                    }
                }
            }
            if ($con == 0) {
                $start_date = $request->input('start_date');
                $finish_date = $request->input('finish_date');
                $obj_period = periodos::create([
                    'user_id' => $user->id,
                    'descripcion' => $description, 'fecha_inicio' => $start_date, 'fecha_fin' => $finish_date
                ]);

                return response()->json(['response' => $obj_period]);
            } else {
                return response()->json(['response' => 'error']);
            }
        } catch (\Exception  $ex) {
            return response()->json(['response' => 'error', 'ex' => $ex->getMessage()]);
        }
    }


    public function eliminar_periodo(Request $request, $id)
    {
        try {
            $user = Auth::user();

            periodos::where('id', $id)->where('user_id', $user->id)->delete();
            return response()->json(['response' => 'success']);
        } catch (\Exception $ex) {
            return response()->json(['response' => 'error']);
        }
    }


    public function cambiar_estado_periodo(Request $request, $id)
    {
        try {

            $user = Auth::user();
            $model_period = periodos::where('id', $id)->where('user_id', $user->id)->first();
            if ($model_period) {
                if ($model_period->estado == 'Activo') {
                    $model_period->estado = 'Inactivo';
                    $model_period->save();
                    return response()->json(['response' => $model_period->estado]);
                } else {
                    $model_period->estado = 'Activo';
                    $model_period->save();
                    return response()->json(['response' => $model_period->estado]);
                }
            } else {
                return response()->json(['response' => false, 'ex' => 'El Periodo No Existe']);
            }
        } catch (\Exception $ex) {
            return response()->json(['response' => false, 'ex' => $ex->getMessage()]);
        }
    }
}
