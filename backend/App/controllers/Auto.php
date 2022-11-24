<?php

namespace App\controllers;
//defined("APPPATH") OR die("Access denied");
require_once dirname(__DIR__) . '/../public/librerias/fpdf/fpdf.php';
require_once dirname(__DIR__) . '/../public/librerias/phpqrcode/qrlib.php';


use \Core\View;
use \Core\MasterDom;
use \App\controllers\Contenedor;
use \Core\Controller;
use \App\models\General as GeneralDao;
use \App\models\Asistentes as AsistentesDao;
use \App\models\Asistencias as AsistenciasDao;
use \App\models\RegistroAsistencia as RegistroAsistenciaDao;
use \App\models\Caja as CajaDao;


use Generator;

class Auto
{


    public function index()
    {

        $extraHeader = <<<html
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/logo_lasra.png">
        <link rel="icon" type="image/png" href="/assets/img/logo_lasra.png">
        <title>
            CONSTANCIAS - LASRA 
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

       <!-- <script src="http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />-->
        
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

        <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

html;

        $cfdi = '';
        foreach (CajaDao::getCfdi() as $key => $value) {
            // $cfdi = ($value['id_pais'] == $userData['id_pais']) ? 'selected' : '';  
            $cfdi .= <<<html
                    <option value="{$value['id_uso_cfdi']}">{$value['clave_uso_cfdi']} - {$value['descripcion_uso_cfdi']}</option>
html;
        }

        $remigenFiscal = '';
        foreach (CajaDao::getRegimenFiscal() as $key => $value) {
            // $cfdi = ($value['id_pais'] == $userData['id_pais']) ? 'selected' : '';  
            $remigenFiscal .= <<<html
                    <option value="{$value['id_regimen_fiscal']}">{$value['descripcion_regimen_fiscal']}</option>
html;
        }

        $especialidades = '';
        foreach (CajaDao::getAllEspecialidades() as $key => $value) {
            $especialidades .= <<<html
           
        <option value="{$value['id_especialidad']}">{$value['nombre']}</option>
html;
        }

        $categorias = '';
        foreach (CajaDao::getCategorias() as $key => $value) {
            $categorias .= <<<html
           
        <option value="{$value['id_categoria']}">{$value['categoria']}</option>
html;
        }

        $categoria_gaf = '';
        foreach (CajaDao::getCategoriasGafetes() as $key => $value) {
            $categoria_gaf .= <<<html
           
        <option value="{$value['id']}">{$value['tipo']}</option>
html;
        }


        View::set('usoCfdi', $cfdi);
        View::set('remigenFiscal', $remigenFiscal);
        View::set('idCountry', $this->getCountry());
        View::set('especialidades', $especialidades);
        View::set('categorias', $categorias);
        View::set('categoria_gaf', $categoria_gaf);


        View::set('header', $extraHeader);
        View::set('footer', $extraFooter);
        View::render("automatico");
    }

    public function getCountry()
    {
        $country = '';
        foreach (CajaDao::getCountryAll() as $key => $value) {
            $country .= <<<html
           
        <option value="{$value['id_pais']}">{$value['country']}</option>
html;
        }
        return $country;
    }

    public function getEstadoPais()
    {
        $pais = $_POST['pais'];

        if (isset($pais)) {
            $Paises = AsistentesDao::getStateByCountry($pais);

            echo json_encode($Paises);
        }
    }


