<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-1">
    <div class="max-width">
        <div class="row">
            <div class="col-md-3">
                <a class="navbar-brand" href="/paciente/home">
                    <h3 class="font-weight-bold"><img src="{{ASSET}}images/logo.png" width="32px" height="32px" alt=""> SAMED</h3> 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col-md-9">
                <div class="collapse navbar-collapse pt-2" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">Dropdown</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </li>
                    </ul>
                    <a class="btn btn-sm btn-info" title="Sair" id="logout" href="http://localhost/logout">Sair</a>
                </div>
            </div>
        </div>
    </div>
</nav>