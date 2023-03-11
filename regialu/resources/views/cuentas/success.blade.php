@extends('base') 


@section('contenido')
<div class="card">

  <form action="" id="serv">
    @csrf
    <div class="card-body">
      <div class="card-body">
        <div class="container-fluid" id="div-respuesta"
          style="width: 100%;background-color: blueviolet;color: white;align-items: center;align-content: center;text-align: center;padding: 15px;">
          <h3 class="text" style="text-align: center;" id="titulo">Esperando Respuesta del Servidor...</h3>
          <h5> <span class="text">{{$fecha}}</span></h5>
          <table class="table" style="color: white;" id="detalles">
            <tr>
            
              
              <td>
                <img src="{{asset('imagenes/licencia.png')}}" alt="" srcset="">
              </td>
            </tr>
            <tr>
              <td id="Payment-id"></td>
            </tr>
            <tr>
              <td id="payer-id"></td>
            </tr>
            <tr>
              <td id="token-id"></td>
            </tr>

          </table>
        </div>

        <div class="card">
          <img src="{{asset('imagenes/pay.png')}}" class="card-img-top" alt="...">

        </div>
      </div>
    </div>
  </form>
</div>
@endsection
@section('javascript')
<script src="{{asset('server.js')}}"></script>
@endsection