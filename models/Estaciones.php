<?php
    include 'conecction.php';

    class Estaciones extends DataBase {
        /*devuelve la lista de todas las estaciones*/
        function list(){
            return $this->query("SELECT estaciones.chipid,estaciones.vistas,estaciones.ubicacion,estaciones.apodo,estaciones.fechaActual,tiempo.temperatura,tiempo.humedad,tiempo.viento FROM `estaciones` INNER JOIN tiempo ON (estaciones.chipid = tiempo.chipid )")->fetch_all(MYSQLI_ASSOC);
        }
        /*devuelve la estacion seleccionada*/
        function search($chipid){
            return $this->query("SELECT * FROM estaciones WHERE chipid='$chipid'")->fetch_all(MYSQLI_ASSOC)[0];
        }
        /*devuelve la informacion de la estacion seleccionada*/
        function dataStationClima($chipid,$limit){
            $query="SELECT * FROM tiempo WHERE chipid='$chipid' ORDER BY fecha desc LIMIT $limit";
            return $this->query($query)->fetch_all(MYSQLI_ASSOC);
        }
        /*devuelve la informacion de la estacion seleccionada con sus datos*/
        function dataStation($chipid){
            $query="SELECT estaciones.ubicacion,estaciones.apodo,estaciones.fechaActual,tiempo.temperatura,tiempo.humedad,tiempo.viento FROM `estaciones` INNER JOIN tiempo ON (estaciones.chipid LIKE $chipid AND tiempo.chipid = estaciones.chipid) LIMIT 1";
            return $this->query($query)->fetch_all(MYSQLI_ASSOC);
        }
        /*agrega una nueva estacion*/
        function newStation(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data= $_POST;
                $this->query("INSERT INTO `estaciones`(`chipid`, `ubicacion`, `apodo`) VALUES('".$datos['chipid']."','".$datos['ubicacion']."','".$datos['apodo']."')");
            }
        }

        /*agrega datos a una estacion*/
        function putData(){
            if($_SERVER['REQUEST_METHOD']!='POST'){
                echo json_encode(array('en'=>404,'error'=>'metodo no disponible'));
            }else{
                $data=$_POST;
                if(!$this->serch($data['chipid'])){
                    echo json_encode(array('en'=>404,'error'=>'chip ID no disponible'));
                }else{

                    $this->query("INSERT INTO `tiempo`(`chipid`, `temperatura`, `humedad`) VALUES('".$datos['chipid']."','".$datos['temperatura']."','".$datos['humedad']."')");
                    return $this->conn->insert_id;
                }
            }            
        }

    }
    
?>