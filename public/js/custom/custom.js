document.addEventListener("DOMContentLoaded", () => {
  let nivel = document.getElementById("nivel");
  let seccion = document.getElementById("seccion");
  let mencion = document.getElementById("mencion");
  let fetchData = () => {
    let selectedNivel = nivel.value;
    let selectedSeccion = seccion.value;
    let selectedMencion = mencion.value;
    fetch("consulting_tabla", {
      method: "post",
      body: JSON.stringify({
        nivel: selectedNivel,
        seccion: selectedSeccion,
        mencion: selectedMencion,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        let htmlDesktop = document.getElementById("results-body-desktop");
        let htmlMobile = document.getElementById("results-body-mobile");
        htmlDesktop.innerHTML = ""; // Limpiar el contenido previo en desktop
        htmlMobile.innerHTML = ""; // Limpiar el contenido previo en móvil
        if (data && data.length > 0) {
          data.forEach((item) => {
            // console.log(item)
            let genderImg =
              item.sexo == 1 ? "../public/img/1.png" : "../public/img/0.png";
            let rowDesktop = `
                        <tr>
                              <td>
                                <div class="d-flex py-1">
                                  <div>
                                    <img src="${genderImg}" class="avatar avatar-sm me-3">
                                  </div>
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">${item.p_nombre} ${item.p_apellido}</h6>
                                    <p class="text-xs text-secondary mb-0">${item.s_nombre} ${item.s_apellido}</p>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">${item.cedula}</p>
                                
                              </td>
                              <td class="align-middle text-center">
                                <form action="consulting_cedula" method="post">    
                                    <input value="${item.cedula}" type="number" name="cedula" hidden>
                                    <input value="alumnos" type="text" name="opcion" hidden>
                                    <button class="btn btn-primary" type="submit">Editar</button>
                                </form>
                              </td>
                        </tr>
                    `;

            let rowMobile = `
                        <tr>
                            <td>
                                    <div class="d-flex py-1">
                                        <div>
                                            <img src="${genderImg}" class="avatar avatar-sm me-3">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">${item.p_nombre} ${item.p_apellido}</h6>
                                            <p class="text-xs text-secondary mb-0">${item.cedula}</p>
                                        </div>
                                    </div>
                            </td>
                            <td class="align-middle text-center">
                                <form action="consulting_cedula" method="post">
                                    <input value="${item.cedula}" type="number" name="cedula" hidden>
                                    <input value="alumnos" type="text" name="opcion" hidden>
                                    <button class="btn btn-primary" type="submit">Editar</button>
                                </form>
                            </td>
                        </tr>
                    `;
            htmlDesktop.innerHTML += rowDesktop;
            htmlMobile.innerHTML += rowMobile;
          });
        } else {
          htmlDesktop.innerHTML =
            '<tr><td colspan="3">No hay datos disponibles</td></tr>';
          htmlMobile.innerHTML =
            '<tr><td colspan="3">No hay datos disponibles</td></tr>';
        }
      });
  };

  if (nivel && seccion && mencion) {
    nivel.addEventListener("change", fetchData);
    seccion.addEventListener("change", fetchData);
    mencion.addEventListener("change", fetchData);
  }
});

document.addEventListener("DOMContentLoaded", () => {
  let buttonAction = document.getElementById("consultarPagos");
  let buttonActionMobil = document.getElementById("consultarPagosMobil");

  buttonAction.addEventListener("click", function () {
    let idStudent = document.getElementById("idStudent");
    let value = idStudent.value;
    console.log(value);
    fetch("select_payment_student", {
      method: "post",
      body: JSON.stringify({
        idStudent: value,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        let htmlDesktop = document.getElementById("results-body");
        htmlDesktop.innerHTML = ""; // Limpiar el contenido previo en desktop
        if (data && data.length > 0) {
          data.forEach((item) => {
            // console.log(item)
            let rowDesktop = `
                  <tr>
                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-dark text-xs">${
                            item.fecha_pago
                          }</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.fecha_matricula}</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.tipo_pago}</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-dark text-xs">${
                            "$" + item.monto
                          }</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.nota}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
              `;

            htmlDesktop.innerHTML += rowDesktop;
          });
        } else {
          htmlDesktop.innerHTML = `
            <tr>
                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>
                  </tr>
          `;
        }
      });
  });

  buttonActionMobil.addEventListener("click", function () {
    let idStudent = document.getElementById("idStudent");
    let value = idStudent.value;
    console.log(value);
    fetch("select_payment_student", {
      method: "post",
      body: JSON.stringify({
        idStudent: value,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        let htmlDesktop = document.getElementById("results-body");
        htmlDesktop.innerHTML = ""; // Limpiar el contenido previo en desktop
        if (data && data.length > 0) {
          data.forEach((item) => {
            // console.log(item)
            let rowDesktop = `
                  <tr>
                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-dark text-xs">${
                            item.fecha_pago
                          }</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.fecha_matricula}</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.tipo_pago}</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-dark text-xs">${
                            "$" + item.monto
                          }</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">${item.nota}</span>
                        </div>
                      </div>
                    </td>
                  </tr>
              `;

            htmlDesktop.innerHTML += rowDesktop;
          });
        } else {
          htmlDesktop.innerHTML = `
            <tr>
                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-center align-items-center px-1">
                        <div class="my-auto">
                          <span class="text-xs">No hay datos</span>
                        </div>
                      </div>
                    </td>
                  </tr>
          `;
        }
      });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  let miInput = document.getElementById("fecha");
  let edad = document.getElementById("edad");

  let calcularEdad = (fechaNacimiento) => {
    const fechaNacimientoObj = new Date(fechaNacimiento);
    const hoy = new Date();

    // Asegurarse de que la fecha de nacimiento sea válida
    if (fechaNacimientoObj.toString() === "Invalid Date") {
      return "Fecha de nacimiento inválida";
    }

    // Calcular la diferencia en milisegundos
    let diferenciaEnMS = hoy - fechaNacimientoObj;

    // Convertir la diferencia a años (aproximado)
    const edadAproximada = Math.floor(
      diferenciaEnMS / (1000 * 60 * 60 * 24 * 365)
    );

    // Ajustar la edad considerando los meses y días
    const mes = hoy.getMonth() - fechaNacimientoObj.getMonth();
    const dia = hoy.getDate() - fechaNacimientoObj.getDate();

    edad.value = edadAproximada;
  };

  miInput.addEventListener("change", (event) => {
    calcularEdad(event.target.value); // Muestra lo que se escribe en la consola
  });
});

document.addEventListener("DOMContentLoaded", () => {
  let instrumento_pago = document.getElementById("instrumento_pago");
  let monto_bs = document.getElementById("monto_bs_caja");
  let monto_usd = document.getElementById("monto_usd_caja");

  let displayInput = (display) => {
    if (display.toString() == "pago-movil") {
      monto_bs.classList.remove("d-none");
      monto_bs.classList.add("d-flex");
      monto_usd.classList.add("d-none");
      monto_usd.classList.remove("d-flex");
    } else if (display.toString() == "bolivar-efectivo") {
      monto_bs.classList.remove("d-none");
      monto_bs.classList.add("d-flex");
      monto_usd.classList.add("d-none");
      monto_usd.classList.remove("d-flex");
    } else if (display.toString() == "dolar-efectivo") {
      monto_usd.classList.remove("d-none");
      monto_usd.classList.add("d-flex");
      monto_bs.classList.remove("d-flex");
      monto_bs.classList.add("d-none");
    } else {
      monto_bs.classList.add("d-none");
      monto_usd.classList.add("d-none");
    }
  };

  instrumento_pago.addEventListener("change", (event) => {
    displayInput(event.target.value);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  let dolar_bcvElement = document.getElementById("dolar_bcv").value;
  let monto_bs = document.getElementById("monto_bs");
  let monto_usd = document.getElementById("monto_usd");
  let monto_total = document.getElementById("monto_total");
  let total = 0;

  let bsToUsd = (monto) => {
    value = dolar_bcvElement.replace(",", "."); // Si el valor usa comas como separador decimal
    total = parseFloat(monto).toFixed(2) / parseFloat(value).toFixed(2);
    monto_total.value = parseFloat(total).toFixed(2);
  };

  let usdToBs = (monto) => {
    monto_total.value = parseFloat(monto).toFixed(2);
  };

  monto_bs.addEventListener("input", (event) => {
    bsToUsd(event.target.value);
  });

  monto_usd.addEventListener("input", (event) => {
    usdToBs(event.target.value);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  setTimeout(() => {
    let alertBox = document.querySelector(".alert");
    if (alertBox) {
      alertBox.style.transition =
        "height 0.3s ease, opacity 0.5s ease, margin 0.3s ease, padding 0.3s ease";
      alertBox.style.height = "0"; // Colapsa la altura
      alertBox.style.padding = "0"; // Elimina el relleno
      alertBox.style.margin = "0"; // Elimina el margen
      alertBox.style.opacity = "0"; // Desvanece el mensaje
      setTimeout(() => (alertBox.style.display = "none"), 200); // Oculta después de la animación
    }
  }, 3000); // 3 segundos antes de ocultar
});
