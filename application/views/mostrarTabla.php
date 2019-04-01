<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>



    <title>CRUD Alumnos</title>
</head>
<body>
<div class="container mt-5 " >
  <h2 style="text-align:center">Este es un CRUD realizado con Codeigniter, Jquery y Ajax</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#myModal">
   Agregar Usuario
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title " >Agregar Nuevo Usuario </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          <form id="ps">
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
          <label for="">Password:</label>
          <input type="password" name="password" id="password" class="form-control">
          <label for="enail">Email</label>
           <input type="email" id="email" class="form-control">
           </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="agregar()" data-dismiss="modal" id="agregar">Agregar</button>
        </div>
        
      </div>
    </div>
  </div>  


 <!-- The Modal 2 -->
 <div class="modal" id="modalEditar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title " >Agregar Nuevo Usuario </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          <form id="form2">
          <input type="hidden" id="idEditar" name="idEditar">
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombreEditar" id="nombreEditar" class="form-control">
          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellidoEditar" class="form-control">
          <label for="">Password:</label>
          <input type="password" name="password" id="passwordEditar" class="form-control">
          <label for="enail">Email</label>
           <input type="email" id="emailEditar" class="form-control">
           </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="editar()" data-dismiss="modal" id="agregar">Agregar</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- esto es el fin del modal -->


<!-- The Modal 3 -->
<div class="modal" id="modalEliminar">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header ">
          <h4 class="modal-title " >¿Seguro quiere eliminar el registro? </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" >
          <form id="form3">
          <input type="hidden"  id="idEliminar" name="idEditar">
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombreEliminar" id="nombreEliminar" disabled class="form-control">
          <label for="apellido">Apellido:</label>
          <input type="text" name="apellido" id="apellidoEliminar" disabled class="form-control">
         
           </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="eliminar()" data-dismiss="modal" id="agregar">Eliminar</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- esto es el fin del modal -->



  </div>





    <div class="container">
<table class="table table-bordered mt-3 ">
    <thead>
        <tr>
            <th>Id </th>
            <th>Nombre </th>
            <th>Apellido </th>
            <th>Password</th>
            <th>Email</th>
            <th>Acciones</th>
            
          
        </tr>
    </thead>

    <tbody id="mostrar">


    </tbody>
</table>
</div>

    <script>
    //Esto se carga al finalizar de cargar el html
    $(document).ready(procesarPeticion);

    

    function procesarPeticion() {

        //Vamos a utilizar ajax
        $.ajax({
            method:"Get",
            url:"http://localhost/CodeIgniter/index.php/UsuariosController/lista",
            success:ok,
            error:error
        }) //final de la peticion ajax
    } //Final de la funcion procesar

    //la funcion ok por defecto va ir a traer la respuesta de la peticion 
    function ok(respuesta){
        $('#mostrar').html("");
        respuesta.listado.forEach(element => {
           $('#mostrar').append('<tr>'+'<td>'+element.id_usuario+'</td>'+
                                    '<td>'+element.nombre+'</td>'+
                                    '<td>'+element.apellido+'</td>'+
                                    '<td>'+element.password+'</td>'+
                                    '<td>'+element.email+'</td>'+
                                    '<td>'
                                    +'<button type="button" class="btn btn-info" onclick="cargarDatosAlumno('+element.id_usuario+')" data-toggle="modal" data-target="#modalEditar">Modificar</button> | '
                                                   
                                     +'<button type="button" class="btn btn-danger" onclick="cargarDatos('+element.id_usuario+')" data-toggle="modal" data-target="#modalEliminar">Eliminar</button>'
                        
                                     +'</td>'
                                     +'</tr>');
        });

        // procesarPeticion();
    }

    function error(respuesta) {
        alert("Error en la peticon "+r);
    }

    function agregar(){
        
         //Vamos a utilizar ajax
                var email=$('#email').val();
                var nombre=$('#nombre').val();
                var apellido =$('#apellido').val();
                var password=$('#password').val();
                //alert();
         $.ajax({
            method:"Post",
            url:"http://localhost/CodeIgniter/index.php/UsuariosController/agregar",
            data:{
                email:email,
                nombre:nombre,
                apellido:apellido,
                password:password,
            },
            success:exito,
            error:error
        }) //final de la peticion ajax

    }
    function exito(respuesta){
        alert(respuesta);
        $('#ps')[0].reset();
        procesarPeticion();
    }



    function cargarDatosAlumno(id){

        $.ajax({
           method:"Post",
           url:"http://localhost/CodeIgniter/index.php/UsuariosController/buscarPorId",
           data:{
               id:id,
           },
           success:mostrarDatosAlumno,
           error:error
       }) //final de la peticion ajax
    }// fin de la funcion 


//Esta funcion carga los datos del alumno a editar en el modal para editar
    function mostrarDatosAlumno(r){
        let datos=r[0];

        $('#idEditar').val(datos.id_usuario);
        $('#nombreEditar').val(datos.nombre);
        $('#apellidoEditar').val(datos.apellido);
        $('#emailEditar').val(datos.email);
        $('#passwordEditar').val(datos.password);
    }

    function error(r) {
        console.log(r);    
    }


    //Funcion para mandar la peticion de modificar a la bd
    function editar(){

        var id=$('#idEditar').val();
        var email=$('#emailEditar').val();
        var nombre=$('#nombreEditar').val();
        var apellido =$('#apellidoEditar').val();
        var password=$('#passwordEditar').val();

         $.ajax({
            method:"Post",
            url:"http://localhost/CodeIgniter/index.php/UsuariosController/editar",
            data:{
                id_usuario:id,
                email:email,
                nombre:nombre,
                apellido:apellido,
                password:password,
            },
            success:exito,
            error:error
        }) //final de la peticion ajax


    }

    function exito(p) {
     alert(p);
    procesarPeticion();
        
    }


    //------------------------------TODO ESTO ES PARA ELIMINAR--------------------------------------------------



    function cargarDatos(id){

$.ajax({
   method:"Post",
   url:"http://localhost/CodeIgniter/index.php/UsuariosController/buscarPorId",
   data:{
       id:id,
   },
   success:mostrarDatos,
   error:error
}) //final de la peticion ajax
}// fin de la funcion 


//Esta funcion carga los datos del alumno a editar en el modal para editar
function mostrarDatos(r){
let datos=r[0];

$('#idEliminar').val(datos.id_usuario);
$('#nombreEliminar').val(datos.nombre);
$('#apellidoEliminar').val(datos.apellido);
}


//Funcion para mandar la peticion de modificar a la bd
function eliminar(){

var id=$('#idEliminar').val();
 $.ajax({
    method:"Post",
    url:"http://localhost/CodeIgniter/index.php/UsuariosController/eliminar",
    data:{
        id_usuario:id,  
    },
    success:exito,
    error:error
}) //final de la peticion ajax


}

function exito(pr) {
alert(pr);
procesarPeticion();

}



    </script>
    
</body>
</html>