<?php

use App\Http\Controllers\ControllerAlumnos;
use App\Http\Controllers\ControllerAreas;
use App\Http\Controllers\ControllerAsistencias;
use App\Http\Controllers\ControllerAulas;
use App\Http\Controllers\ControllerCuenta;
use App\Http\Controllers\ControllerGestions;
use App\Http\Controllers\ControllerHorarios;
use App\Http\Controllers\ControllerInstitucions;
use App\Http\Controllers\ControllerLicencias;
use App\Http\Controllers\ControllerPeriodos;
use App\Http\Controllers\ControllerTransaccion;
use App\Http\Controllers\ControllerUsuarioLogin;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ControllerUsuarioLogin::class)->prefix('Login')->group(function () {
    Route::post('GuardarUsuario', 'crear_usuario');
    Route::get('Registrarse', 'vista_registrarse')->name('register');
    Route::get('IniciarSesion', 'vista_iniciar_sesion')->name('customlogin');
    Route::get('Loguearse', 'loguearse');
    Route::get('logout', 'cerrar_sesion');
    Route::get('RecuperarPass', 'restablecer_pass');
    // Route::post('Email','enviar_email');

});
Route::controller(ControllerCuenta::class)->prefix('Cuenta')->group(function () {
    Route::get('MiCuenta', 'vista_cuenta_index');
    Route::get('CambiarPassword', 'cambiar_password');
});
Route::controller(PaymentController::class)->prefix('Pagos')->group(function () {
    Route::get('payment', 'checkout')->name('checkout');
    Route::get('cancel', 'cancel')->name('paypal.cancel');
    Route::get('payment/success', 'success')->name('paypal.success');
    Route::get('Detalles', 'ejecutar_pago');
});
Route::controller(ControllerLicencias::class)->prefix('Licencias')->group(function () {
    Route::get('Activar', 'activar_licencia');
    Route::get('Verificar', 'verificar_licencia');
});
Route::controller(ControllerTransaccion::class)->prefix('Transacciones')->group(function () {
    Route::get('Resumen', 'resumen');
});

Route::controller(ControllerPeriodos::class)->prefix('Periodos')->group(function () {
    Route::get('IndexPeriodos', 'vista_periodo')->name('index_periodo');
    Route::get('CrearPeriodo', 'crear_periodo');
    Route::get('EliminarPeriodo/{id}', 'eliminar_periodo');
    Route::get('EstadoPeriodo/{id}', 'cambiar_estado_periodo');
});
Route::controller(ControllerInstitucions::class)->prefix('Instituciones')->group(function () {
    Route::get('IndexInstitucions', 'index_instituciones')->name('index_instituciones');
    Route::get('CrearInstitucion', 'save_instituciones');
    Route::get('EstadoInstitucion/{id}', 'status_change');
    Route::get('EliminarInstitucion/{id}', 'delete_instituciones');
    Route::get('ModificarInstitucion/{id}/{period}', 'update_instituciones');
});
Route::controller(ControllerAulas::class)->prefix('Aulas')->group(function () {
    Route::get('IndexAulas', 'index_aulas')->name('index_aulas');
    Route::get('GuardarAula', 'save_Aula');
    Route::get('TodasAulas', 'all_classrooms');
    Route::get('EstadoAula/{id}', 'cambiar_estado');
    Route::get('EliminarAula/{id}', 'delete_aula');
    Route::get('EditarAula/{id}', 'update_aula');
    Route::get('InstitucionSeleccionada/{id}', 'InstitucionSeleccionada');
});
Route::controller(ControllerAreas::class)->prefix('Areas')->group(function () {
    Route::get('IndexAreas', 'index_areas')->name('index_areas');
    Route::get('GuardarArea', 'area_save');
    Route::get('EstadoArea/{id}', 'area_status_change');
    Route::get('EliminarArea/{id}', 'area_delete');
});
Route::controller(ControllerHorarios::class)->prefix('Horarios')->group(function () {
    Route::get('IndexHorario', 'index_horario')->name('index_horario');
    Route::get('GuardarHorario', 'horario_save');
    Route::get('EstadoHorario/{id}', 'horario_status_change');
    Route::get('EliminarHorario/{id}', 'horario_delete');
    Route::get('ModificarHorario/{id}', 'horario_update');
    Route::get('AsignarAula/{id}', 'classroom_assign');
    Route::get('AsignarDatosAula/{id}', 'classroom_data_assign');
    Route::get('DetalleAula/{id}', 'classroom_details');
    Route::get('DesasignarAula/{id}/{idHorario}', 'unlink_classroom');
});
Route::controller(ControllerAlumnos::class)->prefix('Alumnos')->group(function () {
    Route::get('IndexAlumno', 'students_all')->name('indexAlumnos');
    Route::get('TodoAlumnos', 'students_all')->name('students_all');
    Route::get('EditarAlumno/{id}', 'update_student');
    Route::get('InstitucionSeleccionada/{id}', 'institution_selected');
    Route::get('EliminarAlumno/{id}', 'delete_student');
});
Route::controller(ControllerGestions::class)->prefix('Gestiones')->group(function(){
    Route::get('IndexGestion', 'management_view')->name('indexGestion');
    Route::get('InstitucionPeriodo/{id}','get_institution_by_period');
    Route::get('InstitucionSeleccionada/{id}','get_aulas');
    Route::get('RetornarEstudiantes/{id}','get_students');
    Route::get('HorariosEstudiante/{id}','get_students_horario');

});
Route::controller(ControllerAsistencias::class)->prefix('Asistencias')->group(function (){
    Route::get('GuardarAsistencia/{id}','');
});
