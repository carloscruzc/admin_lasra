<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class ComprobantesPago implements Crud{
    public static function getAll(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.id_producto,pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,ua.user_id,ua.nombre as nombre_usuario,ua.apellidop,ua.apellidom,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.status in (0,2) and pp.url_archivo != '' GROUP BY pp.clave;
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getConceptosByUser($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pro.id_producto,pro.nombre,pro.precio_publico,pro.precio_socio,pro.tipo_moneda,pro.caratula,pro.es_curso,pro.es_servicio,pro.es_congreso,ua.monto_congreso as amout_due,ua.clave_socio,ua.user_id,ua.nombre as nombre_usuario,ua.apellidop,ua.apellidom,pp.id_pendiente_pago,pp.status,pp.tipo_pago,pp.url_archivo,pp.clave
      FROM productos pro
      INNER JOIN pendiente_pago pp ON (pro.id_producto = pp.id_producto)
      INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id)
      WHERE pp.status in (0,2)  and ua.user_id = $id
sql;
      return $mysqli->queryAll($query);
        
    }

    
    public static function getById($id){
         
    } 

    public static function deleteProducto($id){
      $mysqli = Database::getInstance(true);
      $query =<<<sql
      UPDATE productos SET status = 0 WHERE id_producto = $id
sql;

      return $mysqli->update($query);
    }

    public static function updateStatusPendientePagoByUrl($status,$url_archivo){
      $mysqli = Database::getInstance();
      $query=<<<sql
      UPDATE pendiente_pago SET status = $status WHERE url_archivo  = '$url_archivo'
sql;
      return $mysqli->update($query);
    }

    public static function getPendientesPagoByUrl($user_id,$url_archivo){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT *
      FROM pendiente_pago 
      WHERE user_id = $user_id and url_archivo = '$url_archivo'
sql;
      return $mysqli->queryAll($query);
    }

    public static function getAsignaProductoByIdProductAndUser($user_id,$id_producto){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM asigna_producto WHERE user_id = $user_id and id_producto = $id_producto;
sql;
      return $mysqli->queryOne($query);
    }

    public static function insertAsignaProducto($data){

      $mysqli = Database::getInstance();
      $query = <<<sql
      INSERT INTO asigna_producto (user_id,id_producto,fecha_asignacion,status) VALUES(:user_id,:id_producto,NOW(),1)                        
sql;

      $parametros = array(
          ':user_id' => $data->_user_id,
          ':id_producto' => $data->_id_producto
      );

      $id = $mysqli->insert($query, $parametros);

      return $id;
        
    }
    
    
    public static function insert($data){
        
         
    }
    public static function update($data){
        
    }
    public static function delete($id){
        
    }
   
} 