<?php

include_once '../model/Login/LoginModel.php';

Class GstLogin{

    private $gstLogin;
 	
 	function __construct(){
 		$this->modelLogin = new LoginModel();
 	}

    public function consultarCorreo($correo) {
        
        $sql = " SELECT ruta_img, email FROM usuario WHERE email = '$correo' ";
        $datos = $this->modelLogin->consultarArray($sql);
        return $datos;
    }

    public function login($data) {
        //var_dump($data);
        @session_start();
        $correo = $data['correo'];
        $pass = $data['password'];
        
        $sql = " SELECT id,rol,nombre FROM usuario WHERE email = '$correo' and password = '$pass' ";
        $datos = $this->modelLogin->consultarArray($sql);
        
        if($datos){
            foreach( $datos as $dato){

                $_SESSION['Usuario']=$dato['nombre'];
                $_SESSION['rol']=$dato['rol'];
                $_SESSION['id']=$dato['id'];
            }
            
        }else{
            unset($_SESSION);
            session_destroy();
            
        }
        return $datos;
    }

}