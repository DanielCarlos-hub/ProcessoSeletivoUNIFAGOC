<nav class="navbar navbar-expand-lg navbar-dark bg-primary p-1">
    <div class="max-width">
        <div class="row">
            <div class="col-md-3">
                <a class="navbar-brand" href="/admin/home">
                    <h3 class="font-weight-bold"><img src="{{ASSET}}images/logo.png" width="32px" height="32px" alt=""> SAMED</h3> 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col-md-9">
                <div class="collapse navbar-collapse pt-2" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li {% if page == 'home' %} class="nav-item active" {% else %} class="nav-item" {% endif %}>
                            <a class="nav-link" href="/admin/home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        
                        <li {% if page == 'users' %} class="nav-item active" {% else %} class="nav-item" {% endif %}>
                            <a class="nav-link" href="/admin/users/menu">Usuários</a>
                        </li>
                    </ul>
                    <a class="btn btn-sm btn-info" title="Sair" id="logout" href="http://localhost/logout">Sair</a>
                </div>
            </div>
        </div>
    </div>
</nav>