    function timeDiff($firstTime, $lastTime)
    {
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);
        $timeDiff = $lastTime - $firstTime;
        return $timeDiff;
    }


    public function getStatusProductosUser()
    {
        $user_id = $_POST['user_id'];
        $cont_cards = '';
        $no_cards = 0;
        $no_pendientes = 0;
        $nombre = AsistentesDao::getNombreUser($user_id);

        $getProductosByUser = AsistentesDao::getProductosByUser($user_id);

        $cont_cards .= <<<html
        <div class="row">
html;

        foreach ($getProductosByUser as $key => $value) {
            $no_cards++;
            if ($value['status_as'] == null && $value['status'] == 0) {
                $status = '<span class="badge badge-warning">Pendiente de pagar</span>';
                $no_pendientes++;
            } else {
                $status = '<span class="badge badge-success">Pagado</span>';
                $no_pendientes = 0;
            }
            $cont_cards .= <<<html
            
            <div class="col-md-4 col-sm-12 mb-3">
                <div class="card">                        
                    <div class="card-body">
                        <h3 class="card-title mb-3">{$value['nombre']}</h3>
                        <p class="card-text mb-1">{$status}</p>                            
                        
                    </div>
                </div>
            </div>
html;
        }

        if ($no_pendientes == 0) {
            $button_gafete = '<a href="/Auto/abrirpdfGafete/' . $value['user_id'] . '" class="btn bg-turquoise text-white w-100 h2" title="Imprimir Gafete Congreso" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Imprimir Gafetes" target="_blank"><i class="fas fa-print"> </i></a>';
            $text_pendiente = '<p><span class="badge badge-success w-100 h3">Parece que todo esta al corriente</span></p>';
        } else {
            $button_gafete = '';
            $text_pendiente = '<p><span class="badge badge-danger w-100 h3">Parece que tienes algunos adeudos, por favor pasa a caja</span></p>';
        }



        $cont_cards .= <<<html
    </div>
html;


        $data = [
            "status" => "success",
            "cont_cards" => $cont_cards,
            "no_cards" => $no_cards,
            "datos_user" => $nombre,
            "productos_pendientes" => $no_pendientes,
            "no_pendientes" => $no_pendientes,
            "button_gafete" => $button_gafete,
            "text_pendiente" => $text_pendiente
        ];
        echo json_encode($data);
    }

    // public function ObtenerEstado()
    // {
    //     $pais = $_POST['pais'];

    //     // if ($pais != 156) {
    //     $estados = CajaDao::getState($pais);
    //     $html = "";
    //     foreach ($estados as $estado) {
    //         $html .= '<option value="' . $estado['id_estado'] . '">' . $estado['estado'] . '</option>';
    //     }
        


    //     $respuesta = new respuesta();
    //     $respuesta->success = true;
    //     $respuesta->html = $html;

    //     echo json_encode($respuesta);
    // }

    public function ObtenerEstado()
    {
        $pais = $_POST['pais'];

        echo $pais ."sadasdasdasdasd";

        // // if ($pais != 156) {
        // $estados = CajaDao::getState($pais);
        // $html = "";
        // foreach ($estados as $estado) {
        //     $html .= '<option value="' . $estado['id_estado'] . '">' . $estado['estado'] . '</option>';
        // }
        


        // $respuesta = new respuesta();
        // $respuesta->success = true;
        // $respuesta->html = $html;

        // echo json_encode($respuesta);
    }

    public function getUsuariosGafetes()
    {
        $concidencia = $_POST['concidencia'];
        $getUser = AsistenciasDao::getUserById($concidencia);
        echo json_encode($getUser);
    }

    public function UpdateFiscalData()
    {

        if ($_POST['especialidades'] == null) {
            $_POST['especialidades'] = '';
        }
        
        if($_POST['categoria_gaf'] == 1){
            $es_socio = 1;
        }else{
            $es_socio = "";
        }

        $user_id = $_POST["modal_user_id"];
        $business_name_iva = $_POST['business_name_iva'];
        $code_iva = $_POST['code_iva'];
        $email_receipt_iva = $_POST['email_receipt_iva'];
        $direccion = $_POST['direccion'];
        $postal_code_iva = $_POST['postal_code_iva'];
        $direccion = $_POST['direccion_user'];
        $cfdi = $_POST['cfdi'];
        $regimen_fiscal = $_POST['regimen_fiscal'];
        
        $title = $_POST['title'];
        $nombre_user = $_POST['nombre_user'];
        $apellidop_user = $_POST['apellidop_user'];
        $apellidom_user = $_POST['apellidom_user'];
        $email_user = $_POST['email_user'];
 
        $data = new \stdClass();
        $data->_user_id = $user_id;
        $data->_title = $title;
        $data->_nombre = $nombre_user;
        $data->_apellidop = $apellidop_user;
        $data->_apellidom = $apellidom_user;
        $data->_email = $email_user;
        $data->_telephone = $_POST['telephone'];
        $data->_categorias = $_POST['categorias'];
        $data->_especialidades = $_POST['especialidades'];
        $data->_nationality = $_POST['nationality'];
        $data->_state = $_POST['state'];
        $data->_txt_especialidad = $_POST['txt_especialidad'];
        $data->_categoria_gaf = $_POST['categoria_gaf'];
        $data->_socio = $es_socio;
        $data->_porcentaje_becado = $_POST['porcentaje_becado'];
        $data->_comentario_beca = $_POST['comentario_beca'];

        $data->_business_name_iva = $business_name_iva;
        $data->_code_iva = $code_iva;
        $data->_email_receipt_iva = $email_receipt_iva;
        $data->_direccion = $direccion;
        $data->_postal_code_iva = $postal_code_iva;
        $data->_cfdi = $cfdi;
        $data->_regimen_fiscal = $regimen_fiscal;


        $updateFiscalData = CajaDao::UpdateDataUserAuto($data);

      
        if ($updateFiscalData) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    public function generaterQr($clave_ticket)
    {

        $codigo_rand = $clave_ticket;

        $config = array(
            'ecc' => 'H',    // L-smallest, M, Q, H-best
            'size' => 11,    // 1-50
            'dest_file' => '../public/qrs/' . $codigo_rand . '.png',
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

    public function abrirConstancia($clave, $nombre_supra, $id_producto = null, $no_horas = NULL)
    {

        // $this->generaterQr($clave_ticket);
        $clave = base64_decode($clave);
        $nombre_supra = base64_decode($nombre_supra);
        $id_producto = base64_decode($id_producto);

        // exit;
        $datos_user = GeneralDao::getUserRegisterByClave($clave)[0];

        $getTalleres = AsistentesDao::getTalleresByUserId($clave);

        $title = html_entity_decode($datos_user['title']);
        $nombre = html_entity_decode($datos_user['nombre']);
        $apellido = html_entity_decode($datos_user['apellidop']);
        $segundo_apellido = html_entity_decode($datos_user['apellidom']);
        $nombre_completo = ($title) . " " . ($nombre) . " " . ($apellido) . " " . ($segundo_apellido);
        $nombre_completo = mb_strtoupper($nombre_completo);
        $cont = 0;

        $insert_impresion_constancia = AsistentesDao::insertImpresionConstancia($datos_user['user_id'], 'Fisica', $id_producto);


        $pdf = new \FPDF($orientation = 'L', $unit = 'mm', $format = 'Letter');
        //$pdf->setSourceFile("constancias/plantillas/supra.pdf");
        $pdf->AddPage();
        $pdf->Image('constancias/plantillas/constancia_supra.jpg', '0', '0', '279.5', '216');
        //$pdf->Image('constancias/plantillas/firmas.jpg', 70, 183, 100, 25);//imagen de firmas
        $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $pdf->setY(1);

        $pdf->SetXY(10, 83);
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(260, 12, utf8_decode($nombre_completo), 0, 'C');

        //nombre Supra       

        if ($datos_user['categoria_gafete'] != 3) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 90);
            $pdf->Multicell(260, 10, utf8_decode('Por su participación como ASISTENTE en los talleres: '), 0, 'C');

            $espace = 95;
            foreach ($getTalleres as $key => $value) {
                $cont++;
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetXY(10, $espace);
                $pdf->Multicell(260, 10, utf8_decode('Taller ' . $cont . ': ' . $value['nombre']), 0, 'C');

                $espace = $espace + 5;
            }
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetXY(10, $espace - 1);
            $pdf->Multicell(260, 10, utf8_decode('en el marco del'), 0, 'C');
        } else {
            //aqui va el texto Por su participación como ASISTENTE, en el marco del curso:
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(10, 100);
            $pdf->Multicell(260, 10, utf8_decode('Por su participación como ASISTENTE, en el marco del curso: '), 0, 'C');
        }


        //firma 1
        //nombre Supra
        //$pdf->Image('constancias/plantillas/firma1_supra.jpg',80,165, 40, 25);
        //$pdf->SetFont('Arial', '',10);
        //$pdf->SetXY(70, 183);
        //$pdf->Multicell(60, 3, utf8_decode('Dr. José Ramón Saucillo Osuna Director del curso'), 0, 'C');


        //firma 2
        //$pdf->Image('constancias/plantillas/firma2_supra.jpg',150,165, 25, 25);
        //$pdf->SetFont('Arial', '',10);
        //$pdf->SetXY(135, 183);
        //$pdf->Multicell(60, 3, utf8_decode('Dra. Sandra Patricia Gaspar Carrillo Director del curso'), 0, 'C');



        //qr supra
        $pdf->Image('constancias/plantillas/qr_supra.png', 20, 20, 25, 25);

        $pdf->Output();
        // $pdf->Output('F','constancias/'.$clave.$id_curso.'.pdf');

        // $pdf->Output('F', 'C:/pases_abordar/'. $clave.'.pdf');
    }

    public function abrirConstanciaCongreso($clave, $id_producto = null, $no_horas = NULL)
    {

        // $this->generaterQr($clave_ticket);
        $clave = base64_decode($clave);
        $id_producto = base64_decode($id_producto);

        // exit;
        $datos_user = GeneralDao::getUserRegisterByClave($clave)[0];

        // $nombre = explode(" ", $datos_user['nombre']);


        $title = html_entity_decode($datos_user['title']);
        $nombre = html_entity_decode($datos_user['nombre']);
        $apellido = html_entity_decode($datos_user['apellidop']);
        $segundo_apellido = html_entity_decode($datos_user['apellidom']);
        $nombre_completo = ($title) . " " . ($nombre) . " " . ($apellido) . " " . ($segundo_apellido);
        $nombre_completo = mb_strtoupper($nombre_completo);

        $insert_impresion_constancia = AsistentesDao::insertImpresionConstancia($datos_user['user_id'], 'Fisica', $id_producto);


        $pdf = new \FPDF($orientation = 'L', $unit = 'mm', $format = 'Letter');
        //$pdf->setSourceFile("constancias/plantillas/congreso.pdf");
        $pdf->AddPage();
        $pdf->Image('constancias/plantillas/constancia_congreso.jpg', '0', '0', '279.5', '216');
        //$pdf->Image('constancias/plantillas/firmas_congreso.jpeg', 0, 0, 250, 215);//imagen de firmas
        $pdf->SetFont('Arial', 'B', 8);    //Letra Arial, negrita (Bold), tam. 20
        $pdf->setY(1);

        $pdf->SetXY(45, 84);
        $pdf->SetFont('Arial', 'B', 25);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Multicell(200, 15, utf8_decode($nombre_completo), 0, 'C');

        //nombre Supra
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetXY(40, 115);
        //$pdf->Multicell(230, 8, utf8_decode('Por su participación como ASISTENTE, en el marco del:'), 0, 'C');


        //qr congreso
        $pdf->Image('constancias/plantillas/qr_congreso.png', 240, 10, 25, 25);

        //firma 1
        //$pdf->Image('constancias/plantillas/firma3_congreso.jpg', 15, 160, 40, 25);
        //$pdf->SetFont('Arial', '', 9);
        //$pdf->SetXY(15, 180);
        //$pdf->Multicell(60, 3, utf8_decode('Dr. Alberto Amado Vázquez Lomas VICE-PRESIDENTE'), 0, 'C');

        //firma 2
        //$pdf->Image('constancias/plantillas/firma1_supra.jpg', 75, 160, 50, 25);
        //$pdf->SetFont('Arial', '', 9);
        //$pdf->SetXY(70, 180);
        //$pdf->Multicell(60, 3, utf8_decode('Dr. José Ramón Saucillo Osuna PRESIDENTE'), 0, 'C');


        //firma 3
        //$pdf->Image('constancias/plantillas/firma4_congreso.jpg', 132, 155, 40, 25);
        //$pdf->SetFont('Arial', '', 9);
        //$pdf->SetXY(122, 180);
        //$pdf->Multicell(60, 3, utf8_decode('Dra. María Magdalena Tun Martín SECRETARIO'), 0, 'C');


        //firma 4
        //$pdf->Image('constancias/plantillas/firma2_supra.jpg', 187, 158, 25, 25);
        //$pdf->SetFont('Arial', '', 9);
        //$pdf->SetXY(175, 180);
        //$pdf->Multicell(60, 3, utf8_decode('Dra. Sandra Patricia Gaspar Carrillo TESORERO'), 0, 'C');

        $pdf->Output();
        // $pdf->Output('F','constancias/'.$clave.$id_curso.'.pdf');

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
            $nombre_completo = mb_strtoupper($datos_user['title']) . " " . mb_strtoupper($nombre) . " " . mb_strtoupper($apellidop) . " " . mb_strtoupper($apellidom);
        } else {
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
            $pdf->Image("codigos_barras/" . $clave . ".png", 84.5, 206, 40, 20);
            $tipo = 'Congreso';
        } else if ($datos_user['categoria_gafete'] == 4) {
            $tipo = 'Expositor';
        } else if ($datos_user['categoria_gafete'] == 5) {
            $tipo = 'Staff';
        }

        $insertImpresionGafete = RegistroAsistenciaDao::insertImpGafete($datos_user['user_id'], 0, $tipo);


        $pdf->setXY(57, 190);
        $pdf->SetFont('Arial', 'B', 17);
        #4D9A9B
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->SetMargins(32, 25, 30, 10);
        $pdf->Multicell(95, 8, utf8_decode($nombre_completo), 0, 'C');
        // $pdf->Multicell(150.8, 7, utf8_decode($clave), 1, 'C');

        unlink("codigos_barras/" . $clave . ".png"); //Eliminar codigo de barras

        $pdf->output();
    }



    function generateRandomString($length = 6)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    public function abrirpdf($clave, $noPages = null, $no_habitacion = null)
    {
        $datos_user = AsistentesDao::getRegistroAccesoByClaveRA($clave)[0];

        $nombre = html_entity_decode($datos_user['nombre'], ENT_QUOTES, "UTF-8");
        $apellido = html_entity_decode($datos_user['apellido_paterno'], ENT_QUOTES, "UTF-8");
        $nombre_completo = mb_strtoupper($nombre) . " " .  mb_strtoupper($apellido);
        // $nombre_completo = strtoupper($datos_user['nombre'] . " " . $datos_user['apellido_paterno']);
        //$nombre_completo = utf8_decode($_POST['nombre']);
        //$datos_user['numero_habitacion']



        $pdf = new \FPDF($orientation = 'L', $unit = 'mm', array(37, 155));

        for ($i = 1; $i <= $noPages; $i++) {


            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 5);    //Letra Arial, negrita (Bold), tam. 20
            $textypos = 5;
            $pdf->setY(2);

            $pdf->Image('https://registro.foromusa.com/assets/pdf/iMAGEN_aso_2.png', 1, 0, 150, 40);
            $pdf->SetFont('Arial', '', 5);    //Letra Arial, negrita (Bold), tam. 20

            $pdf->SetXY(12, 10);
            $pdf->SetFont('Arial', 'B', 25);
            #4D9A9B
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Multicell(95, 10, utf8_decode($nombre_completo), 0, 'C');


            $textypos += 6;
            $pdf->setX(2);

            $textypos += 6;
        }

        $pdf->Output();
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
        $tmp_qrcode_file = dirname(__FILE__) . '/tmp_qrcode_' . time() . mt_rand(100, 999) . '.png';

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
