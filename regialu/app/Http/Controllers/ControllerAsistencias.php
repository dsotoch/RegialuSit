<?php

namespace App\Http\Controllers;

use App\Models\aulas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerAsistencias extends Controller
{
    public function save_assistance(Request $request, $id){
    try:
        $user=Auth::user();
            $areas = area.objects.get(idArea=data.get('area'),user=user);
            $registrationdate = Carbon::now();
            $updatedate = Carbon::now();
            $classroom = aulas::where('id',$id)->where('user_id',$user->id)->first();
            $assistance = asistencia.objects.filter(user=user,
                aulas=classroom, fechaRegistro=registrationdate).distinct();

            if (assistance.exists() == False):
                for key, value in data.get('data').items():
                    objectstudent = alumnos.objects.get(idAlumno=key)
                    asistencia.objects.create(user=user,
                        fechaRegistro=registrationdate, fechaActualizacion=updatedate, estado=value, alumno=objectstudent, aulas=classroom, area=areas)
                return JsonResponse({'response': 'success'})

            else:
                return JsonResponse({'response': 'existe'})

        else:
            return JsonResponse({'response': 'error'})

    except Exception as ex:
        print(ex)
        return JsonResponse({'response': 'error'})

}
