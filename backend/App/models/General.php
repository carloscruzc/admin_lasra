<?php

namespace App\models;

defined("APPPATH") or die("Access denied");

use \Core\Database;
use \App\interfaces\Crud;
use \App\controllers\UtileriasLog;

class General implements Crud
{
  // perfil_id -> 1.- ROOT 4.- Admin 5.- Personalizado 6. Recursos humanos
  // identificador_noi -> "" | "GATSA -> Pam liquidos" | "UNIDESH -> Pan deshidratados" | "VALLEJO" | "XOCHIMILCO"
  // planta_id -> "" | "GATSA -> Pam liquidos" | "UNIDESH -> Pan deshidratados" | "VALLEJO" | "XOCHIMILCO"
  public static function getAllColaboradores()
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ua.utilerias_asistentes_id, ua.status, ra.telefono, ua.usuario, ra.numero_empleado, ra.ticket_virtual, ra.nombre, ra.apellido_paterno, ra.apellido_materno, ra.img, ra.genero, ra.alergias, ra.alergias_otro, ra.alergia_medicamento_cual, ra.alergia_medicamento, ra.restricciones_alimenticias, ra.restricciones_alimenticias_cual, ra.id_linea_principal, ra.clave, lp.nombre as nombre_linea, bu.nombre as nombre_bu, ps.nombre as nombre_posicion, lp.id_linea_ejecutivo, le.nombre as nombre_linea_ejecutivo, le.color, al.utilerias_administradores_id_linea_asignada as id_ejecutivo_administrador, uad.nombre as nombre_ejecutivo
    FROM utilerias_asistentes ua
    INNER JOIN registros_acceso ra ON (ra.id_registro_acceso = ua.id_registro_acceso) 
    INNER JOIN bu ON (bu.id_bu = ra.id_bu) 
    INNER JOIN posiciones ps ON (ps.id_posicion = ra.id_posicion) 
    INNER JOIN linea_principal lp ON (ra.id_linea_principal = lp.id_linea_principal)
    INNER JOIN linea_ejecutivo le ON (le.id_linea_ejecutivo = lp.id_linea_ejecutivo)
    INNER JOIN asigna_linea al ON (al.id_linea_ejecutivo = le.id_linea_ejecutivo)
    INNER JOIN utilerias_administradores uad ON (uad.utilerias_administradores_id = al.utilerias_administradores_id_linea_asignada);
sql;
    return $mysqli->queryAll($query);
  }

  public static function getAllColaboradoresByName($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.*, ra.user_id as id_registro_acceso,ra.usuario as email, cg.tipo as tipo_categoria_gafete, 
    ra.usuario as usuario, ra.clave as ticket_virtual, 
    ra.apellidop as apellido_paterno,
    ra.apellidom as apellido_materno, ra.clave, ra.organizacion, pa.pais, es.estado,
    ra.clave, ra.clave_socio 
    FROM utilerias_administradores ra 
    LEFT JOIN categorias_gafetes cg ON(ra.categoria_gafete = cg.id)
    INNER JOIN paises pa ON (ra.id_pais = pa.id_pais) 
    INNER JOIN estados es ON (ra.id_estado = es.id_estado)
    WHERE ra.mostrar = 1 
    AND CONCAT_WS(' ',ra.usuario,ra.nombre,ra.apellidop,ra.apellidom,ra.user_id, ra.clave, ra.clave_socio)
    LIKE '%$search%';
sql;

    return $mysqli->queryAll($query);
  }

  public static function getAllColaboradoresCongreso($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.*, pp.monto,pp.tipo_pago,pp.url_archivo,
    pp.status,ra.usuario as email, pp.id_pendiente_pago, pp.clave,
    ra.usuario as usuario, ra.clave as ticket_virtual, 
    ra.apellidop as apellido_paterno,
    ra.apellidom as apellido_materno, ra.clave, ra.organizacion, pa.pais, es.estado,
    ra.clave, ra.clave_socio 
    FROM utilerias_administradores ra 
    INNER JOIN paises pa ON (ra.id_pais = pa.id_pais) 
    INNER JOIN estados es ON (ra.id_estado = es.id_estado)
    INNER JOIN pendiente_pago pp ON pp.user_id = ra.user_id
    WHERE ra.mostrar = 1 AND pp.id_producto IN (1,23,35)
    AND CONCAT_WS(' ',ra.usuario,ra.nombre,ra.apellidop,ra.apellidom,ra.user_id, ra.clave, ra.clave_socio)
    LIKE '%$search%';
sql;

    return $mysqli->queryAll($query);
  }

  public static function getReportQuery($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ua.user_id,concat(ua.nombre," ", ua.apellidop," ", ua.apellidom) as nombrecompleto,
    ua.usuario, ua.clave, ua.clave_socio,c.categoria,
    e.nombre as especialidad,
    pa.pais,
    (case when (SELECT COUNT(*) FROM asigna_producto ap WHERE ap.user_id = ua.user_id) > 0 then 'Productos Pagados' else 'Solo Registro' end) as estatuscompra,
    (case when (SELECT COUNT(*) FROM asigna_producto ap WHERE ap.id_producto in (1,23,34) AND ap.user_id = ua.user_id) > 0 then 'Si' else 'No' end) as congreso,
    (case when (SELECT COUNT(*) FROM asigna_producto ap WHERE ap.id_producto in (38,41) AND ap.user_id = ua.user_id) > 0 then 'Si' else 'No' end) as supra2,
    (case when (SELECT COUNT(*) FROM asigna_producto ap WHERE ap.id_producto in (37,40) AND ap.user_id = ua.user_id) > 0 then 'Si' else 'No' end) as supra3,
    (case when (SELECT COUNT(*) FROM asigna_producto ap WHERE ap.id_producto in (36,39) AND ap.user_id = ua.user_id) > 0 then 'Si' else 'No' end) as supra4,
    (case when (SELECT COUNT(pp.tipo_pago) FROM pendiente_pago pp WHERE pp.id_producto in (1,23,34,38,41,37,40,36,39) AND pp.tipo_pago = 'Transferencia' AND pp.url_archivo != '' AND pp.user_id = ua.user_id) = 0 then 'No' else 'Si' end) as transferencia,
    (case when (SELECT COUNT(pp.tipo_pago) FROM pendiente_pago pp WHERE pp.id_producto in (1,23,34,38,41,37,40,36,39) AND pp.tipo_pago = 'Paypal' AND pp.status = 1 AND pp.user_id = ua.user_id) = 0 then 'No' else 'Si' end) as paypal
    FROM utilerias_administradores ua
    INNER JOIN categorias c
    ON c.id_categoria = ua.id_categoria
    INNER JOIN especialidades e
    ON e.id_especialidad = ua.especialidades
    INNER JOIN paises pa
    ON pa.id_pais = ua.id_pais
    WHERE CONCAT_WS(' ',ua.usuario,ua.nombre,ua.apellidop,ua.apellidom,ua.user_id, ua.clave, ua.clave_socio)
    LIKE '%$search%';
sql;

    return $mysqli->queryAll($query);
  }

  public static function getAllColaboradoresCursos($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.*, pp.monto,pp.tipo_pago,pp.url_archivo,
    pp.status,ra.usuario as email, pp.id_pendiente_pago, pp.clave,
    ra.usuario as usuario, ra.clave as ticket_virtual, 
    ra.apellidop as apellido_paterno,
    ra.apellidom as apellido_materno, ra.clave, ra.organizacion, pa.pais, es.estado,
    ra.clave, ra.clave_socio 
    FROM utilerias_administradores ra 
    INNER JOIN paises pa ON (ra.id_pais = pa.id_pais) 
    INNER JOIN estados es ON (ra.id_estado = es.id_estado)
    INNER JOIN pendiente_pago pp ON pp.user_id = ra.user_id
    WHERE ra.mostrar = 1 AND pp.id_producto NOT IN (1,2,23,34,35)
    AND CONCAT_WS(' ',ra.usuario,ra.nombre,ra.apellidop,ra.apellidom,ra.user_id, ra.clave, ra.clave_socio)
    LIKE '%$search%';
sql;

    return $mysqli->queryAll($query);
  }

  public static function getAllColaboradoresImprimir($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.*, pp.monto,pp.tipo_pago,pp.url_archivo,pp.status,ra.usuario as email,
    ra.usuario as usuario, ra.clave as ticket_virtual, 
    ra.apellidop as apellido_paterno,
    ra.apellidom as apellido_materno, ra.clave, ra.organizacion, pa.pais, es.estado,
    ra.clave, ra.clave_socio 
    FROM utilerias_administradores ra 
    INNER JOIN paises pa ON (ra.id_pais = pa.id_pais) 
    INNER JOIN estados es ON (ra.id_estado = es.id_estado)
    INNER JOIN pendiente_pago pp ON pp.user_id = ra.user_id
    WHERE ra.mostrar = 1 AND pp.id_producto IN (1,23) AND ra.user_id = $user_id AND pp.status = 1
sql;

    return $mysqli->queryAll($query);
  }

  public static function getBuscarBeca($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ua.user_id, ua.usuario, p.status, p.fecha_liberado, p.url_archivo, p.id_producto 
    FROM pendiente_pago p INNER JOIN utilerias_administradores ua on ua.user_id = p.user_id 
    WHERE ua.usuario = '$search' and p.id_producto = 1;
sql;

    return $mysqli->queryAll($query);
  }

  public static function getBecaUser($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT be.*,lab.* FROM becas be
      INNER JOIN laboratorios lab ON lab.id_laboratorio = be.id_laboratorio
      WHERE be.usadopor = '$id';
sql;

    return $mysqli->queryAll($query);
  }

  public static function getImpresionGafete($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT * FROM `impresion_gafete` WHERE user_id = '$id' GROUP BY user_id;
sql;

    return $mysqli->queryOne($query);
  }

  public static function getImpresionGafeteTipo($id,$tipo)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
  SELECT * FROM `impresion_gafete` WHERE user_id = '$id' and tipo = '$tipo'
