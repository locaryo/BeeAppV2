// Inicializamos el módulo cuando el DOM esté cargado
document.addEventListener("DOMContentLoaded", () => {
  //view-data-student go back buttons
  const buttons = document.querySelectorAll(".go-back");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      window.history.back();
    });
  });
  // End view-data-student go back buttons
  // Navbar breadcrumb
  const breadcrumb = document.getElementById("current-bc");
  const ruta = "beeapp";
  const currentRoute = window.location.pathname;
  const crumbs = [
    "Dashboard",
    "Registrar representante",
    "Registrar estudiante",
    "Registrar maestro",
    "Consulta",
    "Horarios",
    "Estudiantes",
    "Documentos",
    "Pagos recibidos",
    "Pagos de servicios",
    "Institución",
    "Consulta de estudiante"
  ];

  const routes = [
    "/" + `${ruta}` + "/home/dashboard",
    "/" + `${ruta}` + "/home/register_responsable_view",
    "/" + `${ruta}` + "/home/register_student_view",
    "/" + `${ruta}` + "/home/register_teacher_view",
    "/" + `${ruta}` + "/home/consulting_view",
    "/" + `${ruta}` + "/home/schedule_view",
    "/" + `${ruta}` + "/home/tables",
    "/" + `${ruta}` + "/home/documents",
    "/" + `${ruta}` + "/home/view_register_receive_payment",
    "/" + `${ruta}` + "/home/view_register_service_payment",
    "/" + `${ruta}` + "/home/view_institution",
    "/" + `${ruta}` + "/home/view_data_student"
  ];
  function getBreadcrumb() {
    routes.forEach((route, index) => {
      if (route === currentRoute) {
        breadcrumb.innerText = crumbs[index];
      }
    });
  }
  getBreadcrumb();

  // End Navbar breadcrumb
  // Custom form validation
  (() => {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener(
        "submit",
        event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }

          form.classList.add("was-validated");
        },
        false
      );
    });
  })();
  // End custom form validation

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

const calcularDolar = (() => {
  let bcv = 0;
  let enparalelovzla = 0;
  const inputMontoBs = document.getElementById("amount-bs");
  const divUsdBs = document.querySelector(".d-amount");

  if (!inputMontoBs) return; // Si no existe el input, salimos de la función
  if (!divUsdBs) return; // Si no existe el div, salimos de la función

  fetch(
    "https://pydolarve.org/api/v2/dollar?page=alcambio&format_date=default&rounded_price=true"
  )
    .then((response) => {
      // Verificamos si la respuesta es correcta
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // Aquí puedes manipular los datos obtenidos
      // console.log("Data fetched successfully:", data);
      // console.log("Data fetched successfully:", data.monitors.bcv["price"]);
      // console.log(
      //   "Data fetched successfully:",
      //   data.monitors.enparalelovzla["price"]
      // );

      bcv = data.monitors.bcv["price"];
      enparalelovzla = data.monitors.enparalelovzla["price"];
    })
    .catch((error) => {
      console.error("Error fetching dollar data:", error);
    });

  if (inputMontoBs) {
    inputMontoBs.addEventListener("input", (event) => {
      const montoBs = event.target.value;
      if (montoBs > 0) {
        divUsdBs.classList.remove("d-none");
        const montoDolares = parseFloat(montoBs) / parseFloat(bcv);
        divUsdBs.querySelector("input").value = montoDolares.toFixed(2);
        divUsdBs.querySelector("input").setAttribute("readonly", true);
      } else {
        divUsdBs.classList.add("d-none");
      }
    });
  }
})();

