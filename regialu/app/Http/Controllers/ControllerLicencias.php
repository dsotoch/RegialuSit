<?php

namespace App\Http\Controllers;

use App\Models\grupos;
use App\Models\licencias;
use App\Models\planes;
use App\Models\transaccions;
use App\Models\users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerLicencias extends Controller
{
    public function activar_licencia(Request $request)
    {
        try {
            $user = Auth::user();
            $usuario = users::where('dni', $user->dni)->first();
            $grupo = grupos::where('descripcion', 'CONLICENCIA')->first();
            $planes = planes::where('precio', $request->input('monto'))->where('estado', true)->first();
            $licencia = licencias::where('is_active', false)->where('is_usado', false)->first();
            if ($licencia && $planes) {
                $licencia->user_id = $user->id;
                $licencia->is_usado = true;
                $licencia->is_active = true;
                $licencia->plan_id = $planes->id;
                $usuario->id_grupo = $grupo->id;
                $usuario->save();
                $planes->licencias()->save($licencia);


                switch ($planes->nombre_plan) {
                    case 'BASICO':
                        $licencia->activation_date = Carbon::now();
                        $licencia->expired_date = Carbon::now()->addDays(30);
                        $licencia->save();
                        transaccions::create([
                            'payment_id' => $request->input('payment_id'),
                            'payer_id' => $request->input('payer_id'),
                            'monto' => $request->input('monto'),
                            'pagado' => true,
                            'fecha' => Carbon::now(),
                            'plan_id' => $planes->id,
                            'user_id' => $user->id,
                        ]);

                        break;
                    case 'PREMIUN':
                        $licencia->activation_date = Carbon::now();
                        $licencia->expired_date = Carbon::now()->addDays(180);
                        $licencia->save();
                        transaccions::create([
                            'payment_id' => $request->input('payment_id'),
                            'payer_id' => $request->input('payer_id'),
                            'monto' => $request->input('monto'),
                            'pagado' => true,
                            'fecha' => Carbon::now(),
                            'plan_id' => $planes->id,
                            'user_id' => $user->id,
                        ]);
                        break;

                    default:
                        $licencia->activation_date = Carbon::now();
                        $licencia->expired_date = Carbon::now()->addDays(365);
                        $licencia->save();
                        transaccions::create([
                            'payment_id' => $request->input('payment_id'),
                            'payer_id' => $request->input('payer_id'),
                            'monto' => $request->input('monto'),
                            'pagado' => true,
                            'fecha' => Carbon::now(),
                            'plan_id' => $planes->id,
                            'user_id' => $user->id,
                        ]);
                        break;
                }
                return response()->json(['value' => true]);
            } else {
                return response()->json(['value' => false, 'ex' => '0 LICENCIAS DISPONIBLES']);
            }
        } catch (\Exception $th) {
            return response()->json(['value' => false, 'ex' => $th->getMessage()]);
        }
    }
    public function verificar_licencia(Request $request)
    {
        $grupo = grupos::where('descripcion', 'SINLICENCIA')->first();
        $user = Auth::user();
        $usuario = users::where('dni', $user->dni)->first();
        $key = $request->input('key', '');
        try {
            $license = licencias::where('key', $key)->first();
            if ($license) {
                if ($license->is_active && $license->expired_date > Carbon::now()) {
                    return response()->json(['valid' => True]);
                } else {
                    $usuario->id_grupo = $grupo->id;
                    $usuario->save();
                    $license->is_active = false;
                    $license->is_usado=false;
                    $license->user_id = null;
                    $license->plan_id=null;
                    $license->save();
                    return response()->json(['valid' => false, 'reason' => 'Licencia vencida o inactiva.']);
                }
            } else {
                return response()->json(['valid' => false, 'reason' => 'Licencia vencida o aun no ha Comprado Una.']);
            }
        } catch (\Exception $ex) {
            return response()->json(['valid' => False, 'reason' => $ex->getMessage()]);
        }
    }
}
