<?php

namespace App\Http\Controllers;

use App\Models\areas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAreas extends Controller
{
    public function index_areas(Request $request)
    {
        $user = Auth::user();

        $total = areas::where('user_id', $user->id)->get()->count();
        $data = areas::where('user_id', $user->id)->get();

        return view('areas/area', ['total' => $total, 'data' => $data, 'user' => $user]);
    }

    public function area_save(Request $request)
    {
        $user = Auth::user();
        $descripcion = $request->input('da');
        if ($descripcion) {
            $obj = areas::where('descripcion', $descripcion)->where('user_id', $user->id)->first();
            if ($obj) {
                return response()->json(['response' => 'existe']);
            } else {
                $nuevoObjeto = areas::create(['descripcion' => $descripcion, 'user_id' => $user->id]);
                if ($nuevoObjeto) {
                    return response()->json(['response' => $nuevoObjeto]);
                } else {
                    return response()->json(['response' => 'error']);
                }
            }
        } else {
            return response()->json(['response' => 'error']);
        }
    }

    public function area_delete(Request $request, $id)
    {

        $user = Auth::user();

        areas::where('id', $id)->where('user_id', $user->id)->delete();

        return response()->json(['response' => 'success']);
    }
    public function area_status_change(Request $request, $id)
    {
        $user = Auth::user();

        $model = areas::where('id', $id)->where('user_id', $user->id)->first();
        if ($model) {
            $new = "";
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
}
