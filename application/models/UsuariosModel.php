<?php
//Extendemos del modelo por defecto de codeigniter

class UsuariosModel extends CI_Model{

    //Creamos el constructor del modelo
    public function __construct(){
        //Llamo al constructor de la clase padre
        parent::__construct();

        //cargamos la bd
        $this->load->database();
    }


    public function ver(){
        //Hacemos la consulta a la bd
        $consulta=$this->db->query("SELECT * FROM usuarios");

        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }

    //Este metodo es para consultar un unico registro de la bd
    public function buscarId($id){
        //Hacemos la consulta a la bd
        $consulta=$this->db->query("SELECT * FROM usuarios WHERE id_usuario=$id ");
        //Devolvemos el resultado de la consulta
        return $consulta->result();
    }


    
    public function agregar($email,$password,$nombre,$apellido){
        //Creamos la consulta para que se ejecute en la bd
        $consulta=$this->db->query("INSERT INTO usuarios VALUES ('null','$email','$password','$nombre','$apellido');");
       
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }

    public function modificar($id_usuario,$email,$password,$nombre,$apellido){
        $consulta=$this->db->query("UPDATE usuarios SET email='$email',password='$password',nombre='$nombre',apellido='$apellido' WHERE id_usuario=$id_usuario;");
       
        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }


    public function eliminar($id_usuario){
        $consulta=$this->db->query("DELETE FROM usuarios WHERE id_usuario=$id_usuario");

        if($consulta==true){
            return true;
        }else{
            return false;
        }
    }


}


?>