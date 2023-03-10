<!-- plugins:css -->
<link rel="stylesheet" href="{{asset( 'melody/vendors/iconfonts/font-awesome/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset( 'melody/vendors/css/vendor.bundle.base.css')}}">
<link rel="stylesheet" href="{{asset( 'melody/vendors/css/vendor.bundle.addons.css')}}">
<!-- endinject -->
<!-- plugin css for this page -->
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{asset( 'melody/css/style.css')}}">
<link rel="stylesheet" href="{{asset( 'login/register.css')}}">




<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">

            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow" style="background-color: white;">
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img src="{{asset( 'imagenes/logo.png')}}" alt="logo">
                            </div>
                            <h4>Nuevo Usuario?</h4>
                            <h6 class="font-weight-light">¡Únete a nosotros hoy! Solo toma unos pocos pasos</h6>
                            <form class="pt-3" id="miform">
                                @csrf
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Documento de Identidad</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-address-card
                                                text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control form-control-lg border-left-0" id="dni"
                                            placeholder="Documento de Identidad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nombres y Apellidos</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg border-left-0"
                                            id="nombres" placeholder="Nombres">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="far fa-envelope-open text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg border-left-0"
                                            id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pais</label>
                                    <select class="form-control form-control-lg" id="pais">
                                        <option value="AR">Argentina</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BR">Brasil</option>
                                        <option value="CL">Chile</option>
                                        <option value="CO">Colombia</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CU">Cuba</option>
                                        <option value="DO">República Dominicana</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="HT">Haití</option>
                                        <option value="HN">Honduras</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="MX">México</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="PA">Panamá</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Perú</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="OT">Otro</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0">
                                                <i class="fa fa-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0"
                                            id="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="mb-4" hidden>
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" id="check" checked>
                                            Acepto los Terminos & Condiciones
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        id="register">Registrarse</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    ¿Ya tienes una cuenta?<a href="{% url 'customlogin')}}"
                                        class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 register-half-bg d-flex flex-row">
                        <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy;
                            2023 Todos los Derechos Reservados.</p>
                    </div>
                </div>
            </div>
            
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
        <!-- Button trigger modal -->

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->

    <!-- endinject -->

    <script src="{{asset( 'melody/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset( 'melody/vendors/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset( 'melody/js/off-canvas.js')}}"></script>
    <script src="{{asset( 'melody/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset( 'melody/js/misc.js')}}"></script>
    <script src="{{asset( 'melody/js/settings.js')}}"></script>
    <script src="{{asset( 'melody/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset( 'melody/js/toastDemo.js')}}" type="module"></script>

    <script src="{{asset( 'login/register.js')}}" type="module"></script>
</body>