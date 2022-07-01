<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Procurar utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/addP.css')}}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor"  content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="antialiased">
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#"><img src="{{asset('images/SafetrackLogo_White.png')}}" alt="Paris" class="center"></a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a href="{{ route('logout') }}" class="nav-link px-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Utentes</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/addU">
                                <span data-feather="user-plus" class="align-text-bottom"></span>
                                Adicionar Utente
                            </a>
                        </li>
                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Bandas</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/addB">
                                <span data-feather="watch" class="align-text-bottom"></span>
                                Adicionar Banda
                            </a>
                        </li>

                    </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                        <span>Monitorização</span>
                    </h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/addM">
                                <span data-feather="monitor" class="align-text-bottom"></span>
                                Monitorizar Utente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active currentO" aria-current="page">
                                <span data-feather="activity" class="align-text-bottom"></span>
                                Estado do Utente
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <section>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h2 class="h2 text-center">Pesquisar Utente</h2>
                    </div>

                    <form action="" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6 center">
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary dropdown-toggle" id="dropMonitor" type="button" data-bs-toggle="dropdown" aria-expanded="false">Identificador da Banda</button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" onclick="setSearch(1)">Identificador da Banda</a></li>
                                        <li><a class="dropdown-item" onclick="setSearch(2)">Identificador do utente</a></li>
                                    </ul>
                                    <select class="form-control" id="inputMNumber" name="inputMNumber" hidden required>
                                        <option disabled selected value="-1"> Seleciona um utente </option>
                                        @foreach($monitors as $monitorD)
                                            <option value="{{ $patients[$monitorD->patient_id - 1]['id'] }}">{{ $patients[$monitorD->patient_id - 1]['id'] }} - {{ $patients[$monitorD->patient_id - 1]['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-control" name="inputMNumber" id="inputBNumber" required>
                                        <option disabled selected value="-1"> Seleciona uma Banda </option>
                                        @foreach($monitors as $monitorD)
                                            <option value="{{ $bands[$monitorD->band_id - 1]['id'] }}">{{ $bands[$monitorD->band_id - 1]['id'] }} - {{ $bands[$monitorD->band_id - 1]['serial'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4  mb-2 text-center">
                            <input type="text" id="queryR" name="queryR" value="1" hidden>
                            <button type="submit" class="btn btn-primary">Procurar</button>
                        </div>

                    </form>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @elseif(session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                    @endif

                </section>

                <section class="mt-5">
                    @if($show == 0)

                    @else
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h2 class="h2 text-center">Ficha Utente</h2>
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" name="delM" value="{{$monitor->id}}">Terminar Monitorização</button>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Banda Nº:</b>
                            </div>
                            <div class="col-md-6">
                                <b>{{$band->id}}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Nome:</b>
                            </div>
                            <div class="col-md-6">
                                <b>{{$patient->name}}</b>
                            </div>
                        </div>
                    @endif
                </section>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('js/addP.js')}}"></script>
    <script src="{{asset('js/getMonitor.js')}}"></script>
</body>
</html>
