<?php

namespace App\Http\Controllers;

use App\Mail\EmailConfirmation;
use App\Mail\RestablecerContraseña;
use App\Models\grupos;
use App\Models\users;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ControllerUsuarioLogin extends Controller
{
    public function crear_usuario(Request $request)
    {
        try {
            $dni_existe = users::where('dni', $request->input('dni'))->count();
            $email_existe = users::where('email', $request->input('email'))->count();

            if ($dni_existe > 0) {
                return response()->json(['value' => 'dni_existe']);
            } else {
                if ($email_existe > 0) {
                    return response()->json(['value' => 'email_existe']);
                } else {
                    $grupo = grupos::where('descripcion', 'SINLICENCIA')->firstOrFail();
                    $user = users::create([
                        'name' => $request->input('name'),
                        'apellidos' => $request->input('surnames'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'dni' => $request->input('dni'),
                        'pais' => $request->input('pais'),
                        'is_active' => true,
                        'is_admin' => false,
                        'id_grupo' => $grupo->id,
                    ]);

                    if ($user) {
                        return response()->json(['value' => true]);
                    } else {
                        return response()->json(['value' => false]);
                    }
                }
            }
        } catch (Exception  $th) {
            return response()->json(['value' => false, 'ex' => $th]);
        }
    }
    public function cerrar_sesion(Request $request)
    {
        Auth::logout();
        return redirect()->route('customlogin');
    }
    public function vista_registrarse(Request $request)
    {
        return view('Usuarios/registrarse');
    }
    public function vista_iniciar_sesion(Request $request)
    {
        return view('Usuarios/iniciarsesion');
    }
    public function loguearse(Request $request)
    {
        $user = users::where('dni', $request->input('user'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            if (Auth::attempt(['dni' => $user->dni, 'password' =>$request->input('password')])){
                return response()->json(['value' => true]);
            } else {
                return response()->json(['value' => false]);
            }
        } else {
            return response()->json(['value' => false]);
        }
    }

    public function restablecer_pass(Request $request)
    {

        $user = users::where('dni', $request->input('dni'))->where('email', $request->input('email'))->first();
        if ($user) {
            $new_password = Str::random(8);
            Mail::to($request->input('email'))->send(new EmailConfirmation($new_password));
            $user->password = Hash::make($new_password);
            $user->save();
            return response()->json(['value' => true]);
        } else {
            return response()->json(['value' => false, 'message' => 'El Dni o el Correo Electronico no Pertenecen a un Usuario Registrado']);
        }
    }
    public function enviar_email(Request $request)
    {
        Mail::to($request->input('email'))->send(new EmailConfirmation($request->input('new_password')));
        return response()->json(['value' => true]);
    }
}
