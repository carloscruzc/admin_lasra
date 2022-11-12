<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Encuestas{


  public static function insert($datos){
    $mysqli = Database::getInstance(1);
    $query=<<<sql
    INSERT INTO encuesta (nombre, email, preg_1, preg_2, preg_3, preg_4, preg_5, preg_6) 
    VALUES (:nombre, :email, :preg_1, :preg_2, :preg_3, :preg_4, :preg_5, :preg_6);
sql;



  $parametros = array(
    ':nombre'=>$datos->_nombre,
    ':email'=>$datos->_email,
    ':preg_1'=>$datos->_preg_1,
    ':preg_2'=>$datos->_preg_2,
    ':preg_3'=>$datos->_preg_3,
    ':preg_4'=>$datos->_preg_4,
    ':preg_5'=>$datos->_preg_5,
    ':preg_6'=>$datos->_preg_6,
   
  );
  $id = $mysqli->insert($query,$parametros);
  // $accion = new \stdClass();
  // $accion->_sql= $query;
  // $accion->_parametros = $parametros;
  // $accion->_id = $id;

  // UtileriasLog::addAccion($accion);
  return $id;
}

public static function searchUserEncuesta($usuario){
    $mysqli = Database::getInstance();
    $query=<<<sql
    SELECT * FROM encuesta WHERE email = '$usuario'   
sql;
  return $mysqli->queryAll($query);
}


public static function getUserEncuesta($email){
  $mysqli = Database::getInstance();
  $query=<<<sql
  SELECT ra.id_registro_acceso,ra.nombre,ra.segundo_nombre,ra.apellido_paterno,ra.apellido_materno,
  ra.email,ra.clave FROM registros_acceso ra 
  WHERE ra.email = '$email'
sql;
return $mysqli->queryAll($query);
}

}