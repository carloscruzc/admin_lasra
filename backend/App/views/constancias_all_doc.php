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
                        <li class="nav-item d-flex align-items-center">
                            <a href="/Login/cerrarSession" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-power-off me-sm-1"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a>
                        </li>
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
                                    <span class="fas fa-cash-register" style="font-size: xx-large;"></span>

                                </div>
                            </div>
                            <div class="col-md-6 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-0">
                                        CONSTANCIAS
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
                                                        
                                                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#constanciamanual" style="width: 20%; ">
                                                            Constancia General Manual
                                                        </button>
                                                    </div>

                                                    <div class="row gx-2 gx-sm-3">
                                                        <div class="col">
                                                            <div class="form-group">

                                                                <input style="font-size: 35px" type="text" class="form-control" id="codigo_qr_venta" name="codigo_qr_venta" list="list_concidencias" autofocus>
                                                                <datalist id="list_concidencias">

                                                                </datalist>

                                                                <input style="font-size: 35px" type="hidden" id="codigo_qr_venta_hidden" name="codigo_qr_venta_hidden" class="form-control form-control-lg text-center" minlength="11" maxlength="11" autocomplete="off" autocapitalize="off" autofocus>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="mb-0">Nombre: <br> <span id="nombre_completo" class="text-thin">Nombre</span> </h6>
                                                        <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Información del asistente">
                                                            <i class="fas fa-info" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- <div class="card-body"> -->
                                                <!-- <div class="row ">
                                                    <div class="col-5">
                                                        <img class="w-100 h-100 avatar" id="img_asistente" src="/img/user.png" alt="user">
                                                    </div>
                                                    
                                                </div> -->

                                                <!-- <div class="row m-2">
                                                    <h6>Correo: <span class="text-thin" id="correo_user"> _____</span></h6>
                                                    <h6>Teléfono: <span class="text-thin" id="telefono_user"> 00 0000 0000</span></h6>
                                                    <input type="hidden" id="user_id" name="user_id">
                                                    <input type="hidden" id="precio_desbloquedo_por" name="precio_desbloquedo_por">

                                                    <a href="" id="generar_gafete" target="_blank" style="display: none;">gafete</a>
                                                    <a href="" id="imprimir_comprobante" target="_blank" style="display: none;">comprobante</a>

                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mt-sm-0 mt-4">




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
        function buscarArticulo() {

            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("buscador");
            filter = input.value.toUpperCase();
            table = document.getElementById("cont-cheks");
            tr = table.getElementsByTagName("div");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("div")[0];
                // hr = tr[i].getElementsByTagName("hr")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        // hr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                        // hr[i].style.display = "none";
                    }
                }
            }
        }

        function focus_input() {
            $("#codigo_qr_venta").focus();
        }

        $("#prueba").on("click", function() {
            // $("#check_curso_8").prop('checked', true);
            // $("[data-clave=5gyku]").prop('checked', true);
        })

        // search_item.oninput = function() {
        //     input.value;
        //     $("[data-clave=" + input.value + "]").click();
        //     // $("#prueba").click();
        //     console.log(input.value);
        //     setTimeout(function() {
        //         $("#search_item").val('');
        //     }, 1000)
        //     $(this).focus();
        // };



        // $(".checks_product").on("click", function() {
        //     $("#prueba").click();
        // });


        function borrarRegister(dato) {
            // alert(dato);
            $.ajax({
                url: "/RegistroAsistencia/borrarRegistrado/" + dato,
                type: "POST",
                dataType: 'json',
                beforeSend: function() {
                    console.log("Procesando....");
                    // alert('Se está borrando');

                },
                success: function(respuesta) {
                    console.log(respuesta);
                    console.log('despues de borrar');
                    // alert('Bien borrado');
                    swal("¡Se borró correctamente!", "", "success").
                    then((value) => {
                        $("#codigo_qr_venta").focus();
                        window.location.reload();
                    });
                },
                error: function(respuesta) {
                    console.log(respuesta);
                    // alert('Error');
                    swal("¡Ha ocurrido un error al intentar borrar el registro!", "", "warning").
                    then((value) => {
                        $("#codigo_qr_venta").focus();
                    });
                }
            })
        }



        $(document).ready(function() {

            $("#update_fiscal_data").on("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(document.getElementById("update_fiscal_data"));
                for (var value of formData.values()) {
                    console.log(value);
                }

                $.ajax({
                    url: "/Caja/UpdateFiscalData",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        console.log("Procesando....");
                    },
                    success: function(respuesta) {
                        console.log(respuesta);

                        if (respuesta == 'success') {
                            swal("Alerta", "¡Se actualizaron los Datos Correctamente!", "success")
                            $('#cerrar_modal').click();
                        } else {
                            swal("¡Hubo un error al actualizar!", "Contacte a soporte", "error")
                            $('#cerrar_modal').modal();
                        }


                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            });

            $("#addUser").on("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(document.getElementById("addUser"));
                for (var value of formData.values()) {
                    console.log(value);
                }

                $.ajax({
                    url: "/Caja/addNewUser",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        console.log("Procesando....");
                    },
                    success: function(respuesta) {
                        console.log(respuesta);

                        if (respuesta.status == 'success') {
                            // swal("¡Se actualizaron los Datos Correctamente!", "", "success")
                            // $('#cerrar_modal').click();
                            Swal.fire({
                                icon: 'success',
                                title: 'Alerta',
                                text: 'Usuario registrado correctamente.'
                            }).then((value) => {
                                // $("#search_item").focus();
                            });
                            // $("#addNewUser").modal('toggle');
                            $("#reset_form_addUser").click();
                            getSell(respuesta.user_id);
                            $("#codigo_qr_venta_hidden").val(respuesta.user_id);
                            // $("#search_item").focus();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Alerta',
                                text: 'Hubo un error al registrar el usuario.'

                            })
                            // $("#addNewUser").modal('toggle');
                            $("#reset_form_addUser").click();
                            // swal("¡Hubo un error al actualizar!", "Contacte a soporte", "error")
                            // $('#cerrar_modal').modal();
                        }


                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            });


            // let codigo = '';
            // var link_a = $(location).attr('href');
            // var clave_a = link_a.substr(link_a.indexOf('codigo/') + 7, link_a.length);

            // var precios=<?php //echo json_encode($array_precios); 
                            ?>;
            // var productos=<?php //echo json_encode($array_productos); 
                                ?>;
            var flag_descripcion = false;

            var precios = [];
            var productos = [];

            // bloquearRegistro();

            $("#btn_pagar").on("click", function() {
                var metodo_pago = $("#metodo_pago").val();
                var user_id = $("#user_id").val();
                // alert(user_id);
                // var total_usd = $("#total_usd").text();
                var total_pesos = $("#total_pesos").text();
                var descripcion = $("#txt_descripcion").val();
                var num_operacion = $("#num_operacion").val();

                console.log(user_id);


                if (metodo_pago != '' && total_pesos > 0) {
                    Swal.fire({
                        title: 'Se va a procesar el pago.',
                        text: "",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Pagar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/Caja/setPay",
                                type: "POST",
                                data: {
                                    'array': JSON.stringify(productos),
                                    user_id,
                                    metodo_pago,
                                    total_pesos,
                                    descripcion,
                                    num_operacion
                                },
                                // dataType: 'json',
                                beforeSend: function() {
                                    console.log("Procesando....");
                                },
                                success: function(respuesta) {
                                    console.log(respuesta);

                                    if (respuesta == 'success') {

                                        $('#imprimir_comprobante')[0].click();
                                        Swal.fire('Pago generado correctamente.', '', 'success').then(() => {
                                            // $('#generar_gafete')[0].click();
                                            setTimeout(function() {
                                                location.reload();
                                            }, 1000);
                                        });

                                    }
                                },
                                error: function(respuesta) {

                                }

                            });
                        }

                    })
                    // var total_usd = $("#total_usd").text();
                    // alert(total_usd);
                } else {
                    //seleccionar metodo de pago
                    if (metodo_pago == "") {
                        Swal.fire('Selecciona un metodo de pago', '', 'info');
                    } else if (total_pesos <= 0) {
                        Swal.fire('Selecciona al menos un producto', '', 'info');
                    }


                }



            });

            $("#metodo_pago").on("change", function() {
                var metodo_pago = $(this).val();

                var total_pagar = $("#txt_pago").val();
                var total_pesos = $("#total_pesos").text();


                if (metodo_pago != 'Efectivo') {
                    $(".cont-cambio").hide();
                    $(".cont_txt_pago").hide();
                    $(".no_transaccion").show();
                    $("#btn_pagar").removeAttr('disabled');

                } else {

                    if (parseFloat(total_pagar) > parseFloat(total_pesos)) {
                        $("#btn_pagar").removeAttr('disabled')
                    } else {
                        $("#btn_pagar").attr('disabled', 'disabled');
                    }
                    $(".cont_txt_pago").show();
                    $(".cont-cambio").show();
                    $(".no_transaccion").hide();
                }
            });


            $("#btn_desb_precio").on("click", function() {

                const {
                    value: password
                } = Swal.fire({
                    title: 'Se necesitan permisos de administrador',
                    input: 'password',
                    inputLabel: 'Password',
                    inputPlaceholder: 'Ingresa el password',
                    inputAttributes: {
                        maxlength: 15,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    }
                }).then((password) => {

                    var password = password.value;

                    $.ajax({
                        url: "/Caja/buscarPassword",
                        type: "POST",
                        data: {
                            password
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            console.log("Procesando....");

                        },
                        success: function(respuesta) {

                            if (respuesta.status == "success") {
                                console.log(respuesta);

                                $(".precio_articulo").removeAttr('readonly');
                                $(".precio_articulo").css('border', 'solid 1px #000');
                                $("#precio_desbloquedo_por").val(respuesta.admin.utilerias_administradores_id);

                            } else {
                                Swal.fire('Password incorrecto', '', 'error');
                            }

                        },
                        error: function(respuesta) {
                            console.log(respuesta);
                        }

                    });
                });


            });

            $("#codigo_qr_venta").on("keyup", function() {
                var concidencia = $(this).val();

                console.log(concidencia)

                $.ajax({
                    // url: "https://sasv2.congresoneurologia.com/gafetes/api/" + concidencia,
                    url: '/Constanciasdoc/getUsuariosGafetes',
                    type: "POST",
                    data: {
                        concidencia
                    },
                    dataType: "json",
                    crossDomain: true,
                    beforeSend: function() {
                        console.log("Procesando....");
                        $('#list_concidencias')
                            .find('option')
                            .remove()
                            .end();
                    },
                    success: function(respuesta) {
                        // console.log(respuesta);
                        console.log("tamaño de respeusta " + respuesta.length);

                        if (respuesta.length > 0) {
                            $.each(respuesta, function(key, value) {
                                //console.log(key);
                                // console.log(value);
                                $('#list_concidencias')
                                    .append($('<option>', {
                                            'data-value': value.user_id
                                        })
                                        .text(value.user_id + ' - ' + value.nombre_completo + ' - '+ value.usuario));
                            });
                        }
                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            });

            $("#nombre_user").on("keyup", function() {
                var nombre = $(this).val();
                $("#business_name_iva_user").val(nombre);
            })

            $("#email_user").on("keyup", function() {
                var email = $(this).val();
                $("#email_receipt_iva_user").val(email);

                $.ajax({
                    url: "/Caja/searchEmail",
                    type: "POST",
                    data: {
                        email
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Procesando....");

                    },
                    success: function(respuesta) {
                        // console.log(respuesta);
                        // console.log(respuesta.length);
                        if (respuesta.length > 0) {
                            $("#msg_email_user").html("Este correo ya esta registrado.");
                            $("#btn_save_user").attr('disabled', 'disabled');
                        } else {
                            $("#msg_email_user").html("");
                            $("#btn_save_user").removeAttr('disabled');
                        }

                    },
                    error: function(respuesta) {

                    }

                });
            })



            $("#codigo_qr_venta").on('change', function() {
                var codigo = $(this).val();

                // console.log(user_id);
                $("#codigo_qr_venta_hidden").val(codigo);

                var usuario = codigo.split("-");
                var id_gafete = parseInt(usuario[0]);
                var nombre = usuario[1];

                $('#codigo_qr_venta').val('');

                console.log("Codigo " + codigo);
                console.log("----------------");
                console.log("id gafete " + id_gafete);
                console.log("----------------");
                console.log("nombre "+ nombre);
                getConstancias(id_gafete, nombre, codigo);

            });

            function getSell(user_id) {

                // console.log(user_id)
                $.ajax({
                    url: "/Caja/getSell",
                    type: "POST",
                    data: {
                        user_id
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Procesando....");

                    },
                    success: function(respuesta) {

                        console.log(respuesta);
                        console.log(respuesta.status);
                        // console.log(respuesta);
                        if (respuesta.status == "success") {


                            // crearTabla(respuesta);
                            crearChecks(respuesta);
                            precios = respuesta.precios;
                            productos = respuesta.productos;
                            sumarPrecios(precios);
                            sumarProductos(productos);
                            $(".cont-totales").show();
                            $("#cont-descripcion").hide();
                            $("#btn_fact").show();
                            // $("#search_item").show();
                            // $("#search_item").focus();
                            $("#buscador").show();
                            $("#cont-pagar").show();
                            // $("#btn_desb_precio").show();
                            flag_descripcion = false;

                            // console.log(precios);
                            // console.log(productos);


                        } else {
                            // console.log(Object.keys(respuesta).length);
                            // crearTabla(respuesta);
                            //    location.reload();
                            $("#cont-pagar").hide();
                            console.log("refrescar");
                        }
                    },
                    error: function(respuesta) {
                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Alerta',
                        //     text: 'No se encontro ningun registro para este codigo, Retgistra el usuario.',
                        //     timer: 2000
                        // });
                        setTimeout(function() {
                            // location.reload();

                        }, 1000)
                        console.log(respuesta);
                    }

                });
            }

            function getConstancias(id_gafete, nombre, nombremodal = null) {

                console.log(id_gafete)
                console.log(nombre);

                $.ajax({
                    url: "/Constanciasdoc/getConstancias",
                    type: "POST",
                    data: {
                        id_gafete,
                        nombre
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        console.log("Procesando....");

                    },
                    success: function(respuesta) {

                        console.log(respuesta)

                        // if (!isNaN(id_gafete)) {
                            contCards(respuesta);
                        // } else {
                        //     $("#cont_cards").html(`<div class="row">
                        //                                 <div class="col-md-12">
                        //                                     <p>El usuario buscado no existe puedes porbar descargando la constancia manual</p>
                        //                                 </div>
                        //                                 <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#constanciamanual" style="width: 20%; ">
                        //                                     Constancia General Manual
                        //                                 </button>
                        //                             </div>`);

                        //     $("#nombre_completo").css('text-transform','uppercase')                        
                        //     $("#nombre_completo").html(nombremodal)
                        //     $("#name_dr_constancia").val(nombremodal);
                        // }




                    },
                    error: function(respuesta) {
                        // Swal.fire({
                        //     icon: 'error',
                        //     title: 'Alerta',
                        //     text: 'No se encontro ningun registro para este codigo, Retgistra el usuario.',
                        //     timer: 2000
                        // });
                        setTimeout(function() {
                            // location.reload();

                        }, 1000)
                        console.log(respuesta);
                    }

                });
            }



            function contCards(respuesta) {
                // console.log(respuesta);

                $("#cont_cards").html(respuesta.cont_cards);
                $("#nombre_completo").html(respuesta.nombre_completo);


            }

            $("#btn_constancia_manual").on("click",function(){
            
                // $("#a_generar_constancia").attr("href","/Constancias/abrirConstanciaManualGeneral/"+ btoa($("#name_dr_constancia").val()) + "/" + btoa($("#id_asistencia").val()) + "/" + btoa($("#id_gafete").val()));

                $("#a_generar_constancia").attr("href","/Constancias/abrirConstanciaManualGeneral?nombre="+($("#name_dr_constancia").val())+"&asis="+($("#id_asistencia").val())+"&gafete="+($("#id_gafete").val()));

                $("#a_generar_constancia").attr("target","_blank");

                $('#a_generar_constancia')[0].click();

                $('#btn_clos_modal')[0].click();          
            
                
            })




            function format2(n, currency) {
                return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
            }

            $("table#lista_productos").on("click", "button.btn-delete", function() {
                var id_producto = $(this).attr('data-id-producto');
                var user_id = $("#user_id").val();

                Swal.fire({
                    title: '¿Remover el producto?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Confirmar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: "/Caja/removePendientesPago",
                            type: "POST",
                            data: {
                                id_producto,
                                user_id
                            },
                            cache: false,
                            beforeSend: function() {
                                console.log("Procesando....");

                            },
                            success: function(respuesta) {

                                console.log(respuesta);
                                if (respuesta == "success") {
                                    // location.reload();
                                    var codigo = $("#codigo_qr_venta_hidden").val();
                                    getSell(codigo);
                                }



                            },
                            error: function(respuesta) {
                                console.log(respuesta);
                            }

                        });

                    }

                })

                // alert(id_producto);
                // alert(user_id);

            });

            $("#txt_pago").on('keyup', function() {

                var total_pesos = parseFloat($("#total_pesos").text());
                var total_pagar = $(this).val();
                var cambio = 0;


                if (total_pagar >= total_pesos) {
                    $("#btn_pagar").removeAttr('disabled');
                    cambio = total_pagar - total_pesos;
                    $("#total_cambio").html(cambio);
                    $("#total_cambio_formato").html(format2(cambio, ''));

                    // console.log("se habilita");
                } else {
                    $("#btn_pagar").attr('disabled', 'disabled');
                    $("#total_cambio").html("");
                    $("#total_cambio_formato").html("");
                    // console.log("se desabilita");
                }
            });



            ///Pagos              



            $("#cont-cheks").on("change", "input[type=checkbox].checks_product", function() {
                var id_product = $(this).val();
                var precio = $(this).attr('data-precio');
                var cantidad = $("#numero_articulos" + id_product).val();
                var nombre_producto = $(this).attr('data-nombre-producto');

                if (this.checked) {

                    precios.push({
                        'id_product': id_product,
                        'precio': precio,
                        'cantidad': cantidad
                    });
                    sumarPrecios(precios);


                    productos.push({
                        'id_product': id_product,
                        'precio': precio,
                        'cantidad': cantidad,
                        'nombre_producto': nombre_producto
                    });

                    sumarProductos(productos);

                } else if (!this.checked) {

                    for (var i = 0; i < precios.length; i++) {

                        if (precios[i].id_product === id_product) {
                            console.log("remover");
                            precios.splice(i, 1);

                            productos.splice(i, 1);
                            sumarPrecios(precios);
                            sumarProductos(productos);
                        } else if (precios[i].id_product === id_product && precios[i].cantidad === cantidad) {
                            precios.splice(i, 1);

                            productos.splice(i, 1);
                            sumarPrecios(precios);
                            sumarProductos(productos);

                        }
                    }

                    // $.ajax({
                    //     url: "/Home/removePendientesPago",
                    //     type: "POST",
                    //     data: {
                    //         id_product,cantidad
                    //     },
                    //     cache: false,
                    //     beforeSend: function() {
                    //         console.log("Procesando....");

                    //     },
                    //     success: function(respuesta) {

                    //         console.log(respuesta);
                    //         if(respuesta == "success"){
                    //             location.reload();
                    //         }


                    //     },
                    //     error: function(respuesta) {
                    //         console.log(respuesta);
                    //     }

                    // });
                }
                // console.log(productos);
                // sumarPrecios(precios);
                // sumarProductos(productos);

            });

            $("#cont-cheks").on("change", "select.select_numero_articulos", function() {

                var id_producto = $(this).attr('data-id-producto');
                var cantidad = $(this).val();
                var precio = $(this).attr('data-precio');
                var nombre_producto = $(this).attr('data-nombre-producto');

                var stock = $("#stock" + id_producto).val();

                if (parseInt(cantidad) > parseInt(stock)) {
                    Swal.fire({
                        'icon': 'info',
                        'title': 'Alerta',
                        'text': 'No puede seleccionar cantidad mayor al stock'
                    });
                    $(this).val(stock);
                } else {
                    if ($("#check_curso_" + id_producto).is(':checked')) {

                        for (var i = 0; i < precios.length; i++) {

                            if (precios[i].id_product === id_producto && precios[i].cantidad != cantidad) {
                                console.log("remover");
                                precios.splice(i, 1, {
                                    'id_product': id_producto,
                                    'precio': precio,
                                    'cantidad': cantidad
                                });

                                productos.splice(i, 1, {
                                    'id_product': id_producto,
                                    'precio': precio,
                                    'cantidad': cantidad,
                                    'nombre_producto': nombre_producto
                                });

                            }

                        }
                        console.log(precios.length);

                        console.log(productos);
                        sumarProductos(productos);
                        sumarPrecios(precios);

                    }
                }

            });

            // $("#cont-cheks").on("change", "input.select_numero_articulos", function() {

            //     var id_producto = $(this).attr('data-id-producto');
            //     var cantidad = $(this).val();
            //     var precio = $(this).attr('data-precio');
            //     var nombre_producto = $(this).attr('data-nombre-producto');

            //     if ($("#check_curso_" + id_producto).is(':checked')) {

            //         for (var i = 0; i < precios.length; i++) {

            //             if (precios[i].id_product === id_producto && precios[i].cantidad != cantidad) {
            //                 console.log("remover");
            //                 precios.splice(i, 1, {
            //                     'id_product': id_producto,
            //                     'precio': precio,
            //                     'cantidad': cantidad
            //                 });

            //                 productos.splice(i, 1, {
            //                     'id_product': id_producto,
            //                     'precio': precio,
            //                     'cantidad': cantidad,
            //                     'nombre_producto': nombre_producto
            //                 });

            //             }

            //         }
            //         console.log(precios.length);

            //         console.log(productos);

            //         sumarPrecios(precios);

            //     }

            // });


            $("#cont-cheks").on("click", "button.btn_desbloquear_precio", function() {

                var id_producto = $(this).attr('data-id-producto');

                const {
                    value: password
                } = Swal.fire({
                    title: 'Se necesitan permisos de administrador',
                    input: 'password',
                    inputLabel: 'Password',
                    inputPlaceholder: 'Ingresa el password',
                    inputAttributes: {
                        maxlength: 15,
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    }
                }).then((password) => {

                    var password = password.value;

                    $.ajax({
                        url: "/Caja/buscarPassword",
                        type: "POST",
                        data: {
                            password
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            console.log("Procesando....");

                        },
                        success: function(respuesta) {

                            if (respuesta.status == "success") {
                                console.log(respuesta);

                                // $("#precio_articulo"+id_producto).removeAttr('readonly');
                                // $("#precio_articulo"+id_producto).css('border','solid 1px #000');
                                // $("#precio_desbloquedo_por").val(respuesta.admin.utilerias_administradores_id);

                                $(".precio_articulo").removeAttr('readonly');
                                $(".precio_articulo").css('border', 'solid 1px #000');
                                $("#precio_desbloquedo_por").val(respuesta.admin.utilerias_administradores_id);

                            } else {
                                Swal.fire('Password incorrecto', '', 'error');
                            }

                        },
                        error: function(respuesta) {
                            console.log(respuesta);
                        }

                    });

                });




                $(".precio_articulo").on("change", function() {

                    var id_producto = $(this).attr('data-id-producto');
                    var cantidad = 1;
                    var precio = $(this).val();
                    var nombre_producto = $(this).attr('data-nombre-producto');



                    $("#check_curso_" + id_producto).attr('data-precio', precio);

                    $("#numero_articulos" + id_producto).attr('data-precio', precio);

                    // if ($("#check_curso_" + id_producto).is(':checked')) {

                    for (var i = 0; i < precios.length; i++) {

                        if (precios[i].id_product === id_producto) {
                            console.log("remover");
                            precios.splice(i, 1, {
                                'id_product': id_producto,
                                'precio': precio,
                                'cantidad': cantidad
                            });

                            productos.splice(i, 1, {
                                'id_product': id_producto,
                                'precio': precio,
                                'cantidad': cantidad,
                                'nombre_producto': nombre_producto
                            });

                            // precios.push({'id_product':id_product,'precio':precio,'cantidad':cantidad});
                        }

                    }
                    // console.log(precios.length);

                    // console.log(productos);

                    console.log("se ejecuta");

                    sumarPrecios(precios);
                    sumarProductos(productos);
                    $("#cont-descripcion").show();
                    flag_descripcion = true;

                    // }
                });

                $(".select_numero_articulos").on("change", function() {
                    var id_producto = $(this).attr('data-id-producto');
                    var cantidad = $(this).val();
                    var precio = $(this).attr('data-precio');
                    var nombre_producto = $(this).attr('data-nombre-producto');

                    if ($("#check_curso_" + id_producto).is(':checked')) {

                        for (var i = 0; i < precios.length; i++) {

                            if (precios[i].id_product === id_producto && precios[i].cantidad != cantidad) {
                                console.log("remover");
                                precios.splice(i, 1, {
                                    'id_product': id_producto,
                                    'precio': precio,
                                    'cantidad': cantidad
                                });

                                productos.splice(i, 1, {
                                    'id_product': id_producto,
                                    'precio': precio,
                                    'cantidad': cantidad,
                                    'nombre_producto': nombre_producto
                                });

                                // precios.push({'id_product':id_product,'precio':precio,'cantidad':cantidad});
                            }

                        }
                        console.log(precios.length);

                        console.log(productos);

                        sumarPrecios(precios);

                    }
                });

            });


            function sumarPrecios(precios) {
                console.log(precios);

                // var sumaPrecios = <?= $total_pago ?>;
                // var sumaArticulos = <?= $total_productos ?>;

                var sumaPrecios = 0;
                var sumaArticulos = 0;

                precios.forEach(function(precio, index) {

                    console.log("precio " + index + " | id_product: " + precio.id_product + " precio: " + parseInt(precio.precio) + " cantidad: " + parseInt(precio.cantidad))

                    sumaPrecios += parseInt(precio.precio * precio.cantidad);
                    sumaArticulos += parseInt(precio.cantidad);


                });



                console.log("Suma precios " + sumaPrecios);

                $("#total_pesos").html((sumaPrecios).toFixed(2));
                $("#total_pesos_formato").html(format2(sumaPrecios, ''));

                var total_pagar = $("#txt_pago").val();
                var cambio = 0;

                // if($("#metodo_pago").val() == 'Efectivo'){
                if (total_pagar >= sumaPrecios) {
                    // $("#btn_pagar").removeAttr('disabled');
                    cambio = total_pagar - sumaPrecios;
                    $("#total_cambio").html(cambio);
                    $("#total_cambio_formato").html(format2(cambio, ''));

                    // console.log("se habilita");
                } else {
                    // $("#btn_pagar").attr('disabled', 'disabled');
                    $("#total_cambio").html("");
                    $("#total_cambio_formato").html("");
                    // console.log("se desabilita");
                }
                // }else{
                //     $("#btn_pagar").removeAttr('disabled');
                // }
            }

            function sumarProductos(productos) {
                console.log(productos);
                var nombreProductos = '';
                var plantilla_productos = '';

                console.log("Suma de productos");
                console.log(productos.length)

                if (productos.length != 0) {
                    plantilla_productos += `<p>Se han seleccionado los siguientes productos</p>`;
                    $("#cont-productos-seleccionados").css({
                        "padding": "14px",
                        "border": "1px solid",
                        "border-radius": "6px",
                        "margin-top": "15px",
                        "margin-bottom": "15px"
                    });
                } else {
                    $("#cont-productos-seleccionados").css({
                        "padding": "",
                        "border": "",
                        "border-radius": "",
                        "margin-top": "",
                        "margin-bottom": ""
                    });
                }
                plantilla_productos += `<ul>`;

                productos.forEach(function(producto, index) {

                    console.log("precio " + index + " | id_product: " + producto.id_product + " precio: " + parseInt(producto.precio) + " cantidad: " + parseInt(producto.cantidad) + " producto: " + producto.nombre_producto)

                    nombreProductos += producto.nombre_producto + ',';

                    plantilla_productos += `<li style="text-align: justify; font-size:14px;">
                                                ${producto.nombre_producto} Cant. ${producto.cantidad}&nbsp; <button class="btn bg-gradient-danger btn-tool m-0 quitar_producto" value="${producto.id_product}" style="padding: 0.8%;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Quitar Producto"><i class="fas fa-trash " aria-hidden="true"></i></button>
                                            </li>`;
                });

                plantilla_productos += `</ul>`;

                // console.log(nombreProductos);

                $("#item_name").val(nombreProductos);

                $("#cont-productos-seleccionados").html(plantilla_productos);

            }

            $("#cont-productos-seleccionados").on("click", "button.quitar_producto", function() {
                var id_producto = $(this).val();
                // alert(id_producto);
                $("#check_curso_" + id_producto).prop("checked", false);
                for (var i = 0; i < precios.length; i++) {

                    if (precios[i].id_product === id_producto) {
                        console.log("remover");
                        precios.splice(i, 1);

                        productos.splice(i, 1);
                        sumarPrecios(precios);
                        sumarProductos(productos);
                    } else if (precios[i].id_product === id_producto && precios[i].cantidad === cantidad) {
                        precios.splice(i, 1);

                        productos.splice(i, 1);
                        sumarPrecios(precios);
                        sumarProductos(productos);

                    }
                }
            });



        });

        window.addEventListener("keypress", function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
            }
        }, false);
    </script>

</body>

<?php echo $footer; ?>

</html>