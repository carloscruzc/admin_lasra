<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");
require_once dirname(__DIR__) . '/../public/librerias/mpdf/mpdf.php';
require_once dirname(__DIR__) . '/../public/librerias/fpdf/fpdf.php';
require_once dirname(__DIR__) . '/../public/librerias/phpqrcode/qrlib.php';

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \App\controllers\EnLetras;
use \Core\Controller;
use \App\models\PruebasCovidSitio as PruebasCovidSitioDao;
use \App\models\Asistencias as AsistenciasDao;
use \App\models\Conceptos as ConceptosDao;
use \App\models\ComprobantesCaja as ComprobantesCajaDao;
use \App\models\Caja as CajaDao;
use \DateTime;
use \DatetimeZone;
// use \App\models\Linea as LineaDao;

class ComprobantesCaja extends Controller
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
    $datos = ComprobantesCajaDao::getAll();
    $total_pesos = 0;


    foreach ($datos as $key => $value) {
      $tipo_pago = str_replace("_", " ", $value['tipo_pago']);

      $tabla .= <<<html
      <tr>
        <td>{$value['id_transaccion_compra']}</td>
        <td>{$value['nombre_user']}</td>
        <td id="descripcion_asistencia" width="20">{$value['productos']}</td>
        <td class="text-center">{$value['total_pesos']}</td>
        <td class="text-center">{$tipo_pago}</td>         
        <td class="text-center">{$value['fecha_transaccion']}</td> 
        <td class="text-center">{$value['nombre_caja']}</td>
        <td class="text-center">
        <a href='/ComprobantesCaja/print/{$value['id_transaccion_compra']}' style='' class='btn btn-icon-only btn-info' value={$value['id_registrado']} data-bs-toggle="tooltip" target="_blank" data-bs-placement="left" data-bs-original-title="ver comprobante"><i class="fa fal fa-file"></i></a>
        </td>
      </tr>
 
html;

      $total_pesos += $value['total_pesos'];
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
    View::set('total_pesos', $total_pesos);
    View::set('tabla', $tabla);
    View::set('num_asistencias', $num_asistencias);
    View::set('asideMenu', $this->_contenedor->asideMenu());
    View::set('header', $this->_contenedor->header($extraHeader));
    View::set('footer', $this->_contenedor->footer($extraFooter));
    View::set('productos', $productos);
    View::render("comprobante_caja_all");
  }

  public function comprobantes()
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
    $datos = ComprobantesCajaDao::getAll();
    $total_pesos = 0;
    $total_dolares = 0;


    foreach ($datos as $key => $value) {

      $tipo_pago = str_replace("_", " ", $value['tipo_pago']);

      $tipo_pago_moneda = $value['tipo_pago_moneda'];

      if ($tipo_pago_moneda == "MXN") {
        $total = $value['total_pesos'];
        $total_pesos += $value['total_pesos'];
      } else if ($tipo_pago_moneda == "USD") {
        $total = $value['total_dolares'];
        $total_dolares += $value['total_dolares'];
      }

      $tabla .= <<<html
      <tr>
        <td>{$value['id_transaccion_compra']}</td>
        <td>{$value['nombre_user']}</td>
        <td id="descripcion_asistencia" width="20">{$value['productos']}</td>
        <td class="text-center">{$total}</td> 
        <td class="text-center">$tipo_pago_moneda</td> 
        <td class="text-center">$tipo_pago</td>              
        <td class="text-center">{$value['fecha_transaccion']}</td> 
        <td class="text-center">{$value['nombre_caja']}</td>
        <td class="text-center">
        <a href='/ComprobantesCaja/print/{$value['id_transaccion_compra']}' style='' class='btn btn-icon-only btn-info' value={$value['id_registrado']} data-bs-toggle="tooltip" target="_blank" data-bs-placement="left" data-bs-original-title="ver comprobante"><i class="fa fal fa-file"></i></a>
        </td>
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


    View::set('total_pesos', $total_pesos);
    View::set('total_dolares', $total_dolares);
    View::set('tabla', $tabla);
    View::set('num_asistencias', $num_asistencias);
    View::set('ventas_totales', count($datos));
    // View::set('asideMenu',$this->_contenedor->asideMenu());
    View::set('header', $this->_contenedor->header($extraHeader));
    View::set('footer', $this->_contenedor->footer($extraFooter));
    View::set('productos', $productos);
    View::render("comprobante_caja_all_caja");
  }

  public function print($id_transaccion)
  {
    date_default_timezone_set('America/Mexico_City');

    // $this->generaterQr($clave);

    $productos = CajaDao::getTransaccion($id_transaccion);

    $datos_user = CajaDao::getDataUser($productos['user_id']);
    $user_id = $datos_user['user_id'];


    $reference = $productos['referencia_transaccion'];
    $fecha = $productos['fecha_transaccion'];
    $tipo_pago = $productos['tipo_pago'];
    $id_transaccion = $productos['id_transaccion_compra'];
    $num_operacion = $productos['num_operacion'];
    $tipo_moneda = $productos['tipo_pago_moneda'];


    if (strlen($id_transaccion) == 1) {
      $ini_folio = '000';
    } elseif (strlen($id_transaccion) == 2) {
      $ini_folio = '00';
    } elseif (strlen($id_transaccion) == 3) {
      $ini_folio = '0';
    } else {
      $ini_folio = '';
    }

    $nombre_completo = $datos_user['nombre'] . " " . $datos_user['apellidop'] . "\n " . $datos_user['apellidom'];



    $pdf = new \FPDF($orientation = 'P', $unit = 'mm', $format = 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
    $pdf->setY(1);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Image('plantillas/orden_ori.jpeg', 0, 0, 210, 300);


    //$pdf->Image('1.png', 1, 0, 190, 190);
    $pdf->SetFont('Arial', 'B', 5);    //Letra Arial, negrita (Bold), tam. 20


    $espace = 135;
    $total = array();
    $pro = explode(",", $productos['productos']);


    foreach ($pro as $key => $value) {

      // $total_productos = CajaDao::getCountProductos($user_id,2)[0];

      // $count_productos = $total_productos['numero_productos'];

      $pro_precio = explode("-", $value);
      $cantidad = $pro_precio[0];
      $solo_precio = explode("$", $pro_precio[2]); //precio unitario producto
      $solo_precio_usd = explode("$", $pro_precio[3]); //precio unitario producto usd
      $cantidad = explode(".", $pro_precio[0]);
      $solo_cantidad = $cantidad[1]; //cantidad de compra

      // echo number_format($solo_precio[1],2);

      $precio_mostrar = 0;
      $total = 0;

      if ($tipo_moneda == "MXN") {
        $precio_mostrar = $solo_precio[1];
        $total = $productos['total_pesos'];
        $complemeto_total_letras = 'pesos 00/100 M.N.';
      } else if ($tipo_moneda == "USD") {
        $precio_mostrar = $solo_precio_usd[1];
        $total = $productos['total_dolares'];
        $complemeto_total_letras = 'USD.';
      }


      //Nombre Curso
      $pdf->SetXY(22, $espace);
      $pdf->SetFont('Arial', 'B', 8);
      $pdf->SetTextColor(94, 94, 94);
      $pdf->Multicell(100, 4, utf8_decode($pro_precio[1]), 0, 'C');

      //Costo
      $pdf->SetXY(103, $espace);
      $pdf->SetFont('Arial', 'B', 8);
      $pdf->SetTextColor(94, 94, 94);
      $pdf->Multicell(100, 4, number_format($precio_mostrar, 2) ." ".$tipo_moneda, 0, 'C');

      //Cantidad
      $pdf->SetXY(18, $espace);
      $pdf->SetFont('Arial', 'B', 8);
      $pdf->SetTextColor(94, 94, 94);
      $pdf->Multicell(20, 4, $solo_cantidad, 0, 'C');

      //Total
      $pdf->SetXY(138, $espace);
      $pdf->SetFont('Arial', 'B', 8);
      $pdf->SetTextColor(94, 94, 94);
      $pdf->Multicell(100, 4, number_format(($precio_mostrar * $solo_cantidad), 2) ." ".$tipo_moneda, 0, 'C');

      $espace = $espace + 6;
    }

    $tipo_cambio = CajaDao::getTipoCambio()['tipo_cambio'];

    if (!empty($num_operacion)) {

      //num operacion
      $pdf->SetXY(100, 60);
      $pdf->SetFont('Arial', 'B', 13);
      $pdf->SetTextColor(94, 94, 94);
      $pdf->Multicell(98, 10, utf8_decode('Número de Transacción : ') . $num_operacion, 0, 'C');
    }


     //folio
     $pdf->SetXY(5, 75);
     $pdf->SetFont('Arial', 'B', 13);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(100, 10, $ini_folio . $id_transaccion, 0, 'C');

     //fecha
     $pdf->SetXY(10, 110);
     $pdf->SetFont('Arial', 'B', 13);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(100, 10, $fecha, 0, 'C');

     //Nombre
     $pdf->SetXY(149, 79);
     $pdf->SetFont('Arial', 'B', 9);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 6, utf8_decode($nombre_completo), 0, 'L');

     //correo
     $pdf->SetXY(149, 85);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 10, utf8_decode($datos_user['direccion']), 0, 'L');

     //Nombre empresa
     $pdf->SetXY(149, 92);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 10, utf8_decode($datos_user['business_name_iva']), 0, 'L');

     //RFC
     $pdf->SetXY(149, 97);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 10, utf8_decode($datos_user['code_iva']), 0, 'L');

     //correo
     $pdf->SetXY(149, 103);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 10, utf8_decode($datos_user['email_receipt_iva']), 0, 'L');

     //correo
     $pdf->SetXY(149, 107);
     $pdf->SetFont('Arial', 'B', 10);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(55, 10, utf8_decode($datos_user['postal_code_iva']), 0, 'L');



     $letras = new EnLetras();
     $TotalLetra = $total;
     $total_en_letras = $letras->ValorEnLetras($TotalLetra, $complemeto_total_letras);


     //total 
     $pdf->SetXY(138, 248);
     $pdf->SetFont('Arial', 'B', 13);
     $pdf->SetTextColor(0, 0, 0);
     $pdf->Multicell(100, 10, '$ ' . number_format($total, 2) . '', 0, 'C');

     //total  letra
     $pdf->SetXY(5, 240);
     $pdf->SetFont('Arial', 'B', 13);
     $pdf->SetTextColor(94, 94, 94);
     $pdf->Multicell(120, 5, $total_en_letras, 0, 'C');

    if ($tipo_pago == "Tarjeta_Credito") {

      //tipo pago
      $pdf->SetXY(22, 208);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->Multicell(100, 10, '$ ' . number_format($total, 2) . '', 0, 'C');
    } else if ($tipo_pago == "Tarjeta_Debito") {

      //tipo pago
      $pdf->SetXY(26, 211.5);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->Multicell(100, 10, '$ ' . number_format($total, 2) . '', 0, 'C');
    } else if ($tipo_pago == "Efectivo") {

      //tipo pago
      $pdf->SetXY(12, 201);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->Multicell(100, 10, '$ ' . number_format($total, 2) . '', 0, 'C');
    } else if ($tipo_pago == "Transferencia") {

      //tipo pago
      $pdf->SetXY(22, 208);
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->SetTextColor(0, 0, 0);
      $pdf->Multicell(100, 10, '$ ' . number_format($total, 2) . '', 0, 'C');
    }

    //tipo pago
    // $pdf->SetXY(125, 265);
    // $pdf->SetFont('Arial', 'B', 13);  
    // $pdf->SetTextColor(0, 0, 0);
    // $pdf->Multicell(100, 10, $tipo_pago, 0, 'C');

    //imagen Qr
    // $pdf->Image('qrs/'.$clave.'.png' , 152 ,245, 35 , 38,'PNG');


    $pdf->Output();
    // $pdf->Output('F','constancias/'.$clave.$id_curso.'.pdf');

    // $pdf->Output('F', 'C:/pases_abordar/'. $clave.'.pdf');
  }


  public function conceptosAdd()
  {

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio_publico'];

    $data = new \stdClass();
    $data->_clave = $this->generateRandomString();
    $data->_nombre = $nombre;
    $data->_descripcion = $descripcion;
    $data->_tipo = $tipo;
    $data->_precio = $precio;

    $id = ConceptosDao::insert($data);
    if ($id >= 1) {
      // $this->alerta($id,'add');
      echo '<script>
          alert("Concepto Registrada con exito");
          window.location.href = "/Conceptos";
        </script>';
    } else {
      // $this->alerta($id,'error');
      echo '<script>
        alert("Error al registrar el concepto, consulte a soporte");
        window.location.href = "/Conceptos";
      </script>';
    }
  }


  public function deleteProduct()
  {
    $id_producto = $_POST['id_producto'];

    $delete = ConceptosDao::deleteProducto($id_producto);

    if ($delete) {
      echo "success";
    } else {
      echo "fail";
    }
  }



  function generateRandomString($length = 6)
  {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
  }

  // View::set('permisoGlobalHidden', $permisoGlobalHidden);
  // View::set('asistentesHidden', $asistentesHidden);
  // View::set('vuelosHidden', $vuelosHidden);
  // View::set('pickUpHidden', $pickUpHidden);
  // View::set('habitacionesHidden', $habitacionesHidden);
  // View::set('cenasHidden', $cenasHidden);
  // View::set('aistenciasHidden', $aistenciasHidden);
  // View::set('vacunacionHidden', $vacunacionHidden);
  // View::set('pruebasHidden', $pruebasHidden);
  // View::set('configuracionHidden', $configuracionHidden);
  // View::set('utileriasHidden', $utileriasHidden);
  // View::set('header', $this->_contenedor->header($extraHeader));
  // View::set('footer', $this->_contenedor->footer($extraFooter));
  // View::render("asistencias_all");

}
