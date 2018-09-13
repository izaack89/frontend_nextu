<?php
function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );

}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );

}


function validarFormatos($valor,$tipo) {
    $respuesta=false;
    switch ($tipo){
        case'fecha':
            $tmp= str_replace("-", "", $valor);
            if(is_numeric($tmp)){
                $respuesta=true;
            }
            break;
        case'tiempo':
            $tmp= str_replace(":", "", $valor);
            if(is_numeric($tmp)){
                if($tmp!="000000"){
                    $respuesta=true;
                }
            }
            break;
    }
    return $respuesta;
}