const filtroStudent = (() => {
  const inputIngresoTipo = document.getElementById("ingreso-tipo");
  const inputFiltroContainer = document.querySelector(".d-filtro");
  const inputFechaContainer = document.querySelector(".d-fecha");
  const inputIdEstudiante = document.getElementById("student-id"); // Obtener el campo oculto
  const inputEstudiante = inputFiltroContainer
    ? inputFiltroContainer.querySelector("input")
    : null;
  const contenedorResultados = document.getElementById(
    "contenedor-resultados-estudiantes"
  );
  let typingTimer;
  const doneTypingInterval = 100;

  if (inputIngresoTipo && inputEstudiante && contenedorResultados) {
    inputIngresoTipo.addEventListener("change", (event) => {
      const selectedOption = event.target.options[event.target.selectedIndex];
      const nameValue = selectedOption.getAttribute("nameValue");

      if (nameValue === "Matrícula") {
        inputFiltroContainer.classList.remove("d-none");
        inputFechaContainer.classList.add("d-none");
        inputEstudiante.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            typingTimer = setTimeout(() => {
              selectStudent(event.target.value);
            }, doneTypingInterval);
          } else {
            mostrarResultados([]);
          }
        });
      } else if (nameValue === "Mensualidades") {
        inputFiltroContainer.classList.remove("d-none");
        inputFechaContainer.classList.remove("d-none");
        inputEstudiante.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            typingTimer = setTimeout(() => {
              selectStudent(event.target.value);
            }, doneTypingInterval);
          } else {
            mostrarResultados([]);
          }
        });
      } else {
        inputFiltroContainer.classList.add("d-none");
        inputFechaContainer.classList.add("d-none");
        mostrarResultados([]);
      }
    });
  }

  const selectStudent = (value) => {
    fetch("filtrar_estudiantes", {
      method: "POST",
      body: JSON.stringify({
        query: value,
      }),
      headers: { "Content-Type": "application/json" },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        mostrarResultados(data);
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const mostrarResultados = (estudiantes) => {
    contenedorResultados.innerHTML = "";

    if (estudiantes && estudiantes.length > 0) {
      const lista = document.createElement("ul");
      lista.classList.add("autocomplete-list"); // Añade una clase para estilos (opcional)
      estudiantes.forEach((estudiante) => {
        const item = document.createElement("li");
        item.textContent = `${estudiante.p_nombre} ${estudiante.p_apellido}`;
        item.classList.add("autocomplete-item"); // Añade una clase para estilos (opcional)
        item.addEventListener("click", () => {
          inputEstudiante.value = `${estudiante.p_nombre} ${estudiante.p_apellido}`; // Inserta el nombre completo en el input
          inputIdEstudiante.value = estudiante.id;
          contenedorResultados.innerHTML = ""; // Limpia la lista de resultados después de la selección
        });
        lista.appendChild(item);
      });
      contenedorResultados.appendChild(lista);
    } else if (inputEstudiante && inputEstudiante.value.length > 0) {
      const mensaje = document.createElement("p");
      mensaje.textContent =
        "No se encontraron estudiantes con ese nombre o cédula.";
      contenedorResultados.appendChild(mensaje);
    }
  };
})();

const filtroTeacher = (() => {
  const inputIngresoTipo = document.getElementById("gasto-tipo");
  const inputFiltroContainer = document.querySelector(".d-filtro");
  const inputIdEstudiante = document.getElementById("teacher-id"); // Obtener el campo oculto
  const inputEstudiante = inputFiltroContainer
    ? inputFiltroContainer.querySelector("input")
    : null;
  const contenedorResultados = document.getElementById(
    "contenedor-resultados-filtro"
  );
  let typingTimer;
  const doneTypingInterval = 100;

  if (inputIngresoTipo && inputEstudiante && contenedorResultados) {
    inputIngresoTipo.addEventListener("change", (event) => {
      const selectedOption = event.target.options[event.target.selectedIndex];
      const nameValue = selectedOption.getAttribute("nameValue");

      if (nameValue === "Pago Personal Docente") {
        inputFiltroContainer.classList.remove("d-none");
        inputEstudiante.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            mostrarResultados([]);
          }
        });
      } else if (nameValue === "Pago Personal Administrativo") {
        inputFiltroContainer.classList.remove("d-none");
        inputEstudiante.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            mostrarResultados([]);
          }
        });
      } else if (nameValue === "Pago Personal de Apoyo(mantenimiento, limpieza, seguridad)") {
        inputFiltroContainer.classList.remove("d-none");
        inputEstudiante.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            mostrarResultados([]);
          }
        });
      }else {
        inputFiltroContainer.classList.add("d-none");
        mostrarResultados([]);
      }
    });
  }

  const selectTeacher = (value) => {
    fetch("filtrar_docente", {
      method: "POST",
      body: JSON.stringify({
        query: value,
      }),
      headers: { "Content-Type": "application/json" },
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        mostrarResultados(data);
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const mostrarResultados = (docentes) => {
    contenedorResultados.innerHTML = "";

    if (docentes && docentes.length > 0) {
      const lista = document.createElement("ul");
      lista.classList.add("autocomplete-list"); // Añade una clase para estilos (opcional)
      docentes.forEach((docente) => {
        const item = document.createElement("li");
        item.textContent = `${docente.p_nombre} ${docente.p_apellido}`;
        item.classList.add("autocomplete-item"); // Añade una clase para estilos (opcional)
        item.addEventListener("click", () => {
          inputEstudiante.value = `${docente.p_nombre} ${docente.p_apellido}`; // Inserta el nombre completo en el input
          inputIdEstudiante.value = docente.id;
          contenedorResultados.innerHTML = ""; // Limpia la lista de resultados después de la selección
        });
        lista.appendChild(item);
      });
      contenedorResultados.appendChild(lista);
    } else if (inputEstudiante && inputEstudiante.value.length > 0) {
      const mensaje = document.createElement("p");
      mensaje.textContent =
        "No se encontraron estudiantes con ese nombre o cédula.";
      contenedorResultados.appendChild(mensaje);
    }
  };
})();

const mostrarReferencia = (() => {
  const inputReferencia = document.getElementById("pago-tipo");
  const referenciaContainer = document.querySelector(".d-reference");
  if (!inputReferencia) return; // Si no existe el input, salimos de la función
  if (!referenciaContainer) return; // Si no existe el contenedor, salimos de la función
  inputReferencia.addEventListener("change", (event) => {
    const selectedOption = event.target.options[event.target.selectedIndex];
    const nameValue = selectedOption.getAttribute("nameValue");

    if (nameValue === "Pago Movil") {
      referenciaContainer.classList.remove("d-none");
    } else if (nameValue === "Transferencia Bancaria") {
      referenciaContainer.classList.remove("d-none");
    } else {
      const referenciaContainer = document.querySelector(".d-reference");
      referenciaContainer.classList.add("d-none");
    }
  });
})();

const endDate = (() => {
  const inputFechaContainer = document.querySelector(".d-fecha");
  if (!inputFechaContainer) return; // Si no existe el contenedor, salimos de la función
  const inputFecha = inputFechaContainer.querySelector("input");
  const inputEndFecha = document.getElementById("end_monthly_payment");

  inputFecha.addEventListener("change", (event) => {
    const fechaSeleccionada = event.target.value;

    if (fechaSeleccionada) {
      const fecha = new Date(fechaSeleccionada + "T00:00"); // Convertir a UTC
      const año = fecha.getFullYear();
      const mes = fecha.getMonth(); // 0-11

      // Creamos la fecha del primer día del *siguiente* mes
      const primerDiaDelSiguienteMes = new Date(año, mes + 1, 1);

      // Restamos un día para obtener el último día del mes *actual*
      const ultimoDiaDelMes = new Date(primerDiaDelSiguienteMes);
      ultimoDiaDelMes.setDate(ultimoDiaDelMes.getDate() - 1);

      const añoUltimoDia = ultimoDiaDelMes.getFullYear();
      const mesUltimoDia = (ultimoDiaDelMes.getMonth() + 1)
        .toString()
        .padStart(2, "0");
      const diaUltimoDia = ultimoDiaDelMes
        .getDate()
        .toString()
        .padStart(2, "0");
      const fechaFormateada = `${añoUltimoDia}-${mesUltimoDia}-${diaUltimoDia}`;

      console.log("Fecha seleccionada:", fechaSeleccionada);
      console.log("Último día del mes:", fechaFormateada);

      if (inputEndFecha) {
        inputEndFecha.value = fechaFormateada; // Asignar la fecha formateada al input
        console.log("Valor del input end_fecha:", inputEndFecha.value);
      }
    } else {
      console.log("No se ha seleccionado ninguna fecha.");
      if (inputEndFecha) {
        inputEndFecha.value = ""; // Limpiar el valor del input si no hay fecha seleccionada
        console.log("Valor del input end_fecha:", inputEndFecha.value);
      }
    }
  });
})();

const alumnosModule = (() => {
  // Elementos del DOM que vamos a manipular
  const nivelSelect = document.getElementById("nivel");
  const seccionSelect = document.getElementById("seccion");
  const mencionSelect = document.getElementById("mencion");
  const resultsBodyDesktop = document.getElementById("results-body-desktop");
  const resultsBodyMobile = document.getElementById("results-body-mobile");

  // Función para realizar la consulta al backend
  const fetchData = async () => {
    const selectedNivel = nivelSelect ? nivelSelect.value : "";
    const selectedSeccion = seccionSelect ? seccionSelect.value : "";
    const selectedMencion = mencionSelect ? mencionSelect.value : "";

    try {
      const response = await fetch("consulting_tabla", {
        method: "post",
        body: JSON.stringify({
          nivel: selectedNivel,
          seccion: selectedSeccion,
          mencion: selectedMencion,
        }),
        headers: { "Content-Type": "application/json" },
      });
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      const data = await response.json();
      updateResults(data);
    } catch (error) {
      console.error("Error fetching alumnos:", error);
      if (resultsBodyDesktop)
        resultsBodyDesktop.innerHTML =
          '<tr><td colspan="3">Error al cargar los alumnos.</td></tr>';
      if (resultsBodyMobile)
        resultsBodyMobile.innerHTML =
          '<tr><td colspan="3">Error al cargar los alumnos.</td></tr>';
    }
  };

  // Función para actualizar la tabla de resultados
  const updateResults = (data) => {
    if (resultsBodyDesktop) resultsBodyDesktop.innerHTML = "";
    if (resultsBodyMobile) resultsBodyMobile.innerHTML = "";

    if (data && data.length > 0) {
      data.forEach((item) => {
        const genderImg =
          item.sexo == 1 ? "../public/img/1.png" : "../public/img/0.png";
        const rowDesktop = `
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

        const rowMobile = `
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

        if (resultsBodyDesktop) resultsBodyDesktop.innerHTML += rowDesktop;
        if (resultsBodyMobile) resultsBodyMobile.innerHTML += rowMobile;
      });
    } else {
      if (resultsBodyDesktop)
        resultsBodyDesktop.innerHTML =
          '<tr><td colspan="3">No hay datos disponibles</td></tr>';
      if (resultsBodyMobile)
        resultsBodyMobile.innerHTML =
          '<tr><td colspan="3">No hay datos disponibles</td></tr>';
    }
  };

  // Función para inicializar los event listeners
  const initializeListeners = () => {
    if (nivelSelect) {
      nivelSelect.addEventListener("change", fetchData);
    }
    if (seccionSelect) {
      seccionSelect.addEventListener("change", fetchData);
    }
    if (mencionSelect) {
      mencionSelect.addEventListener("change", fetchData);
    }
  };

  // Retornamos un objeto con los métodos que queremos exponer
  return {
    init: initializeListeners,
  };
})();

const calcularEdad = (() => {
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

  if (miInput) {
    miInput.addEventListener("change", (event) => {
      calcularEdad(event.target.value); // Muestra lo que se escribe en la consola
    });
  }
})();
