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

                                                    <div>
                                                        <h3 class="mb-0">Nombre: <br> <span id="nombre_completo" class="text-thin"></span> </h3>

                                                        <h3 class="mb-0">Email: <br> <span id="email_usuario" class="text-thin"></span> </h3>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 mt-sm-0 mt-4">

                                            <div class="row mt-3">
                                                <div class="col-md-12" id="cont-edit">

                                                </div>
                                            </div>


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

    <!-- Actualizar datos -->
    <div class="modal fade" id="editDataUser" tabindex="-1" role="dialog" aria-labelledby="editDataUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataUserLabel">Actualizar Usuario</h5>
                    <span type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal" aria-label="Close">
                        X
                    </span>
                </div>
                <form class="form-horizontal" id="update_fiscal_data" action="" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="modal_user_id" id="modal_user_id">
                        <div class="row">
                            <div class="col-12 col-sm-2">
                                <label>Prefijo *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="title" id="title_update" required>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Dra.">Dra.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Sra.">Sra.</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label>Nombre *</label>
                                <input class="multisteps-form__input form-control" type="text" id="nombre_user_update" name="nombre_user" placeholder="" maxlength="100" style="text-transform:uppercase;" required>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label>Apellido Paterno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidop_user_update" name="apellidop_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-5">
                                <label>Apellido Materno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidom_user_update" name="apellidom_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-7">
                                <label>Email *</label>
                                <input class="multisteps-form__input form-control" type="text" id="email_user_update" name="email_user" placeholder="" maxlength="100">
                                <input type="hidden" id="email_user_update_keep">
                                <span id="msg_email_user_update" style="color:#FF3B11;font-size: 12px;"></span>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Teléfono</label>
                                <input class="multisteps-form__input form-control" type="number" id="telephone_update" name="telephone" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ej. (555) 555-1234" autocomplete="no" value="">
                            </div>

                            <div class="col-12 col-sm-4" id="cont-categoria">

                                <label>Nivel *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="categorias" id="categorias_update" required readonly>
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <?php echo $categorias ?>
                                </select>

                            </div>


                            <div class="col-12 col-sm-4" id="cont-especialidades">

                                <label id="label-especialidades">Especialidades *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="especialidades" id="especialidades_update" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>

                                    <?= $especialidades ?>

                                </select>

                            </div>


                            <div class="col-12 col-sm-4" id="cont-especialidad-text-update" style="display: none;">

                                <label id="label-especialidades">Especialidad (Especifique) *</label>
                                <input type="text" class="form-control" id="txt_especialidad_update" name="txt_especialidad">

                            </div>




                            <div class="col-12 col-sm-4">
                                <label>País *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="nationality" id="nationality_update" onchange="actualizaEdosUpdate();" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <option value="156">Mexico</option>
                                    <?php echo $idCountry; ?>
                                </select>
                            </div>


                            <div class="col-12 col-sm-4  ">
                                <label>Estado *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="state" id="state_update" required>

                                </select>
                            </div>

                            <div class="col-12 col-sm-4">

                                <label id="label-categoria_gaf">Categoria *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="categoria_gaf" id="categoria_gaf_update" required readonly>
                                    <option value="" disabled selected>Selecciona una Opción</option>

                                    <?= $categoria_gaf ?>

                                </select>

                            </div>

                            <div class="col-12 col-sm-4 cont-porcentaje-becado-update" style="display: none;">

                                <label id="label-porcentaje-becado">Becado %</label>
                                <input type="number" min="0" class="form-control" id="porcentaje_becado_update" name="porcentaje_becado">

                            </div>

                            <div class="col-12 col-sm-4 cont-porcentaje-becado-update" style="display: none;">

                                <label id="label-porcentaje-becado">Comentario Beca</label>
                                <textarea class="form-control" name="comentario_beca" id="comentario_beca_update" cols="30" rows="5"></textarea>

                            </div>

                        </div>
                        <br>


                        <h5 class="modal-title" id="">Datos de Facturación</h5>

                        <hr>


                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Razón Social </label>
                                <input class="multisteps-form__input form-control" type="text" id="business_name_iva_update" name="business_name_iva" style="text-transform: uppercase;" placeholder="eg. Christopher Prior Jones" maxlength="100">
                            </div>
                            <div class="col-12 col-sm-4 mt-1 mt-sm-0">
                                <label>RFC </label>
                                <input class="multisteps-form__input form-control" type="text" id="code_iva_update" name="code_iva" placeholder="eg. CPJ41250AS" maxlength="13" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label>Correo Electrónico facturación </label>
                                <input class="multisteps-form__input form-control" type="text" id="email_receipt_iva_update" name="email_receipt_iva" placeholder="eg. user@domain.com">
                                <span class="mb-0 text-sm" id="error_email_send" style="display:none;color:red;">Correo electrónico incorrecto</span>
                            </div>


                            <div class="col-md-4 col-sm-12">
                                <label>CP</label>
                                <input class="multisteps-form__input form-control" id="postal_code_iva_update" name="postal_code_iva" type="number" min="1" maxlength="5" placeholder="Código postal" class="form-control ameg-shadow-box-two" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>CFDI * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="cfdi" id="cfdi_update">
                                    <option value="">Selecciona una opción</option>
                                    <?= $usoCfdi ?>

                                </select>

                            </div>

                            <div class="col-md-4 col-sm-12">
                                <label>Régimen Fiscal * </label>
                                <select class="multisteps-form__select form-control all_input_select" name="regimen_fiscal" id="regimen_fiscal_update">
                                    <option value="">Selecciona una opción</option>
                                    <?= $remigenFiscal ?>
                                </select>

                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label>Dirección Fiscal </label>
                                <textarea class="multisteps-form__input form-control" name="direccion_user" id="direccion_user_update" cols="30" rows="3"></textarea>

                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="reset" id="reset_form_updateUser" data-bs-dismiss="modal" class="d-none">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="cerrar_modal_datos_fac">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary" id="btn_update_user">Guardar</button>
                    </div>
                </form>
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

            function actualizaEdosUpdate(pais = null) {
                var pais = $('#nationality_update').val();

                $.ajax({
                        url: '/Auto/ObtenerEstado',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            pais
                        }
                    })
                    .done(function(json) {
                        console.log(json)
                        if (json.success) {
                            $("#state_update").html(json.html);
                        }
                    })
                    .fail(function() {
                          alert("Ocurrio un error al actualizar el estado intenta de nuevo");
                    })
            }
            //Actulizar usuarios
            $("#update_fiscal_data").on("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(document.getElementById("update_fiscal_data"));
                for (var value of formData.values()) {
                    console.log(value);
                }

                $.ajax({
                    url: "/Auto/UpdateFiscalData",
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
                            swal("¡Se actualizaron los Datos Correctamente!", "", "success")
                            // $('#cerrar_modal').click();
                            $("#cerrar_modal_datos_fac").click();

                        } else {
                            console.log(respuesta);
                            swal("¡Hubo un error al actualizar!", "Contacte a soporte", "error")
                            $("#cerrar_modal_datos_fac").click();
                            // $('#cerrar_modal').modal();
                        }


                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            });

            $("#email_user_update").on("keyup", function() {
                var email = $(this).val();
                $("#email_receipt_iva_update").val(email);

                console.log(email);

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

                        if (respuesta.length > 0) {

                            if (respuesta[0].usuario == $("#email_user_update_keep").val()) {
                                $("#msg_email_user_update").html("");
                            } else {
                                $("#msg_email_user_update").html("Este correo ya esta registrado.");
                                $("#btn_update_user").attr('disabled', 'disabled');
                            }

                        } else {
                            $("#msg_email_user_update").html("");
                            $("#btn_update_user").removeAttr('disabled');
                        }

                    },
                    error: function(respuesta) {

                    }

                });
            })

            $("#btn_search_constancia").on("click", function() {
                var concidencia = $("#codigo_qr_venta").val();

                // console.log(concidencia)

                $.ajax({
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
                $("#codigo_qr_venta").val('');

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
                    $("#nombre_completo").text(respuesta.datos_user.nombre_completo);
                    $("#email_usuario").text(respuesta.datos_user.usuario);
                    $("#cont-text").html(respuesta.text_pendiente + respuesta.button_gafete);

                    $("#cont-edit").html('<button type="button" class="btn bg-gradient-info  mb-0 mt-3" data-bs-toggle="modal" data-bs-target="#editDataUser">Actualizar Datos</button>');

                    //modal facturacion
                    $("#modal_user_id").val(respuesta.datos_user.user_id);
                    $("#title_update").val(respuesta.datos_user.title);
                    $("#nombre_user_update").val(respuesta.datos_user.nombre);
                    $("#apellidop_user_update").val(respuesta.datos_user.apellidop);
                    $("#apellidom_user_update").val(respuesta.datos_user.apellidom);
                    $("#email_user_update").val(respuesta.datos_user.usuario);
                    $("#email_user_update_keep").val(respuesta.datos_user.usuario);
                    $("#telephone_update").val(respuesta.datos_user.telefono);
                    $("#categorias_update").val(respuesta.datos_user.id_categoria);
                    $("#especialidades_update").val(respuesta.datos_user.especialidades);
                    $("#nationality_update").val(respuesta.datos_user.id_pais);


                    actualizaEdosUpdate(respuesta.datos_user.id_pais);

                    setTimeout(function() {
                        $("#state_update").val(respuesta.datos_user.id_estado);
                    }, 1000);


                    $("#categoria_gaf_update").val(respuesta.datos_user.categoria_gafete);
                    // if (respuesta.datos_user.categoria_gafete == 2) {
                    //     $(".cont-porcentaje-becado-update").show();
                    // }
                    $("#porcentaje_becado_update").val(respuesta.datos_user.porcentaje_beca);
                    $("#comentario_beca_update").val(respuesta.datos_user.comentario_beca);



                    $("#business_name_iva_update").val(respuesta.datos_user.business_name_iva);
                    $("#code_iva_update").val(respuesta.datos_user.code_iva);
                    $("#email_receipt_iva_update").val(respuesta.datos_user.email_receipt_iva);
                    $("#direccion_update").val(respuesta.datos_user.direccion);
                    $("#postal_code_iva_update").val(respuesta.datos_user.postal_code_iva);
                    $("#cfdi_update").val(respuesta.datos_user.cfdi);
                    $("#regimen_fiscal_update").val(respuesta.datos_user.regimen_fiscal);
                    $("#direccion_user_update").val(respuesta.datos_user.direccion);



                } else if (respuesta.no_cards == 0 && respuesta.nombre_completo == null) {
                    $("#cont_cards").html(`<div class="row mt-3 p-3">
                                                        <div class="col-md-12">
                                                            <p>El usuario buscado no existe en la base de datos.</p>
                                                        </div>
                                                        
                                                    </div>`);
                    $("#nombre_completo").text('El usuario no existe');
                    $("#email_usuario").text('------------------');
                    $("#cont-text").html('');
                }

            }


        });
    </script>

</body>

<?php echo $footer; ?>

</html>