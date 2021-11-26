{% extends 'registro.html' %}

{% block content %}

<div class="container" >
        <div class="abs-center" >
          <form action="#" class="border p-4 form"  >
                <div class="form-group">
                    <h2 class="text-info">REGISTRO</h2>
                    <div class="alert alert-danger" id = "idError" style="display: none;"></div>
                </div>
                <div class="border p-4 form" style="background-color:lightgray;">
                <div class="form-group" >
                    <div class="input-group form-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" placeholder="Correo" id="txtCorreo">
                    </div>
                </div>
                <div class="input-group form-group" >
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Clave">
                </div>
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Nombre" id="txtNombre">
                </div>
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Apellido" id="txtApellido">
                </div>
                <div class="input-group form-group">
                        <span class="input-group-text"><i class="far fa-id-card"></i></span>
                    <div class="form-group"  style = "width:88.8%">
                        <select class="input-group form-control" id="sel1">
                          <option value="" disabled selected>Seleccionar Perfil</option>
                          <option value="encargado">Encargado</option>
                          <option value="propietario">Propietario</option>
                          <option value="empleado">Empleado</option>
                        </select>
                      </div>
                </div>
                <div class="input-group form-group">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                    <input type="file" class="form-control" id="foto">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="btnRegistrar" name="btnRegistrar" onclick="RegistrarUsuario()"style="width: 195px">Registrar</button>
                    <button type="reset" class="btn btn-warning" style="width: 195px">Limpiar</button>
                </div>
            </div>
          </form>
        </div>
    </div>
    

{% endblock %}