<?php
  require('db/conector.php');
  require('functions.php');

  $con = new ConectorBD();

  $response['conexion']=$con->initConexion("nextu_frontend");
  if($response['conexion']=='OK'){
    $data['usuario']=$_POST['username'];
    $data['pass']=encryptIt( $_POST['password']);
   
    $resultado=$con->consultar(["usuarios"], ["email","nombre"], " where email='".$data['usuario']."' and password= '".$data['pass']."'");
    $informacion=$resultado->fetch_assoc();
    
    if($informacion['email']!=""){
        $response['msg']="OK";
        session_start();
        $_SESSION['email']=$informacion['email'];
        $_SESSION['nombre']=$informacion['nombre'];
    }else{
        $response['msg']="Usuario y/o Password Incorrecto!!";
    }
    
  }else{
      $response['msg']='No se pudo conectar a la base datos';
  }
  $con->cerrarConexion();
  
  echo json_encode($response);
 ?>
