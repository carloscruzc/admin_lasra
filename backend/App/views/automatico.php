<?php echo $header; ?>
<style>
    .font-totales {
        font-size: 25px;
        font-weight: bold;
    }
</style>

<body class="g-sidenav-show  bg-gray-100">
    <main class="main-content  max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav  justify-content-end">

                    </ul>
                    <ul class="navbar-nav  justify-content-end">


                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-2 d-flex align-items-center">

                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="row" style="margin-bottom: -50px;">
            <div class="col-11 m-auto">
                <div class="mt-7 m-auto">
                    <div class="card card-body mt-n6 overflow-hidden m-5">
                        <div class="row mb-0">
                            <div class="col-auto">
                                <div class="bg-gradient-pink avatar avatar-xl ">
                                    <!-- <img src="../../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm"> -->
                                    <span class="fas fa-print" style="font-size: xx-large;"></span>

                                </div>
                            </div>
                            <div class="col-md-6 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-0">
                                        ----
                                    </h5>
                                    <h6><b><?php echo $nombre; ?></b></h6>
                                    <p class="mb-0 font-weight-bold text-sm">

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="mt-7">
            <div class="row">
                <div class="col-10 m-auto">
                    <div class="card card-body mt-n6 overflow-hidden">
                        <div class="col-12">
                            <div class="">
                                <div class="col-auto">
                                    <div class="row mt-4">


                                        <div class="col-lg-12 col-sm-6">
                                            <div class="card h-100">
                                                <div class="card-header pb-0 p-3">

                                                    <div class="row gx-2 gx-sm-3">

                                                        <div class="col">
                                                            <p>Escanea el codigo QR.</p>
                                                        </div>
                                                    </div>

                                                    <div class="row gx-2 gx-sm-3">
                                                        <div class="col">
                                                            <div class="form-group">

                                                                <input style="font-size: 35px" type="text" class="form-control" id="codigo_qr_venta" name="codigo_qr_venta" list="list_concidencias" autofocus>
                                                                <datalist id="list_concidencias">

                                                                </datalist>

                                                                <input style="font-size: 35px" type="hidden" id="codigo_qr_venta_hidden" name="codigo_qr_venta_hidden" class="form-control form-control-lg text-center" minlength="11" maxlength="11" autocomplete="off" autocapitalize="off" autofocus>

                                                            </div>
                                                            <button class="btn btn-info" id="btn_search_constancia">buscar</button>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="mb-0">Nombre: <br> <span id="nombre_completo" class="text-thin">Nombre</span> </h6>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mt-sm-0 mt-4">


                                            <div class="row mt-3">
                                                <div class="col-md-12" id="cont-text">

                                                </div>
                                            </div>

                                            <div id="cont_cards" class="mt-3">


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

    <div class="modal fade" id="datosFacturacion" tabindex="-1" role="dialog" aria-labelledby="datosFacturacionLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datosFacturacionLabel">Capturar datos de Facturacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" id="update_fiscal_data" action="" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="modal_user_id" id="modal_user_id">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Razón Social *</label>
                                <input class="multisteps-form__input form-control" type="text" id="business_name_iva" name="business_name_iva" placeholder="eg. Christopher Prior Jones" maxlength="100">
                            </div>
                            <div class="col-12 col-sm-4 mt-1 mt-sm-0">
                                <label>RFC *</label>
                                <input class="multisteps-form__input form-control" type="text" id="code_iva" name="code_iva" placeholder="eg. CPJ41250AS" maxlength="13" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label>Correo Electrónico facturación * </label>
                                <input class="multisteps-form__input form-control" type="text" id="email_receipt_iva" name="email_receipt_iva" placeholder="eg. user@domain.com">
                                <span class="mb-0 text-sm" id="error_email_send" style="display:none;color:red;">Correo electrónico incorrecto</span>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>CP Fiscal * </label>
                                <input class="multisteps-form__input form-control" id="postal_code_iva" name="postal_code_iva" type="number" min="-99999" maxlength="5" placeholder="Código postal" class="form-control ameg-shadow-box-two" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>CFDI * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="cfdi_update" id="cfdi_update">
                                    <option value="">Selecciona una opción</option>
                                    <?= $usoCfdi ?>

                                </select>

                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>Régimen Fiscal * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="regimen_fiscal_update" id="regimen_fiscal_update">
                                    <option value="">Selecciona una opción</option>
                                    <?= $remigenFiscal ?>
                                </select>

                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label>Dirección Fiscal * </label>
                                <textarea class="multisteps-form__input form-control" name="direccion" id="direccion" cols="30" rows="4"></textarea>
                                <!-- <input class="multisteps-form__input form-control" type="text" id="direccion" name="direccion" placeholder=""> -->
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="cerrar_modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary" id="btn_save_fiscal">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewUserLabel">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" id="addUser" action="" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Nombre *</label>
                                <input class="multisteps-form__input form-control" type="text" id="nombre_user" name="nombre_user" placeholder="" maxlength="100" style="text-transform:uppercase;" required>
                            </div>
                            <div class="col-12 col-sm-4">
                                <label>Apellido Paterno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidop_user" name="apellidop_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Apellido Materno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidom_user" name="apellidom_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Email *</label>
                                <input class="multisteps-form__input form-control" type="text" id="email_user" name="email_user" placeholder="" maxlength="100">
                                <span id="msg_email_user" style="color:#FF3B11;font-size: 12px;"></span>
                            </div>

                        </div>
                        <br>


                        <h5 class="modal-title" id="">Datos de Facturación</h5>

                        <hr>

                        <!-- <input type="hidden" name="modal_user_id" id="modal_user_id"> -->
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Razón Social </label>
                                <input class="multisteps-form__input form-control" type="text" id="business_name_iva_user" name="business_name_iva_user" placeholder="eg. Christopher Prior Jones" maxlength="100">
                            </div>
                            <div class="col-12 col-sm-4 mt-1 mt-sm-0">
                                <label>RFC </label>
                                <input class="multisteps-form__input form-control" type="text" id="code_iva_user" name="code_iva_user" placeholder="eg. CPJ41250AS" maxlength="13" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label>Correo Electrónico facturación </label>
                                <input class="multisteps-form__input form-control" type="text" id="email_receipt_iva_user" name="email_receipt_iva_user" placeholder="eg. user@domain.com">
                                <span class="mb-0 text-sm" id="error_email_send" style="display:none;color:red;">Correo electrónico incorrecto</span>
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label>CP</label>
                                <input class="multisteps-form__input form-control" id="postal_code_iva_user" name="postal_code_iva_user" type="number" min="-99999" maxlength="5" placeholder="Código postal" class="form-control ameg-shadow-box-two" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>CFDI * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="cfdi" id="cfdi">
                                    <option value="">Selecciona una opción</option>
                                    <?= $usoCfdi ?>

                                </select>

                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>Régimen Fiscal * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="regimen_fiscal" id="regimen_fiscal">
                                    <option value="">Selecciona una opción</option>
                                    <?= $remigenFiscal ?>
                                </select>

                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label>Dirección Fiscal </label>
                                <textarea class="multisteps-form__input form-control" name="direccion_user" id="direccion_user" cols="30" rows="3"></textarea>
                                <!-- <input class="multisteps-form__input form-control" type="text" id="direccion_user" name="direccion_user" placeholder=""> -->
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="reset" id="reset_form_addUser" class="d-none">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="cerrar_modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary" id="btn_save_user">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="constanciamanual" tabindex="-1" role="dialog" aria-labelledby="constanciamanualLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="constanciaLabel">Generar Constancia Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" id="a_generar_constancia"></a>
                            <input type="hidden" name="id_asistencia" id="id_asistencia" value="1000">

                            <label for="">No. Gafete</label>
                            <input class="form-control" type="number" min="1" name="id_gafete" id="id_gafete">

                            <label for="">Nombre Dr.</label>
                            <input class="form-control" style="text-transform:uppercase;" type="text" name="name_dr_constancia" id="name_dr_constancia">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="btn_clos_modal">Cerrar</button>
                    <button type="button" class="btn bg-gradient-success" id="btn_constancia_manual">Imprimir</button>
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Kanban scripts -->
    <script src="../../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../../assets/js/plugins/jkanban/jkanban.js"></script>
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <script src="../../assets/js/plugins/threejs.js"></script>
    <script src="../../assets/js/plugins/orbit-controls.js"></script>


    <script>
        function focus_input() {
            $("#codigo_qr_venta").focus();
        }

        $("#prueba").on("click", function() {
            // $("#check_curso_8").prop('checked', true);
            // $("[data-clave=5gyku]").prop('checked', true);
        })



        $(document).ready(function() {

            $("#btn_search_constancia").on("click", function() {
                var concidencia = $("#codigo_qr_venta").val();

                // console.log(concidencia)

                $.ajax({
                    // url: "https://sasv2.congresoneurologia.com/gafetes/api/" + concidencia,
                    url: '/Auto/getUsuariosGafetes',
                    type: "POST",
                    data: {
                        concidencia
                    },
                    dataType: "json",
                    crossDomain: true,
                    beforeSend: function() {
                        console.log("Procesando....");
                        // $('#list_concidencias')
                        //     .find('option')
                        //     .remove()
                        //     .end();
                    },
                    success: function(respuesta) {
                        console.log(respuesta);
                        // console.log("tamaño de respeusta " + respuesta.length);
                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            })


            $("#codigo_qr_venta").on('change', function() {
                var codigo = $(this).val();

                $("#codigo_qr_venta_hidden").val(codigo);

                getStatusProductosUser(codigo);

            });


            function getStatusProductosUser(user_id) {

                // console.log("lo que se tiene que buscar " +id_gafete)
                // console.log(nombre);

                $.ajax({
                    url: "/Auto/getStatusProductosUser",
                    type: "POST",
                    data: {
                        user_id
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Procesando....");

                    },
                    success: function(respuesta) {

                        console.log(respuesta)
                        // console.log("gafetes " + id_gafete);

                        contCards(respuesta);


                    },
                    error: function(respuesta) {

                        console.log(respuesta);
                        // $("#cont_cards").html(`<div class="row">
                        //                                 <div class="col-md-12">
                        //                                     <p>El usuario buscado no existe </p>
                        //                                 </div>

                        //                             </div>`);

                        // $("#nombre_completo").css('text-transform', 'uppercase')

                    }

                });
            }



            function contCards(respuesta) {
                console.log(respuesta);

                if (respuesta.no_cards > 0) {
                    $("#cont_cards").html(respuesta.cont_cards);
                    $("#nombre_completo").text(respuesta.nombre_completo);

                    $("#cont-text").html(respuesta.text_pendiente + respuesta.button_gafete);
                } else if (respuesta.no_cards == 0 && respuesta.nombre_completo == null) {
                    $("#cont_cards").html(`<div class="row mt-3 p-3">
                                                        <div class="col-md-12">
                                                            <p>El usuario buscado no existe en la base de datos.</p>
                                                        </div>
                                                        
                                                    </div>`);
                    $("#nombre_completo").text('El usuario no existe');
                }

            }


        });
    </script>

</body>

<?php echo $footer; ?>

</html>