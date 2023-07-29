<?php

class Usuarios extends Controller{

    public function __construct()
    {
        session_start();
        //carga el contructor de la instancia
        parent::__construct();
    }

public function index(){

    //print_r($this->model->getUsuario());
    $data['myroles']=$this->model->getRoles();
    $this->views->getView($this,"index",$data);
    


}
 public function validar(){

    if(empty($_POST["idUsuario"]) || empty($_POST["idPassword"])){
            $msg="LOS CAMPOS ESTAN VACIOS";
    }else{
        $usuario=$_POST["idUsuario"];
        $clave = $_POST["idPassword"];

        $data=$this->model->getUsuario($usuario,$clave);
        if ($data) {
            //crear la session
            $_SESSION["id_usuario"]=$data["idusuarios"];
            $_SESSION["usuario"]=$data["usuario"];
            $_SESSION["nombre"]=$data["nombre"];
            $msg= "ok";


        }else{
            $msg="Usuario o Contraseña Incorrecta";
        }
    }
    echo json_encode($msg,JSON_UNESCAPED_UNICODE);
    die();
 }
 public function listar(){

    $data=$this->model->getUsuarios();
    
    for ($i=0; $i <count($data) ; $i++) { 
        if ($data[$i]['estado']==1) {
            $data[$i]['estado']='<span class="badge badge-success">Activo</span>';
        }else{
            $data[$i]['estado']='<span class="badge badge-danger">Inactivo</span>';
        }
        # code...
        $data[$i]['acciones']='<div class="btn-group ml-2" role="group" ">
        <button type="button" class="btn btn-primary" onclick="btnEditarUser('.$data[$i]['idusuarios'].');">Editar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
        
      </div>';

    }
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    die();
 }
 public function registrar(){

        $newUsuario = $_POST["newUser"];
        $newNombre =  $_POST["newNombre"];                                             
        $newPassword =$_POST["newPassword"];                                              
        $newConfirmar=  $_POST["newConfirma"];                                            
        $newCorreo =  $_POST["newCorreo"];                                         
        $newTelefono =  $_POST["newTelefono"];                               
        $newRol =  $_POST["roles"];   
        $id =  $_POST["id"];   
        $hash=hash("SHA256",$newPassword);
        
        if(empty($newUsuario) || empty($newNombre) || empty($newPassword) || empty($newConfirmar) || empty($newCorreo) || empty($newTelefono) || empty($newRol)){
         $msg="Todos los campos son obligatorios";
        }else if($newPassword!=$newConfirmar){
            $msg="Las contraseña no coinciden";
        }else{
            if ($id=="") {

                $data=$this->model->registrarUsuario($newUsuario, $newNombre,$hash,$newCorreo,$newTelefono,$newRol);

                if ($data=="ok") {
  
                      $msg="si";
  
                }else if($data=="existe"){
                      $msg="El USUARIO ya existe";
                }else{
                  $msg="Error al registar al Usuario";
                }
            }else{
                $data=$this->model->modifcarUsuario($newUsuario, $newNombre,$hash,$newCorreo,$newTelefono,$newRol,$id);

                if ($data=="modificado") {
  
                      $msg="modificado";
  
                }else{
                  $msg="Error al Modificar al Usuario";
                }
                
            }
            
        }
        echo json_encode($msg,JSON_UNESCAPED_UNICODE);
        die();
 }

 function editar(int $id){
    
    $data=$this->model->editarUsuario($id);
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
    die();
 }

}


