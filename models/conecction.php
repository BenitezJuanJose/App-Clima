<?php
    include 'credentials.php';
  
    /* 
    Declaracion de una clase
    */
    class DataBase{
        /*conexion a la base de datos*/
        function connection(){
            $this->conn= new mysqli(HOST,USER,PASS,DB);
            /*verifica si hay un error*/
            if($this->conn->connect_errno){
                echo 'no';
            }
        }

        /*realiza una consulta*/
        function query($consulta){
            $this->connection();
            $response = $this->conn->query($consulta);
            if($this->conn->error){
                echo 'erro ->'.$this->conn->error;
            }else{
                return $response;
            }

        }
    }
?>