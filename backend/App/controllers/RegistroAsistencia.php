<?php

namespace App\controllers;

defined("APPPATH") or die("Access denied");
require_once dirname(__DIR__) . '/../public/librerias/mpdf/mpdf.php';
require_once dirname(__DIR__) . '/../public/librerias/fpdf/fpdf.php';
require_once dirname(__DIR__) . '/../public/librerias/phpqrcode/qrlib.php';

use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\RegistroAsistencia as RegistroAsistenciaDao;
use \App\models\Habitaciones as HabitacionesDao;
use \App\models\Asistentes as AsistentesDao;
use \DateTime;
use \DatetimeZone;

class RegistroAsistencia extends Controller
{


    private $_contenedor;

    public function codigo($id)
    {
        $extraHeader = <<<html
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="https://foromusa.com/assets/images/Mus-01.png">
        <link rel="icon" type="image/png" href="https://foromusa.com/assets/images/Mu0-01.png">
        <title>
            Asistencia LASRA
        </title>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="/assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
        <link rel="stylesheet" href="/css/alertify/alertify.core.css" />
        <link rel="stylesheet" href="/css/alertify/alertify.default.css" id="toggleCSS" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

html;
        $extraFooter = <<<html
        <script src="/js/jquery.min.js"></script>
        <script src="/js/validate/jquery.validate.js"></script>
        <script src="/js/alertify/alertify.min.js"></script>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <!--   Core JS Files   -->
        <script src="/assets/js/core/popper.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>
        <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <!-- Kanban scripts -->
        <script src="/assets/js/plugins/dragula/dragula.min.js"></script>
        <script src="/assets/js/plugins/jkanban/jkanban.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="/assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
        
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

        <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

html;

        $codigo = RegistroAsistenciaDao::getById($id);

        $lista_registrados = RegistroAsistenciaDao::getRegistrosAsistenciasNewByCode($id);

        $nombre_asistencia = RegistroAsistenciaDao::getRegistrosAsistenciasNewByCode($id)[0]['nombre_asistencia'];

        $tabla = '';
        foreach ($lista_registrados as $key => $value) {
            $tabla .= <<<html
            <tr>
                <td><b>{$value['nombre_completo']} </b></td>
                <td>
                    <u><a href="mailto:{$value['usuario']}"><span class="fa fa-mail-bulk"> </span> {$value['usuario']}</a></u>
                    <br><br>
                    <u><a href="https://api.whatsapp.com/send?phone=52{$value['telephone']}&text=Buen%20d%C3%ADa,%20te%20contacto%20de%20parte%20del%20Equipo%20Grupo%20LAHE%20%F0%9F%98%80" target="_blank"><span class="fa fa-whatsapp" style="color:green;"> </span> {$value['telephone']}</a></u>
                </td>
                
html;
            if ($value['status'] == 1) {
                $tabla .= <<<html
                <td class="text-center"> 
                    <span class="badge badge-success"> En Tiempo</span>
                    <br>
                    <span>Fecha ingreso: <b>{$value['fecha_alta']}</b></span>
                    <br> 
                    <span>Asistencia a: <b>{$nombre_asistencia}</b></span>
                <td>
                <td>
                    <button class="btn btn-danger " onclick="borrarRegister({$value['id_registro_asistencia']})" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Eliminar Registro de {$value['nombre_completo']}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
html;
            } else if ($value['status'] == 2) {
                $tabla .= <<<html
                <td class="text-center">
                    <span class="badge badge-danger">Fuera del Horario</span>
                    <br>
                    <span>Fecha ingreso: <b>{$value['fecha_alta']}</b></span>
                    <br> 
                    <span>Asistencia a: <b>{$nombre_asistencia}</b></span>
                <td>
                <td>
                    <button class="btn btn-danger " onclick="borrarRegister({$value['id_registro_asistencia']})" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Eliminar Registro de {$value['nombre_completo']}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
html;
            }
        }

        foreach ($codigo as $key => $value) {
            if ($value['id_asistencia'] != '') {
                $flag = true;
                $nombre = $value['nombre'];
                $descripcion = $value['descripcion'];
                $fecha_asistencia = $value['fecha_asistencia'];
                $hora_asistencia_inicio = $value['hora_asistencia_inicio'];
                $hora_asistencia_fin = $value['hora_asistencia_fin'];
            }
        }



        if ($flag == true) {
            View::set('tabla', $tabla);
            View::set('nombre', $nombre);
            View::set('descripcion', $descripcion);
            View::set('nombre_asistencia', $nombre_asistencia);
            View::set('clave_asistencia', $id);
            View::set('fecha_asistencia', $fecha_asistencia);
            View::set('hora_asistencia_inicio', $hora_asistencia_inicio);
            View::set('hora_asistencia_fin', $hora_asistencia_fin);
            View::set('header', $extraHeader);
            View::set('footer', $extraFooter);
            View::render("registro_asistencias_codigo_new");
        } else {
            // View::render("asistencias_panel_registro");
            View::render("asistencias_all_vacia");
        }
    }

    public function mostrarLista($clave)
    {
        $lista_registrados = RegistroAsistenciaDao::getRegistrosAsistenciasByCode($clave);

        echo json_encode($lista_registrados);
    }

