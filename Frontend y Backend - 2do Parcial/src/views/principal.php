

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- bootstrap 4 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">-->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="css/estilos.css">

    <script type="text/javascript" src="{{ base_path() }}/principal.js"></script>

    <title>Principal</title>
    
</head>
<body style="height:1500px">

  <div class="container-fluid" style="margin-top:30px">
  
      <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle text-primary" id="navbardrop" data-toggle="dropdown" aria-expanded = "false">
                          Listados 
                          <b class="caret"></b>
                      </a>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" onclick = "TablaPrincipal()">Usuarios</a>
                          <a class="dropdown-item" onclick = "TablaAutos()">Autos</a>
                      </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link  text-primary" onclick = "AltaModificarAuto(0)">Alta Autos</a>
                  </li>
              </ul>
          </div>
      </nav>
      <div class="alert alert-danger" id = "idError" style="display: none;top:60px"></div>
      <div class="alert alert-warning" id = "idErrorBorrarAuto" style="display: none;top:60px"></div>
      </div>
        <div class="jumbotron jumbotron">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6" style="background-color:#e03444">
                <div class="table-responsive">

                <div id = "Autos" style="display: block;">IZQUIERDA</div>
                
                <div id = "AltaAuto" style="display: none;">
                
                <div class="container" >
                    <div class="abs-center" >
                    <form action="#" class="p-4 form" style="width: 50%;">

                            <div class="border p-5 form" style="background-color:darkcyan;">
                            <div class="form-group" >
                                <div class="input-group form-group">
                                    <span class="input-group-text"><i class=" fas fa-trademark"></i></span>
                                    <input type="text" class="form-control" placeholder="Marca" id="idMarca">
                                </div>
                            </div>
                            <div class="form-group" >
                                <div class="input-group form-group">
                                    <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                    <input type="text" class="form-control" placeholder="Color" id="idColor">
                                </div>
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text"><i class="fas fa-car"></i></span>
                                <input type="text" class="form-control" placeholder="Modelo" id="idModelo">
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                <input type="text" class="form-control" placeholder="Precio" id="idPrecio">
                            </div>
                            <div class="form-group">
                                <div class="input-group form-group">
                                <input type="text" class="form-control" style="display: none;" id="idAuxAuto">
                                <button type="button" class="btn btn-success m-2" id = "btnAgregar"style="display: none;" onclick="AltaAuto()"style="width: 90px">Agregar</button>
                                <button type="button" class="btn btn-success m-2" id = "btnModificar" style="display: none;" onclick="ModificarAuto()"style="width: 90px">Modificar</button>
                                <button type="reset" class="btn btn-warning m-2 " style="width: 90px">Limpiar</button>
                                </div>

                            </div>
                        </div>
                    </form>
                    </div>
                 </div>

                </div>
        </div>
            </div>
                <div class="col-sm-6" style="background-color:#30a444">
                <div class="table-responsive">
                <table class="table" id = "idTabla"><th>DERECHA</th></table>
                </div>                
            </div>  
        </div>    
       </div> 
  </div>
</body>
</html>