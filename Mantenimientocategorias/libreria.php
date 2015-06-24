<?php

  $conexion = new mysqli();

  $host ="localhost";
  $user = "root";
  $pass= "";
  $db="nw201502";

  $conexion->connect($host,$user,$pass,$db);

  if($conexion->errno){
    echo ($conexion->error);

  }

function getCategorias($descripcion, $estado){
  global $conexion;

  $descripcion= "%". $conexion->real_escape_string($descripcion)."%";
  $estado= $conexion->real_escape_string($estado);

  $query = "select * from categorias where ctgdsc like '%s' and ctgest='%s'";

  $query= sprintf($query,$descripcion,$estado);

  $cursor= $conexion->query($query);

  $categorias=array();
  if($cursor){
    while($categoria= $cursor->fetch_assoc()){
      $categorias[]= $categoria;
    }
  }
  return $categorias;
}


function getCategoria($codigo){
  global $conexion;

  $descripcion= "%". $conexion->real_escape_string($codigo)."%";


  $query = "select * from categorias where ctgcod='%s'";

  $query= sprintf($query,$codigo);

  $cursor= $conexion->query($query);

  if($cursor){
    $categoria= $cursor->fetch_assoc();
  }
  return $categoria;
}


function insertarCategoria($descripcion,$estado){
  global $conexion;

  $descripcion = $conexion->real_escape_string($descripcion);
  $estado = $conexion->real_escape_string($estado);

  $query = "insert into categorias values (NULL,'%s','%s')";

  $query=sprintf($query,$descripcion,$estado);

  if($conexion->query($query)){
    return true;
  }else {
    return false ;
  }

}


function actualizarCategoria($codigo,$descripcion,$estado){
  global $conexion;
  $codigo = $conexion->real_escape_string($codigo);
  $descripcion = $conexion->real_escape_string($descripcion);
  $estado = $conexion->real_escape_string($estado);

  $query = "update categorias set ctgdsc='%s', ctgest='%s' where ctgcod='%s'";
  $query=sprintf($query,$descripcion,$estado,$codigo);

  if($conexion->query($query)){
    return true;
  }else {
    return false ;
  }

}

 function getLastInsertID(){
   global $conexion;
   return $conexion->insert_id;
 }
function eliminarCategoria($codigo){
  global $conexion;

  $query = "delete from categorias where ctgcod='%s'";
$query=sprintf($query,$codigo);

  if($conexion->query($query)){
    return true;
  }else {
    return false ;
  }

}

 ?>
