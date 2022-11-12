<?php
echo $header;
?>

<body class="">
    <main class="main-content main-content-bg mt-0">
        <div class="min-vh-75">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-12 d-flex flex-column mx-auto">
                        <div class="card card-plain mt-7">
                            <div class="container-fluid py-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="multisteps-form">
                                            <!--progress bar-->
                                            <!--form panels-->
                                            <div class="row">
                                                <div class="col-12 col-lg-12 m-auto">
                                                    <form class="multisteps-form__form" id="form_encuesta" method="POST" action="/EncuestaSatisfaccion/saveEncuesta" style="height: 403px;">
                                                        <div id="card_three" class="card multisteps-form__panel p-1 border-radius-xl bg-white js-active" data-animation="FadeIn">


                                                            <div class="row text-center mt-4">
                                                                <div class="col-10 mx-auto">
                                                                    <h5 class="font-weight-normal"><strong>ENCUESTA LASRA 2022
                                                                        </strong></h5>
                                                                    <p>Coloque el puntaje a cada uno de los siguientes ítems, donde (Cara feliz) es “totalmente satisfecho” y (cara triste) es “nada satisfecho”.</p>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="multisteps-form__content row text-center">

                                                                <br>
                                                                <div class="row mx-auto">
                                                                    <div class="col-md-6">
                                                                        <label for="nombre">Nombre :</label>
                                                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escriba su nombre completo" required>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="nombre">Correo :</label>
                                                                        <input type="email" id="email" name="email" class="form-control" placeholder="Escriba su email" required>
                                                                        <span id="msg_email"></span>
                                                                    </div>
                                                                    <span>* Verifique que sus datos esten escritos correctamenrte.</span>

                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-12">

                                                                        <ul style="list-style-type: none;">
                                                                            <li>
                                                                                <p>1. Valoración global del evento (Programa académico, lugar del evento, coordinación, etc.)</p>
                                                                                <div class="row mt-4 d-flex justify-content-center text-center">
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-green" id="btncheck4" name="group1" required value="3">
                                                                                        <label class="color-face-green btn btn-lg btn-outline-secondary border-2 px-2 py-2 color-face-green" for="btncheck4">
                                                                                            <i class="far fa-grin-beam"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-yellow" id="btncheck5" name="group1" required value="2">
                                                                                        <label class="color-face-yellow btn btn-lg btn-outline-secondary border-2 px-2 py-2 color-face-yellow" for="btncheck5">
                                                                                            <i class="far fa-grin"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-orange" id="btncheck6" name="group1" required value="1">
                                                                                        <label class="color-face-orange btn btn-lg btn-outline-secondary border-2 px-2 py-2 color-face-orange" for="btncheck6">
                                                                                            <i class="far fa-meh"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-red" id="btncheck7" name="group1" required value="0">
                                                                                        <label class="color-face-red btn btn-lg btn-outline-secondary border-2 px-2 py-2 color-face-red" for="btncheck7">
                                                                                            <i class="far fa-frown"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>

                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <p>2. Calidad del programa</p>
                                                                                <div class="row mt-4 d-flex justify-content-center text-center">
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-green" id="btncheck8" name="group2" required value="3">
                                                                                        <label class="color-face-green btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck8">
                                                                                            <i class="far fa-grin-beam"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-yellow" id="btncheck9" name="group2" required value="2">
                                                                                        <label class="color-face-yellow btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck9">
                                                                                            <i class="far fa-grin"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-orange" id="btncheck10" name="group2" required value="1">
                                                                                        <label class="color-face-orange btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck10">
                                                                                            <i class="far fa-meh"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-red" id="btncheck11" name="group2" required value="0">
                                                                                        <label class="color-face-red btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck11">
                                                                                            <i class="far fa-frown"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>

                                                                                </div>
                                                                            </li>


                                                                            <li>
                                                                                <p>3. Valoración respecto al tiempo destinado a las conferencias, preguntas y mesas redondas</p>
                                                                                <div class="row mt-4 d-flex justify-content-center text-center">
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-green" id="btncheck12" name="group3" required value="3">
                                                                                        <label class="color-face-green btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck12">
                                                                                            <i class="far fa-grin-beam"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-yellow" id="btncheck13" name="group3" required value="2">
                                                                                        <label class="color-face-yellow btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck13">
                                                                                            <i class="far fa-grin"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-orange" id="btncheck14" name="group3" required value="1">
                                                                                        <label class="color-face-orange btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck14">
                                                                                            <i class="far fa-meh"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-red" id="btncheck15" name="group3" required value="0">
                                                                                        <label class="color-face-red btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck15">
                                                                                            <i class="far fa-frown"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <p>4. Considera que hubo temas importantes que quedaron fuera del programa</p>
                                                                                <div class="row mt-4 d-flex justify-content-center text-center">
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-green" id="btncheck16" name="group4" required value="3">
                                                                                        <label class="color-face-green btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck16">
                                                                                            <i class="far fa-grin-beam"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-yellow" id="btncheck17" name="group4" required value="2">
                                                                                        <label class="color-face-yellow btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck17">
                                                                                            <i class="far fa-grin"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-orange" id="btncheck18" name="group4" required value="1">
                                                                                        <label class="color-face-orange btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck18">
                                                                                            <i class="far fa-meh"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-red" id="btncheck19" name="group4" required value="0">
                                                                                        <label class="color-face-red btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck19">
                                                                                            <i class="far fa-frown"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>

                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <p>5. Desde el punto de vista académico, ¿volvería a participar de un evento de LASRA MÉXICO?</p>
                                                                                <div class="row mt-4 d-flex justify-content-center text-center">
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-green" id="btncheck140" name="group5" required value="3">
                                                                                        <label class="color-face-green btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck140">
                                                                                            <i class="far fa-grin-beam"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-yellow" id="btncheck141" name="group5" required value="2">
                                                                                        <label class="color-face-yellow btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck141">
                                                                                            <i class="far fa-grin"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-orange" id="btncheck142" name="group5" required value="1">
                                                                                        <label class="color-face-orange btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck142">
                                                                                            <i class="far fa-meh"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>
                                                                                    <div class="col-sm-1 ">
                                                                                        <input type="radio" class="btn-check btn-face-red" id="btncheck143" name="group5" required value="0">
                                                                                        <label class="color-face-red btn btn-lg btn-outline-secondary border-2 px-2 py-2" for="btncheck143">
                                                                                            <i class="far fa-frown"></i>
                                                                                        </label>
                                                                                        <h6></h6>
                                                                                    </div>

                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <p>6. Desea agregar algún comentario adicional.</p>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <textarea name="group6" id="group6" class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <div class="row mt-3">
                                                                                    <div class="col-md-6 m-auto">
                                                                                        <button class="btn btn-secondary" id="btnEnviar" >Enviar Respuestas</button>
                                                                                        
                                                                                        <a href="" id="btn_download_pdf" style="display: none;">descargar</a>
                                                                                    </div>
                                                                                </div>
                                                                            </li>


                                                                        </ul>
                                                                    </div>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    

