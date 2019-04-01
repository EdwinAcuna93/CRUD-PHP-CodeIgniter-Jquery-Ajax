<?php
//Extendemos del controlador padre
class UsuariosController extends CI_Controller{

    public function __construct(){
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

        //incluyo al modelo de la clase usuarios
        $this->load->model("UsuariosModel");
    }



 //Controlador para listar todos los usuarios
 public function lista(){
    //Array asociativo con la llamada al metodo del modelo
    $usuarios['listado']=$this->UsuariosModel->ver();
    
    $this->output->set_header('Content-Type: application/json; charset=utf-8');
    //Cargo la vista y le paso los parametros
    echo json_encode( $usuarios );
}


//Metodo para listar los datos de un solo usuario
public function buscarPorId(){
    $id = $this->input->post('id');
    $usuario = $this->UsuariosModel->buscarId($id);
    $this->output->set_header('Content-Type: application/json; charset=utf-8');
    echo json_encode($usuario);
}






    public function agregar(){
        //Mandamos los datos que estan el input text del formulario  al metodo del controlador  agregar
       $add = $this->UsuariosModel->agregar(
           $this->input->post("email"),
           $this->input->post("password"),
           $this->input->post("nombre"),
           $this->input->post("apellido")
       );

       if ($add==true) {
           $mensaje="Registro agregado con exito";
       } else {
         $mensaje="Fallo al guardar el registro";
       }
    // $mensaje="Estas llegando";
       echo json_encode($mensaje);
    }




    public function editar(){
       
        $mod=$this->UsuariosModel->modificar(
            $this->input->post("id_usuario"),
            $this->input->post("email"),
            $this->input->post("password"),
            $this->input->post("nombre"),
            $this->input->post("apellido")
            );
            if ($mod==true) {
                $mensaje="Registro modificado con exito";
            } else {
              $mensaje="Fallo al modificar el registro";
            }
      
            echo json_encode($mensaje);
    }

    public function mandarEliminar(){
        $this->load->view('eliminar_usuarios');
    }



    public function eliminar(){
        $id_usuario= $this->input->post("id_usuario");
        $eliminar=$this->UsuariosModel->eliminar($id_usuario);
        if ($eliminar==true) {
            $mensaje="Registro eliminado con exito";
        } else {
          $mensaje="Fallo al eliminar el registro";
        }
  
        echo json_encode($mensaje);
    }
 
    //funcion para mandar a llamar la vista de mostrarTabla
    public function mandarPrueba(){
        $this->load->view('mostrarTabla');
    }


}



















?>