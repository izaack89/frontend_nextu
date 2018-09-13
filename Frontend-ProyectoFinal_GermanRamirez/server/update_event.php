<?php
    session_start();

    require('db/conector.php');
    require('functions.php');
    if (isset($_SESSION['email'])) {

        $con = new ConectorBD();
        $response['conexion']=$con->initConexion("nextu_frontend");
        $columns_to_update=array();
        $response['msg']="OK";
        $response['usuario_nombre']=$_SESSION['nombre'];
//      Obtengo los valores enviados por medio del ajax
        $new_date= json_decode(json_encode($_POST['new_date'], true));
        
        if(validarFormatos($new_date->start_date,"fecha")){
           $columns_to_update["fecha_inicio"]=$new_date->start_date;
        }
        
        if(validarFormatos($new_date->end_date,"fecha")){
           $columns_to_update["fecha_final"]=$new_date->end_date;
        }
        
        if(validarFormatos($new_date->start_hour,"tiempo")){
           $columns_to_update["tiempo_inicio"]=$new_date->start_hour;
        }
        
        if(validarFormatos($new_date->end_hour,"tiempo")){
           $columns_to_update["tiempo_final"]=$new_date->end_hour;
        }
        
        $columns_to_update["created_by"]=$_SESSION['email'];
        $resultado=$con->actualizarRegistro("eventos", $columns_to_update, " id= ".$new_date->id);
        $response['debug'] = $resultado;
       
    } else {
        $response['msg'] = "Usuario Vacio";
    }
    echo json_encode($response);
?>
