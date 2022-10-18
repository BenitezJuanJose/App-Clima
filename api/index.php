<?php

header('Acces-Controls-Allow-Origin:*');
header('Credentials:true');
header('Methods: PUT,POST,DELETE,GET');

define('URL_BASE','/alumno/3806/App-Clima/api/');

$request= explode('/',str_replace(URL_BASE,'',$_SERVER['REQUEST_URI']));
$request= array_filter($request);
$modelo='';



if(!count($request)){
    echo json_encode(array('en'=>404,'error'=>'falta modelo'));
}else{
    $modelo= ucfirst(strtolower($request[0]));

    if(!file_exists('../models/'.$modelo.'.php')){
        
        echo json_encode(array('en'=>404,'error'=>'no existe modelo'));

    }else{

        if(!isset($request[1])){

            echo json_encode(array('en'=>404,'error'=>'falta metodo'));

        }else{

            include '../models/'.$modelo.'.php';
            $metodo =$request[1];

            if(!method_exists(strtolower($modelo),$metodo)){

                echo json_encode(array('en'=>404,'error'=>'metodo inexistente en la clase'));
            
            }else{

                $obj= new $modelo;

                if(isset($request[2])){

                    $firstParam= $request[2];

                }
                if(empty($firstParam)){

                    $body= $obj->$metodo();

                }else{

                    if(isset($request[3])){
                        
                        $secondParam= $request[3];

                    }
                    if(empty($secondParam)){

                        $body= $obj->$metodo($firstParam);

                    }else{

                        $body= $obj->$metodo($firstParam,$secondParam);

                    }

                }

            }

        }


    }
}

echo json_encode($body)
   

?>