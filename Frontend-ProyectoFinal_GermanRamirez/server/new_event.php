<?php
    session_start();

    require('db/conector.php');
    if (isset($_SESSION['email'])) {

        $con = new ConectorBD();
        $response['conexion']=$con->initConexion("nextu_frontend");
        $columns_to_update=array();
        $response['msg']="OK";
        $response['usuario_nombre']=$_SESSION['nombre'];
//      Obtengo los valores enviados por medio del ajax
        $new_date= json_decode(json_encode($_POST['new_date'], true));
        
        if($new_date->allDay=="true"){
            $columns_to_update["titulo"]=$new_date->titulo;
            $columns_to_update["fecha_inicio"]=$new_date->start_date;
            $columns_to_update["created_by"]=$_SESSION['email'];
            $columns_to_update["allday"]="1";
        }else{
            $columns_to_update["titulo"]=$new_date->titulo;
            $columns_to_update["fecha_inicio"]=$new_date->start_date;
            $columns_to_update["fecha_final"]=$new_date->end_date;
            $columns_to_update["tiempo_inicio"]=$new_date->start_hour;
            $columns_to_update["tiempo_final"]=$new_date->end_hour;
            $columns_to_update["created_by"]=$_SESSION['email'];
            $columns_to_update["allday"]="0";
        }
        $resultado=$con->insertData("eventos", $columns_to_update);
        
       
    } else {
        $response['msg'] = "Usuario Vacio";
    }
    echo json_encode($response);
?>
