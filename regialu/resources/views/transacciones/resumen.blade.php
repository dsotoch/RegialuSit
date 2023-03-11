<link rel="stylesheet" href="{{asset('melody/vendors/iconfonts/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<div class="card-body">
    <div class="container-fluid">
      <h3 class="text-right my-5">Mis Finanzas</h3>
      <hr>
    </div>
  
      
    <div class="container-fluid mt-5 d-flex justify-content-center ">
      <div class="table-responsive">
          <table class="table" >
            <thead>
              <tr class="bg-dark text-white">
                  <th>ID del pagador</th>
                  <th class="text-left">Costo</th>
                  <th class="text-left">Operación</th>
                  <th class="text-left">Fecha de Pago</th>
                  <th class="text-left">Total</th>
                </tr>
            </thead>
            <tbody>
               @foreach($data as $n)
              <tr class="text-left">
                <td class="text-left">{{$n->payer_id}}</td>
                <td>${{$n->monto}}</td>
                <td>{{$n->payment_id}}</td>
                <td>{{$n->fecha}}</td>
                <td>${{$n->monto}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
    <div class="container-fluid mt-5 w-100">      
      <h4 class="text-right mb-5">Total : ${{$total}}</h4>
      <hr>
    </div>
    <div class="container-fluid w-100">
     
    </div>
</div>