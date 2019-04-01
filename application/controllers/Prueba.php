<?php
//Extendemos del controlador padre
class Prueba extends CI_Controller{


    public function __construct(){
        //llamamos al constructor de la clase padre
        parent::__construct();

        //llamo al helper url
        $this->load->helper("url");

    }

    public function prueba(){
        $this->load->view('prueba.html');
    }



}





?>