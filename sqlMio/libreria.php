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

  function obtenerProducto($codigo){
    conectar();
    global $conexion;


    $query = "select * from productos where prdcod='%d'";

    $query = sprintf($query,$codigo);

    $producto = array();
    $cursorProducto = $conexion->query($query);

    if($cursorProducto){
          $producto=$cursorProducto->fetch_assoc();
    }
    desconectar();
    return $producto;
  }

  function insertarProducto($prddsc,$ctgcod,$prdprc,$prdstk,$prdest){
    conectar();
    global $conexion;


    $query = "insert into productos values(NULL,'%s',%d,%d,%d,'%s','NULL')";

    $query = sprintf($query,$prddsc,$ctgcod,$prdprc,$prdstk,$prdest);

    if($conexion->query($query)){
      echo "CHEQUE";
    }
    else {
      echo $conexion->error;
    }


    desconectar();

  }

  function actualizarProducto($prdcod,$prddsc,$ctgcod,$prdprc,$prdstk,$prdest){
    conectar();
    global $conexion;


    $query = "update productos set  prddsc='%s', ctgcod=%d, prdprc=%d, prdstk=%d, prdest='%s'".
              "where prdcod=%d";

    $query = sprintf($query,$prddsc,$ctgcod,$prdprc,$prdstk,$prdest,$prdcod);

    if($conexion->query($query)){
      echo "CHEQUE";
    }
    else {
      echo $conexion->error;
    }


    desconectar();

  }

  function eliminarProducto($prdcod){
    conectar();
    global $conexion;


    $query = "delete from productos where prdcod=%d";

    $query = sprintf($query,$prdcod);

    if($conexion->query($query)){
      return true;
    }
    else {
      return false;
    }


    desconectar();

  }
 ?>
