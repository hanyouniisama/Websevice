<?php

//Script PHP para insertar un animal en la base de datos
//Recibe id de la especie (idespecie), id estatus del animal (idstatususuario), nombre del animal (nombre),
// fecha de ingreso del animal (fecha), comentario de ingreso (comentario)
//Imprime en Formato Json
//  Estatus 0: Operacion Incorrecta 1: Operacion Correcta
//  Mensaje : Justifica el Estatus


$mensaje = array();
//Se inicializa Bandera de Error
$error = TRUE;
//Comprueba si el Script es llamado por un Metodo POST
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//Se incluye la Clase para Validar Datos
    require_once "../utilidades/Validaciones.php";
//Se comprueba si las Variables estan definidas, caso contrario se asigna NULL
    $idespecie = isset($_POST["idespecie"]) ? Validar::filtrar_texto($_POST["idespecie"]) : NULL;
    $idstatususuario = isset($_POST["idstatususuario"]) ? Validar::filtrar_texto($_POST["idstatususuario"]) : NULL;
    $nombre = isset($_POST["nombre"]) ? Validar::filtrar_texto($_POST["nombre"]) : NULL;
    $fecha = isset($_POST["fecha"]) ? Validar::filtrar_texto($_POST["fecha"]) : NULL;
    $comentario = isset($_POST["comentario"]) ? : NULL;

   // if (!is_null($idespecie) && !is_null($idestatususuario) && !is_null($nombre) && !is_null($fecha)&& !is_null($comentario)) {

     //   if (!Validar::esta_vacio($idespecie) && !Validar::esta_vacio($idestatususuario) && !Validar::esta_vacio($nombre) && !Validar::esta_vacio($fecha) && !Validar::esta_vacio($comentario)) {
//Clase con los metodos Genericos para el CRUB
            require_once '../modelo/Crud.php';
//Se instancia un objeto de tipo CRUB
            $modelo = new Crud();
//Se inicializan los atributos para el Insert            
            //Tabla a la que se le van a insertar los datos
            $modelo->setInserInto("animal");
            //Columna a la que se le insertaran los datos
            $modelo->setInsertColumns("idespecie,idstatususuario,nombre,fecha,comentario");
            //Valores que se le insertaran a la colummna
             $modelo->setInsertValues("'1','1','pancho','2015-4-6','lalalala'");
           // $modelo->setInsertValues("'$idespecie','$idestatususuario','$nombre','$fecha','$comentario'");

            if ($modelo->Create()) {
                $error = FALSE;
            }
  //      }
  //  }
//}

//Si existe un error el estatus es 0
if ($error) {
    $mensaje["estatus"] = 0;
    $mensaje["mensaje"] = "Ocurrio un error al Insertar el Usuario";
} else {
//Caso contrario es 1    
    $mensaje["estatus"] = 1;
    $mensaje["mensaje"] = "Usuario Insertado con Exito";
}
//Se usa la funcion json_encode para obtener el formato json del array
echo json_encode($mensaje);
