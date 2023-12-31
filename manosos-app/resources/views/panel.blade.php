<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mañosos Spa</title>
    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  </head>
  </head>
  <body>
    <div class="container mt-3">
      <h2>Tareas de {{$user_name}} @if($perfil == '1') | Administrador @endif | Mañosos Spa</h2>
      <br>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#home">@if($perfil == '2') Mis @endif tareas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#menu0">Tareas Completadas</a>
        </li>
        @if($perfil == '2')
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#menu1">Nueva tarea</a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link"href="{{ route('login') }}" class="">Salir</a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class="container tab-pane active">
          <br>
            <h3>Mis tareas pendientes</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tarea</th>
                    <th scope="col">acciones</th>
                    </tr>
                </thead>
                <tbody class="mis-tareas">
                </tbody>
            </table>
            <form action="/update_tasks" class="form-inline" method="post" id="form-update-task"> 
            @csrf 
                <input class="form-control"type="hidden" name="task_id" id="task_id" placeholder="Nombre de tarea" value="" />
                <input class="form-control"type="hidden" name="task_status" id="task_status" placeholder="Descripción" value="" />
                <input class="form-control"type="hidden" name="task_nombre_up" id="task_nombre_up" placeholder="Nombre de tarea" />
            </form>  
        </div>

        <div id="menu0" class="container tab-pane">
          <br>
          <h3>Completadas</h3>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody class="mis-tareas-Completadas">
            </tbody>
        </table>  
        </div>

        <div id="menu1" class="container tab-pane fade">
          <br>
          <form action="/add_task" class="form-inline" method="post"> 
            @csrf 
            <input class="form-control"type="text" name="task_nombre" id="task_nombre" placeholder="Nombre de tarea" />
            <br/>
            <input class="form-control"type="text" name="task_desc" id="task_desc" placeholder="Descripción" />
            <br/>
            <input type="submit" class="btn btn-success" value="Crear" />
          </form>
        </div>
      </div>
    </div>
    @if(request()->get('status'))
        <div class="alert alert-warning">
          {{ request()->get('status') }}
        </div>
    @endif
    <script src="/js/utils.js"></script>
    <script>
    @if($perfil == '1')
        $.get("/get_tasks_all", function(data, status){
            $.each(data, function(k, v) {
                $(".mis-tareas").append('<li class="list-group-item"><label class="form-check-label mi-tarea" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" >'+v.nombre+'</label> </li>')            
            });      
        });
        $.get("/get_tasks_closed_all", function(data, status){
            $.each(data, function(k, v) {
                $(".mis-tareas-Completadas").append('<li class="list-group-item"><label class="form-check-label mi-tarea" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" >'+v.nombre+'</label></li>')            
            });      
        });
    @else  
        $.get("/get_tasks", function(data, status){
            $.each(data, function(k, v) {
                $(".mis-tareas").append('<tr><th scope="row">'+(k+1)+'</th><td><label class="form-check-label mi-tarea" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" >'+v.nombre+'</label>  </td><td>  <button class="btn btn-secondary btn-sm" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" onclick="updateTask('+v.id+', \'1\', \''+v.nombre+'\' )" >Finalizar</button> <button class="btn btn-primary btn-sm" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" onclick="viewUpdateTask('+v.id+', \'0\', \''+v.nombre+'\' )" > Editar </button>  <button class="btn btn-danger btn-sm" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'"  onclick="deleteTask('+v.id+')" >Eliminar</button> <input type="text" class="form-control" id="input-update-nombre'+v.id+'" style="display:none" /><button class="btn btn-primary" id="btn-update'+v.id+'" " style="display:none" onclick="doUpdateTask('+v.id+')" >Actualizar</button></td></th>')            
            });      
        });
        $.get("/get_tasks_closed", function(data, status){
            $.each(data, function(k, v) {
                $(".mis-tareas-Completadas").append('<tr><th scope="row">'+(k+1)+'</th><td><label class="form-check-label mi-tarea" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" >'+v.nombre+'</label> </td><td>   <button class="btn btn-primary btn-sm" for="firstCheckbox" data-id-tarea="'+v.id+'" data-status="'+v.status+'"  data-nombre="'+v.nombre+'"   data-descripcion="'+v.descripcion+'" onclick="updateTask('+v.id+', \'0\', \''+v.nombre+'\')" >reabrir</button></td></th>')            
            });      
        }); 
    @endif
    </script>    
  </body>
</html>