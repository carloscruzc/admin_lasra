<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Asistencias implements Crud{
    public static function getAll(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM asistencias
sql;
      return $mysqli->queryAll($query);
        
    }
    public static function getById($id){
         
    }

    
    public static function getProductos(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM productos
sql;
      return $mysqli->queryAll($query);
        
    }
    
    public static function insert($data){
        $mysqli = Database::getInstance(1);
        $query=<<<sql
            INSERT INTO asistencias(id_asistencia, clave, nombre, descripcion, fecha_asistencia, hora_asistencia_inicio, hora_asistencia_fin, url, utilerias_administrador_id,id_producto)
            VALUES(null, :clave, :nombre, :descripcion, :fecha_asistencia, :hora_asistencia_inicio, :hora_asistencia_fin, :url, :utilerias_administrador_id,:id_producto);
sql;


            $parametros = array(
            
            ':clave'=>$data->_clave,
            ':nombre'=>$data->_nombre,
            ':descripcion'=>$data->_descripcion,
            ':fecha_asistencia'=>$data->_fecha_asistencia,
            ':hora_asistencia_inicio'=>$data->_hora_asistencia_inicio,
            ':hora_asistencia_fin'=>$data->_hora_asistencia_fin,
            ':url'=> $data->_url,
            ':utilerias_administrador_id'=> $data->_utilerias_administrador_id,
            ':id_producto' =>$data->_id_producto
           
            );
 
            $id = $mysqli->insert($query,$parametros);
            //UtileriasLog::addAccion($accion);
            return $id;
         
    }
    public static function update($data){
        
    }
    public static function delete($id){
        
    }
    public static function getNumAsistencias(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT COUNT(*) AS total FROM asistencias
sql;
      return $mysqli->queryOne($query);
    }

    public static function getUsuarioGafete($search){
      $mysqli = Database::getInstance();
      
        $query=<<<sql
      select user_id, usuario,concat_ws(' ',nombre, apellidop, apellidom) as nombre_completo from utilerias_administradores WHERE CONCAT_WS(' ',user_id,usuario) LIKE '%$search%'
sql;
      
      return $mysqli->queryAll($query);
        
    }

    public static function getUserById($search){
      $mysqli = Database::getInstance();
      
        $query=<<<sql
      select user_id, usuario,concat_ws(' ',nombre, apellidop, apellidom) as nombre_completo from utilerias_administradores WHERE user_id = '$search'
sql;
      
      return $mysqli->queryAll($query);
        
    }
    
} 