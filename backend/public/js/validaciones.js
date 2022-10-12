$(".iframe").on("click", function () {
  var pdf = $(this).attr("data-pdf");
  var user_id = $(this).attr("data-user-id");

  $(".cont-modal").html(
    '<iframe src="https://registro.lasra-mexico.org/comprobantesPago/' +
      user_id +
      "/" +
      pdf +
      '" style="width:100%; height:700px;" frameborder="0" ></iframe>'
  );
});

function confirmarsolicitar(clave, user_id, id_pendiente_pago) {
  //var respuesta = confirm("Estas seguro de volver a solicitar el comprobante de pago?");
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "¿Está seguro?",
      text: "Se enviará un correo solicitando enviar nuevamente su comprobante de pago!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, Solicitarlo!",
      cancelButtonText: "No, cancelar!",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        solicitarComprobante(clave, user_id, id_pendiente_pago);
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Tu petición ha sido enviada correctamente!",
          showConfirmButton: false,
          //timer: 5000
        });

        window.setTimeout(function () {
          location.reload();
        }, 1000);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          "Cancelado",
          "Tu petición ah sido cancelada",
          "error"
        );
      }
    });
}

function solicitarComprobante(clave, user_id, id_pendiente_pago) {
  $.ajax({
    url: "/Validacion/updateSolicitar",
    type: "POST",
    dataType: "json",
    data: {
      clave: clave,
      user_id: user_id,
      id_pendiente_pago: id_pendiente_pago,
    },
  }).done(function (json) {
    if (json == 1) {
      //borrarregistro(user_id);

      enviarcorreo(user_id, id_pendiente_pago);
    }
  });
}

function enviarcorreo(user_id, id_pendiente_pago) {
  $.ajax({
    type: "POST",
    url: "/Mailer/mailer",
    data: {
      user_id: user_id,
      id_pendiente_pago: id_pendiente_pago,
    },
  }).done(function (r) {
    console.log("correo enviado a:");
    console.log(user_id);
    console.log(id_pendiente_pago);
    // alert("Se ha enviado el correo correctamente");
    // mensaje.html(r);
  });
}

function confirmarvalidar(id_pendiente_pago, user_id, id_producto, clave) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "¿Está seguro?",
      text: "Al liberar el comprobante usted ya no podrá volver a solicitar el comprobante de pagó.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "OK",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        validarComprobante(id_pendiente_pago, user_id, id_producto, clave);

        // Swal.fire({
        //   position: "top-end",
        //   icon: "success",
        //   title: "Comprobante liberado!",
        //   showConfirmButton: false,
        // });

        // // window.setTimeout(function () {
        // //   location.reload();
        // // }, 2000);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          "Cancelado",
          "Tu petición ah sido cancelada",
          "error"
        );
      }
    });
}

function validarComprobante(id_pendiente_pago, user_id, id_producto, clave) {
  $.ajax({
    url: "/Validacion/updateComprobante",
    type: "POST",
    // dataType: "json",
    data: {
      id_pendiente_pago: id_pendiente_pago,
      user_id: user_id,
      id_producto: id_producto,
      clave: clave,
    },
  }).done(function (json) {
    console.log(json);
    if (json == 1) {
      //alert(json.mensaje);
      //location.reload();
      insertarAsignaProducto(id_pendiente_pago, user_id, id_producto, clave);
    } else {
      // alert(json.mensaje);
      //location.reload();
    }
  });
}

function insertarAsignaProducto(
  id_pendiente_pago,
  user_id,
  id_producto,
  clave
) {
  $.ajax({
    url: "/Validacion/insertarAsignaProducto",
    type: "POST",
    // dataType: "json",
    data: {
      id_pendiente_pago: id_pendiente_pago,
      user_id: user_id,
      id_producto: id_producto,
      clave: clave,
    },
  }).done(function (json) {
    console.log(json);
    if (json == 1) {
      console.log("checamos si es socio");
      checarSocio(user_id);
      //borrarregistro(user_id);
      //enviarcorreo(user_id);
    }
  });
}

function checarSocio(user_id) {
  $.ajax({
    url: "/Validacion/updateSocio",
    type: "POST",
    // dataType: "json",
    data: {
      user_id: user_id,
    },
  }).done(function (json) {
    console.log(json);
    if (json == 1) {

		Swal.fire({
			  position: "top-end",
			  icon: "success",
			  title: "Comprobante liberado!",
			  showConfirmButton: false,
			});
	
			window.setTimeout(function () {
			  location.reload();
			}, 2000);
      //borrarregistro(user_id);
      //enviarcorreo(user_id);
    }else{
		Swal.fire({
			position: "top-end",
			icon: "success",
			title: "Comprobante liberado!",
			showConfirmButton: false,
		  });
  
		  window.setTimeout(function () {
			location.reload();
		  }, 2000);
	}
  });
}

