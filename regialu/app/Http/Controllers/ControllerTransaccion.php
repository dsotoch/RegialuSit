<?php

namespace App\Http\Controllers;

use App\Models\transaccions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerTransaccion extends Controller
{
    public function resumen(Request $request)
    {
        $user = Auth::user();
        $object_transaccion = transaccions::where('user_id', $user->id)->get();
        $total = 0.0;
        $c = 0.0;
        foreach ($object_transaccion as $key => $transaccion) {
            $c = $transaccion->monto;
            $total = $total + $c;
        }


        $html = view(
            'transacciones/resumen',
            ['data' => $object_transaccion, 'total' => $total]
        );
        return $html;
    }
}
