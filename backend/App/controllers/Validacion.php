<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\PruebasCovidSitio as PruebasCovidSitioDao;
use \App\models\Asistencias as AsistenciasDao;
use \App\models\Estadisticas as EstadisticasDao;
use \DateTime;
use \DatetimeZone;
// use \App\models\Linea as LineaDao;

class Validacion extends Controller
{

  private $_contenedor;

  function __construct()
  {
    parent::__construct();
    $this->_contenedor = new Contenedor;
    View::set('header', $this->_contenedor->header());
    View::set('footer', $this->_contenedor->footer());
    // if (Controller::getPermisosUsuario($this->__usuario, "seccion_asistencias", 1) == 0)
    //   header('Location: /Principal/');
  }

  public function getUsuario()
  {
    return $this->__usuario;
  }

  public function index()
  {
    $extraHeader = <<<html
html;
    // $permisoGlobalHidden = (Controller::getPermisoGlobalUsuario($this->__usuario)[0]['permisos_globales']) != 1 ? "style=\"display:none;\"" : "";
    // $asistentesHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_asistentes", 1) == 0) ? "style=\"display:none;\"" : "";
    // $vuelosHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_vuelos", 1) == 0) ? "style=\"display:none;\"" : "";
    // $pickUpHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_pickup", 1) == 0) ? "style=\"display:none;\"" : "";
    // $habitacionesHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_habitaciones", 1) == 0) ? "style=\"display:none;\"" : "";
    // $cenasHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_cenas", 1) == 0) ? "style=\"display:none;\"" : "";
    // $cenasHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_cenas", 1) == 0) ? "style=\"display:none;\"" : "";
    // $aistenciasHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_asistencias", 1) == 0) ? "style=\"display:none;\"" : "";
    // $vacunacionHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_vacunacion", 1) == 0) ? "style=\"display:none;\"" : "";
    // $pruebasHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_pruebas_covid", 1) == 0) ? "style=\"display:none;\"" : "";
    // $configuracionHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_configuracion", 1) == 0) ? "style=\"display:none;\"" : "";
    // $utileriasHidden = (Controller::getPermisosUsuario($this->__usuario, "seccion_utilerias", 1) == 0) ? "style=\"display:none;\"" : "";

$extraFooter =<<<html
      <script>
        $(document).ready(function(){

          $('#asistencia-list').DataTable({
            "drawCallback": function(settings) {
                $('.current').addClass("btn bg-gradient-pink text-white btn-rounded").removeClass("paginate_button");
                $('.paginate_button').addClass("btn").removeClass("paginate_button");
                $('.dataTables_length').addClass("m-4");
                $('.dataTables_info').addClass("mx-4");
                $('.dataTables_filter').addClass("m-4");
                $('input').addClass("form-control");
                $('select').addClass("form-control");
                $('.previous.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
                $('.next.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
                $('.previous').addClass("btn-outline-info btn-rounded mx-2");
                $('.next').addClass("btn-outline-info btn-rounded mx-2");
                $('a.btn').addClass("btn-rounded");
            },
            "language": {

                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

            }
        });

        $('#constancia-list').DataTable({
          "drawCallback": function(settings) {
              $('.current').addClass("btn bg-gradient-pink text-white btn-rounded").removeClass("paginate_button");
              $('.paginate_button').addClass("btn").removeClass("paginate_button");
              $('.dataTables_length').addClass("m-4");
              $('.dataTables_info').addClass("mx-4");
              $('.dataTables_filter').addClass("m-4");
              $('input').addClass("form-control");
              $('select').addClass("form-control");
              $('.previous.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
              $('.next.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
              $('.previous').addClass("btn-outline-info btn-rounded mx-2");
              $('.next').addClass("btn-outline-info btn-rounded mx-2");
              $('a.btn').addClass("btn-rounded");
          },
          "language": {

              "sProcessing": "Procesando...",
              "sLengthMenu": "Mostrar _MENU_ registros",
              "sZeroRecords": "No se encontraron resultados",
              "sEmptyTable": "Ningún dato disponible en esta tabla",
              "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix": "",
              "sSearch": "Buscar:",
              "sUrl": "",
              "sInfoThousands": ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst": "Primero",
                  "sLast": "Último",
                  "sNext": "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }

          }
      });

      $('#socio-list').DataTable({
        "drawCallback": function(settings) {
            $('.current').addClass("btn bg-gradient-pink text-white btn-rounded").removeClass("paginate_button");
            $('.paginate_button').addClass("btn").removeClass("paginate_button");
            $('.dataTables_length').addClass("m-4");
            $('.dataTables_info').addClass("mx-4");
            $('.dataTables_filter').addClass("m-4");
            $('input').addClass("form-control");
            $('select').addClass("form-control");
            $('.previous.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
            $('.next.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
            $('.previous').addClass("btn-outline-info btn-rounded mx-2");
            $('.next').addClass("btn-outline-info btn-rounded mx-2");
            $('a.btn').addClass("btn-rounded");
        },
        "language": {

            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        }
    });

    $('#todos-list').DataTable({
      "drawCallback": function(settings) {
          $('.current').addClass("btn bg-gradient-pink text-white btn-rounded").removeClass("paginate_button");
          $('.paginate_button').addClass("btn").removeClass("paginate_button");
          $('.dataTables_length').addClass("m-4");
          $('.dataTables_info').addClass("mx-4");
          $('.dataTables_filter').addClass("m-4");
          $('input').addClass("form-control");
          $('select').addClass("form-control");
          $('.previous.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
          $('.next.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
          $('.previous').addClass("btn-outline-info btn-rounded mx-2");
          $('.next').addClass("btn-outline-info btn-rounded mx-2");
          $('a.btn').addClass("btn-rounded");
      },
      "language": {

          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }

      }
  });

    $('#estudiante-list').DataTable({
      "drawCallback": function(settings) {
          $('.current').addClass("btn bg-gradient-pink text-white btn-rounded").removeClass("paginate_button");
          $('.paginate_button').addClass("btn").removeClass("paginate_button");
          $('.dataTables_length').addClass("m-4");
          $('.dataTables_info').addClass("mx-4");
          $('.dataTables_filter').addClass("m-4");
          $('input').addClass("form-control");
          $('select').addClass("form-control");
          $('.previous.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
          $('.next.disabled').addClass("btn-outline-info opacity-5 btn-rounded mx-2");
          $('.previous').addClass("btn-outline-info btn-rounded mx-2");
          $('.next').addClass("btn-outline-info btn-rounded mx-2");
          $('a.btn').addClass("btn-rounded");
      },
      "language": {

          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast": "Último",
              "sNext": "Siguiente",
              "sPrevious": "Anterior"
          },
          "oAria": {
              "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }

      }
  });

          $("#muestra-cupones").tablesorter();
          var oTable = $('#muestra-cupones').DataTable({
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }],
                 "order": false
            });

            // Remove accented character from search input as well
            $('#muestra-cupones input[type=search]').keyup( function () {
                var table = $('#example').DataTable();
                table.search(
                    jQuery.fn.DataTable.ext.type.search.html(this.value)
                ).draw();
            });

            var checkAll = 0;
            $("#checkAll").click(function () {
              if(checkAll==0){
                $("input:checkbox").prop('checked', true);
                checkAll = 1;
              }else{
                $("input:checkbox").prop('checked', false);
                checkAll = 0;
              }

            });

            $("#export_pdf").click(function(){
              $('#all').attr('action', '/Empresa/generarPDF/');
              $('#all').attr('target', '_blank');
              $("#all").submit();
            });

            $("#export_excel").click(function(){
              $('#all').attr('action', '/Empresa/generarExcel/');
              $('#all').attr('target', '_blank');
              $("#all").submit();
            });

            $("#delete").click(function(){
              var seleccionados = $("input[name='borrar[]']:checked").length;
              if(seleccionados>0){
                alertify.confirm('¿Segúro que desea eliminar lo seleccionado?', function(response){
                  if(response){
                    $('#all').attr('target', '');
                    $('#all').attr('action', '/Empresa/delete');
                    $("#all").submit();
                    alertify.success("Se ha eliminado correctamente");
                  }
                });
              }else{
                alertify.confirm('Selecciona al menos uno para eliminar');
              }
            });

        });
      </script>
html;
    $tabla = '';
    $datos = EstadisticasDao::getPendientes();
    $numero_gafete = 0;
    $total_gafetes = 0;
    
    foreach ($datos as $key => $value) {

      if($value['tipo_pago'] != ''){
        $tipo_pago = '';
      }else{
        $tipo_pago = '<span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>SIN SELECCIONAR</strong></span>';
      }

      if($value['status'] == 0){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>PENDIENTE</strong></span>';
      }else{
        $status_pendiente = '<span class="badge badge-success" style="background-color: #9A1622; color:white "><strong>VOLVER A SUBIR</strong></span>';
      }

      
      $productos = EstadisticasDao::getNombreProductos($value['clave']);
      $todos = '';
      foreach ($productos as $key => $all_productos){
        $variable = $all_productos['nombre_producto'];
        $todos .= $variable.('<br>');
      }
      $numero_gafete = $numero_gafete + 1;

      $tabla.=<<<html
      <tr>
        <td>$numero_gafete</td>
        <td>{$value['user_id']}</td>
        <td class="text-center">{$status_pendiente}</td>
        <td class="text-center">{$value['nombre']}<br>{$value['usuario']}</td>
        <td class="text-center">{$todos}</td>
        <td class="text-center">{$value['tipo_pago']}{$tipo_pago}</td> 
        <td class="text-center">{$value['fecha']}</td>
      </tr>
 
html;
    }
    foreach ($datos as $key => $value){
      $total_gafetes = $total_gafetes + 1;
    }


    $tabla_constancia = '';
    $datos_consta = EstadisticasDao::getProcesados();
    $numero_constancia = 0;
    $total_consta = 0;
    
    foreach ($datos_consta as $key => $value) {

      $productos = EstadisticasDao::getNombreProductos($value['clave']);
      $todos = '';
      foreach ($productos as $key => $all_productos){
        $variable = $all_productos['nombre_producto'];  
        $todos .= $variable.('<br>');
      }
      
      $numero_constancia = $numero_constancia + 1;

      $tabla_constancia.=<<<html
      <tr>
        <td>$numero_constancia</td>
        <td>{$value['user_id']}</td>
        <td class="text-center">{$value['nombre']}<br>{$value['usuario']}</td>
        <td class="text-center">{$todos}</td>
        <td class="text-center">{$value['tipo_pago']}
          <br>VER COMPROBANTE<br>
          <div data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}">
            <button data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
          </div>
        </td>
        <td class="text-center">
          <button onclick="confirmarsolicitar('{$value['clave']}',{$value['user_id']},{$value['id_pendiente_pago']})" title="Volver a solicitar" class="btn btn-warning" type="button" id="button">
            <span class="fa fa-undo-alt" style="color:white"></span>
          </button><br>
          <button onclick="confirmarvalidar({$value['id_pendiente_pago']},{$value['user_id']},{$value['id_producto']},'{$value['clave']}')" type="button" class="btn btn-primary">
            LIBERAR
          </button>
        </td>
        
      </tr>
 
html;
    }

    foreach ($datos_consta as $key => $value){
      $total_consta = $total_consta + 1;
    }


    $tabla_socios = '';
    $datos_socios = EstadisticasDao::getLiberados();
    $numero_socios = 0;
    $total_socios = 0;
    
    foreach ($datos_socios as $key => $value) {


      $productos = EstadisticasDao::getNombreProductos($value['clave']);
      $todos = '';
      foreach ($productos as $key => $all_productos){
        $variable = $all_productos['nombre_producto'];
        $todos .= $variable.('<br>');
      }
      $numero_socios = $numero_socios + 1;

      $tabla_socios.=<<<html
      <tr>
        <td>$numero_socios</td>
        <td>{$value['user_id']}</td>
        <td class="text-center">{$value['nombre']}<br>{$value['usuario']}</td>
        <td class="text-center">{$todos}</td>
        <td class="text-center">{$value['tipo_pago']}
          <br>VER COMPROBANTE<br>
          <div data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}">
            <button data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
          </div>
        </td>
        <td class="text-center">{$value['fecha_liberado']}</td>
      </tr>
 
html;
    }

    $tabla_caja = '';
    $datos_caja = EstadisticasDao::getTodos();
    $numero_caja = 0;
    $total_pesos = 0;
    
    foreach ($datos_caja as $key => $value) {
      $comprobante = '';
      $acciones = '';

      if($value['tipo_pago'] != ''){
        $tipo_pago = '';
      }else{
        $tipo_pago = '<span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>SIN SELECCIONAR</strong></span>';
      }

      if($value['url_archivo'] != '' && $value['status'] == 0){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #03A5E7; color:white "><strong>EN ESPERA</strong></span>';
      }else if($value['status'] == 0){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>PENDIENTE</strong></span>';
      }else if($value['status'] == 2){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #9A1622; color:white "><strong>VOLVER A SUBIR</strong></span>';
      }else{
        $status_pendiente = '<span class="badge badge-success" style="background-color: #1C6C42; color:white "><strong>ACEPTADO</strong></span>';
      }

      if($value['url_archivo'] != '' && $value['status'] == 1){
        $comprobante .=<<<html
        <br>VER COMPROBANTE<br>
        <div data-toggle="modal" data-target="#pdf" data-pdf="{$value['url_archivo']}">
          <button data-toggle="modal" data-target="#pdf" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <span class="badge badge-success" style="background-color: #1C6C42; color:white "><strong>LIBERADO</strong></span>
        </td>
html;
      }else if($value['url_archivo'] == ''){
        $comprobante .=<<<html
        <br>SIN COMPROBANTE<br>
        <div>
          <button disabled data-toggle="modal" data-target="#pdf" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-danger pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>PENDIENTE</strong></span>
        </td>
html;
      }else{
        $comprobante .=<<<html
        <br>VER COMPROBANTE<br>
        <div data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}">
          <button data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <button onclick="confirmarsolicitar('{$value['clave']}',{$value['user_id']},{$value['id_pendiente_pago']})" title="Volver a solicitar" class="btn btn-warning" type="button" id="button">
            <span class="fa fa-undo-alt" style="color:white"></span>
          </button><br>
          <button onclick="confirmarvalidar({$value['id_pendiente_pago']},{$value['user_id']},{$value['id_producto']},'{$value['clave']}')" type="button" class="btn btn-primary">
            LIBERAR
          </button>
        </td>
html;
      }

      $productos = EstadisticasDao::getNombreProductos($value['clave']);
      $todos = '';
      foreach ($productos as $key => $all_productos){
        $variable = $all_productos['nombre_producto'];
        $todos .= $variable.('<br>');
      }
      $numero_caja = $numero_caja + 1;
      $tabla_caja.=<<<html
      <tr>
        <td>$numero_caja</td>
        <td>{$value['user_id']}</td>
        <td class="text-center">{$status_pendiente}</td>
        <td class="text-center">{$value['nombre']}<br>{$value['usuario']}</td>
        <td class="text-center">{$todos}</td>
        <td class="text-center">$ {$value['monto']}.00</td>
        <td class="text-center">{$value['tipo_pago']}{$tipo_pago}
        {$comprobante}
        </td>
        {$acciones}
      </tr>
html;
    }

    foreach ($datos_caja as $key => $value){
      $total_pesos = $total_pesos + 1;
    }

    $tabla_estudiante = '';
    $datos_estudiante = EstadisticasDao::getTodosEstudiantes();
    $numero_estudiante = 0;
    $total_pesos = 0;
    
    foreach ($datos_estudiante as $key => $value) {
      $comprobante = '';
      $acciones = '';

      if($value['url_archivo'] != '' && $value['status'] == 0){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #03A5E7; color:white "><strong>EN ESPERA</strong></span>';
      }else if($value['status'] == 0){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>PENDIENTE</strong></span>';
      }else if($value['status'] == 2){
        $status_pendiente = '<span class="badge badge-success" style="background-color: #9A1622; color:white "><strong>VOLVER A SUBIR</strong></span>';
      }else{
        $status_pendiente = '<span class="badge badge-success" style="background-color: #1C6C42; color:white "><strong>ACEPTADO</strong></span>';
      }

      if($value['url_archivo'] != '' && $value['status'] == 1){
        $comprobante .=<<<html
        <br>VER COMPROBANTE<br>
        <div data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}">
          <button data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <span class="badge badge-success" style="background-color: #1C6C42; color:white "><strong>LIBERADO</strong></span>
        </td>
html;
      }else if($value['url_archivo'] == ''){
        $comprobante .=<<<html
        <br>SIN COMPROBANTE<br>
        <div>
          <button disabled data-toggle="modal" data-target="#pdf" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-danger pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <span class="badge badge-success" style="background-color: #F2B500; color:white "><strong>PENDIENTE</strong></span>
        </td>
html;
      }else{
        $comprobante .=<<<html
        <br>VER COMPROBANTE<br>
        <div data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}">
          <button data-toggle="modal" data-target="#pdf" data-user-id="{$value['user_id']}" data-pdf="{$value['url_archivo']}" type="button" class="btn btn-success pdf iframe" value="{$value['url_archivo']}"><span class="fa fa-eye" style="color:white"></span></button>
        </div>
html;
        $acciones .=<<<html
        <td class="text-center">
          <button onclick="confirmarsolicitarEstudiante({$value['user_id']},{$value['id_pendiente_estudiante']})" title="Volver a solicitar" class="btn btn-warning" type="button" id="button">
            <span class="fa fa-undo-alt" style="color:white"></span>
          </button><br>
          <button onclick="confirmarvalidarEstudiante({$value['id_pendiente_estudiante']},{$value['user_id']})" type="button" class="btn btn-primary">
            LIBERAR
          </button>
        </td>
html;
      }

      $numero_estudiante = $numero_estudiante + 1;
      $tabla_estudiante.=<<<html
      <tr>
        <td>$numero_estudiante</td>
        <td>{$value['user_id']}</td>
        <td class="text-center">{$status_pendiente}</td>
        <td class="text-center">{$value['nombre']}<br>{$value['usuario']}<br>Registro del: {$value['fecha']}</td>
        <td class="text-center">{$comprobante}</td>
        {$acciones}
      </tr>
html;
    }

    foreach ($datos_estudiante as $key => $value){
      $total_pesos = $total_pesos + 1;
    }

    if($_SESSION['perfil'] == 2){
      // View::set('asideMenu',$this->_contenedor->asideMenu());
    }else{
      View::set('asideMenu',$this->_contenedor->asideMenu());
    }
      View::set('total_pesos',$total_pesos);
      View::set('total_consta',$total_consta);
      View::set('total_gafetes',$total_gafetes);
      View::set('numero_caja',$numero_caja);
      View::set('total_socios',$total_socios);
      View::set('ventas_totales',count($datos_caja));
      View::set('tabla',$tabla);
      View::set('tabla_constancia',$tabla_constancia);
      View::set('tabla_caja',$tabla_caja);
      View::set('tabla_socios',$tabla_socios);
      View::set('tabla_estudiante',$tabla_estudiante);
      // View::set('num_asistencias',$num_asistencias);
      View::set('header',$this->_contenedor->header($extraHeader));
      View::set('footer',$this->_contenedor->footer($extraFooter));
      // View::set('productos',$productos);
      View::render("validacion_all");
    }

    public function updateSolicitar()
    {
        $documento = new \stdClass();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user_id = $_POST['user_id'];
            $clave = $_POST['clave'];

            $documento->_user_id = $user_id;
            $documento->_clave = $clave;

            // var_dump($documento);
            $id = EstadisticasDao::updateSolicitar($documento);

            if ($id) {
                echo "1";
            } else {
                echo "2";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }

    public function updateSolicitarEstudiante()
    {
        $documento = new \stdClass();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user_id = $_POST['user_id'];
            $clave = $_POST['clave'];

            $documento->_user_id = $user_id;
            $documento->_clave = $clave;

            // var_dump($documento);
            $id = EstadisticasDao::updateSolicitarEstudiante($documento);

            if ($id) {
                echo "1";
            } else {
                echo "2";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }

    public function updateComprobante()
    {
        $documento = new \stdClass();
        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $fecha = $date->format('Y-m-d H:i:s');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user_id = $_POST['user_id'];
            // $id_pendiente_pago = $_POST['id_pendiente_pago'];
            $id_producto = $_POST['id_producto'];
            $clave = $_POST['clave'];

            $documento->_user_id = $user_id;
            $documento->_clave = $clave;
            $documento->_id_producto = $id_producto;
            $documento->_fecha = $fecha;

            $id = EstadisticasDao::updateComprobante($documento);

            if ($id) {
                echo "1";
            } else {
                echo "fail";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }

    public function updateComprobanteEstudiante()
    {
        $documento = new \stdClass();
        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $fecha = $date->format('Y-m-d H:i:s');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user_id = $_POST['user_id'];
            // $id_pendiente_pago = $_POST['id_pendiente_pago'];

            $documento->_user_id = $user_id;
            $documento->_fecha = $fecha;

            $id = EstadisticasDao::updateComprobanteEstudiante($documento);

            if ($id) {
                echo "1";
            } else {
                echo "fail";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }
    

    public function insertarAsignaProducto()
    {
        $documento = new \stdClass();
        $date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
        $fecha = $date->format('Y-m-d H:i:s');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $user_id = $_POST['user_id'];
          $clave = $_POST['clave'];

          $productos = EstadisticasDao::getNombreProductos($clave);
          foreach($productos as $key => $value){

            $id_producto = $value['id_producto'];

            $documento->_user_id = $user_id;
            $documento->_id_producto = $id_producto;
            $documento->_fecha = $fecha;


    
                   $id = EstadisticasDao::insertarAsignaProducto($documento);

         
            }
            if ($id) {
                echo "1";
            } else {
                echo "2";
                // header("Location: /Home/");
            }
        } else {
            echo 'fail REQUEST';
        }
    }

    public function updateSocio()
    {
        $documento = new \stdClass();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $user_id = $_POST['user_id'];
            $documento->_user_id = $user_id;

            $checarSocio = EstadisticasDao::getChecarSocio($user_id);
            if($checarSocio){
            $id = EstadisticasDao::updateSocio($documento);
            if ($id) {
                echo "1";
            } else {
                echo "2";
                // header("Location: /Home/");
            }
          }else{

            }
        } else {
            echo 'fail REQUEST';
        }
    }

    public function getCaja(){
      $fecha = $_POST['fecha'];
      $total = 0;
      $getData = EstadisticasDao::getDataCajaByFecha($fecha);

      if(count($getData) > 0){
        foreach($getData as $key => $value){
          $total += $value['total_pesos'];
        }
      }else{
        $total = 0;
      }

      $data  = [
        'data' => $getData,
        'count' => count($getData),
        'total' => number_format($total,2)
      ];

      echo json_encode($data);
    }

    public function getCajaAll(){
      
      $total = 0;
      $getData = EstadisticasDao::getDataCajaAll();

      if(count($getData) > 0){
        foreach($getData as $key => $value){
          $total += $value['total_pesos'];
        }
      }else{
        $total = 0;
      }

      $data  = [
        'data' => $getData,
        'count' => count($getData),
        'total' => number_format($total,2)
      ];

      echo json_encode($data);
    }


}
