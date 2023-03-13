<style>
    #title {
        background-color: red;
        color: white;
        height: 50px;
        font-size: 45px;
        width: 100%;
    }

    #title tr th {
        width: 100%;
    }

    #cabecera {
        width: 100%;
        background-color: black;
        font-size: 14px;
        color: white;
        padding: 10px;
    }

    #cabecera tr th {
        width: 100% / 3;
    }

    #contenido thead tr {
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 5px;

    }

    #contenidonote thead tr {
        background-color: black;
        color: white;
        font-size: 15px;
        height: 30px;


    }

    #contenidonote {
        width: 100%;

    }

    #contenidonote tr {
        font-size: 12px;


    }

    #contenidonote td {
        text-align: center;
        width: 100% /2;

    }

    #contenido1 {
        width: 100%;
    }

    #contenido1 td {

        width: 50%;
    }
</style>

<body>
    <table id="title">
        <tr>
            <th>
                <center>Reporte de Asistencia </center>
            </th>

        </tr>
    </table>




    <div>
        <table id="cabecera">
            <tr>
                <th>Periodo : {{$periodo->descripcion}} </th>
                <th>Institucion : {{$institucions}}</th>
                <th>Fecha de Reporte : {{$fechas}}</th>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table id="contenido1">
            <thead>
                <tr>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                <tr>

                    <td>AREA : {{$areas}}</td>
                    <td>ALUMNO : {{$alumnoss}}</td>

                </tr>
                <tr><td>Numero De Asistencias : {{$numero_asistencias}}</td></tr>
                <tr><td>Asistencias : {{$asistencias}}</td></tr>
                <tr><td>Faltas : {{$faltas}}</td></tr>
                <tr><td>Tardanzas : {{$tardanzas}}</td></tr>

                <tr>
                    <td>Fecha de Inicio : {{$fecha_inicio}}</td>
                    <td>Fecha de fin : {{$fecha_fin}}</td>

                </tr>



            </tbody>
        </table>
        <br>
        <span>Mostrando Reporte de Asistencia de Rango de Fechas del Periodo </span>

    </div>
    <br>
    <table id="contenidonote">
        <thead>

            <th style="text-align: center;">Fecha</th>
            <th style="text-align: center;">Estado</th>

        </thead>
        <tbody>
            @foreach($asistances as $n)
            <tr>
                <td>{{$n['fecha']}}</td>
                <td>{{$n['estado']}}</td>

            </tr>


@endforeach
        </tbody>
    </table>

</body>