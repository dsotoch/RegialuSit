

<!DOCTYPE html>
<html lang="es">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Regialu Admin</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset( 'melody/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset( 'melody/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset( 'melody/vendors/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset( 'melody/css/style.css')}}"> @yield('stilos') 
    <!-- endinject -->
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo" href="{% url 'indexDashboard')}}"><img src="{{asset( 'imagenes/logo1.png')}}" alt="logo"/></a>
              <a class="navbar-brand brand-logo-mini" href="{% url 'indexDashboard')}}"><img src="{{asset( 'imagenes/logo1.png')}}" alt="logo"/></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="fas fa-bars"></span>
              </button>
              <ul class="navbar-nav navbar-nav-right">
      
      
                 
      
                  <li class="nav-item nav-profile dropdown">
                      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                          <img src="{{asset( 'imagenes/use.png')}}" title="Mi Perfil" />
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                          aria-labelledby="profileDropdown">
                          <button class="dropdown-item" id="cuenta">
                              <i class="fas fa-cog text-primary"></i> Mi Cuenta </button>
                          </a>
                          <div class="dropdown-divider"></div>
                          <button class="dropdown-item" id="logout">
                              <i class="fas fa-power-off text-primary"></i> Cerrar Sesion</button>
                          </a>
                      </div>
                  </li>
      
              </ul>
              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="fas fa-bars"></span>
              </button>
            </div>
          </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->


            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav" id="opciones" >
                    <li class="nav-item nav-profile">
                        <div class="nav-link">
                            <div class="profile-image">
                                <img  src="{{asset( 'imagenes/use.png')}}" title="Perfil" />
                            </div>
                            <div class="profile-name">
                                <p class="name" id="name-user">
                                    
                                </p>
                                <p class="designation" id="tipo-user">
                                    Super Admin
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{% url  'indexDashboard' )}}">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                            <label for="" id="dni-user" hidden>{{$user->dni}}</label>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('indexGestion')}}">
                            <i class="fa fa-cubes menu-icon"></i>
                            <span class="menu-title">Gestiones</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index_periodo')}}">
                            <i class="fa fa-calendar menu-icon"></i>
                            <span class="menu-title">Periodos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{  route('index_instituciones')}}">
                            <i class="fa fa-building menu-icon"></i>
                            <span class="menu-title">Instituciones</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index_aulas')}}">
                            <i class="fa fa-home menu-icon"></i>
                            <span class="menu-title">Aulas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index_areas')}}">
                            <i class="fa fa-book menu-icon"></i>
                            <span class="menu-title">Areas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index_horario')}}">
                            <i class="fa fa-table menu-icon"></i>
                            <span class="menu-title">Horarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('indexAlumnos')}}">
                            <i class="fa fa-graduation-cap menu-icon"></i>
                            <span class="menu-title">Alumnos</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link collapsed" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                          <i class="far fa-compass menu-icon"></i>
                          <span class="menu-title">Documentos</span>
                          <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic" style="background-color: red;color: white;font-weight: bold;">
                          <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="../ui-features/accordions.html" title="Click para Descargar Funcionamiento del Software ">Funcionamiento</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{asset( 'documentos/FormatoRegialu.xlsx')}}" title="Click para Descargar formato para subir alumnos ">Formato Excel</a></li>
                           
                          </ul>
                          </div>
                      </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                @yield('contenido')

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023.
                            Todos los Derechos Reservados.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Diego Soto Chavarria <i
                                class="far fa-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
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
    <script src="{{asset( 'melody/js/dashboard.js')}}"></script>
    <script src="{{asset( 'login/register.js')}}" type="module"></script>

    @yield('javascript')
    <!-- End custom js for this page-->
</body>


</html>