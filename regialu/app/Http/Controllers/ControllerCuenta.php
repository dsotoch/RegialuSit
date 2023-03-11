<?php

namespace App\Http\Controllers;

use App\Models\licencias;
use App\Models\planes;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ControllerCuenta extends Controller
{
    public function vista_cuenta_index(Request $request)
    {
        $license = "EL SOFTWARE ESTA INABILITADO POR QUE AUN NO HA COMPRADO NINGUNA LICENCIA";
        $nombreplan = "";
        $tiempo = "";
        $idaut = Auth::user();
        if ($idaut) {
            $user = users::where('dni', $idaut->dni)->first();
            $licencias = licencias::where('user_id', $user->id)->where('is_active', true)->where('is_usado', true)->first();

            if ($licencias) {
                $planes = planes::where('id', $licencias->plan_id)->first();
                $is_activo = "";
                $is_usado = "";
                $tiempo = "";

                switch ($planes->nombre_plan) {
                    case 'VIP':
                        $tiempo = "1 Año";
                        break;
                    case 'PREMIUN':
                        $tiempo = "6 Meses";
                        break;

                    default:
                        $tiempo = "1 Mes";
                        break;
                }

                switch ($licencias->is_active) {
                    case 1:
                        $is_activo = "Verdadero";
                        break;

                    default:
                        $is_activo = "Falso";
                        break;
                }
                switch ($licencias->is_usado) {
                    case 1:
                        $is_usado = "Verdadero";
                        break;

                    default:
                        $is_usado = "Falso";
                        break;
                }

                return view('cuentas/vista_cuenta_index', ['tiempo' => $tiempo, 'plan' => $planes->nombre_plan, 'user' => $user, 'dni' => $user->dni, 'tiempo' => $tiempo, 'nombreplan' => $nombreplan, 'license' => $licencias->key, 'activation' => $licencias->activation_date, 'expired' => $licencias->expired_date, 'is_active' => $is_activo, 'is_usado' => $is_usado]);
            } else {
                return view('cuentas/vista_cuenta_index', ['plan' => 'Aun No Ha comprado Ningun Plan', 'user' => $user, 'dni' => $user->dni, 'tiempo' => $tiempo, 'nombreplan' => $nombreplan, 'license' => $license, 'activation' => null, 'expired' => null, 'is_active' => 'Falso', 'is_usado' => 'Falso']);
            }
        } else {
        }
    }

    public function cambiar_password(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $usuario = users::where('dni', $user->dni)->first();
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();
            Auth::logout();
            return response()->json(['value' => true]);
        } else {
            return response()->json(['value' => false]);
        }
    }
}
