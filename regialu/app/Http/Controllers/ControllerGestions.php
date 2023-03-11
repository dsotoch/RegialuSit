<?php

namespace App\Http\Controllers;

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
        return view('gestions/managementview', ['current_date' => $current_date, 'periods' => $periods,'user'=>$user]);
    }
}