    public function borrarRegistrado()
    {

        $id_asistencia = '';
        $dato = $_POST['dato'];
        $delete_registrado = RegistroAsistenciaDao::delete($dato);

        echo json_encode($delete_registrado);
    }

    public function registroAsistencia()
    {

        $clave_user = $_POST['clave_user'];
        $clave_asistencia = $_POST['clave_asistencia'];

        $user_clave = RegistroAsistenciaDao::getInfo($clave_user)[0];
        // $especialidades = RegistroAsistenciaDao::getEspecialidades();
        $asistencia = RegistroAsistenciaDao::getIdRegistrosAsistenciasByCode($clave_asistencia)[0];

        $fecha = new DateTime('now', new DateTimeZone('America/Cancun'));
        $hora_actual = substr($fecha->format(DATE_RFC822), 15, 5);
        $a_tiempo = 1;

        // if (
        //     intval(substr($hora_actual, 0, 2)) > intval(substr($asistencia['hora_asistencia_inicio'], 0, 2))
        //     && intval(substr($hora_actual, 0, 2)) < intval(substr($asistencia['hora_asistencia_fin'], 0, 2))
        // ) {
        //     $a_tiempo = 1;
        //     $aqui = 1;
        // } else if (
        //     intval(substr($hora_actual, 0, 2)) == intval(substr($asistencia['hora_asistencia_fin'], 0, 2))
        //     && intval(substr($hora_actual, 3, 6)) <= intval(substr($asistencia['hora_asistencia_fin'], 3, 6))
        // ) {
        //     $a_tiempo = 1;
        //     $aqui = 2;
        // } else if (
        //     intval(substr($hora_actual, 0, 2)) == intval(substr($asistencia['hora_asistencia_inicio'], 0, 2))
        //     && intval(substr($hora_actual, 3, 6)) >= intval(substr($asistencia['hora_asistencia_inicio'], 3, 6))
        // ) {
        //     $a_tiempo = 1;
        //     $aqui = 3;
        // } else {
        //     $a_tiempo = 2;
        //     $aqui = 4;
        // }

        $asigna_producto = RegistroAsistenciaDao::getAsignaProductoByUser($user_clave['user_id'], $asistencia['id_producto']);
        if ($asigna_producto) {
            $msg_asigna_pro = "";
            $status_asigna_pro = 0;
        } else {
            $msg_asigna_pro = "El usuario no compro este curso";
            $status_asigna_pro = 1;
        }



        if ($user_clave) {
            $hay_asistente = RegistroAsistenciaDao::findAsistantById($user_clave['user_id'], $asistencia['id_asistencia'])[0];
            // if ($hay_asistente) {
            // $msg_insert = 'success_find_assistant';
            // } else {
            $msg_insert = 'fail_not_found_assistant';
            $insert = RegistroAsistenciaDao::addRegister($asistencia['id_asistencia'], $user_clave['user_id'], $a_tiempo);
            // }

            $data = [
                'datos' => $user_clave,
                'status' => 'success',
                'msg_insert' => $msg_insert,
                'hay_asistente' => $hay_asistente,
                'asistencia' => $asistencia,
                'hora_actual' => $hora_actual,
                'a_tiempo' => $a_tiempo,
                'status_asigna_pro' => $status_asigna_pro,
                'msg_asigna_pro' => $msg_asigna_pro,
                // 'aqui' => $aqui,
                'hora_actual' => intval(substr($hora_actual, 0, 2)),
                'hora_fin' => intval(substr($asistencia['hora_asistencia_fin'], 0, 2)),
            ];
        } else {
            $data = [
                'status' => 'fail'
            ];
        }

        echo json_encode($data);
    }



