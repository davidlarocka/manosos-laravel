<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mañosos Spa</title>
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  </head>
  <body>
    <div class="container mt-3">
      <h2>Registro de tareas | Mañosos Spa</h2>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#menu1">Ingresar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#menu2">Registrarse</a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class="container tab-pane active">
          <br>
          <h3>Todo list </h3>
          <p>Bienvenido al sistema de registro de tareas de mañosos spa. si ya tienes cuenta hacer click en Ingresar, sino Registrate.</p>
        </div>
        <div id="menu1" class="container tab-pane fade">
          <br>
          <form action="/send_login" class="form-inline" method="post"> 
            @csrf 
            <input class="form-control"type="text" name="user_id" id="user_id" placeholder="correo" />
            <br>
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
            <br>
            <input type="submit" class="btn btn-primary" value="Enviar" />
          </form>
        </div>
        <div id="menu2" class="container tab-pane fade">
          <br>
          <form action="/sign_in" class="form-inline" method="post"> 
            @csrf 
            <input class="form-control" type="text" name="user_id" id="user_id" placeholder="Nombre de usuario" />
            <br>
            <input class="form-control" type="text" name="correo" id="correo" placeholder="Correo" />
            <br>
            <input class="form-control"  type="password" name="password" id="password" placeholder="Password" />
            <br>
            <input type="submit" class="btn btn-success" value="Registrar" />
          </form>
        </div>
      </div>
    </div>
  </body>
</html>