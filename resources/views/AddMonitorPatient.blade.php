<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monitorizar utente</title>
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
                            <a class="nav-link active currentO" aria-current="page">
                                <span data-feather="monitor" class="align-text-bottom"></span>
                                Monitorizar Utente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/getM">
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
                        <h2 class="h2 text-center">Começar Monitorização</h2>
                    </div>

                    <form action="" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputPID" class="form-label">Identificador do Utente</label>
                                <select class="form-control" name="pID" id="inputPID" required>
                                    <option disabled selected value=null> Seleciona um utente </option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}">{{$patient->id}} - {{ $patient->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputBID" class="form-label">Identificador da Banda</label>
                                <select class="form-control" name="bID" id="inputBID" required>
                                    <option disabled selected value=null> Seleciona uma Banda </option>
                                    @foreach($bands as $band)
                                        <option value="{{ $band->id }}">{{$band->id}} - {{ $band->serial }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4  mb-2 text-center">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
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

                <hr>
                <section class="mt-2">
                    <div class="row mt-3 mb-3">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" id="btn1" onclick="setTables(1)" disabled>Monitorizações</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-success" id="btn2" onclick="setTables(2)">Utentes</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-outline-danger" id="btn3" onclick="setTables(3)">Bandas</button>
                        </div>
                    </div>
                    <div id="monitorTable">
                        @if($monitors->isEmpty())
                            <h2 class="text-center text-secondary textEmpty">Ainda não existem bandas ativas</h2>
                        @else
                            <h2>Doentes monitorizados</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Banda Nº</th>
                                        <th scope="col">Nome do Utente</th>
                                        <th scope="col">Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monitors as $monitor)
                                        <tr>
                                            <td>{{ $bands[$monitor->band_id - 1]['id'] }}</td>
                                            <td>{{ $patients[$monitor->patient_id - 1]['name'] }}</td>
                                            <td><a href="/getM?inputMNumber={{ $patients[$monitor->band_id -1]['id'] }}&queryR=1"><button type="submit" class="btn btn-warning">Ver</button></a></td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                    <div id="patientTable" hidden>
                        @if($patients->isEmpty())
                            <h2 class="text-center text-secondary textEmpty">Ainda não existem bandas ativas</h2>
                        @else
                            <h2>Utentes Registados</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Identificador do Utente</th>
                                        <th scope="col">Nome do Utente</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->id }}</td>
                                            <td>{{ $patient->name }}</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                    <div id="bandTable" hidden>
                        @if($bands->isEmpty())
                            <h2 class="text-center text-secondary textEmpty">Ainda não existem bandas ativas</h2>
                        @else
                            <h2>Bandas Registadas</h2>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Banda Nº</th>
                                        <th scope="col">Nº Série</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bands as $band)
                                        <tr>
                                            <td>{{ $band->id }}</td>
                                            <td>{{ $band->serial }}</td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </section>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{asset('js/addP.js')}}"></script>
    <script src="{{asset('js/tables.js')}}"></script>
</body>
</html>