    public function registroAsistenciaCheckin($clave, $code)
    {

        $clave_habitacion = '';
        $id_asigna_habitacion = '';

        $user_clave = RegistroAsistenciaDao::getInfo($clave)[0];
        $linea_principal = RegistroAsistenciaDao::getEspecialidades();
        $bu = RegistroAsistenciaDao::getBu();
        $posiciones = RegistroAsistenciaDao::getPosiciones();
        $asistencia = RegistroAsistenciaDao::getIdRegistrosAsistenciasByCode($code)[0];

        $habitaciones = HabitacionesDao::getAsignaHabitacionByIdRegAcceso($user_clave['id_registro_acceso'])[0];
        if ($habitaciones) {
            $clave_habitacion = $habitaciones['clave'];
            $id_asigna_habitacion = $habitaciones['id_asigna_habitacion'];
            $numero_habitacion = $habitaciones['id_habitacion'];
        }


        $fecha = new DateTime('now', new DateTimeZone('America/Cancun'));
        $hora_actual = substr($fecha->format(DATE_RFC822), 15, 5);
        // $a_tiempo = '';

        if (
            intval(substr($hora_actual, 0, 2)) > intval(substr($asistencia['hora_asistencia_inicio'], 0, 2))
            && intval(substr($hora_actual, 0, 2)) < intval(substr($asistencia['hora_asistencia_fin'], 0, 2))
        ) {
            $a_tiempo = 1;
            $aqui = 1;
        } else if (
            intval(substr($hora_actual, 0, 2)) == intval(substr($asistencia['hora_asistencia_fin'], 0, 2))
            && intval(substr($hora_actual, 3, 6)) <= intval(substr($asistencia['hora_asistencia_fin'], 3, 6))
        ) {
            $a_tiempo = 1;
            $aqui = 2;
        } else if (
            intval(substr($hora_actual, 0, 2)) == intval(substr($asistencia['hora_asistencia_inicio'], 0, 2))
            && intval(substr($hora_actual, 3, 6)) >= intval(substr($asistencia['hora_asistencia_inicio'], 3, 6))
        ) {
            $a_tiempo = 1;
            $aqui = 3;
        } else {
            $a_tiempo = 2;
            $aqui = 4;
        }
        // || substr($hora_actual,0,2) > substr($asistencia['hora_asistencia_fin'],0,2)


        if ($user_clave) {
            $hay_asistente = RegistroAsistenciaDao::findAsistantById($user_clave['utilerias_asistentes_id'], $asistencia['id_asistencia'])[0];
            if ($hay_asistente) {
                $msg_insert = 'success_find_assistant';
            } else {
                $msg_insert = 'fail_not_found_assistant';
                $insert = RegistroAsistenciaDao::addRegister($asistencia['id_asistencia'], $user_clave['utilerias_asistentes_id'], $a_tiempo);
            }

            $data = [
                'datos' => $user_clave,
                'linea_principal' => $linea_principal,
                'bu' => $bu,
                'posiciones' => $posiciones,
                'status' => 'success',
                'msg_insert' => $msg_insert,
                'hay_asistente' => $hay_asistente,
                'asistencia' => $asistencia,
                'hora_actual' => $hora_actual,
                'a_tiempo' => $a_tiempo,
                'aqui' => $aqui,
                'hora_actual' => intval(substr($hora_actual, 0, 2)),
                'hora_fin' => intval(substr($asistencia['hora_asistencia_fin'], 0, 2)),
                'clave_habitacion' => $clave_habitacion,
                'id_asigna_habitacion' => $id_asigna_habitacion,
                'numero_habitacion' => $numero_habitacion,
                'anchor_abrir_pdf' => "<a href='/RegistroAsistencia/abrirpdf/{$user_clave['clave']}' target='_blank' style='display:none;' id='a_abrir_etiqueta'>abrir</a>",
                'anchor_abrir_gafete' => "<a href='/RegistroAsistencia/abrirpdfGafete/{$user_clave['clave']}/{$user_clave['clave_ticket']}' target='_blank' style='display:none;' id='a_abrir_gafete' class='btn btn-info'><i class='fa fal fa-address-card' style='font-size: 18px;'></i>Presione esté botón para descargar el gafete</a>",

            ];
        } else {
            $data = [
                'status' => 'fail'
            ];
        }

        echo json_encode($data);
    }

    public function abrirpdf($clave, $noPages = null)
    {

        $datos_user = AsistentesDao::getRegistroAccesoHabitacionByClaveRA($clave)[0];
        $nombre_completo = strtoupper($datos_user['nombre'] . " " . $datos_user['apellido_paterno'] . " " . $datos_user['apellido_materno']);
        //$nombre_completo = utf8_decode($_POST['nombre']);
        $num_habitacion = $_POST['num_habitacion'];


        $pdf = new \FPDF($orientation = 'L', $unit = 'mm', array(37, 155));

        for ($i = 1; $i <= $noPages; $i++) {


            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 5);    //Letra Arial, negrita (Bold), tam. 20
            $textypos = 5;
            $pdf->setY(2);

            // $pdf->Image('https://convencionasofarma2022.mx/assets/pdf/iMAGEN_aso.png', 1, 0, 150, 40);
            $pdf->SetFont('Arial', '', 5);    //Letra Arial, negrita (Bold), tam. 20

            $pdf->SetXY(9, 8);
            $pdf->SetFont('Times', 'B', 10);
            #4D9A9B
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Multicell(110, 4.2, $nombre_completo . utf8_decode(" #habitación") . " - " . $datos_user['numero_habitacion'], 0, 'C');
            // $pdf->Multicell(120, 4.2, $nombre_completo .utf8_decode(" #habitación") ." - ".$datos_user['numero_habitacion'], 0, 'C');
            // $pdf->Multicell(120, 3.5, $numero_habitacion, 0, 'C');



            $textypos += 6;
            $pdf->setX(2);

            $textypos += 6;
        }

