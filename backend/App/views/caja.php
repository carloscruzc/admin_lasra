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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-gradient-pink avatar avatar-xl ">

                                    <span class="fas fa-cash-register" style="font-size: xx-large;"></span>

                                </div>
                                <span style="font-size: 30px; font-weight: 500; color: #000;">Caja</span>
                            </div>

                            <div class="col-md-6 d-flex justify-content-end">
                                <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#addNewUser" style="margin-right: 10px;">
                                    Agregar Usuario
                                </button>
                                <a href="/ComprobantesCaja/comprobantes" target="blank_" class="btn bg-gradient-pink" style="color: white;"> Ver comprobantes</a>

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

                            <div class="col-auto">
                                <div class="row mt-4">
                                    <div class="col-lg-12 col-sm-6">
                                        <div class="card h-100">
                                            <div class="card-header pb-0 p-3">

                                                <div class="row gx-2 gx-sm-3">
                                                    <div class="col">
                                                        <div class="form-group">

                                                            <input style="font-size: 35px" type="text" class="form-control" id="codigo_qr_venta" name="codigo_qr_venta" list="list_concidencias" autofocus>
                                                            <datalist id="list_concidencias">

                                                            </datalist>
                                                            <!-- user_id -->
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


                                            <div class="row m-2">
                                                <h6>Correo: <span class="text-thin" id="correo_user"> _____</span></h6>
                                                <h6>Teléfono: <span class="text-thin" id="telefono_user"> 00 0000 0000</span></h6>
                                                <input type="hidden" id="user_id" name="user_id">
                                                <input type="hidden" id="clave_socio" name="clave_socio">
                                                <input type="hidden" id="precio_desbloquedo_por" name="precio_desbloquedo_por">

                                                <a href="" id="generar_gafete" target="_blank" style="display: none;">gafete</a>
                                                <a href="" id="imprimir_comprobante" target="_blank" style="display: none;">comprobante</a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6 mt-sm-0 mt-4">
                                        <div class="card mt-3">
                                            <div class="card-header pb-0 p-3">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="<?php echo $descripcion; ?>">
                                                        <i class="fas fa-info" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="card p-4" style="overflow-y: auto;">

                                                    <div id="cont-cheks">

                                                    </div>

                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-8">
                                                        <div class="cont-totales">
                                                            <div class="row">

                                                                <div class="col-md-8">
                                                                    <div class="cont-totales-pesos">
                                                                        <div>
                                                                            <span class="font-totales">Total pesos mexicanos: $ <span id="total_pesos_formato"></span></span>
                                                                            <span class="font-totales" style="display: none;">Total pesos mexicanos: $ <span id="total_pesos"></span></span>
                                                                        </div>
                                                                        <br>

                                                                        <div class="cont_cambio_pesos">

                                                                            <span class="font-totales">Cambio pesos mexicanos: $ <span id="total_cambio_formato"></span></span>
                                                                            <span class="font-totales" style="display: none;">Cambio pesos mexicanos: $ <span id="total_cambio"></span></span>
                                                                        </div>
                                                                    </div>


                                                                    <div class="cont-totales-dolares" style="display: none;">
                                                                        <div>
                                                                            <span class="font-totales">Total dolares: $ <span id="total_dolares_formato"></span></span>
                                                                            <span class="font-totales" style="display: none;">Total dolares: $ <span id="total_dolares"></span></span>
                                                                        </div>
                                                                        <br>

                                                                        <div class="cont_cambio_dolares">

                                                                            <span class="font-totales">Cambio dolares: $ <span id="total_dolares_cambio_formato"></span></span>
                                                                            <span class="font-totales" style="display: none;">Cambio dolares: $ <span id="total_cambio_dolares"></span></span>
                                                                        </div>
                                                                    </div>

                                                                    <br>

                                                                </div>

                                                                <div class="col-md-4" id="cont-descripcion" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label>Descripción</label>
                                                                        <textarea class="form-control" id="txt_descripcion" name="txt_descripcion" rows="6" cols="100"> </textarea>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="col-md-4 cont-totales">
                                                        <div style="display:flex; justify-content: space-evenly;">


                                                            <div id="cont-input-pay">

                                                                <div>
                                                                    <label>Tipo Moneda *</label>
                                                                    <select class="form-control" id="tipo_moneda" name="tipo_moneda">
                                                                        <option value="" disabled>Seleccione una opción</option>
                                                                        <option value="MXN">$ MXN</option>
                                                                        <option value="USD">$ USD</option>

                                                                    </select>
                                                                </div>

                                                                <div>
                                                                    <label>Metodo de Pago *</label>
                                                                    <select class="form-control" id="metodo_pago" name="metodo_pago">
                                                                        <option value="">Seleccione una opción</option>
                                                                        <option value="Efectivo">Efectivo</option>
                                                                        <option value="Tarjeta">Tarjeta Credito / Debito</option>

                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Ingrese el monto *</label>
                                                                    <input type="number" class="form-control" id="txt_pago" name="txt_pago" min="0" step="0.01">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div style="display:flex; justify-content:start;">

                                                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#datosFacturacion" style="display: none;" id="btn_fact">
                                                                Actualización de Datos
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div style="display:flex; justify-content:end;">

                                                            <button id="btn_pagar" class="btn btn-primary" disabled>Pagar</button>
                                                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_talleres">
                                                                Launch demo modal
                                                            </button> -->
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
            </div>
        </div>

    </main>

    <!-- Modal crear nuevo usuario -->
    <div class="modal fade" id="addNewUser" tabindex="-1" role="dialog" aria-labelledby="addNewUserLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                            <div class="col-12 col-sm-2">
                                <label>Prefijo *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="title" id="title" required>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Dra.">Dra.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Sra.">Sra.</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label>Nombre *</label>
                                <input class="multisteps-form__input form-control" type="text" id="nombre_user" name="nombre_user" placeholder="" maxlength="100" style="text-transform:uppercase;" required>
                            </div>
                            <div class="col-12 col-sm-5">
                                <label>Apellido Paterno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidop_user" name="apellidop_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-5">
                                <label>Apellido Materno *</label>
                                <input class="multisteps-form__input form-control" type="text" id="apellidom_user" name="apellidom_user" placeholder="" style="text-transform:uppercase;" maxlength="100">
                            </div>

                            <div class="col-12 col-sm-7">
                                <label>Email *</label>
                                <input class="multisteps-form__input form-control" type="text" id="email_user" name="email_user" placeholder="" maxlength="100">
                                <span id="msg_email_user" style="color:#FF3B11;font-size: 12px;"></span>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Teléfono</label>
                                <input class="multisteps-form__input form-control" type="number" id="telephone" name="telephone" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ej. (555) 555-1234" autocomplete="no" value="">
                            </div>

                            <div class="col-12 col-sm-4" id="cont-categoria">

                                <label>Nivel *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="categorias" id="categorias" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <?php echo $categorias ?>
                                </select>

                            </div>



                            <!-- <div class="col-12 col-sm-4" id="cont-ano-residente" style="display: none;">

                                <label>Año de Residencia *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="ano_residencia" id="ano_residencia">
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>

                                </select>

                            </div> -->

                            <!-- <div class="col-12 col-sm-4" id="cont-archivo-residente" style="display: none;">
                                <label>Archivo *</label>
                                <input type="file" accept="image/*,.pdf" class="form-control" id="archivo_residente" name="archivo_residente" style="width: auto; margin: 0 auto;" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div> -->


                            <!-- <div class="col-12 col-sm-4 mt-3" id="cont-clave-socio" style="display: none;">
                                <label id="label-clave-socio">Clave Socio *</label>
                                <input type="text" class="form-control" name="clave_socio" id="clave_socio" value="<?= $data['clave_socio'] ?>">
                            </div> -->

                            <div class="col-12 col-sm-4" id="cont-especialidades">

                                <label id="label-especialidades">Especialidades *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="especialidades" id="especialidades" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>

                                    <?= $especialidades ?>

                                </select>

                            </div>


                            <div class="col-12 col-sm-4" id="cont-especialidad-text" style="display: none;">

                                <label id="label-especialidades">Especialidad (Especifique) *</label>
                                <input type="text" class="form-control" id="txt_especialidad" name="txt_especialidad">

                            </div>




                            <div class="col-12 col-sm-4">
                                <label>País *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="nationality" id="nationality" onchange="actualizaEdos();" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <option value="156">Mexico</option>
                                    <?php echo $idCountry; ?>
                                </select>
                            </div>


                            <div class="col-12 col-sm-4  ">
                                <label>Estado *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="state" id="state" required>

                                </select>
                            </div>

                            <div class="col-12 col-sm-4">

                                <label id="label-categoria_gaf">Categoria *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="categoria_gaf" id="categoria_gaf" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>

                                    <?= $categoria_gaf ?>

                                </select>

                            </div>

                            <div class="col-12 col-sm-4 cont-porcentaje-becado" style="display: none;">

                                <label id="label-porcentaje-becado">Becado %</label>
                                <input type="number" min="0" value="0" class="form-control" id="porcentaje_becado" name="porcentaje_becado">

                            </div>

                            <div class="col-12 col-sm-4 cont-porcentaje-becado" style="display: none;">

                                <label id="label-porcentaje-becado">Comentario Beca</label>
                                <textarea class="form-control" name="comentario_beca" id="comentario_beca" cols="30" rows="5"></textarea>

                            </div>

                        </div>
                        <br>


                        <h5 class="modal-title" id="">Datos de Facturación</h5>

                        <hr>

                        <!-- <input type="hidden" name="modal_user_id" id="modal_user_id"> -->
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <label>Razón Social </label>
                                <input class="multisteps-form__input form-control" type="text" id="business_name_iva_user" name="business_name_iva_user" style="text-transform: uppercase;" placeholder="eg. Christopher Prior Jones" maxlength="100">
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
                                <input class="multisteps-form__input form-control" id="postal_code_iva_user" name="postal_code_iva_user" type="number" min="1" maxlength="5" placeholder="Código postal" class="form-control ameg-shadow-box-two" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
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
                        <input type="reset" id="reset_form_addUser" data-bs-dismiss="modal" class="d-none">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal" id="cerrar_modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary" id="btn_save_user">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Actualizar datos -->
    <div class="modal fade" id="datosFacturacion" tabindex="-1" role="dialog" aria-labelledby="datosFacturacionLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datosFacturacionLabel">Actualizar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                                <span id="msg_email_user_update" style="color:#FF3B11;font-size: 12px;"></span>
                            </div>

                            <div class="col-12 col-sm-4">
                                <label>Teléfono</label>
                                <input class="multisteps-form__input form-control" type="number" id="telephone_update" name="telephone" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" placeholder="ej. (555) 555-1234" autocomplete="no" value="">
                            </div>

                            <div class="col-12 col-sm-4" id="cont-categoria">

                                <label>Nivel *</label>
                                <select class="multisteps-form__select form-control all_input_select" name="categorias" id="categorias_update" required>
                                    <option value="" disabled selected>Selecciona una Opción</option>
                                    <?php echo $categorias ?>
                                </select>

                            </div>



                            <!-- <div class="col-12 col-sm-4" id="cont-archivo-residente" style="display: none;">
                                <label>Archivo *</label>
                                <input type="file" accept="image/*,.pdf" class="form-control" id="archivo_residente" name="archivo_residente" style="width: auto; margin: 0 auto;" onfocus="focused(this)" onfocusout="defocused(this)">
                            </div> -->




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
                                <select class="multisteps-form__select form-control all_input_select" name="categoria_gaf" id="categoria_gaf_update" required>
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

    <!-- modal seleccionar talleres -->
    <div class="modal fade" id="modal_talleres" role="dialog" aria-labelledby="" aria-hidden="" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">

        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_talleresLabel">
                        Talleres
                    </h5>
                    <p id="nombre_user_text"></p>
                </div>
                <center>
                    <div class="modal-body">
                        <div class="container-fluid py-0">
                            <div class="card col-lg-12 mt-lg-4 mt-1">
                                <div class="card-header pb-0 p-3">
                                    <p style="font-size: 14px">Compro el paquete <b><span id="nombre_paquete"></span></b> (Seleccione a continuación los <b><span id="numero_talleres"></span></b> Talleres para crear su paquete)</p>

                                    <input type="hidden" name="clave_combo" id="clave_combo" value="">
                                </div>
                                <div class="card-body px-5 pb-5">


                                    <div class="row">
                                        <div class="col-md-12">

                                            <div id="cont-checks">




                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div id="buttons">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>Productos agregados: <span id="productos_agregados"></span></p>

                                                            </div>

                                                            <div class="col-md-6">

                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div id="buttons">

                                                        <div class="row">
                                                            <div class="col-md-6">

                                                            </div>

                                                            <div class="col-md-6" style="display: flex; justify-content: end;">



                                                                <button class="btn bg-gradient-info" id="btn_pago">Elegir Talleres</button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>

                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
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

        function actualizaEdos(pais = null) {
            var pais = $('#nationality').val();

            $.ajax({
                    url: '/Caja/ObtenerEstado',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pais: pais
                    },

                })
                .done(function(json) {
                    if (json.success) {
                        $("#state").html(json.html);
                    }
                })
                .fail(function() {
                    //   alert("Ocurrio un error al actualizar el estado intenta de nuevo");
                })
        }

        function actualizaEdosUpdate(pais = null) {
            var pais = $('#nationality_update').val();

            $.ajax({
                    url: '/Caja/ObtenerEstado',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pais: pais
                    },

                })
                .done(function(json) {
                    if (json.success) {
                        $("#state_update").html(json.html);
                    }
                })
                .fail(function() {
                    //   alert("Ocurrio un error al actualizar el estado intenta de nuevo");
                })
        }

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

            // getCombo(625);

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
                                $("#search_item").focus();
                            });
                            // $("#addNewUser").modal('hide');
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
                            // $("#addNewUser").modal('hide');
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

            $("#nombre_user").on("keyup", function() {
                var nombre = $(this).val();
                var apellidop = $("#apellidop_user").val();
                var apellidom = $("#apellidom_user").val();
                $("#business_name_iva_user").val(nombre + " " + apellidop + " " + apellidom);
            })

            $("#apellidop_user").on("keyup", function() {
                var nombre = $("#nombre_user").val();
                var apellidop = $(this).val();
                var apellidom = $("#apellidom_user").val();
                $("#business_name_iva_user").val(nombre + " " + apellidop + " " + apellidom);
            })

            $("#apellidom_user").on("keyup", function() {
                var nombre = $("#nombre_user").val();
                var apellidop = $("#apellidop_user").val();
                var apellidom = $(this).val();
                $("#business_name_iva_user").val(nombre + " " + apellidop + " " + apellidom);
            })


            $("#email_user").on("keyup", function() {
                var email = $(this).val();
                $("#email_receipt_iva_user").val(email);

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

            //si la categoria es residente
            $('#categorias').on('change', function() {
                let categoria = $(this).val();

                if (categoria == 3) {
                    // $('#cont-archivo-residente').css('display', 'inline-block');
                    // $('#archivo_residente').attr('required', 'required');
                    $('#cont-ano-residente').css('display', 'inline-block');
                    $('#ano_residencia').attr('required', 'required');

                    // Swal.fire({
                    //     title: '',
                    //     text: 'Se le recuerda que deberá subir imagen legible de su credencial de residente vigente, o su carta de residencia expedida por su hospital vigente, para proceder a realizar el cobro, de lo contrario deberá pagar la inscripción al Curso o al Congreso en la Modalidad de Médico No Socio',
                    //     icon: 'info',
                    //     showCancelButton: true,
                    //     showCancelButton: false,
                    //     allowOutsideClick: false,
                    //     confirmButtonColor: '#3085d6',
                    //     confirmButtonText: 'Aceptar'
                    // })
                } else {
                    // $('#cont-archivo-residente').css('display', 'none');
                    // $('#archivo_residente').removeAttr('required')
                    // $('#archivo_residente').val('')
                    $('#cont-ano-residente').css('display', 'none');
                    $('#ano_residencia').removeAttr('required');
                    $('#ano_residencia').val('');


                }
            });

            $("#especialidades").on("change", function() {
                // var especialidad = $("#especialidades option:selected").text();
                var especialidad = $(this).val();
                if (especialidad == 6) {
                    $("#cont-especialidad-text").show();
                    $("#txt_especialidad").attr('required', 'required');
                } else {
                    $("#cont-especialidad-text").hide();
                    $("#txt_especialidad").val("");
                    $("#txt_especialidad").removeAttr('required');
                }
            })

            //upadte especialidades
            $("#especialidades_update").on("change", function() {
                // var especialidad = $("#especialidades option:selected").text();
                var especialidad = $(this).val();
                if (especialidad == 6) {
                    $("#cont-especialidad-text-update").show();
                    $("#txt_especialidad_update").attr('required', 'required');
                } else {
                    $("#cont-especialidad-text").hide();
                    $("#txt_especialidad_update").val("");
                    $("#txt_especialidad_update").removeAttr('required');
                }
            })

            $("#categoria_gaf").on("change", function() {
                var categoria_gaf = $(this).val();

                if (categoria_gaf == 2) {
                    $(".cont-porcentaje-becado").show();
                    // $("#porcentaje_becado").attr('required', 'required');
                    // $("#comentario_beca").attr('required', 'required');

                } else {
                    $(".cont-porcentaje-becado").hide();
                    $("#porcentaje_becado").val("");
                    $("#comentario_beca").val("");
                    $("#porcentaje_becado").removeAttr('required');
                    $("#comentario_beca").removeAttr('required');
                }
            });

            $("#categoria_gaf_update").on("change", function() {
                var categoria_gaf = $(this).val();

                if (categoria_gaf == 2) {
                    $(".cont-porcentaje-becado-update").show();
                } else {
                    $(".cont-porcentaje-becado-update").hide();
                    $("#porcentaje_becado_update").val("");
                    $("#comentario_beca_update").val("");
                }
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
                        // console.log(respuesta.length);
                        if (respuesta.length > 0) {
                            $("#msg_email_user_update").html("Este correo ya esta registrado.");
                            $("#btn_update_user").attr('disabled', 'disabled');
                        } else {
                            $("#msg_email_user_update").html("");
                            $("#btn_update_user").removeAttr('disabled');
                        }

                    },
                    error: function(respuesta) {

                    }

                });
            })



            function seleccionarTalleres(user_id) {
                getCombo(user_id);
            }

            function getCombo(user_id) {


                $.ajax({
                    url: "/Caja/getCombo",
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
                        if (respuesta.status == true && respuesta.check_talleres == 0) {
                            $('#modal_talleres').modal('show');
                            $("#nombre_paquete").text(respuesta.nombre_combo);
                            $("#numero_talleres").text(respuesta.numero_talleres);
                            $("#nombre_user_text").text(respuesta.nombre_user);
                            $("#clave_combo").val(respuesta.clave);
                            getTalleres(user_id);
                        } else {
                            location.reload();
                        }

                    },
                    error: function(respuesta) {

                    }

                });
            }

            function getTalleres(user_id) {
                $.ajax({
                    url: "/Caja/getTalleres",
                    type: "POST",
                    data: {
                        user_id
                    },
                    // dataType: 'json',
                    beforeSend: function() {
                        console.log("Procesando....");
                    },
                    success: function(respuesta) {

                        $("#cont-checks").html(respuesta);

                    },
                    error: function(respuesta) {

                    }

                });
            }





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
                            swal("¡Se actualizaron los Datos Correctamente!", "", "success")
                            // $('#cerrar_modal').click();
                            $("#cerrar_modal_datos_fac").click();
                            getSell(formData.get('modal_user_id'));
                        } else {
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



            // var precios=<?php //echo json_encode($array_precios); 
                            ?>;
            // var productos=<?php //echo json_encode($array_productos); 
                                ?>;
            var flag_descripcion = false;

            var precios = [];
            var productos = [];

            // bloquearRegistro();

            $("#metodo_pago").on("change", function() {
                var metodo_pago = $(this).val();
                var tipo_moneda = $("#tipo_moneda").val();

                if (metodo_pago == "Tarjeta") {
                    $(".cont_cambio_pesos").hide();
                    $(".cont_cambio_dolares").hide();
                } else {

                    if (tipo_moneda == "MXN") {
                        $(".cont_cambio_pesos").show();
                    } else if (tipo_moneda == "USD") {
                        $(".cont_cambio_dolares").show();
                    }

                }
            });

            $("#btn_pagar").on("click", function() {
                var metodo_pago = $("#metodo_pago").val();
                var tipo_moneda = $("#tipo_moneda").val();
                var user_id = $("#user_id").val();
                var total_dolares = $("#total_dolares").text();
                var total_pesos = $("#total_pesos").text();
                var descripcion = $("#txt_descripcion").val();
                console.log(tipo_moneda);



                if (metodo_pago != '') {
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
                                    tipo_moneda,
                                    total_pesos,
                                    total_dolares,
                                    descripcion
                                },
                                // dataType: 'json',
                                beforeSend: function() {
                                    console.log("Procesando....");
                                },
                                success: function(respuesta) {
                                    console.log(respuesta);

                                    if (respuesta == 'success') {

                                        $('#imprimir_comprobante')[0].click();

                                        Swal.fire({
                                            icon: "success",
                                            title: "Info",
                                            text: "Pago generado correctamente.",
                                            closeOnClickOutside: false,
                                            closeOnEsc: false,
                                            allowOutsideClick: false
                                        }).then(() => {
                                            // $('#generar_gafete')[0].click();
                                            getCombo(user_id);

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
                    Swal.fire('Selecciona un metodo de pago', '', 'info');
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
                // var estado = $("#residencia").val();
                var concidencia = $(this).val();

                $.ajax({
                    url: "/Caja/SearchConcidenciaUsers",
                    type: "POST",
                    data: {
                        concidencia
                    },
                    dataType: "json",
                    beforeSend: function() {
                        console.log("Procesando....");
                        $('#list_concidencias')
                            .find('option')
                            .remove()
                            .end();
                        // $('#list_concidencias')
                        //     .find('li')
                        //     .remove()
                        //     .end();

                    },
                    success: function(respuesta) {
                        console.log(respuesta);


                        $.each(respuesta, function(key, value) {
                            //console.log(key);
                            console.log(value);
                            $('#list_concidencias')
                                .append($('<option>', {
                                        'data-value': value.user_id
                                    })
                                    .text(value.user_id + ' - ' + value.nombre + ' ' + value.apellidop + ' ' + value.apellidom + ' ' + value.usuario + ' ' + value.clave));

                            // $('#list_concidencias').append('<li>'+value.nombre+'</li>');


                        });

                    },
                    error: function(respuesta) {
                        console.log(respuesta);
                    }

                });
            });



            $("#codigo_qr_venta").on('change', function() {
                codigo = $(this).val();

                var split = codigo.split(" ");
                var user_id = split[0];
                // console.log(user_id);
                $("#codigo_qr_venta_hidden").val(user_id);
                $("#modal_user_id").val(user_id);

                $('#codigo_qr_venta').val('');

                console.log(user_id);

                getSell(user_id);


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
                            // $("#btn_desb_precio").show();
                            flag_descripcion = false;

                            // console.log(precios);
                            // console.log(productos);


                        } else {
                            // console.log(Object.keys(respuesta).length);
                            // crearTabla(respuesta);
                            // location.reload();
                            console.log("refrescar");
                        }
                    },
                    error: function(respuesta) {
                        Swal.fire('No se encontro ningun registro', '', 'info');
                        // setTimeout(function(){
                        //     location.reload();
                        // },1000)
                        console.log(respuesta);
                    }

                });
            }



            function crearChecks(respuesta) {
                console.log(respuesta.datos_user)
                $("#cont-cheks").html(respuesta.checks);
                $("#user_id").val(respuesta.datos_user.user_id);
                $("#nombre_completo").html(respuesta.nombre_completo);
                $("#correo_user").html(respuesta.datos_user.usuario);
                $("#telefono_user").html(respuesta.datos_user.telefono);
                $("#clave_socio").val(respuesta.datos_user.clave_socio);
                $("#imprimir_comprobante").attr('href', '/Caja/print/' + respuesta.datos_user.user_id + '/' + respuesta.datos_user.clave);

                //modal facturacion
                $("#title_update").val(respuesta.datos_user.title);
                $("#nombre_user_update").val(respuesta.datos_user.nombre);
                $("#apellidop_user_update").val(respuesta.datos_user.apellidop);
                $("#apellidom_user_update").val(respuesta.datos_user.apellidom);
                $("#email_user_update").val(respuesta.datos_user.usuario);
                $("#telephone_update").val(respuesta.datos_user.telefono);
                $("#categorias_update").val(respuesta.datos_user.id_categoria);
                $("#especialidades_update").val(respuesta.datos_user.especialidades);
                $("#nationality_update").val(respuesta.datos_user.id_pais);
                actualizaEdosUpdate();
                setTimeout(function() {
                    $("#state_update").val(respuesta.datos_user.id_estado);
                }, 1000);
                $("#categoria_gaf_update").val(respuesta.datos_user.categoria_gafete);

                if (respuesta.datos_user.categoria_gafete == 2) {
                    $(".cont-porcentaje-becado-update").show();
                }
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


            }




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

            $("#tipo_moneda").on("change", function() {
                var tipo_moneda = $(this).val();



                if (tipo_moneda == 'MXN') {
                    $(".cont-totales-pesos").css('display', 'inline-block');
                    $(".cont-totales-dolares").css('display', 'none');
                    $("#txt_pago").val("");
                    $("#btn_pagar").attr("disabled", "disabled");
                } else {
                    $(".cont-totales-pesos").css('display', 'none');
                    $(".cont-totales-dolares").css('display', 'inline-block');
                    $("#txt_pago").val("");
                    $("#btn_pagar").attr("disabled", "disabled");
                }
            });

            $("#txt_pago").on('keyup', function() {
                var tipo_moneda = $("#tipo_moneda").val();
                var total_pesos = parseFloat($("#total_pesos").text());
                var total_dolares = parseFloat($("#total_dolares").text());
                var total_pagar = $(this).val();
                var cambio = 0;


                if (tipo_moneda == "MXN") {

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

                } else if (tipo_moneda == "USD") {
                    if (total_pagar >= total_dolares) {
                        $("#btn_pagar").removeAttr('disabled');
                        cambio = total_pagar - total_dolares;
                        $("#total_cambio_dolares").html(cambio);
                        $("#total_dolares_cambio_formato").html(format2(cambio, ''));

                        // console.log("se habilita");
                    } else {
                        $("#btn_pagar").attr('disabled', 'disabled');
                        $("#total_cambio_dolares").html("");
                        $("#total_dolares_cambio_formato").html("");
                        // console.log("se desabilita");
                    }
                }



            });



            ///Pagos  
            $("#cont-cheks").on("change", "input[type=checkbox].checks_product", function() {
                var id_product = $(this).val();
                var precio = $(this).attr('data-precio');
                var precio_usd = $(this).attr('data-precio-usd');
                var precio_socio = $(this).attr('data-precio-socio');
                var precio_socio_usd = $(this).attr('data-precio-socio-usd');
                var cantidad = $("#numero_articulos" + id_product).val();
                var nombre_producto = $(this).attr('data-nombre-producto');


                if (this.checked) {

                    // if((id_product == 2 || id_product == 35) && $("#clave_socio").val() != ''){
                    if (id_product == 2 || id_product == 35) {
                        //1,23,34,44

                        // $(".precio_articulo").each(function(index) {
                        //         $("#precio_articulo" + $(this).attr('data-id-producto')).val($(this).attr('data-precio-socio'));

                        //     });
                        if ($("#porcentaje_becado_update").val() > 0) {

                            $(".precio_articulo").each(function(index) {
                                $("#precio_articulo" + $(this).attr('data-id-producto')).val($(this).attr('data-precio-socio'));

                            });

                            $("#precio_articulo1").val($("#precio_articulo1").attr('data-precio'));
                            $("#precio_articulo23").val($("#precio_articulo23").attr('data-precio'));
                            $("#precio_articulo34").val($("#precio_articulo34").attr('data-precio'));
                            $("#precio_articulo44").val($("#precio_articulo44").attr('data-precio'));

                        }else{

                            $(".precio_articulo").each(function(index) {
                                $("#precio_articulo" + $(this).attr('data-id-producto')).val($(this).attr('data-precio-socio'));

                            });
                        }


                    }

                    if ($("#check_curso_2").is(":checked") || $("#check_curso_35").is(":checked")) {
                        precios.push({
                            'id_product': id_product,
                            'precio': precio_socio,
                            'precio_usd': precio_socio_usd,
                            'cantidad': cantidad
                        });

                        productos.push({
                            'id_product': id_product,
                            'precio': precio_socio,
                            'precio_usd': precio_socio_usd,
                            'cantidad': cantidad,
                            'nombre_producto': nombre_producto
                        });

                    } else {

                        precios.push({
                            'id_product': id_product,
                            'precio': precio,
                            'precio_usd': precio_usd,
                            'cantidad': cantidad
                        });

                        productos.push({
                            'id_product': id_product,
                            'precio': precio,
                            'precio_usd': precio_usd,
                            'cantidad': cantidad,
                            'nombre_producto': nombre_producto
                        });
                    }


                    sumarPrecios(precios);
                    sumarProductos(productos);

                } else if (!this.checked) {

                    if (id_product == 2 || id_product == 35) {
                        //
                        $(".precio_articulo").each(function(index) {
                            $("#precio_articulo" + $(this).attr('data-id-producto')).val($(this).attr('data-precio'));
                            $(".checks_product").prop('checked', false);
                        });

                        precios = [];
                        productos = [];

                        sumarPrecios(precios);
                        sumarProductos(productos);


                    }

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

                // $(".select_numero_articulos").on("change", function() {
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
                var sumaPreciosUsd = 0;

                precios.forEach(function(precio, index) {

                    console.log("precio " + index + " | id_product: " + precio.id_product + " precio: " + parseInt(precio.precio) + " cantidad: " + parseInt(precio.cantidad) + " precio_usd: " + precio.precio_usd)

                    sumaPrecios += parseInt(precio.precio * precio.cantidad);
                    sumaArticulos += parseInt(precio.cantidad);

                    sumaPreciosUsd += parseInt(precio.precio_usd * precio.cantidad);


                });



                console.log("Suma precios " + sumaPrecios);

                $("#total_pesos").html((sumaPrecios).toFixed(2));
                $("#total_pesos_formato").html(format2(sumaPrecios, ''));

                $("#total_dolares").html((sumaPreciosUsd).toFixed(2));
                $("#total_dolares_formato").html(format2(sumaPreciosUsd, ''));

                var total_pagar = $("#txt_pago").val();
                var cambio = 0;
                if (total_pagar >= sumaPrecios) {
                    // $("#btn_pagar").removeAttr('disabled');
                    cambio = total_pagar - sumaPrecios;
                    $("#total_cambio").html(cambio);
                    $("#total_cambio_formato").html(format2(cambio, ''));

                    // console.log("se habilita");
                } else {
                    $("#btn_pagar").attr('disabled', 'disabled');
                    $("#total_cambio").html("");
                    $("#total_cambio_formato").html("");
                    // console.log("se desabilita");
                }




            }

            function sumarProductos(productos) {
                console.log(productos);
                var nombreProductos = '';

                productos.forEach(function(producto, index) {

                    console.log("precio " + index + " | id_product: " + producto.id_product + " precio: " + parseInt(producto.precio) + " cantidad: " + parseInt(producto.cantidad) + " producto: " + producto.nombre_producto + "precio_usd: " + producto.precio_usd)

                    nombreProductos += producto.nombre_producto + ',';
                });

                console.log(nombreProductos);
                $("#item_name").val(nombreProductos);


            }


            var preciosT = [];
            var productosT = [];

            function sumarProductosT(productosT) {
                console.log(productosT);
                var nombreProductos = '';

                productosT.forEach(function(producto, index) {

                    console.log("precio " + index + " | id_product: " + producto.id_product + " precio: " + parseInt(producto.precio) + " cantidad: " + parseInt(producto.cantidad) + " producto: " + producto.nombre_producto)

                    nombreProductos += producto.nombre_producto + ',';
                });

                console.log(nombreProductos);


            }

            function sumarPreciosT(preciosT) {


                var sumaPrecios = 0;
                var sumaPreciosUsd = 0;
                var sumaArticulos = 0;

                preciosT.forEach(function(precio, index) {

                    // console.log("precio " + index + " | id_product: " + precio.id_product + " precio: " + parseInt(precio.precio) + " cantidad: " + parseInt(precio.cantidad))

                    sumaPrecios += parseInt(precio.precio * precio.cantidad);
                    sumaArticulos += parseInt(precio.cantidad);

                    sumaPreciosUsd += parseInt(precio.precio_usd * precio.cantidad);


                });


                $("#total").html(sumaPrecios);


                console.log("Suma Articulos " + sumaArticulos);

                $("#productos_agregados").html(sumaArticulos);

            }

            $("#btn_pago").on("click", function(event) {
                event.preventDefault();
                // var metodo_pago = $("#metodo_pago").val();
                var clave = $("#clave_combo").val();
                var user_id = $("#user_id").val();
                var usuario = $("#correo_user").text();
                var metodo_pago = 'combo';
                var tipo_moneda = '-';
                var compra_en = 'sitio';

                // console.log("precios ------");
                // console.log(precios);

                // console.log("clave " + clave);
                // console.log("------");
                // console.log("user_id " + user_id);
                // console.log("------");
                // console.log("usuario " + usuario);
                // console.log("------");
                // console.log("metodo_pago " + metodo_pago);
                // console.log("------");
                // console.log("tipo_moneda " + tipo_moneda);
                // console.log("------");
                // console.log("compra_en " + compra_en);


                if (preciosT.length < $("#numero_talleres").text()) {
                    var resta = $("#numero_talleres").text() - preciosT.length;
                    if (resta == 1) {
                        var text = "producto";
                    } else {
                        var text = "productos";
                    }
                    Swal.fire("¡Alerta!", "Tienes que seleccionar " + resta + " " + text + " más", "warning");
                } else if (preciosT.length > $("#numero_talleres").text()) {
                    Swal.fire("¡Alerta!", "Solo puedes seleccionar " + $("#numero_talleres").text() + " productos", "warning");
                } else {
                    var plantilla_productos = '';

                    plantilla_productos += `<ul>`;


                    $.each(productosT, function(key, value) {
                        console.log("funcioina");
                        console.log(value);
                        plantilla_productos += `<li style="text-align: justify; font-size:14px;">
                                                ${value.nombre_producto} 
                                            </li>`;
                    });

                    plantilla_productos += `</ul>`;



                    Swal.fire({
                        title: 'Se han seleccionado los siguientes productos',
                        text: '',
                        html: plantilla_productos,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Confirmar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).attr('disabled', 'disabled')

                            console.log($("#total_mx").text());

                            var enviar_email = 1;
                            $.ajax({
                                url: "/Caja/choseWorkshops",
                                type: "POST",
                                data: {
                                    'array': JSON.stringify(preciosT),
                                    clave,
                                    usuario,
                                    user_id,
                                    metodo_pago,
                                    enviar_email,
                                    tipo_moneda
                                },
                                cache: false,
                                dataType: "json",
                                // contentType: false,
                                // processData: false,
                                beforeSend: function() {
                                    console.log("Procesando....");

                                },
                                success: function(respuesta) {

                                    console.log(respuesta);

                                    if (respuesta.status == 'success') {

                                        Swal.fire("¡Se agregaron sus talleres correctamente!", "", "success").
                                        then((value) => {
                                            // $(".form_compra").submit();
                                            // if (metodo_pago == 'Transferencia') {
                                            setTimeout(function() {
                                                location.href = '/Caja';
                                            }, 1000);

                                            // }
                                        });
                                    }

                                },
                                error: function(respuesta) {
                                    console.log(respuesta);
                                }

                            });

                        }
                    })
                }
            });

            $('#cont-checks').on("change", "input[type=checkbox].checks_product_t", function(event) {

                var id_product = $(this).val();
                var precio = $(this).attr('data-precio');
                var precio_socio = $(this).attr('data-precio-socio');
                var precio_usd = $(this).attr('data-precio-usd');
                var precio_socio_usd = $(this).attr('data-precio-socio-usd');
                var cantidad = $("#numero_articulos" + id_product).val();
                var nombre_producto = $(this).attr('data-nombre-producto');


                if (this.checked) {


                    //validaciones para los talleres simultaneos 

                    if (nombre_producto == 'INDISPENSABLE BLOQUEOS BASICOS MIEMBRO SUPERIOR') {
                        $("#check_curso_t_27").attr('disabled', 'disabled');

                    }

                    if (nombre_producto == 'PERFUSIONES INTRAVENOSAS PARA SEDACIÓN DE LO MANUAL A TCI') {
                        $("#check_curso_t_24").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'INDISPENSABLE BLOQUEOS BASICOS MIEMBRO INFERIOR') {
                        $("#check_curso_t_29").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'ULTRASONIDO EN BLOQUEOS PARA DOLOR CRONICO') {
                        $("#check_curso_t_25").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'BLOQUEOS AVANZADOS: NEUROMONITOREO, MIEMBRO SUPERIOR Y MIEMBO INFERIOR') {
                        $("#check_curso_t_43").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'RECAT/ECO CRITICA') {
                        $("#check_curso_t_32").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'ACCESOS VASCULARES PRAVE') {
                        $("#check_curso_t_30").attr('disabled', 'disabled');
                        $("#check_curso_t_28").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'BLOQUEOS AVANZADOS :TORAX Y ABDOMEN') {
                        $("#check_curso_t_31").attr('disabled', 'disabled');
                        $("#check_curso_t_28").attr('disabled', 'disabled');
                    }

                    if (nombre_producto == 'SIMULADORES ESCANEA Y PRACTICA CON MODELO EN SIMULACION') {
                        $("#check_curso_t_31").attr('disabled', 'disabled');
                        $("#check_curso_t_30").attr('disabled', 'disabled');
                    }


                    //fin de validaciones para talleres simultaneos




                    preciosT.push({
                        'id_product': id_product,
                        'precio': '0',
                        'precio_usd': '0',
                        'cantidad': cantidad
                    });


                    productosT.push({
                        'id_product': id_product,
                        'precio': '0',
                        'precio_usd': '0',
                        'cantidad': cantidad,
                        'nombre_producto': nombre_producto
                    });

                    sumarPreciosT(preciosT);
                    sumarProductosT(productosT);


                } else if (!this.checked) {



                    //validaciones para los talleres simultaneos 

                    if (nombre_producto == 'INDISPENSABLE BLOQUEOS BASICOS MIEMBRO SUPERIOR') {
                        $("#check_curso_t_27").removeAttr('disabled');

                    }

                    if (nombre_producto == 'PERFUSIONES INTRAVENOSAS PARA SEDACIÓN DE LO MANUAL A TCI') {
                        $("#check_curso_t_24").removeAttr('disabled');
                    }

                    if (nombre_producto == 'INDISPENSABLE BLOQUEOS BASICOS MIEMBRO INFERIOR') {
                        $("#check_curso_t_29").removeAttr('disabled');
                    }

                    if (nombre_producto == 'ULTRASONIDO EN BLOQUEOS PARA DOLOR CRONICO') {
                        $("#check_curso_t_25").removeAttr('disabled');
                    }

                    if (nombre_producto == 'BLOQUEOS AVANZADOS: NEUROMONITOREO, MIEMBRO SUPERIOR Y MIEMBO INFERIOR') {
                        $("#check_curso_t_43").removeAttr('disabled');
                    }

                    if (nombre_producto == 'RECAT/ECO CRITICA') {
                        $("#check_curso_t_32").removeAttr('disabled');
                    }

                    if (nombre_producto == 'ACCESOS VASCULARES PRAVE') {
                        $("#check_curso_t_30").removeAttr('disabled');
                        $("#check_curso_t_28").removeAttr('disabled');
                    }

                    if (nombre_producto == 'BLOQUEOS AVANZADOS :TORAX Y ABDOMEN') {
                        $("#check_curso_t_31").removeAttr('disabled');
                        $("#check_curso_t_28").removeAttr('disabled');
                    }

                    if (nombre_producto == 'SIMULADORES ESCANEA Y PRACTICA CON MODELO EN SIMULACION') {
                        $("#check_curso_t_31").removeAttr('disabled');
                        $("#check_curso_t_30").removeAttr('disabled');
                    }



                    //fin de validaciones para talleres simultaneos


                    for (var i = 0; i < preciosT.length; i++) {

                        if (preciosT[i].id_product === id_product) {
                            // console.log("remover");
                            preciosT.splice(i, 1);

                            productosT.splice(i, 1);
                            sumarPreciosT(preciosT);
                            sumarProductosT(productosT);
                        } else if (preciosT[i].id_product === id_product && preciosT[i].cantidad === cantidad) {
                            preciosT.splice(i, 1);

                            productosT.splice(i, 1);
                            sumarPreciosT(preciosT);
                            sumarProductosT(productosT);

                        }
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

    <script>
        $(document).ready(function() {


        });
    </script>

</body>

<?php echo $footer; ?>

</html>