<?php
    session_start();
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
    
        require('db/conector.php');
    if(isset($_SESSION['email'])){

        $con = new ConectorBD();
        $eventos=array();
        $response['conexion']=$con->initConexion("nextu_frontend");
        $it=0;
        $resultado=$con->consultar(["eventos"], ["id","titulo","fecha_inicio","fecha_final","tiempo_inicio","tiempo_final","allday"], " where created_by='".$_SESSION['email']."'");
        
        while($informacion_eventos=$resultado->fetch_array())
        {
            $start="";
            $end="";
            $allDay="";
            
            if(trim($informacion_eventos["tiempo_inicio"])==""){
                $start=$informacion_eventos["fecha_inicio"];
            }else{
                $start=$informacion_eventos["fecha_inicio"]."T".$informacion_eventos["tiempo_inicio"];
            }
            
            if(trim($informacion_eventos["tiempo_final"])==""){
                $end=$informacion_eventos["fecha_final"];
            }else{
                $end=$informacion_eventos["fecha_final"]."T".$informacion_eventos["tiempo_final"];
            }
            
            if($informacion_eventos["allday"]==0){
                $allDay=false;
            }else{
                $allDay=true;
            }
            
            $evento[]=array(
                "id"=>$informacion_eventos["id"],
                "title"=>$informacion_eventos["titulo"],
                "start"=>$start,
                "end"=>$end,
                "allDay"=>$allDay);
        }
        $eventos[]=$evento;
        $response["eventos"]=$evento;
        $response['msg']="OK";
        $response['usuario_nombre']=$_SESSION['nombre'];
        $response['debug']=$resultado;
    }else{
        $response['msg']="Usuario Vacio";
        
    }
  echo json_encode($response);
 ?>
