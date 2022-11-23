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

        <script src="http://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
        
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

        <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js" defer></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />

html;


        View::set('header', $extraHeader);
        View::set('footer', $extraFooter);
        View::render("automatico");
    }

    public function general()
    {

        $extraHeader = <<<html
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/logo_lasra.png">
        <link rel="icon" type="image/png" href="/assets/img/logo_lasra.png">
        <title>
            CONSTANCIAS - AMN 
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


        View::set('header', $extraHeader);
        View::set('footer', $extraFooter);
        View::render("constancias_general");
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
            if($value['status_as'] == null && $value['status'] == 0){
                $status = '<span class="badge badge-warning">Pendiente de pagar</span>';
                $no_pendientes++;
               

            }else{
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

        if($no_pendientes == 0){
            $button_gafete = '<a href="/RegistroAsistencia/abrirpdfGafete/'.$value['user_id'].'" class="btn bg-turquoise text-white w-100 h2" title="Imprimir Gafete Congreso" data-bs-placement="top" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Imprimir Gafetes" target="_blank"><i class="fas fa-print"> </i></a>';
            $text_pendiente = '<p><span class="badge badge-success w-100 h3">Parece que todo esta al corriente</span></p>';
        }else{
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
            "nombre_completo" => $nombre['nombre_completo'],
            "productos_pendientes" => $no_pendientes,
            "no_pendientes" => $no_pendientes,
            "button_gafete" => $button_gafete,
            "text_pendiente" =>$text_pendiente
        ];
        echo json_encode($data);
    }

    public function getUsuariosGafetes()
    {
        $concidencia = $_POST['concidencia'];
        $getUser = AsistenciasDao::getUserById($concidencia);
        echo json_encode($getUser);
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
