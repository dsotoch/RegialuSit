
<link rel="stylesheet" href="{{asset('melody/vendors/iconfonts/font-awesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}">
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

<div class="container-fluid" style="background-color: darkviolet;">
    <div class="row" style="padding-left: 40px;padding-right: 40px;">
        <div class="col-12" style="background-color: black;color: white;border-radius: 10px;padding: 10px;">
            <div class="float-sm-right"> <a class="btn btn-success btn-icon-text" href="{{route('customlogin')}}"><i class="fas fa-key btn-icon-prepend"></i> Iniciar Sesión</a>
                <a class="btn btn-info btn-icon-text"  href="{{route('register')}}"><i class="fas fa-edit btn-icon-prepend"></i> Registrarse</a>
            </div>
        </div>

        <div class="col-12">

            <div class="card" style="border: 1px solid darkviolet;border-radius: 10px;background-color: darkviolet;">
                <div class="card-body" style="background-color: darkviolet;border-radius: 10px;">
                    <img src="{{asset('imagenes/regialu.png')}}" alt="" class="card-img-top"
                        style="border-radius: 10px;">
                </div>
            </div>
        </div>
    </div>



    <footer class="footer">
        <div class="card" style="background-color: darkviolet;">
            <div class="card-body">
                <div class="d-sm-flex justify-content-center justify-content-sm-between"
                    style="background-color: black;color: white;border-radius: 10px;padding: 10px;">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                        Todos los Derechos Reservados.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Diego Soto Chavarria <i
                            class="far fa-heart text-danger"></i></span>
                </div>
            </div>
        </div>
    </footer>
</div>