        $pdf->Output();
        // $pdf->Output('F', 'C:/pases_abordar/'. $clave.'.pdf');


    }



    public function abrirpdfGafete($clave, $clave_ticket = null)
    {
        // $this->generaterQr($clave); con qur

        $datos_user = AsistentesDao::getRegistroAccesoByClaveRA($clave)[0];
        $id = $datos_user['user_id'];
        $tipo = '';
        $nombre = html_entity_decode($datos_user['nombre'], ENT_QUOTES, "UTF-8");
        $apellidop = html_entity_decode($datos_user['apellido_paterno'], ENT_QUOTES, "UTF-8");
        $apellidom = html_entity_decode($datos_user['apellido_materno'], ENT_QUOTES, "UTF-8");

        if ($datos_user['categoria_gafete'] == 1 || $datos_user['categoria_gafete'] == 2 || $datos_user['categoria_gafete'] == 3) {
            $nombre_completo = mb_strtoupper($datos_user['title'])." ". mb_strtoupper($nombre) . " " . mb_strtoupper($apellidop) . " " . mb_strtoupper($apellidom);
        }else{
            $nombre_completo =  mb_strtoupper($nombre) . " " . mb_strtoupper($apellidop) . " " . mb_strtoupper($apellidom);
        }
        
        // $nombre_completo = mb_strtoupper($datos_user['nombre']) . "\n\n" . mb_strtoupper($datos_user['apellido_paterno']) . "\n\n" . mb_strtoupper($datos_user['apellido_materno']);

        $nombre_fichero = 'codigos_barras/';

        if (!file_exists($nombre_fichero)) {
            mkdir($nombre_fichero, 0777, true);
        }

        //Crear Codigo de barras
        $this->barcode($nombre_fichero . $clave . ".png", $clave, "20", "horizontal", "code128", true, 1);

        // $user_id = new \stdClass();
        // $user_id->_user_id = $datos_user['user_id'];
        $pdf = new \FPDF($orientation = 'P', $unit = 'mm', array(300, 210));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $pdf->SetFont('Arial', 'B', 16);
        //HABILITAR CODIGO QR ↓↓↓↓
        // $pdf->Image('qrs/gafetes/'.$clave.'.png',70,40,70,0,'PNG');

        if ($datos_user['categoria_gafete'] == 1 || $datos_user['categoria_gafete'] == 2 || $datos_user['categoria_gafete'] == 3) {
            //HABILITAR CODIGO DE BARRAS ↓↓↓↓
            $pdf->Image("codigos_barras/" . $clave . ".png", 84.5, 195, 40, 20);
            $tipo = 'Congreso';
        } else if ($datos_user['categoria_gafete'] == 4) {
            $tipo = 'Expositor';
        } else if ($datos_user['categoria_gafete'] == 5) {
            $tipo = 'Staff';
        }

        $insertImpresionGafete = RegistroAsistenciaDao::insertImpGafete($datos_user['user_id'], $_SESSION['utilerias_administradores_id'], $tipo);


        $pdf->setXY(52, 170);
        $pdf->SetFont('Arial', 'B', 17);
        #4D9A9B
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->SetMargins(32, 25, 30, 10);
        $pdf->Multicell(100, 8, utf8_decode($nombre_completo), 0, 'C');
        // $pdf->Multicell(150.8, 7, utf8_decode($clave), 1, 'C');

        unlink("codigos_barras/" . $clave . ".png"); //Eliminar codigo de barras

        $pdf->output();
    }

    public function abrirpdfGafeteSupras($clave, $clave_ticket = null)
    {
        // $this->generaterQr($clave); con qur

        $datos_user = AsistentesDao::getRegistroAccesoByClaveRA($clave)[0];
        $id = $datos_user['user_id'];
        $tipo = 'Supra';
        $nombre = html_entity_decode($datos_user['nombre'], ENT_QUOTES, "UTF-8");
        $apellidop = html_entity_decode($datos_user['apellido_paterno'], ENT_QUOTES, "UTF-8");
        $apellidom = html_entity_decode($datos_user['apellido_materno'], ENT_QUOTES, "UTF-8");
        $nombre_completo = mb_strtoupper($datos_user['title'])." ".mb_strtoupper($nombre) . " " . mb_strtoupper($apellidop) . " " . mb_strtoupper($apellidom);
        // $nombre_completo = mb_strtoupper($datos_user['nombre']) . "\n\n" . mb_strtoupper($datos_user['apellido_paterno']) . "\n\n" . mb_strtoupper($datos_user['apellido_materno']);

        $nombre_fichero = 'codigos_barras/';

        if (!file_exists($nombre_fichero)) {
            mkdir($nombre_fichero, 0777, true);
        }

        //Crear Codigo de barras
        $this->barcode($nombre_fichero . $clave . ".png", $clave, "20", "horizontal", "code128", true, 1);

        // $user_id = new \stdClass();
        // $user_id->_user_id = $datos_user['user_id'];
        $pdf = new \FPDF($orientation = 'P', $unit = 'mm', array(300, 210));
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $pdf->SetFont('Arial', 'B', 16);
        //HABILITAR CODIGO QR ↓↓↓↓
        // $pdf->Image('qrs/gafetes/'.$clave.'.png',70,40,70,0,'PNG');


        //HABILITAR CODIGO DE BARRAS ↓↓↓↓
        $pdf->Image("codigos_barras/" . $clave . ".png", 84.5, 206, 40, 20);


        $insertImpresionGafete = RegistroAsistenciaDao::insertImpGafete($datos_user['user_id'], $_SESSION['utilerias_administradores_id'], $tipo);


        $pdf->setXY(80, 190);
        $pdf->SetFont('Arial', 'B', 18);
        #4D9A9B
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->SetMargins(30, 25, 30, 10);
        $pdf->Multicell(90, 10, utf8_decode($nombre_completo), 0, 'C');
        // $pdf->Multicell(150.8, 7, utf8_decode($clave), 1, 'C');

        unlink("codigos_barras/" . $clave . ".png"); //Eliminar codigo de barras

        $pdf->output();
    }

    function barcode($filepath = "", $text = "0", $size = "20", $orientation = "horizontal", $code_type = "code128", $print = false, $SizeFactor = 1)
    {
        $code_string = "";
        // Translate the $text into barcode the correct $code_type
        if (in_array(strtolower($code_type), array("code128", "code128b"))) {
            $chksum = 104;
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "\`" => "111422", "a" => "121124", "b" => "121421", "c" => "141122", "d" => "141221", "e" => "112214", "f" => "112412", "g" => "122114", "h" => "122411", "i" => "142112", "j" => "142211", "k" => "241211", "l" => "221114", "m" => "413111", "n" => "241112", "o" => "134111", "p" => "111242", "q" => "121142", "r" => "121241", "s" => "114212", "t" => "124112", "u" => "124211", "v" => "411212", "w" => "421112", "x" => "421211", "y" => "212141", "z" => "214121", "{" => "412121", "|" => "111143", "}" => "111341", "~" => "131141", "DEL" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "FNC 4" => "114131", "CODE A" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ($X = 1; $X <= strlen($text); $X++) {
                $activeKey = substr($text, ($X - 1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum = ($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211214" . $code_string . "2331112";
        } elseif (strtolower($code_type) == "code128a") {
            $chksum = 103;
            $text = strtoupper($text); // Code 128A doesn't support lower case
            // Must not change order of array elements as the checksum depends on the array's key to validate final code
            $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "NUL" => "111422", "SOH" => "121124", "STX" => "121421", "ETX" => "141122", "EOT" => "141221", "ENQ" => "112214", "ACK" => "112412", "BEL" => "122114", "BS" => "122411", "HT" => "142112", "LF" => "142211", "VT" => "241211", "FF" => "221114", "CR" => "413111", "SO" => "241112", "SI" => "134111", "DLE" => "111242", "DC1" => "121142", "DC2" => "121241", "DC3" => "114212", "DC4" => "124112", "NAK" => "124211", "SYN" => "411212", "ETB" => "421112", "CAN" => "421211", "EM" => "212141", "SUB" => "214121", "ESC" => "412121", "FS" => "111143", "GS" => "111341", "RS" => "131141", "US" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "CODE B" => "114131", "FNC 4" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
            $code_keys = array_keys($code_array);
            $code_values = array_flip($code_keys);
            for ($X = 1; $X <= strlen($text); $X++) {
                $activeKey = substr($text, ($X - 1), 1);
                $code_string .= $code_array[$activeKey];
                $chksum = ($chksum + ($code_values[$activeKey] * $X));
            }
            $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

            $code_string = "211412" . $code_string . "2331112";
        } elseif (strtolower($code_type) == "code39") {
            $code_array = array("0" => "111221211", "1" => "211211112", "2" => "112211112", "3" => "212211111", "4" => "111221112", "5" => "211221111", "6" => "112221111", "7" => "111211212", "8" => "211211211", "9" => "112211211", "A" => "211112112", "B" => "112112112", "C" => "212112111", "D" => "111122112", "E" => "211122111", "F" => "112122111", "G" => "111112212", "H" => "211112211", "I" => "112112211", "J" => "111122211", "K" => "211111122", "L" => "112111122", "M" => "212111121", "N" => "111121122", "O" => "211121121", "P" => "112121121", "Q" => "111111222", "R" => "211111221", "S" => "112111221", "T" => "111121221", "U" => "221111112", "V" => "122111112", "W" => "222111111", "X" => "121121112", "Y" => "221121111", "Z" => "122121111", "-" => "121111212", "." => "221111211", " " => "122111211", "$" => "121212111", "/" => "121211121", "+" => "121112121", "%" => "111212121", "*" => "121121211");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for ($X = 1; $X <= strlen($upper_text); $X++) {
                $code_string .= $code_array[substr($upper_text, ($X - 1), 1)] . "1";
            }

            $code_string = "1211212111" . $code_string . "121121211";
        } elseif (strtolower($code_type) == "code25") {
            $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
            $code_array2 = array("3-1-1-1-3", "1-3-1-1-3", "3-3-1-1-1", "1-1-3-1-3", "3-1-3-1-1", "1-3-3-1-1", "1-1-1-3-3", "3-1-1-3-1", "1-3-1-3-1", "1-1-3-3-1");

            for ($X = 1; $X <= strlen($text); $X++) {
                for ($Y = 0; $Y < count($code_array1); $Y++) {
                    if (substr($text, ($X - 1), 1) == $code_array1[$Y])
                        $temp[$X] = $code_array2[$Y];
                }
            }

            for ($X = 1; $X <= strlen($text); $X += 2) {
                if (isset($temp[$X]) && isset($temp[($X + 1)])) {
                    $temp1 = explode("-", $temp[$X]);
                    $temp2 = explode("-", $temp[($X + 1)]);
                    for ($Y = 0; $Y < count($temp1); $Y++)
                        $code_string .= $temp1[$Y] . $temp2[$Y];
                }
            }

            $code_string = "1111" . $code_string . "311";
        } elseif (strtolower($code_type) == "codabar") {
            $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-", "$", ":", "/", ".", "+", "A", "B", "C", "D");
            $code_array2 = array("1111221", "1112112", "2211111", "1121121", "2111121", "1211112", "1211211", "1221111", "2112111", "1111122", "1112211", "1122111", "2111212", "2121112", "2121211", "1121212", "1122121", "1212112", "1112122", "1112221");

            // Convert to uppercase
            $upper_text = strtoupper($text);

            for ($X = 1; $X <= strlen($upper_text); $X++) {
                for ($Y = 0; $Y < count($code_array1); $Y++) {
                    if (substr($upper_text, ($X - 1), 1) == $code_array1[$Y])
                        $code_string .= $code_array2[$Y] . "1";
                }
            }
            $code_string = "11221211" . $code_string . "1122121";
        }

        // Pad the edges of the barcode
        $code_length = 20;
        if ($print) {
            $text_height = 30;
        } else {
            $text_height = 0;
        }

        for ($i = 1; $i <= strlen($code_string); $i++) {
            $code_length = $code_length + (int)(substr($code_string, ($i - 1), 1));
        }

        if (strtolower($orientation) == "horizontal") {
            $img_width = $code_length * $SizeFactor;
            $img_height = $size;
        } else {
            $img_width = $size;
            $img_height = $code_length * $SizeFactor;
        }

        $image = imagecreate($img_width, $img_height + $text_height);
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);

        imagefill($image, 0, 0, $white);
        if ($print) {
            imagestring($image, 5, 31, $img_height, $text, $black);
        }

        $location = 10;
        for ($position = 1; $position <= strlen($code_string); $position++) {
            $cur_size = $location + (substr($code_string, ($position - 1), 1));
            if (strtolower($orientation) == "horizontal")
                imagefilledrectangle($image, $location * $SizeFactor, 0, $cur_size * $SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black));
            else
                imagefilledrectangle($image, 0, $location * $SizeFactor, $img_width, $cur_size * $SizeFactor, ($position % 2 == 0 ? $white : $black));
            $location = $cur_size;
        }

        // Draw barcode to the screen or save in a file
        if ($filepath == "") {
            header('Content-type: image/png');
            imagepng($image);
            imagedestroy($image);
        } else {
            imagepng($image, $filepath);
            imagedestroy($image);
        }
    }



    public function generaterQr($clave_ticket)
    {

        // $id_constancia = $_POST['id_constancia'];
        // $user_id = $_SESSION['utilerias_asistentes_id'];

        // var_dump($user_id);
        //Eliminar los archivos del servidor
        //$this->deleteFiles($id_constancia);


        // $codigo_rand = $this->generateRandomString();
        $codigo_rand = $clave_ticket;

        $config = array(
            'ecc' => 'H',    // L-smallest, M, Q, H-best
            'size' => 11,    // 1-50
            'dest_file' => '../public/qrs/gafetes/' . $codigo_rand . '.png',
            'quality' => 90,
            'logo' => 'logo.jpg',
            'logo_size' => 100,
            'logo_outline_size' => 20,
            'logo_outline_color' => '#FFFF00',
            'logo_radius' => 15,
            'logo_opacity' => 100,
        );

        // Contenido del código QR
        $data = $codigo_rand;

        // Crea una clase de código QR
        $oPHPQRCode = new PHPQRCode();

        // establecer configuración
        $oPHPQRCode->set_config($config);

        // Crea un código QR
        $qrcode = $oPHPQRCode->generate($data);

        //   $url = explode('/', $qrcode );
    }
}


class PHPQRCode
{ // class start

    /** Configuración predeterminada */
    private $_config = array(
        'ecc' => 'H',                       // Calidad del código QR L-menor, M, Q, H-mejor
        'size' => 15,                       // Tamaño del código QR 1-50
        'dest_file' => '',        // Ruta de código QR creada
        'quality' => 100,                    // Calidad de imagen
        'logo' => '',                       // Ruta del logotipo, vacío significa que no hay logotipo
        'logo_size' => null,                // tamaño del logotipo, nulo significa que se calcula automáticamente de acuerdo con el tamaño del código QR
        'logo_outline_size' => null,        // Tamaño del trazo del logotipo, nulo significa que se calculará automáticamente de acuerdo con el tamaño del logotipo
        'logo_outline_color' => '#FFFFFF',  // color del trazo del logo
        'logo_opacity' => 100,              // opacidad del logo 0-100
        'logo_radius' => 0,                 // ángulo de empalme del logo 0-30
    );


    public function set_config($config)
    {

        // Permitir configurar la configuración
        $config_keys = array_keys($this->_config);

        // Obtenga la configuración entrante y escriba la configuración
        foreach ($config_keys as $k => $v) {
            if (isset($config[$v])) {
                $this->_config[$v] = $config[$v];
            }
        }
    }

    /**
     * Crea un código QR
     * @param    Contenido del código QR String $ data
     * @return String
     */
    public function generate($data)
    {

        // Crea una imagen de código QR temporal
        $tmp_qrcode_file = $this->create_qrcode($data);

        // Combinar la imagen del código QR temporal y la imagen del logotipo
        $this->add_logo($tmp_qrcode_file);

        // Eliminar la imagen del código QR temporal
        if ($tmp_qrcode_file != '' && file_exists($tmp_qrcode_file)) {
            unlink($tmp_qrcode_file);
        }

        return file_exists($this->_config['dest_file']) ? $this->_config['dest_file'] : '';
    }

    /**
     * Crea una imagen de código QR temporal
     * @param    Contenido del código QR String $ data
     * @return String
     */
    private function create_qrcode($data)
    {

        // Imagen de código QR temporal
        $tmp_qrcode_file = dirname(_FILE) . '/tmp_qrcode' . time() . mt_rand(100, 999) . '.png';

        // Crea un código QR temporal
        \QRcode::png($data, $tmp_qrcode_file, $this->_config['ecc'], $this->_config['size'], 2);

        // Regresar a la ruta temporal del código QR
        return file_exists($tmp_qrcode_file) ? $tmp_qrcode_file : '';
    }

    /**
     * Combinar imágenes de códigos QR temporales e imágenes de logotipos
     * @param  String $ tmp_qrcode_file Imagen de código QR temporal
     */
    private function add_logo($tmp_qrcode_file)
    {

        // Crear carpeta de destino
        $this->create_dirs(dirname($this->_config['dest_file']));

        // Obtener el tipo de imagen de destino
        $dest_ext = $this->get_file_ext($this->_config['dest_file']);

        // Necesito agregar logo
        if (file_exists($this->_config['logo'])) {

            // Crear objeto de imagen de código QR temporal
            $tmp_qrcode_img = imagecreatefrompng($tmp_qrcode_file);

            // Obtener el tamaño de la imagen del código QR temporal
            list($qrcode_w, $qrcode_h, $qrcode_type) = getimagesize($tmp_qrcode_file);

            // Obtener el tamaño y el tipo de la imagen del logotipo
            list($logo_w, $logo_h, $logo_type) = getimagesize($this->_config['logo']);

            // Crea un objeto de imagen de logo
            switch ($logo_type) {
                case 1:
                    $logo_img = imagecreatefromgif($this->_config['logo']);
                    break;
                case 2:
                    $logo_img = imagecreatefromjpeg($this->_config['logo']);
                    break;
                case 3:
                    $logo_img = imagecreatefrompng($this->_config['logo']);
                    break;
                default:
                    return '';
            }

            // Establezca el tamaño combinado de la imagen del logotipo, si no se establece, se calculará automáticamente de acuerdo con la proporción
            $new_logo_w = isset($this->_config['logo_size']) ? $this->_config['logo_size'] : (int)($qrcode_w / 5);
            $new_logo_h = isset($this->_config['logo_size']) ? $this->_config['logo_size'] : (int)($qrcode_h / 5);

            // Ajusta la imagen del logo según el tamaño establecido
            $new_logo_img = imagecreatetruecolor($new_logo_w, $new_logo_h);
            imagecopyresampled($new_logo_img, $logo_img, 0, 0, 0, 0, $new_logo_w, $new_logo_h, $logo_w, $logo_h);

            // Determinar si se necesita un golpe
            if (!isset($this->_config['logo_outline_size']) || $this->_config['logo_outline_size'] > 0) {
                list($new_logo_img, $new_logo_w, $new_logo_h) = $this->image_outline($new_logo_img);
            }

            // Determine si se necesitan esquinas redondeadas
            if ($this->_config['logo_radius'] > 0) {
                $new_logo_img = $this->image_fillet($new_logo_img);
            }

            // Combinar logotipo y código QR temporal
            $pos_x = ($qrcode_w - $new_logo_w) / 2;
            $pos_y = ($qrcode_h - $new_logo_h) / 2;

            imagealphablending($tmp_qrcode_img, true);

            // Combinar las imágenes y mantener su transparencia
            $dest_img = $this->imagecopymerge_alpha($tmp_qrcode_img, $new_logo_img, $pos_x, $pos_y, 0, 0, $new_logo_w, $new_logo_h, $this->_config['logo_opacity']);

            // Generar imagen
            switch ($dest_ext) {
                case 1:
                    imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']);
                    break;
                case 2:
                    imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']);
                    break;
                case 3:
                    imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality'] - 1) / 10));
                    break;
            }

            // No es necesario agregar logo
        } else {

            $dest_img = imagecreatefrompng($tmp_qrcode_file);

            // Generar imagen
            switch ($dest_ext) {
                case 1:
                    imagegif($dest_img, $this->_config['dest_file'], $this->_config['quality']);
                    break;
                case 2:
                    imagejpeg($dest_img, $this->_config['dest_file'], $this->_config['quality']);
                    break;
                case 3:
                    imagepng($dest_img, $this->_config['dest_file'], (int)(($this->_config['quality'] - 1) / 10));
                    break;
            }
        }
    }

    /**
     * Acaricia el objeto de la imagen
     * @param    Objeto de imagen Obj $ img
     * @return Array
     */
    private function image_outline($img)
    {

        // Obtener ancho y alto de la imagen
        $img_w = imagesx($img);
        $img_h = imagesy($img);

        // Calcula el tamaño del trazo, si no está configurado, se calculará automáticamente de acuerdo con la proporción
        $bg_w = isset($this->_config['logo_outline_size']) ? intval($img_w + $this->_config['logo_outline_size']) : $img_w + (int)($img_w / 5);
        $bg_h = isset($this->_config['logo_outline_size']) ? intval($img_h + $this->_config['logo_outline_size']) : $img_h + (int)($img_h / 5);

        // Crea un objeto de mapa base
        $bg_img = imagecreatetruecolor($bg_w, $bg_h);

        // Establecer el color del mapa base
        $rgb = $this->hex2rgb($this->_config['logo_outline_color']);
        $bgcolor = imagecolorallocate($bg_img, $rgb['r'], $rgb['g'], $rgb['b']);

        // Rellena el color del mapa base
        imagefill($bg_img, 0, 0, $bgcolor);

        // Combina la imagen y el mapa base para lograr el efecto de trazo
        imagecopy($bg_img, $img, (int)(($bg_w - $img_w) / 2), (int)(($bg_h - $img_h) / 2), 0, 0, $img_w, $img_h);

        $img = $bg_img;

        return array($img, $bg_w, $bg_h);
    }


    private function image_fillet($img)
    {

        // Obtener ancho y alto de la imagen
        $img_w = imagesx($img);
        $img_h = imagesy($img);

        // Crea un objeto de imagen con esquinas redondeadas
        $new_img = imagecreatetruecolor($img_w, $img_h);

        // guarda el canal transparente
        imagesavealpha($new_img, true);

        // Rellena la imagen con esquinas redondeadas
        $bg = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
        imagefill($new_img, 0, 0, $bg);

        // Radio de redondeo
        $r = $this->_config['logo_radius'];

        // Realizar procesamiento de esquinas redondeadas
        for ($x = 0; $x < $img_w; $x++) {
            for ($y = 0; $y < $img_h; $y++) {
                $rgb = imagecolorat($img, $x, $y);

                // No en las cuatro esquinas de la imagen, dibuja directamente
                if (($x >= $r && $x <= ($img_w - $r)) || ($y >= $r && $y <= ($img_h - $r))) {
                    imagesetpixel($new_img, $x, $y, $rgb);

                    // En las cuatro esquinas de la imagen, elige dibujar
                } else {
                    // arriba a la izquierda
                    $ox = $r; // centro x coordenada
                    $oy = $r; // centro coordenada y
                    if ((($x - $ox) * ($x - $ox) + ($y - $oy) * ($y - $oy)) <= ($r * $r)) {
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // parte superior derecha
                    $ox = $img_w - $r; // centro x coordenada
                    $oy = $r;        // centro coordenada y
                    if ((($x - $ox) * ($x - $ox) + ($y - $oy) * ($y - $oy)) <= ($r * $r)) {
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // abajo a la izquierda
                    $ox = $r;        // centro x coordenada
                    $oy = $img_h - $r; // centro coordenada y
                    if ((($x - $ox) * ($x - $ox) + ($y - $oy) * ($y - $oy)) <= ($r * $r)) {
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }

                    // abajo a la derecha
                    $ox = $img_w - $r; // centro x coordenada
                    $oy = $img_h - $r; // centro coordenada y
                    if ((($x - $ox) * ($x - $ox) + ($y - $oy) * ($y - $oy)) <= ($r * $r)) {
                        imagesetpixel($new_img, $x, $y, $rgb);
                    }
                }
            }
        }

        return $new_img;
    }

    // Combinar las imágenes y mantener su transparencia
    private function imagecopymerge_alpha($dest_img, $src_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity)
    {

        $w = imagesx($src_img);
        $h = imagesy($src_img);

        $tmp_img = imagecreatetruecolor($src_w, $src_h);

        imagecopy($tmp_img, $dest_img, 0, 0, $pos_x, $pos_y, $src_w, $src_h);
        imagecopy($tmp_img, $src_img, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dest_img, $tmp_img, $pos_x, $pos_y, $src_x, $src_y, $src_w, $src_h, $opacity);

        return $dest_img;
    }


    private function create_dirs($path)
    {

        if (!is_dir($path)) {
            return mkdir($path, 0777, true);
        }

        return true;
    }


    private function hex2rgb($hexcolor)
    {
        $color = str_replace('#', '', $hexcolor);
        if (strlen($color) > 3) {
            $rgb = array(
                'r' => hexdec(substr($color, 0, 2)),
                'g' => hexdec(substr($color, 2, 2)),
                'b' => hexdec(substr($color, 4, 2))
            );
        } else {
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = array(
                'r' => hexdec($r),
                'g' => hexdec($g),
                'b' => hexdec($b)
            );
        }
        return $rgb;
    }


    private function get_file_ext($file)
    {
        $filename = basename($file);
        list($name, $ext) = explode('.', $filename);

        $ext_type = 0;

        switch (strtolower($ext)) {
            case 'jpg':
            case 'jpeg':
                $ext_type = 2;
                break;
            case 'gif':
                $ext_type = 1;
                break;
            case 'png':
                $ext_type = 3;
                break;
        }

        return $ext_type;
    }
} // class end