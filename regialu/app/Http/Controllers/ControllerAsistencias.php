<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\areas;
use App\Models\asistencias;
use App\Models\aulas;
use App\Models\periodos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use Dompdf\Dompdf;

class ControllerAsistencias extends Controller
{
    public function save_assistance(Request $request, $id)
    {
        $user = Auth::user();
        $areas = areas::where('id', $request->input('area'))->where('user_id', $user->id)->first();
        $registrationdate = Carbon::now();
        $updatedate = Carbon::now();
        $classroom = aulas::where('id', $id)->where('user_id', $user->id)->first();
        if ($classroom) {
            $assistance = asistencias::where('user_id', $user->id)->where('aula_id', $classroom->id)->where('area_id', $areas->id)->whereDate('fechaRegistro', $registrationdate)->first();
            if ($assistance) {
                return response()->json(['response' => 'existe']);
            } else {
                foreach ($request->input('data') as $ite => $value) {
                    $objectstudent = alumnos::where('id', $ite)->first();
                    asistencias::create([
                        'user_id' => $user->id,
                        'fechaRegistro' => $registrationdate, 'fechaActualizacion' => $updatedate, 'estado' => $value, 'alumno_id' => $objectstudent->id, 'aula_id' => $classroom->id, 'area_id' => $areas->id
                    ]);
                }
                return response()->json(['response' => 'success']);
            }
        } else {
            return response()->json(['response' => 'error']);
        }
    }
    public function update_assistance(Request $request, $id)
    {
        return view("asistencias/updateassistance", ['aula' => $id]);
    }

    public function update_assistance_data(Request $request, $id, $date)
    {
        $user = Auth::user();
        $updatedate = Carbon::now();
        $classroom = aulas::where('id', $id)->where('user_id', $user->id)->first();

        foreach ($request->input('data') as $key => $val) {
            $objectstudent = alumnos::where('id', $key)->where('user_id', $user->id)->first();
            $Asistencia = asistencias::where('user_id', $user->id)->whereDate('fechaRegistro', Carbon::parse($date))->where('aula_id', $classroom->id)->where('alumno_id', $objectstudent->id)->get();
            foreach ($Asistencia as $n) {
                $n->alumno_id = $objectstudent->id;
                $n->estado = $val;
                $n->fechaActualizacion = $updatedate;
                $n->save();
            }
        }
        return response()->json(['response' => 'success']);
    }

    public function get_assistance(Request $request, $date, $idaula)
    {
        $user = Auth::user();
        $classroom = aulas::where('id', $idaula)->where('user_id', $user->id)->first();
        $object_students = asistencias::where('user_id', $user->id)->where('aula_id', $classroom->id)->whereDate('fechaRegistro', Carbon::parse($date))->get();
        $dicc_students = [];
        if ($object_students) {
            foreach ($object_students as $n) {
                $a = alumnos::where('id', $n->alumno_id)->first();
                $d = [
                    'id' => $a->id,
                    'apellidos' => $a->apellidos,
                    'nombres' => $a->nombres,
                    'estado' => $n->estado
                ];
                $dicc_students[] = $d;
            }
            return response()->json($dicc_students);
        } else {
            return response()->json(['response' => 'error']);
        }
    }


    public function generate_pdf(Request $request, $id)
    {

        $user = Auth::user();
        $aulas = $request->input('aulas');
        $areas = $request->input('area');
        $perioda = $request->input('periodo');
        $institucions = $request->input('institucions');
        $fechas = Carbon::now();
        $name_periodo = explode("/", $perioda)[0];
        $period = periodos::where('descripcion', $name_periodo)->where('user_id', $user->id)->first();
        $fecha_fin = $period->fecha_fin;
        $fecha_inicio = $period->fecha_inicio;
        $object_area = areas::where('id', $areas)->where('user_id', $user->id)->first();
        $object_classroom = aulas::where('id', $aulas)->where('user_id', $user->id)->first();
        $object_student = alumnos::where('user_id', $user->id)->where(
            'id',
            $id
        )->where('aula_id', $object_classroom->id)->first();
        $object_asistance = asistencias::where('user_id', $user->id)->where('alumno_id', $object_student->id)->where('aula_id', $object_classroom->id)->where('area_id', $object_area->id)->whereDate('fechaRegistro', '>=', $fecha_inicio)->whereDate('fechaRegistro', '<=', $fecha_fin)->get();
        $alumnoss = $object_student->apellidos . ' ' . $object_student->nombres;
        $numero_asistencias = $object_asistance->count();
        $asistencias = 0;
        $faltas = 0;
        $tardanzas = 0;
        $lista = [];
        $estado = "";
        foreach ($object_asistance as $n) {
            if ($n->estado == 'A') {
                $estado = "Asistio";
                $asistencias = $asistencias + 1;
            } else {
                if ($n->estado == 'F') {
                    $estado = "Faltó";
                    $faltas = $faltas + 1;
                } else {
                    $estado = "Tardanza";
                    $tardanzas = $tardanzas + 1;
                }
            }

            $dicc = ['fecha' => $n->fechaRegistro, 'estado' => $estado];
            $lista[] = $dicc;
        }
        return view('asistencias/reportStudent', [
            'periodo' => $period,
            'institucions' => $institucions,
            'fechas' => $fechas,
            'areas' => $object_area->descripcion,
            'alumnoss' => $alumnoss,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'numero_asistencias' => $numero_asistencias,
            'asistencias' => $asistencias,
            'faltas' => $faltas,
            'tardanzas' => $tardanzas,
            'asistances' => $lista,
        ]);
    }
    public function savePDF(Request $request)
    {

        // Obtener el HTML del documento
        $html = $request->input('html');
        // Crear una instancia de Dompdf
        $pdf = new Dompdf();

        // Cargar el HTML generado en Dompdf
        $pdf->loadHtml($html);

        // Renderizar el PDF
        $pdf->render();

        // Obtener el contenido del PDF generado
        $pdfContent = $pdf->output();

        // Devolver el contenido del PDF como respuesta JSON
        return response()->json([
            'pdf' => base64_encode($pdfContent)
        ]);
    }
}
