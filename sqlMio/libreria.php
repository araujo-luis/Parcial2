<?php

  $conexion = new mysqli();
function conectar(){
      global $conexion;
      $host = "localhost";
      $user ="root";
      $pass = "";
      $db = "nw201502";

      $conexion = new mysqli($host,$user,$pass,$db);

      if($conexion->errno){
        die($conexion->error);
      }
    }

  function desconectar(){
    global $conexion;
    $conexion->close();
  }

  function obtenerProductos($Descripcion, $Estado){
    conectar();
    global $conexion;

    $Descripcion = $conexion->real_escape_string($Descripcion)."%";
    $Estado = $conexion->real_escape_string($Estado);

    $query = "select * from productos where prdest='%s'".
              "and prddsc like '%s'; ";
    $query = sprintf($query,$Estado,$Descripcion);

    $productos = array();
    $cursorProductos = $conexion->query($query);

    if($cursorProductos){

      while($producto = $cursorProductos->fetch_assoc()){
          $productos[]=$producto;
      }
    }
    desconectar();
    return $productos;
  }
 ?>
