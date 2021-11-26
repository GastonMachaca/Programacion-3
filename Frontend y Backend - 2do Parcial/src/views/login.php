
{% extends 'login.html' %}

{% block content %}

            <div class="container">
                <div class="abs-center">
                  <form action="#" class="border p-4 form" style="background-color:lightpink;">
                        <div class="form-group">
                            <h2 style="color:#000080 ">LOGIN</h2>
                            <div class="alert alert-danger" id = "idError" style="display: none;"></div>
                        </div>
                        <div class="border p-5 form" style="background-color:lightgray;">
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" name="correo" id="idCorreo" placeholder="Correo">
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="password">Clave</label>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="idPassword" class="form-control" placeholder="Clave">
                        </div>
                        <div class="form-group">
                                <button type="button" class="btn btn-primary" id = "btnEnviar" name="btnEnviar" onclick="VerificarLogin()" style="width: 150px">Enviar</button>
                                <button type="reset" class="btn btn-warning" style="width: 150px">Limpiar</button>
                        </div>
                        <a href="http://SPP/front-end-registro#"><button type="button" class="btn btn-primary" style="width: 305px">Quiero Registrarme!</button></a>
                    </div>
                  </form>
                </div>
            </div>
            </div>
{% endblock %}

