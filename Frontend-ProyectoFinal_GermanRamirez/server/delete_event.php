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
        $new_date= json_decode(json_encode($_POST['date_eliminar'], true));
        $resultado=$con->eliminarRegistro("eventos", " id= ".$new_date->id);
       
    } else {
        $response['msg'] = "Usuario Vacio";
    }
    echo json_encode($response);

 ?>
