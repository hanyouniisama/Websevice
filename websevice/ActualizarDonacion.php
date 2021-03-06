<?php


//Script PHP para actualizar una donacion en la base de datos
//Recibe idanimal (idanimal), id del veterinario (idveterinario), id pasante (idpasante), Fecha, observaciones
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
    $idusuario = isset($_POST["idusuario"]) ? Validar::filtrar_texto($_POST["idusuario"]) : NULL;
    $idestatusdonacion = isset($_POST["idestatusdonacion"]) ? Validar::filtrar_texto($_POST["idestatusdonacion"]) : NULL;
    $fecha = isset($_POST["fecha"]) ? Validar::filtrar_texto($_POST["fecha"]) : NULL;    
    $referencia = isset($_POST["referencia"]) ? Validar::filtrar_texto($_POST["referencia"]) : NULL;
    $monto = isset($_POST["monto"]) ? Validar::filtrar_texto($_POST["monto"]) : NULL;
    //$idanimal=1;
    if (!is_null($idusuario) && !is_null($idestatusdonacion) && !is_null($fecha) && !is_null($referencia) && !is_null($monto)) {

        if (!Validar::esta_vacio($idusuario) && !Validar::esta_vacio($idestatusdonacion) && !Validar::esta_vacio($fecha) 
                && !Validar::esta_vacio($referencia) && !Validar::esta_vacio($monto)) {
//Clase con los metodos Genericos para el CRUB
            require_once '../modelo/Crud.php';
//Se instancia un objeto de tipo CRUB
            $modelo = new Crud();
//Se inicializan los atributos para el Insert            
            //Tabla a la que se le van a insertar los datos
            $modelo->setUpdate("donacion");
            //Columna a la que se le insertaran los datos
            $modelo->set("idusuario='$idsuario',idestatusdonacion='$idestatusdonacion',fecha='$fecha',referencia='$referencia',monto='$monto'");
            
            $modelo->setCondition("iddonacion=$iddonacion");

            if ($modelo->Update()) {
                $error = FALSE;
            }
        }
   }
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
