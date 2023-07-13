function doUpdateTask (id){
    $("#input-update-nombre"+id).css("display", "none") 
    $("#btn-update"+id).css("display", "none")      
    $("#task_nombre_up").val($("#input-update-nombre"+id).val())  
    $("#form-update-task").submit()
}

function viewUpdateTask (id, status, nombre){
    $("#task_id").val(id)
    $("#task_status").val(0)
    $("#input-update-nombre"+id).css("display", "block") 
    $("#btn-update"+id).css("display", "block")      
}

function updateTask(id, status, nombre){
    $("#task_id").val(id)
    $("#task_status").val(status)
    $("#task_nombre_up").val(nombre)      
    $("#form-update-task").submit()
}

function deleteTask(id){
    $("#task_id").val(id) 
    $("#form-update-task").attr('action', "/delete_task").submit()
}