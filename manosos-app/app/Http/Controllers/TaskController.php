<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->delete_old_tasks();
    }

    private function is_admin(){
        session()->regenerate();
        if(Session::get('perfil') == 1){
            return true;
        }else{
            return false;
        }
    }

    public function add_task(Request $request)
    {

        $task = new Task;
        $tarea = $task::where('nombre', '=', $request->input('task_nombre'))->first();    
        //validar que no exista
        if($tarea != null){
            return redirect()->route('profile', ["status" => "tarea ya existe"]);
        }
        $task->nombre = $request->input('task_nombre');
        $task->descripcion = $request->input('task_desc');
        $task->status = 0;
        $task->id_usuario = Session::get('user_id');
        $task->save();
        return redirect()->route('profile', ["status" => "tarea registrado ok"]);
        
    }

    public function get_tasks_all(Request $request)
    {

        if(!$this->is_admin()){
            return response()->json(["msg" => "acceso denegado"]);
        }

        $task = new Task;
        $tasks = $task::where('status', '=', 0)->get();    

        if($tasks == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   

        return response()->json($tasks);
    }

    public function get_tasks(Request $request)
    {
        $task = new Task;
        $tasks = $task::where('id_usuario', '=', Session::get('user_id'))
                      ->where('status', '=', 0)->get();    

        if($tasks == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   
        return response()->json($tasks);
    }
    
    public function get_tasks_closed_all(Request $request)
    {
        if(!$this->is_admin()){
            return response()->json(["msg" => "acceso denegado"]);
        }

        $task = new Task;
        $tasks = $task::where('status', '=', 1)->get();    

        if($tasks == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   
        
        return response()->json($tasks);  
    }
    
    public function get_tasks_closed(Request $request)
    {
        $task = new Task;
        $tasks = $task::where('id_usuario', '=', Session::get('user_id'))
                      ->where('status', '=', 1)->get();    

        if($tasks == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   
        
        return response()->json($tasks);  
    }

    public function update_tasks(Request $request)
    {
        $task = new Task;
        $myTask = $task::find($request->input('task_id')); 
        
        if($myTask == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   
        
        $myTask->status = $request->input('task_status');

        if($request->input('task_nombre_up') !==  null){
            $myTask->nombre = $request->input('task_nombre_up');
        }

        $myTask->save();
        return redirect()->route('profile', ["status" => "tarea actualizada"]);
        
    }

    public function delete_task(Request $request)
    {
        $task = new Task;
        $myTask = $task::find($request->input('task_id')); 
        
        if($myTask == null){
            return redirect()->route('profile', ["status" => "no hay tareas"]);
        }   
        
        $myTask->delete();
        return redirect()->route('profile', ["status" => "tarea eliminada"]);
        
    }

    //borrar tareas completadas con más de 7 dias
    private function delete_old_tasks(){

        $current_day = date('Y-m-d');
        $days_ago = date('Y-m-d', strtotime('-7 days', strtotime($current_day)));
        $task = new Task;
        $tasks = $task::where('status', '=', 1)
                      ->where('created_at', '<=', $days_ago)->delete();    
    
        return;

    }

}