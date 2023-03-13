<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\aulas;
use App\Models\incidentes;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerIncidentes extends Controller
{
    public function index_incident(Request  $request, $id)
    {
        $user = Auth::user();
        $aulas = aulas::where('id', $id)->where('user_id', $user->id)->first();
        $incidents = incidentes::where('aula_id', $aulas->id)->where('user_id', $user->id)->get();
        $students = alumnos::where('aula_id', $aulas->id)->where('user_id', $user->id)->get();
        return view("incidentes/incident", ['incidents' => $incidents, 'students' => $students]);
    }
    public function save_incident(Request $request)
    {
        $user = Auth::user();

        $classroom = $request->input('classroom');
        $object_classroom = aulas::where('id', $classroom)->where('user_id', $user->id)->first();
        $date = $request->input('date');
        $description = $request->input('description');
        $array_students = $request->input('students');
        $alu = [];
        foreach ($array_students as $n) {
            $students = alumnos::where('id', $n)->where('user_id', $user->id)->first();
            array_push($alu, $students->id);
        }
        $object_incident = incidentes::create([
            'user_id' => $user->id, 'alumnos_id' => json_encode($alu),
            'fecha' => $date, 'descripcion' => $description, 'aula_id' => $object_classroom->id
        ]);

        $dicc = [
            'id' => $object_incident->id,
            'fecha' => $object_incident->fecha, 'descripcion' => $object_incident->descripcion
        ];

        return response()->json($dicc);
    }
    public function delete_incident(Request $request, $id)
    {

        $user = Auth::user();

        incidentes::where('id', $id)->where('user_id', $user->id)->delete();
        return response()->json(['response' => 'success']);
    }
    public function get_students(Request $request, $id)
    {

        $user = Auth::user();


        $object_incident = incidentes::where('id', $id)->where('user_id', $user->id)->first();
        $dicc = [];
        $al = json_decode($object_incident->alumnos_id);
        foreach ($al as $key => $value) {
            $n = alumnos::where('user_id', $user->id)->where('id', $value)->first();
            $object_dicc = ['apellidos' => $n->apellidos, 'nombres' => $n->nombres];
            $dicc[] = $object_dicc;
        }

        return response()->json($dicc);
    }
    public function generate_pdf(Request $request)
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