</body>



<?php echo $footer; ?>
<script>
        $(document).ready(function(){

            //VALIDACIÓN DE EMAIL ENCUESTA
            // $("#email").on("blur",function(){
                
            //     var usuario = $(this).val();
            //     console.log(usuario);
            //     $.ajax({
            //         type:"POST",
            //         // async: false,
            //         url: "/EncuestaSatisfaccion/isUserValidate",
            //         data: {usuario},
            //         success: function(data) {
            //             console.log(data);
            //             if(data=="true"){
            //                 $('#btnEnviar').attr("disabled", false);
            //                 $('#msg_email').html('');
            //                 response = true;
            //             }else{
            //                 $('#btnEnviar').attr("disabled", true);
            //                 $('#msg_email').html('Este email no fue registrado en Foro Salud Mental 2022');
            //             }
            //         }
            //     });
            // });

            // $("#btn_prueba").on("click", function(){
            //     $("#btn_download_pdf").attr("href", '../PDF/vsMNShBOU5.pdf'); 
            //     $("#btn_download_pdf").attr("download","");
            //     $("#btn_download_pdf")[0].click();
            // });

            $("#form_encuesta").on("submit", function(event){
               event.preventDefault();
                var formData = $(this).serialize();

                // for (var value of formData.values()) {
                //     console.log(value);
                // }

                $.ajax({
                    url: "/EncuestaSatisfaccion/saveEncuesta",
                    type: "POST",
                    data: formData, 
                    dataType: 'json',                
                    beforeSend: function() {
                        console.log("Procesando....");
                    },
                    success: function(respuesta) {
                        if (respuesta.status == 'success') {
                            //CONSTANCIAS
                            $("#btn_download_pdf").attr("href", '../PDF/'+respuesta.clave+'.pdf'); 
                            $("#btn_download_pdf").attr("download","");
                            $("#btn_download_pdf")[0].click();

                            Swal.fire(respuesta.msg, respuesta.msg2, respuesta.status).
                                then((value) => {       
                                                      
                                window.location.replace("/EncuestaSatisfaccion/");
                            });                
                             
                        
                        }else if(respuesta.status == 'success_2'){
                            Swal.fire(respuesta.msg, respuesta.msg2, 'success').
                                then((value) => {       
                                                      
                                window.location.replace("/EncuestaSatisfaccion/");
                            });
                        }
                        else{

                            Swal.fire(respuesta.msg, "", respuesta.status).
                                then((value) => {
                                window.location.replace("/EncuestaSatisfaccion/");
                            });

                            
                        }
                       
                        console.log(respuesta);
                        console.log(respuesta.msg);
                        console.log(respuesta.status);
                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }
                });                
            });
        });
    </script> 