sql;

    return $mysqli->queryOne($query);
  }

  public static function getImpresionConstancia($id,$ids)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
  SELECT * FROM `impresion_constancia` WHERE user_id = '$id' and id_producto in ($ids)
sql;

    return $mysqli->queryOne($query);
  }

  public static function getAdeudosUser($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT *,COUNT(*) as adeudos FROM pendiente_pago pp
    INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
    WHERE ua.mostrar = 1 AND (pp.status = 0 AND pp.user_id = '$id') GROUP BY pp.user_id;
sql;

    return $mysqli->queryOne($query);
  }

  public static function getBuscarEstatusCompraEmail($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql

        SELECT ua.user_id, ua.usuario, p.status, p.fecha_liberado, p.url_archivo, p.id_producto 
            FROM pendiente_pago p INNER JOIN utilerias_administradores ua on ua.user_id = p.user_id 
            WHERE ua.usuario = '$search' and p.id_producto = 1
        UNION
        SELECT user_id, usuario, 3 as status, '' as fecha_liberado, '' as url_archivo, 1 as id_producto FROM utilerias_administradores
            WHERE user_id NOT IN (SELECT user_id FROM pendiente_pago WHERE id_producto = 1) and scholarship =  '' and usuario = '$search'; 
sql;

    return $mysqli->queryAll($query);
  }
  public static function getBuscarCursos($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
        SELECT ua.user_id,ua.nombre, pp.id_producto, pro.nombre as 'nombre producto', 
        CASE WHEN pp.comprado_en = 1 THEN "SITIO WEB" WHEN pp.comprado_en = 2 
        THEN "CAJA" ELSE "SITIO" END as 'compro en', pp.tipo_pago, 
        CASE WHEN pp.status = 1 
        THEN "PAGADO" WHEN pp.status = 2 THEN "SE VOLVIO A PEDIR COMPROBANTE" ELSE "PENDIETE" 
        END as 'estatus_pendiente_pago', IF(aspro.status = 1, "CON ACCESO", "SIN ACCESO") as 'estatus_compra' 
        FROM pendiente_pago pp INNER JOIN utilerias_administradores ua ON(ua.user_id = pp.user_id) 
        INNER JOIN productos pro ON (pp.id_producto = pro.id_producto) 
        LEFT JOIN asigna_producto aspro ON(pp.user_id = aspro.user_id AND pp.id_producto = aspro.id_producto) 
        WHERE ua.user_id = $search GROUP BY id_producto;
sql;

    return $mysqli->queryAll($query);
  }

  public static function getAllTalleres()
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT pr.id_producto,pr.nombre,COUNT(*) as total_registrado FROM pendiente_pago pp
    INNER JOIN productos pr ON pp.id_producto = pr.id_producto
    WHERE pp.status = 1
    GROUP BY pp.id_producto;
