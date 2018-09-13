<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require('functions.php');
    require('db/conector.php');
    $con = new ConectorBD();
    $con->initConexion("nextu_frontend");
    $fecha_nacimiento=array('1990-02-01',"1980-09-08","1999-08-12");
    $pass=array('mexico2018',"cdmx1989","gustavo90");
    $nombre=array('German Lopez',"Jorge Castellanos","Laura Ortiz");
    for($i=0;$i<3;$i++){
        $columns_to_update["email"]="test$i@test$i.com";
        $columns_to_update["nombre"]=$nombre[$i];
        $columns_to_update["password"]=encryptIt( $pass[$i]);
        $columns_to_update["fecha_nacimiento"]=$fecha_nacimiento[$i];
        $resultado=$con->insertData("usuarios", $columns_to_update);
    }

echo "Usuarios Creados, redireccionado en 3 segundos";

sleep(3);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$actual_link= str_replace("server/create_user.php", "client/index.html", $actual_link);
header("Location: $actual_link");

 ?>
