<?php
namespace App\models;
defined("APPPATH") OR die("Access denied");

use \Core\Database;
use \Core\MasterDom;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class Estadisticas implements Crud{
    public static function getAll(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT ua.user_id,ua.nombre,ua.apellidop,ua.apellidom,ua.codigo_beca,ua.clave_socio,ig.fecha_hora
      FROM utilerias_administradores ua
      INNER JOIN impresion_gafete ig on(ua.user_id = ig.user_id)
      GROUP BY ua.user_id
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getDataCaja(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT ua.nombre,ua.apellidop,ua.apellidom,tc.productos,tc.total_pesos,tc.fecha_transaccion
      FROM utilerias_administradores ua
      INNER JOIN transaccion_compra tc ON (ua.user_id = tc.user_id);
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getDataCajaByFecha($date){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT ua.nombre,ua.apellidop,ua.apellidom,tc.productos,tc.total_pesos,tc.fecha_transaccion
      FROM utilerias_administradores ua
      INNER JOIN transaccion_compra tc ON (ua.user_id = tc.user_id)
      WHERE fecha_transaccion LIKE '%$date%';
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getPendientes(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.user_id, pp.status, CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario, pp.clave,pr.nombre as nombre_producto, pp.tipo_pago, pp.fecha
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo = '' AND pp.status != 1
      GROUP BY pp.clave ORDER BY pp.user_id;
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function updateSolicitar($data){
      $mysqli = Database::getInstance(true);
      $query=<<<sql
      UPDATE pendiente_pago SET url_archivo = '', status = 2
      WHERE user_id = :user_id AND clave = :clave;
sql;
      $parametros = array(
        ':user_id'=>$data->_user_id,
        ':clave'=>$data->_clave
      );

      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
      $accion->_id = $data->_administrador_id;
      // UtileriasLog::addAccion($accion);
      return $mysqli->update($query, $parametros);
  }

  public static function updateSolicitarEstudiante($data){
    $mysqli = Database::getInstance(true);
    $query=<<<sql
    UPDATE pendiente_estudiante SET url_archivo = '', status = 2
    WHERE user_id = :user_id;
sql;
    $parametros = array(
      ':user_id'=>$data->_user_id
    );

    $accion = new \stdClass();
    $accion->_sql= $query;
    $accion->_parametros = $parametros;
    $accion->_id = $data->_administrador_id;
    // UtileriasLog::addAccion($accion);
    return $mysqli->update($query, $parametros);
}


    public static function updateComprobante($data){
      $mysqli = Database::getInstance(true);
      $query=<<<sql
      UPDATE pendiente_pago SET status = 1, fecha_liberado = :fecha
      WHERE user_id = :user_id AND clave = :clave;
  sql;
      $parametros = array(
        ':user_id'=>$data->_user_id,
        ':clave'=>$data->_clave,
        ':fecha'=>$data->_fecha
      );
  
      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
      $accion->_id = $data->_administrador_id;
      // UtileriasLog::addAccion($accion);
      return $mysqli->update($query, $parametros);
  }

  public static function updateComprobanteEstudiante($data){
    $mysqli = Database::getInstance(true);
    $query=<<<sql
    UPDATE pendiente_estudiante SET status = 1, fecha_liberado = :fecha
    WHERE user_id = :user_id;
sql;
    $parametros = array(
      ':user_id'=>$data->_user_id,
      ':fecha'=>$data->_fecha
    );

    $accion = new \stdClass();
    $accion->_sql= $query;
    $accion->_parametros = $parametros;
    $accion->_id = $data->_administrador_id;
    // UtileriasLog::addAccion($accion);
    return $mysqli->update($query, $parametros);
}


  public static function insertarAsignaProducto($data){
    $mysqli = Database::getInstance(1);
    $query=<<<sql
    INSERT INTO asigna_producto(user_id, id_producto, fecha_asignacion)
    VALUES(:user_id, :id_producto, :fecha);
  sql;
  
        $parametros = array(
          ':user_id'=>$data->_user_id,
          ':id_producto'=>$data->_id_producto,
          ':fecha'=>$data->_fecha
        );
        $id = $mysqli->insert($query,$parametros);
        return $id;
      
  }





    public static function getProcesados(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago,pp.user_id, CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario, pp.clave,pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha, pp.url_archivo
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != '' AND pp.url_archivo != 'Registro_Becado' AND pp.status != 1
      GROUP BY pp.clave ORDER BY pp.user_id;
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getLiberados(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago,pp.user_id, CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario, pp.clave,pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha_liberado, pp.url_archivo
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.status = 1 AND pp.url_archivo != ''
      GROUP BY pp.clave ORDER BY pp.user_id;
sql;
      return $mysqli->queryAll($query);
         
    }

    public static function getTodos(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT SUM(pp.monto) as monto,pp.id_pendiente_pago, pp.status,pp.user_id,CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario,pp.clave,pp.url_archivo,pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha_liberado, pp.url_archivo
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado'
      GROUP BY pp.clave ORDER BY pp.user_id;
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getTodosEstudiantes(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pe.*,CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, ua.usuario
      FROM pendiente_estudiante pe
      INNER JOIN utilerias_administradores ua ON ua.user_id = pe.user_id
      WHERE pe.url_archivo != 'Registro_Becado';
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getNombreProductos($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago, pp.status,pp.user_id,CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario, pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha_liberado, pp.url_archivo
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.clave = '$id';
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getNombreProductosInsert($id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago, pp.status,pp.user_id,CONCAT(ua.nombre," ",ua.apellidop," ",ua.apellidom) as nombre, 
      ua.usuario, pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha_liberado, pp.url_archivo
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.user_id = '$id';
sql;
      return $mysqli->queryAll($query);
        
    }

    public static function getSolicitado($user_id,$id_pendiente_pago){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago,pp.user_id, CONCAT(re.nombre," ",re.apellidop," ",re.apellidom) as nombre, 
      re.usuario, pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores re ON re.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.status != 1
      AND pp.user_id = $user_id AND pp.id_pendiente_pago = $id_pendiente_pago;
sql;
      return $mysqli->queryOne($query);
        
    }

    public static function getInfoSolicitado($user_id,$clave){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT pp.id_pendiente_pago,pp.user_id, CONCAT(re.nombre," ",re.apellidop," ",re.apellidom) as nombre, 
      re.usuario, pr.nombre as nombre_producto, pp.id_producto,pp.tipo_pago, pp.fecha
      FROM pendiente_pago pp
      INNER JOIN utilerias_administradores re ON re.user_id = pp.user_id
      INNER JOIN productos pr ON pr.id_producto = pp.id_producto
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.status != 1
      AND pp.user_id = '$user_id' AND pp.clave = '$clave'
sql;
      return $mysqli->queryOne($query);
        
    }

    public static function getSolicitadoEstudiante($user_id,$id_pendiente_estudiante){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT CONCAT(re.nombre," ",re.apellidop," ",re.apellidom) as nombre, re.usuario
      FROM pendiente_estudiante pp
      INNER JOIN utilerias_administradores re ON re.user_id = pp.user_id
      WHERE pp.url_archivo != 'Registro_Becado' AND pp.status != 1
      AND pp.user_id = $user_id AND pp.id_pendiente_estudiante = $id_pendiente_estudiante;
sql;
      return $mysqli->queryOne($query);
        
    }

    public static function getChecarSocio($user_id){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM utilerias_administradores ua
      INNER JOIN asigna_producto ap ON ap.user_id = ua.user_id
      WHERE ua.user_id = $user_id AND ap.id_producto = 2;
sql;
      return $mysqli->queryOne($query);
        
    }

    public static function updateSocio($data){
      $mysqli = Database::getInstance(true);
      $query=<<<sql
      UPDATE utilerias_administradores SET socio = 1 
      WHERE user_id = :user_id;
  sql;
      $parametros = array(
        ':user_id'=>$data->_user_id
      );
  
      $accion = new \stdClass();
      $accion->_sql= $query;
      $accion->_parametros = $parametros;
      $accion->_id = $data->_administrador_id;
      // UtileriasLog::addAccion($accion);
      return $mysqli->update($query, $parametros);
  }

    public static function getProductosAsignaProducto($user_id,$id_producto){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM asigna_producto WHERE user_id = $user_id and id_producto = $id_producto
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

    
    public static function getProductos(){
      $mysqli = Database::getInstance();
      $query=<<<sql
      SELECT * FROM productos
sql;
      return $mysqli->queryAll($query);
        
    }
    
    public static function insert($data){
        $mysqli = Database::getInstance(1);


        if($data->_tipo == "es_curso"){
          $tipo = 'es_curso';
        }else if($data->_tipo == "es_servicio"){
          $tipo = 'es_servicio';
        }
        $query=<<<sql
            INSERT INTO productos(clave, nombre, fecha_producto, descripcion, $tipo, precio_publico,tipo_moneda, max_compra, status)
            VALUES(:clave, :nombre, NOW(),:descripcion, 1, :precio_publico, 'MXN',1, 1);
sql;


            $parametros = array(
            
            ':clave'=>$data->_clave,
            ':nombre'=>$data->_nombre,
            ':descripcion'=>$data->_descripcion,
            ':precio_publico'=>$data->_precio           
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
} 