sql;

    return $mysqli->queryAll($query);
  }

  public static function getAllUsuariosTalleres($id_producto)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT pr.id_producto,pr.nombre,pp.*, ua.*,pp.status as statuspp FROM pendiente_pago pp
    INNER JOIN productos pr ON pp.id_producto = pr.id_producto
    INNER JOIN utilerias_administradores ua ON pp.user_id = ua.user_id
    WHERE pp.status = 1
    AND pp.id_producto = $id_producto
    ORDER BY ua.nombre ASC;
sql;

    return $mysqli->queryAll($query);
  }

  //   public static function getProductoByIdProducto($id_producto){
  //     $mysqli = Database::getInstance();
  //     $query =<<<sql
  //     SELECT * FROM productos pr
  //     WHERE pr.id_producto = $id_producto;
  // sql;

  //     return $mysqli->queryAll($query);
  //   }

  public static function getUserRegisterByClave($clave)
  {
    $mysqli = Database::getInstance(true);
    $query = <<<sql
    SELECT ua.* FROM utilerias_administradores ua 
    WHERE ua.user_id = '$clave';
sql;

    return $mysqli->queryAll($query);
  }


  public static function getBecas($codigo)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
        SELECT b.codigo, l.nombrecompleto FROM becas b INNER JOIN laboratorios l on l.id_laboratorio = b.id_laboratorio WHERE codigo = '$codigo';
