<?php
namespace App\controllers;
defined("APPPATH") OR die("Access denied");
require_once dirname(__DIR__).'/../public/librerias/mpdf/mpdf.php';

use App\models\Encuestas;
use \Core\View;
use \Core\MasterDom;
use \App\models\Login AS LoginDao;
use \App\models\Encuestas AS EncuestasDao;

class EncuestaSatisfaccion{
    private $_contenedor;

    public function index() {
        $extraHeader =<<<html
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon.png">
        <link rel="icon" type="image/png" href="/img/favicon.png">
        <title>
           ENCUESTA - LASRA 2022
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
        <style>
        .photo {
            max-width: 15rem;
        }
        #msg_email{
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: red;
            
        }
        </style>
        
html;
        $extraFooter =<<<html

        <footer class="footer pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-8 mx-auto text-center mt-0">
                        <p class="mb-0 text-secondary">
                            Copyright © <script>
                                document.write(new Date().getFullYear())
                            </script> Grupo LAHE.
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        
        <script src="/js/jquery.min.js"></script>
        <script src="/js/validate/jquery.validate.js"></script>
        <script src="/js/alertify/alertify.min.js"></script>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
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
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

        
html;
        View::set('header',$extraHeader);
        View::set('footer',$extraFooter);
        View::render("encuesta");
    }

    public function isUserValidate(){
        //echo $_POST['usuario'];
        echo (count(LoginDao::getUser($_POST['usuario']))>=1)? 'true' : 'false';
    }

    public function saveEncuesta(){
        
        
        $data = new \stdClass();
        
        $nombre = $_POST['nombre'];         
        $email = $_POST['email'];
        $preg_1 = $_POST['group1'];
        $preg_2 = $_POST['group2'];
        $preg_3 = $_POST['group3'];
        $preg_4 = $_POST['group4'];
        $preg_5 = $_POST['group5'];
        $preg_6 = $_POST['group6'];
        
        $data->_nombre = $nombre;
        $data->_email = $email;
        $data->_preg_1 = $preg_1;
        $data->_preg_2 = $preg_2;
        $data->_preg_3 = $preg_3;
        $data->_preg_4 = $preg_4;
        $data->_preg_5 = $preg_5;
        $data->_preg_6 = $preg_6;

        $user = EncuestasDao::searchUserEncuesta($email);
        $datos = [];

        if($user){
            //ya no puede descargar constancia
           // echo "existe";
            $datos = [
                "status" => "error",
                "msg" => "El usuario asociado a este email ya respondio la encuesta"
            ];
        }else{
            //se guardo la encuesta y puede descargar la constancia
           // echo "no existe";
           

            $id = EncuestasDao::insert($data);

            if($id >= 1){
                $user = EncuestasDao::getUserEncuesta($email)[0];
                if($user){
                    $nombre_completo = $user['nombre']." ".$user['segundo_nombre']." ".$user['apellido_paterno']." ".$user['apellido_materno'];
                    $data_pdf = [
                        "nombre"  => mb_strtoupper($nombre_completo),
                        "email" => $email,
                        "clave" => $user['clave']
                        
                    ];
                    //CONSTANCIA
                    // $this->generarPDF($data_pdf);
                    $datos = [
                        "status" => "success",
                        "msg" => "¡Gracias por contestar la encuesta!",
                        "msg2" => "En breve se descargará su constancia.",
                        "clave" =>  $user['clave']                    
                    ];
                } else{
                    $datos = [
                        "status" => "success_2",
                        "msg" => "¡Gracias por contestar la encuesta!",
                        // "msg2" => "Recuerda que la constancia solo sera liberada para aquellas personas que cuentan con el 70% de asistencia al evento."
                    ];
                }               
                
            }else{
                $datos = [
                    "status" => "error",
                    "msg" => "Hubo un error al guardar la información",                    
                ];
            }
        }  
        
        echo json_encode($datos);

    }

//     public function generarPDF($data){
    

//         $mpdf=new \mPDF('c', 'A4-L');
//         $mpdf->defaultPageNumStyle = 'I';
//         $mpdf->h2toc = array('H5'=>0,'H6'=>1);      
  
        
//           $mpdf->SetDefaultBodyCSS('background', "url('/PDF/template/Asistente.png')");  
              
//           $style =<<<html
//               <style>
              
//                   .titulo{
//                   width:100%;
//                   margin-top: 30px;
//                   color: #F5AA3C;
//                   margin-left:auto;
//                   margin-right:auto;
//                   }
  
//                   .imagen{
  
//                       float: left;	
//                       margin-top: 150px;
//                       width: 100px;
//                       height: 100px;
//                   }
  
//                   .spacer{
//                       margin-left: 7px;
//                       padding-top: 255px!important;
//                       text-align: center;
              
//                   }
//                   .name{
//                       font-family: Arial, Helvetica, sans-serif;
//                       font-size: 50px;
//                   }
                  
 
//               </style>
// html;
//               $tabla =<<<html
  
//               <div style="page-break-inside: avoid;" class='spacer' align='center'>
//                 <h1 class='name name_user'>{$data['nombre']}</h1>
//               </div>
//   html;
       
    
//         $mpdf->SetDefaultBodyCSS('background-image-resize', 6);
//         $mpdf->WriteHTML($style,1);
//         $mpdf->WriteHTML($tabla,2);
  
//         //$nombre_archivo = "MPDF_".uniqid().".pdf";/* se genera un nombre unico para el archivo pdf*/
//         print_r($mpdf->Output('PDF/'.$data['clave'].'.pdf','F'));/* se genera el pdf en la ruta especificada*/
//         //echo $nombre_archivo;/* se imprime el nombre del archivo para poder retornarlo a CrmCatalogo/index */
  
//        // exit;
        
//       }

}