//////////////////ESPAÑOL//////////////////
$(document).ready(function () {
  $(document).on("click", ".pdf-español", function () {
    var id = $(this).val();
    console.log("El código es: " + id);
    var url =
      "https://registro.dualdisorderswaddmexico2022.com/comprobantesPago/" + id;
    $("#pdf-español").modal("show");
    $("#iframePDFes").attr("src", url);
    $("#id_").val(id);
  });

  $(document).on("click", ".pdf-español-view", function () {
    var id = $(this).val();
    console.log("El código es: " + id);
    var url =
      "https://registro.dualdisorderswaddmexico2022.com/comprobantesPago/" + id;
    $("#pdf-español-view").modal("show");
    $("#iframePDFes").attr("src", url);
  });
});

//////////////////INGLES//////////////////
$(document).ready(function () {
  $(document).on("click", ".pdf-ingles", function () {
    var id = $(this).val();
    console.log("El código es: " + id);
    var url =
      "https://register.dualdisorderswaddmexico2022.com/comprobantesPago/" + id;
    $("#pdf-ingles").modal("show");
    $("#iframePDFin").attr("src", url);
    $("#id_").val(id);
  });

  $(document).on("click", ".pdf-ingles-view", function () {
    var id = $(this).val();
    console.log("El código es: " + id);
    var url =
      "https://register.dualdisorderswaddmexico2022.com/comprobantesPago/" + id;
    $("#pdf-ingles-view").modal("show");
    $("#iframePDFin").attr("src", url);
  });
});

function confirmarsolicitarEstudiante(user_id, id_pendiente_estudiante) {
  //var respuesta = confirm("Estas seguro de volver a solicitar el comprobante de pago?");
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "¿Está seguro?",
      text: "Se enviará un correo solicitando enviar nuevamente su comprobante de pago!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Si, Solicitarlo!",
      cancelButtonText: "No, cancelar!",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        solicitarComprobanteEstudiante(user_id, id_pendiente_estudiante);
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Tu petición ha sido enviada correctamente!",
          showConfirmButton: false,
          //timer: 5000
        });

        window.setTimeout(function () {
          location.reload();
        }, 1000);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          "Cancelado",
          "Tu petición ah sido cancelada",
          "error"
        );
      }
    });
}

function solicitarComprobanteEstudiante(user_id, id_pendiente_estudiante) {
  $.ajax({
    url: "/Validacion/updateSolicitarEstudiante",
    type: "POST",
    dataType: "json",
    data: {
      user_id: user_id,
      id_pendiente_estudiante: id_pendiente_estudiante,
    },
  }).done(function (json) {
    if (json == 1) {
      //borrarregistro(user_id);

      enviarcorreoEstudiante(user_id, id_pendiente_estudiante);
    }
  });
}

function enviarcorreo(user_id, id_pendiente_estudiante) {
  $.ajax({
    type: "POST",
    url: "/Mailer/mailerEstudiante",
    data: {
      user_id: user_id,
      id_pendiente_estudiante: id_pendiente_estudiante,
    },
  }).done(function (r) {
    // alert("Se ha enviado el correo correctamente");
    // mensaje.html(r);
  });
}

function enviarcorreoliberacionestudiante(user_id, id_pendiente_estudiante) {
  $.ajax({
    type: "POST",
    url: "/Mailer/mailerEstudianteLiberacion",
    data: {
      user_id: user_id,
      id_pendiente_estudiante: id_pendiente_estudiante,
    },
  }).done(function (r) {
    // alert("Se ha enviado el correo correctamente");
    // mensaje.html(r);
  });
}

function confirmarvalidarEstudiante(id_pendiente_estudiante, user_id) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "¿Está seguro?",
      text: "Al liberar el comprobante usted ya no podrá volver a solicitar el comprobante de pagó.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "OK",
      cancelButtonText: "Cancelar",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        validarComprobanteEstudiante(id_pendiente_estudiante, user_id);
        // enviarcorreoliberacionestudiante(user_id,id_pendiente_estudiante);
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          "Cancelado",
          "Tu petición ah sido cancelada",
          "error"
        );
      }
    });
}

function validarComprobanteEstudiante(id_pendiente_estudiante, user_id) {
  $.ajax({
    url: "/Validacion/updateComprobanteEstudiante",
    type: "POST",
    // dataType: 'json',
    data: {
      id_pendiente_estudiante: id_pendiente_estudiante,
      user_id: user_id,
    },
  }).done(function (json) {
    console.log(json);
    if (json == 1) {
      // enviarcorreoliberacionestudiante(user_id,id_pendiente_estudiante);
      //location.reload();
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Comprobante liberado!",
        showConfirmButton: false,
      });

      window.setTimeout(function () {
        location.reload();
      }, 700);
    } else {
      // alert(json.mensaje);
      //location.reload();
    }
  });
}
