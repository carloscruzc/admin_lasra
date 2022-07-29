<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\PruebasCovidSitio as PruebasCovidSitioDao;
use \App\models\Asistencias as AsistenciasDao;
use \App\models\ComprobantesPago as ComprobantesPagoDao;
use \DateTime;
use \DatetimeZone;
// use \App\models\Linea as LineaDao;

class ComprobantesPago extends Controller
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

    $extraFooter = <<<html
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
    $datos = ComprobantesPagoDao::getAll();


    foreach ($datos as $key => $value) {

      $tabla .= <<<html
      <tr>
        <td>{$value['nombre_usuario']}</td>
        <td id="descripcion_asistencia" width="20">
html;
      $conceptos_a_pagar = ComprobantesPagoDao::getConceptosByUser($value['user_id']);

      foreach ($conceptos_a_pagar as $key => $value) {

        if($value['es_congreso'] == 1 && $value['clave_socio'] == ""){
          $precio = $value['amout_due'];
          // $precio = $value['precio_publico'];
        }elseif($value['es_congreso'] == 1 && $value['clave_socio'] != ""){
            $precio = $value['amout_due'];
        }
        else if($value['es_servicio'] == 1 && $value['clave_socio'] == ""){
            $precio = $value['precio_publico'];
        }else if($value['es_servicio'] == 1 && $value['clave_socio'] != ""){
            $precio = $value['precio_socio'];
        }
        else if($value['es_curso'] == 1  && $value['clave_socio'] == ""){
            $precio = $value['precio_publico'];
        }else if($value['es_curso'] == 1  && $value['clave_socio'] != ""){
            $precio = $value['precio_socio'];
        }

        if ($value['status'] == 0) {
          $icon_status = '<i class="fa fad fa-hourglass" style="color: #4eb8f7;"></i>';
          $status = '<span class="badge badge-info">En espera de validación</span>';
          
        } else if ($value['status'] == 1) {
          $icon_status = '<i class="far fa-check-circle" style="color: #269f61;"></i>';
          $status = '<span class="badge badge-success">Aceptado</span>';
         
        } else {
          $icon_status = '<i class="far fa-times-circle" style="color: red;"></i>';
          $status = '<span class="badge badge-danger">Archivo invalido</span>';
         
        }

        $button_comprobante = '<button class="btn btn-icon-only morado-musa-text text-center btn_ver_comprobante" data-url-archivo="' . $value["url_archivo"] . '" data-user-id="' . $value["user_id"] . '"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ver mi comprobante" data-toggle="modal" data-target="#modal_ver_comprobante"><i class="fas fa-print"> </i></button>';
        

        $tabla .= <<<html

          {$value['nombre']} - {$precio} - {$status}
          <br>
          
html;
      }

      $tabla .= <<<html
        </td>
        <td class="text-center">{$button_comprobante}</td>
      </tr>
 
html;
    }

    $num_asistencias = AsistenciasDao::getNumAsistencias()['total'];
    $date = date("Y") . '-' . date("m") . '-' . date("d");

    $productos = '';
    foreach (AsistenciasDao::getProductos() as $key => $value) {
      $productos .= <<<html
      <option value="{$value['id_producto']}"> {$value['nombre']}</option>
html;
    }


    // View::set('lineas',$lineas);
    View::set('tabla', $tabla);
    View::set('num_asistencias', $num_asistencias);
    View::set('asideMenu', $this->_contenedor->asideMenu());
    View::set('header', $this->_contenedor->header($extraHeader));
    View::set('footer', $this->_contenedor->footer($extraFooter));
    View::set('productos', $productos);
    View::render("comprobantes_all");
  }



  public function cambiarStatus()
  {
    $url_archivo = $_POST['url_archivo'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];


    $getPendientesPago = ComprobantesPagoDao::getPendientesPagoByUrl($user_id, $url_archivo);


    $updateStatus = ComprobantesPagoDao::updateStatusPendientePagoByUrl($status, $url_archivo);


    if ($updateStatus && $status == 1) {

      
      foreach ($getPendientesPago as $key => $value) {
        $getProducto = ComprobantesPagoDao::getAsignaProductoByIdProductAndUser($value['user_id'], $value['id_producto']);

        if (!$getProducto) {

          $data = new \stdClass();
          $data->_user_id = $user_id;
          $data->_id_producto = $value['id_producto'];

          $insertAsiganProducto = ComprobantesPagoDao::insertAsignaProducto($data);

          if($insertAsiganProducto){
            $flag = 1;
          }
        }
      }
    }

    if ($updateStatus && $status == 2) {
      $flag = 1;
    }

    if($flag == 1){
      echo "success";
    }else{
      echo "fail";
    }
  }



  function generateRandomString($length = 6)
  {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }
}