sql;

    return $mysqli->queryAll($query);
  }


  public static function getAllColaboradoresByNameQuery($search)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.*, ra.user_id as id_registro_acceso,ra.usuario as email, ra.usuario 
    as usuario, ra.user_id as ticket_virtual, 
    ra.apellidop as apellido_paterno, ra.apellidom as apellido_materno, ra.img, ra.user_id as clave, 
    ra.organization, pa.pais
    FROM utilerias_administradores ra
    INNER JOIN paises pa ON (ra.id_pais = pa.id_pais)
    AND CONCAT_WS(ra.usuario,ra.nombre,ra.apellidop,ra.apellidom,ra.user_id) 
    LIKE '%$search%';
sql;

    // $query =<<<sql
    //     SELECT *
    //     FROM registros_acceso 
    //     WHERE CONCAT_WS(email,nombre,apellido_materno,apellido_paterno,ticket_virtual) LIKE '%$search%';
    // sql;
    return $mysqli->queryAll($query);
  }

  public static function getAsistentesFaltantes()
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT * FROM registros_acceso WHERE id_registro_acceso NOT IN (SELECT id_registro_acceso FROM utilerias_asistentes);
sql;

    return $mysqli->queryAll($query);
  }

  public static function getTicketByIdTicket($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT *
    FROM ticket_virtual
    WHERE id_ticket_virtual = $id
sql;
    return $mysqli->queryAll($query);
  }

  public static function searchAsistentesTicketbyId($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.nombre, uasis.usuario, tv.clave
    FROM registros_acceso ra
    INNER JOIN utilerias_asistentes uasis ON (ra.id_registro_acceso = uasis.id_registro_acceso)
    WHERE uasis.utilerias_asistentes_id = $id
sql;

    return $mysqli->queryAll($query);
  }

  public static function searchItinerarioByAistenteId($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
    SELECT ra.nombre, uasis.id_registro_acceso, uasis.utilerias_asistentes_id, it.utilerias_asistentes_id as id_uasis_it
    FROM registros_acceso ra
    INNER JOIN utilerias_asistentes uasis ON(ra.id_registro_acceso = uasis.id_registro_acceso)
    LEFT JOIN itinerario it ON(uasis.utilerias_asistentes_id = it.utilerias_asistentes_id)
    WHERE uasis.utilerias_asistentes_id = $id
sql;

    return $mysqli->queryAll($query);
  }



  public static function getPeriodo($data)
  {
    $mysqli = Database::getInstance();
    if ($data->_tipo_busqueda == 0) { /* CUANDO SE BUSCA UN UNICO PERIODO ABIERTO*/
      $query = <<<sql
SELECT * FROM prorrateo_periodo WHERE status = 0 AND tipo = "$data->_tipo" ORDER BY prorrateo_periodo_id ASC 
sql;
    }
    if ($data->_tipo_busqueda == 1) { /* CUANDO SE BUSCA POR SEMANALES O QUINCENALES HISTORICOS */
      $query = <<<sql
SELECT * FROM prorrateo_periodo WHERE status != 0 AND tipo = "$data->_tipo" ORDER BY fecha_inicio DESC
sql;
    }
    if ($data->_tipo_busqueda == 2) { /* CUANDO SE BUSCA UN UNICO PERIODO POR ID */
      $query = <<<sql
SELECT * FROM prorrateo_periodo WHERE prorrateo_periodo_id = "$data->_prorrateo_periodo_id" 
sql;
    }
    return $mysqli->queryAll($query);
  }
  public static function getStatus()
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT * FROM catalogo_status
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusCompra($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.user_id = $user_id;
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusSolicitar($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.status = 2 AND pp.user_id = $user_id;
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusValidando($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.status = 0 AND pp.user_id = $user_id;
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusValidandoCongreso($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.status = 0 AND pp.user_id = $user_id AND id_producto IN (1,23);
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusValidandoCursos($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.status = 0 AND pp.user_id = $user_id AND id_producto NOT IN (1,23);
sql;
    return $mysqli->queryAll($query);
  }

  public static function getStatusLiberado($user_id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT pp.* FROM pendiente_pago pp
      INNER JOIN utilerias_administradores ua ON ua.user_id = pp.user_id
      WHERE pp.status = 1 AND pp.user_id = $user_id;
sql;
    return $mysqli->queryAll($query);
  }

  public static function getAll()
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
        SELECT * FROM catalogo_dia_festivo;
sql;
    return $mysqli->queryAll($query);
  }
  public static function getDatosUsuarioLogeado($user)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
        SELECT * FROM utilerias_administradores WHERE usuario LIKE '$user'
sql;
    return $mysqli->queryOne($query);
  }
  public static function getDatosColaborador($idColaborador)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
SELECT cc.catalogo_colaboradores_id, cc.clave_noi, cc.identificador_noi, cc.nombre, o.sal_diario, o.sdi
FROM catalogo_colaboradores cc 
INNER JOIN operacion_noi o ON (cc.clave_noi = o.clave) 
WHERE cc.catalogo_colaboradores_id = "$idColaborador" AND cc.identificador_noi = o.identificador 
sql;
    return $mysqli->queryOne($query);
  }
  public static function getDatosUsuario($user)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
SELECT ua.administrador_id, ua.nombre, ua.perfil_id, ua.catalogo_planta_id, up.nombre AS nombre_perfil, cd.catalogo_departamento_id, cd.nombre, cp.nombre AS nombre_planta
FROM utilerias_administradores ua
JOIN utilerias_perfiles up USING( perfil_id )
JOIN catalogo_planta cp USING ( catalogo_planta_id )
JOIN utilerias_administradores_departamentos uad ON ( uad.id_administrador = ua.administrador_id )
JOIN catalogo_departamento cd ON ( cd.catalogo_departamento_id = uad.catalogo_departamento_id )
WHERE ua.usuario = "$user"
sql;
    return $mysqli->queryOne($query);
  }
  public static function insert($datos)
  {
    $mysqli = Database::getInstance(1);
    $query = <<<sql
        INSERT INTO catalogo_dia_festivo (catalogo_dia_festivo_id, nombre, descripcion, fecha, status) VALUES (NULL, :nombre, :descripcion, :fecha, '1');
sql;
    $parametros = array(
      ':nombre' => $datos->_nombre,
      ':descripcion' => $datos->_descripcion,
      ':fecha' => $datos->_fecha,
    );
    $id = $mysqli->insert($query, $parametros);
    $accion = new \stdClass();
    $accion->_sql = $query;
    $accion->_parametros = $parametros;
    $accion->_id = $id;
    UtileriasLog::addAccion($accion);
    return $id;
  }
  public static function update($datos)
  {
  }
  public static function delete($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
        DELETE FROM `catalogo_dia_festivo` WHERE `catalogo_dia_festivo`.`catalogo_dia_festivo_id` = $id
sql;
    $parametros = array(':id' => $id);
    $accion = new \stdClass();
    $accion->_sql = $query;
    $accion->_parametros = $parametros;
    $accion->_id = $id;
    UtileriasLog::addAccion($accion);
    return $mysqli->update($query, $parametros);
  }

  public static function getById($id)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
SELECT *  FROM catalogo_dia_festivo WHERE catalogo_dia_festivo_id = $id
sql;
    return $mysqli->queryOne($query);
  }
  public static function getPermisos($usuario)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT * FROM utilerias_permisos WHERE usuario LIKE '$usuario'   
sql;
    return $mysqli->queryAll($query);
  }
  public static function getUsuario($usuario)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT * FROM utilerias_permisos WHERE usuario LIKE '$usuario'   
sql;
    return $mysqli->queryOne($query);
  }

  public static function getPerfilUsuario($usuario)
  {
    $mysqli = Database::getInstance();
    $query = <<<sql
      SELECT * FROM utilerias_administradores_admin WHERE usuario LIKE '$usuario'   
sql;
    return $mysqli->queryOne($query);
  }
}
