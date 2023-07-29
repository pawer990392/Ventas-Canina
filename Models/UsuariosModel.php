<?php

class UsuariosModel extends Query
{
    private $newUsuario;
    private $newNombre;
    private $newPassword;
    private $newCorreo;
    private $newTelefono;
    private $newRol;

    public function __construct(){
      
        parent::__construct();

    }
    public function getUsuario(string $usuario,string $clave){

        $sql="SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$clave'";
        $data=$this->select($sql);
        return $data;

    }
    public function getUsuarios(){

        $sql="SELECT * FROM usuarios";
        $data=$this->selectAll($sql);
        return $data;

    }
    public function getRoles(){

        $sql="SELECT * FROM roles ";
        $data=$this->selectAll($sql);
        return $data;

    }
    public function registrarUsuario(string $newUsuario,string $newNombre,string $newPassword,string $newCorreo,string $newTelefono,int $newRol){

        $this->$newUsuario=$newUsuario;
        $this->$newNombre=$newNombre;
        $this->$newPassword=$newPassword;
        $this->$newCorreo=$newCorreo;
        $this->$newTelefono=$newTelefono;
        $this->$newRol=$newRol;
        $user=$this->$newUsuario;

        $verificar="SELECT * FROM usuarios WHERE usuario ='$user'";
        $existe=$this->select($verificar);

        if(empty($existe)){
            $sql="INSERT INTO usuarios(idRol,usuario,nombre,telefono,email,password) VALUES (?,?,?,?,?,?)";
            $dato=array($this->$newRol,$this->$newUsuario,$this->$newNombre,$this->$newTelefono,$this->$newCorreo, $this->$newPassword);
            $data=$this->save($sql,$dato);
            //print_r($data);
            if($data==1){
                $res="ok";
            }else{
                $res="error";
            }
        }else{
            $res="existe";
        }
        return $res;
    }
    public function editarUsuario(int $id){

        $sql="SELECT * FROM usuarios WHERE idusuarios=$id";
        $data=$this->select($sql);
        return $data;
    }
    public function modifcarUsuario(string $newUsuario,string $newNombre,string $newPassword,string $newCorreo,string $newTelefono,int $newRol, int $newId){

        $this->$newUsuario=$newUsuario;
        $this->$newNombre=$newNombre;
        $this->$newPassword=$newPassword;
        $this->$newCorreo=$newCorreo;
        $this->$newTelefono=$newTelefono;
        $this->$newRol=$newRol;
        $this->$newId=$newId;
        $user=$this->$newUsuario;
                                                                                    
            $sql="UPDATE usuarios SET idRol=?,usuario=?,nombre=?,telefono=?,email=?,password=? WHERE idusuarios=?";
            $dato=array($this->$newRol,$this->$newUsuario,$this->$newNombre,$this->$newTelefono,$this->$newCorreo, $this->$newPassword,$this->$newId);
            $data=$this->save($sql,$dato);
            
            //print_r($data);
            if($data==1){
                $res="modificado";
            }else{
                $res="error";
            }
        return $res;
    }

}
?>