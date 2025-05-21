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
  const ruta = "beeapp.albospc.online";
  const currentRoute = window.location.pathname;
  const crumbs = [
    "Dashboard",
    "Registrar Representante",
    "Registrar Estudiante",
    "Registrar Maestro",
    "Consulta",
    "Horarios",
    "Estudiantes",
    "Documentos",
    "Pagos recibidos",
    "Pagos de servicios",
    "Contabilidad",
    "Institución",
    "Consulta de estudiante",
    "Asignar Aula",
    "Consultar Aula",
  ];
  // Definimos las rutas que queremos manejar
  // Puedes agregar más rutas según sea necesario
  const routes = [
    "/home/dashboard",
    "/home/register_responsable_view",
    "/home/register_student_view",
    "/home/register_teacher_view",
    "/home/consulting_view",
    "/home/schedule_view",
    "/home/tables",
    "/home/documents",
    "/home/view_register_receive_payment",
    "/home/view_register_service_payment",
    "/home/view_institution",
    "/home/view_data_student",
    "/home/accountingDashboard",
    "/home/view_create_sections",
    "/home/view_consulting_sections",
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
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
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
  
  alumnosModule.init();

});

const calcularDolar = (() => {
  let bcv = 0;
  let enparalelovzla = 0;
  const inputMontoBs = document.getElementById("amount-bs");
  const divUsdBs = document.querySelector(".d-amount");

  if (!inputMontoBs) return; // Si no existe el input, salimos de la función
  if (!divUsdBs) return; // Si no existe el div, salimos de la función

  consultarDolar().then((tasa) => {
    if (tasa) {
      bcv = tasa;
    }
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

const filtroTeacher = (() => {
  const inputIngresoTipo = document.getElementById("gasto-tipo");
  const inputFiltroContainer = document.querySelector(".d-filtro");
  const inputIdPersonal = document.getElementById("teacher-id"); // Obtener el campo oculto
  const personalList = document.getElementById("personalList");
  const inputDocente = document.getElementById("filtrar-docente");

  let typingTimer;
  const doneTypingInterval = 100;

  if (inputIngresoTipo && inputDocente) {
    inputIngresoTipo.addEventListener("change", (event) => {
      const selectedOption = event.target.options[event.target.selectedIndex];
      const nameValue = selectedOption.getAttribute("nameValue");

      if (nameValue === "Pago Personal Docente") {
        inputFiltroContainer.classList.remove("d-none");
        inputDocente.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            inputDocente.classList.add("rounded-0", "rounded-top");
            personalList.classList.add("d-block");
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            inputDocente.classList.remove("rounded-0", "rounded-top");
            personalList.classList.remove("d-block");
            mostrarResultados([]);
          }
        });
      } else if (nameValue === "Pago Personal Administrativo") {
        inputFiltroContainer.classList.remove("d-none");
        inputDocente.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            inputDocente.classList.add("rounded-0", "rounded-top");
            personalList.classList.add("d-block");
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            inputDocente.classList.remove("rounded-0", "rounded-top");
            personalList.classList.remove("d-block");
            mostrarResultados([]);
          }
        });
      } else if (
        nameValue ===
        "Pago Personal de Apoyo(mantenimiento, limpieza, seguridad)"
      ) {
        inputFiltroContainer.classList.remove("d-none");
        inputDocente.addEventListener("input", (event) => {
          console.log("Evento input disparado:", event.target.value); // Agrega esta línea
          clearTimeout(typingTimer);
          if (event.target.value.length > 0) {
            inputDocente.classList.add("rounded-0", "rounded-top");
            personalList.classList.add("d-block");
            typingTimer = setTimeout(() => {
              selectTeacher(event.target.value);
            }, doneTypingInterval);
          } else {
            inputDocente.classList.remove("rounded-0", "rounded-top");
            personalList.classList.remove("d-block");
            mostrarResultados([]);
          }
        });
      } else {
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
    personalList.innerHTML = "";

    if (docentes && docentes.length > 0) {
      docentes.forEach((docente) => {
        const item = document.createElement("option");
        item.textContent = `${docente.p_nombre} ${docente.p_apellido}`;
        item.value = docente.id;
        item.classList.add("autocomplete-item"); // Añade una clase para estilos (opcional)
        item.addEventListener("click", () => {
          inputDocente.value = `${docente.p_nombre} ${docente.p_apellido}`; // Inserta el nombre completo en el input
          inputIdPersonal.value = docente.id;
          personalList.innerHTML = ""; // Limpia la lista de resultados después de la selección
          inputDocente.classList.remove("rounded-0", "rounded-top");
          personalList.classList.remove("d-block");
        });
        personalList.appendChild(item);
      });
    } else if (inputDocente && inputDocente.value.length > 0) {
      const noResult = document.createElement("option");
      noResult.textContent = "Sin resultados";
      personalList.appendChild(noResult);
    }
  };
})();

const filtroStudent = (() => {
  const inputIngresoTipo = document.getElementById("ingreso-tipo");
  const inputFiltroContainer = document.querySelector(".d-filtro");
  const inputFechaContainer = document.querySelector(".d-fecha");
  const inputIdEstudiante = document.getElementById("student-id"); // Obtener el campo oculto
  const studentsList = document.getElementById("studentsList");
  const inputEstudiante = document.getElementById("filtrar-estudiante");

  let typingTimer;
  const doneTypingInterval = 100;

  if (inputIngresoTipo && inputEstudiante) {
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
            inputEstudiante.classList.add("rounded-0", "rounded-top");
            studentsList.classList.add("d-block");
            typingTimer = setTimeout(() => {
              selectStudent(event.target.value);
            }, doneTypingInterval);
          } else {
            inputEstudiante.classList.remove("rounded-0", "rounded-top");
            studentsList.classList.remove("d-block");
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
            inputEstudiante.classList.add("rounded-0", "rounded-top");
            studentsList.classList.add("d-block");
            typingTimer = setTimeout(() => {
              selectStudent(event.target.value);
            }, doneTypingInterval);
          } else {
            inputEstudiante.classList.remove("rounded-0", "rounded-top");
            studentsList.classList.remove("d-block");
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
    studentsList.innerHTML = "";

    if (estudiantes && estudiantes.length > 0) {
      estudiantes.forEach((estudiante) => {
        const item = document.createElement("option");
        item.textContent = `${estudiante.p_nombre} ${estudiante.p_apellido}`;
        item.value = estudiante.id;
        item.classList.add("autocomplete-item"); // Añade una clase para estilos (opcional)
        item.addEventListener("click", () => {
          inputEstudiante.value = `${estudiante.p_nombre} ${estudiante.p_apellido}`; // Inserta el nombre completo en el input
          inputIdEstudiante.value = estudiante.id;
          studentsList.innerHTML = ""; // Limpia la lista de resultados después de la selección
          inputEstudiante.classList.remove("rounded-0", "rounded-top");
          studentsList.classList.remove("d-block");
        });
        studentsList.appendChild(item);
      });
    } else if (inputEstudiante && inputEstudiante.value.length > 0) {
      const noResult = document.createElement("option");
      noResult.textContent = "Sin resultados";
      studentsList.appendChild(noResult);
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

const asignarSeccion = (() => {
  const studentsList = document.getElementById("studentsListSection");
  const inputEstudiante = document.getElementById("filtrar-estudiante-seccion");

  let typingTimer;
  const doneTypingInterval = 100;

  if (!studentsList) return; // Si no existe el input, salimos de la función
  if (!inputEstudiante) return; // Si no existe el div, salimos de la función

  inputEstudiante.addEventListener("input", (event) => {
    console.log("Evento input disparado:", event.target.value); // Agrega esta línea
    clearTimeout(typingTimer);
    if (event.target.value.length > 0) {
      inputEstudiante.classList.add("rounded-0", "rounded-top");
      studentsList.classList.add("d-block");
      typingTimer = setTimeout(() => {
        selectStudent(event.target.value);
      }, doneTypingInterval);
    } else {
      inputEstudiante.classList.remove("rounded-0", "rounded-top");
      studentsList.classList.remove("d-block");
      mostrarResultados([]);
    }
  });

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
    studentsList.innerHTML = "";

    if (estudiantes && estudiantes.length > 0) {
      estudiantes.forEach((estudiante) => {
        const item = document.createElement("option");
        item.textContent = `${estudiante.p_nombre} ${estudiante.p_apellido}`;
        item.value = estudiante.id;
        item.classList.add("autocomplete-item"); // Añade una clase para estilos (opcional)
        item.addEventListener("click", () => {
          inputEstudiante.value = ""; // Inserta el nombre completo en el input
          studentsList.innerHTML = ""; // Limpia la lista de resultados después de la selección
          inputEstudiante.classList.remove("rounded-0", "rounded-top");
          studentsList.classList.remove("d-block");
          agregarEstudianteATabla(estudiante);
        });
        studentsList.appendChild(item);
      });
    } else if (inputEstudiante && inputEstudiante.value.length > 0) {
      const noResult = document.createElement("option");
      noResult.textContent = "Sin resultados";
      studentsList.appendChild(noResult);
    }
  };

  function agregarEstudianteATabla(estudiante) {
    const tableBody = document.getElementById("results-body-desktop");

    // Verifica que no esté ya agregado
    const existe = tableBody.querySelector(`[data-id="${estudiante.id}"]`);
    if (existe) return;

    const row = document.createElement("tr");
    row.setAttribute("data-id", estudiante.id);

    row.innerHTML = `
      <td class="text-center">${estudiante.p_nombre} ${estudiante.p_apellido}</td>
      <td class="text-center">${estudiante.cedula}</td>
      <td class="text-center">
        <button type="button" class="btn btn-danger btn-sm remove-student">Remover</button>
      </td>
      <input type="hidden" name="estudiantes[]" value="${estudiante.id}">
    `;

    tableBody.appendChild(row);

    // Añadir evento para eliminar
    row.querySelector(".remove-student").addEventListener("click", () => {
      row.remove();
    });
  }
})();

const asignarNotas = (() => {
  const selectSection = document.getElementById("seccion-asignar");
  const selectNivel = document.getElementById("nivel-asignar");
  const btnAsignar = document.getElementById("btn-asignar");
  let sectionValue = "";
  let gradeValue = "";

  if (!selectSection) return; // Si no existe el input, salimos de la función
  if (!selectNivel) return; // Si no existe el div, salimos de la función
  if (!btnAsignar) return; // Si no existe el div, salimos de la función

  selectSection.addEventListener("change", (even) => {
    sectionValue = even.target.value;
  });

  selectNivel.addEventListener("change", (even) => {
    gradeValue = even.target.value;
  });

  btnAsignar.addEventListener("click", (even) => {
    even.preventDefault(); // Evitar el envío del formulario
    if (sectionValue != "" && gradeValue != "") {
      selectClassroom(sectionValue, gradeValue);
    } else {
      alert("Por favor, selecciona una sección y un nivel.");
    }
  });

  const selectClassroom = (sectionValue, gradeValue) => {
    fetch("filtrar_classroom", {
      method: "POST",
      body: JSON.stringify({
        section: sectionValue,
        grade: gradeValue,
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
        agregarEstudianteATabla(data);
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const agregarEstudianteATabla = (estudiantes) => {
    const tableBody = document.getElementById("results-body-desktop");

    if (!tableBody) return; // Si no existe el contenedor, salimos de la función
    if (!estudiantes || estudiantes.length === 0) return; // Si no hay estudiantes, salimos de la función
    // Limpiar tabla antes de agregar nuevos datos
    tableBody.innerHTML = "";

    estudiantes.forEach((estudiante) => {
      // Verifica que no esté ya agregado
      const existe = tableBody.querySelector(`[data-id="${estudiante.id}"]`);
      if (existe) return;

      const row = document.createElement("tr");
      row.setAttribute("data-id", estudiante.id);

      // Celda de nombre completo
      const nombreTd = document.createElement("td");
      nombreTd.classList.add("text-center");
      nombreTd.textContent = `${estudiante.p_nombre} ${estudiante.p_apellido}`;

      // Celda para inputs de nota
      const notasTd = document.createElement("td");
      notasTd.classList.add("text-center");

      const contenedorNotas = document.createElement("div");
      contenedorNotas.classList.add(
        "d-flex",
        "flex-row",
        "justify-content-around",
        "gap-2",
        "desktop-to-mobile"
      );

      const inputNota = document.createElement("input");
      inputNota.type = "number";
      inputNota.name = `notas[${estudiante.id}][]`;
      inputNota.classList.add("form-control", "mb-1");
      inputNota.placeholder = "Nota";

      contenedorNotas.appendChild(inputNota);
      notasTd.appendChild(contenedorNotas);

      // Botón para agregar nota
      const btnAdd = document.createElement("button");
      btnAdd.type = "button";
      btnAdd.textContent = "+";
      btnAdd.classList.add("btn", "btn-success", "btn-sm", "me-1");

      btnAdd.addEventListener("click", () => {
        const newInput = document.createElement("input");
        newInput.type = "number";
        newInput.name = `notas[${estudiante.id}][]`;
        newInput.classList.add("form-control", "mb-1");
        newInput.placeholder = "Nota";
        contenedorNotas.appendChild(newInput);
      });

      // Botón para remover última nota
      const btnRemove = document.createElement("button");
      btnRemove.type = "button";
      btnRemove.textContent = "-";
      btnRemove.classList.add("btn", "btn-danger", "btn-sm");

      btnRemove.addEventListener("click", () => {
        const inputs = contenedorNotas.querySelectorAll("input");
        if (inputs.length > 1) {
          contenedorNotas.removeChild(inputs[inputs.length - 1]);
        }
      });

      const botonesTd = document.createElement("td");
      botonesTd.classList.add("text-center", "desktop-to-mobile");
      botonesTd.appendChild(btnAdd);
      botonesTd.appendChild(btnRemove);

      row.appendChild(nombreTd);
      row.appendChild(notasTd);
      row.appendChild(botonesTd);

      tableBody.appendChild(row);
    });
  };
})();

const listarNotas = (() => {
  const selectSection = document.getElementById("seccion-notas");
  const selectNivel = document.getElementById("nivel-notas");
  const selectMateria = document.getElementById("materia-notas");
  const btnAsignar = document.getElementById("btn-filtrar-notas");
  let sectionValue = "";
  let gradeValue = "";
  let materiaValue = "";

  if (!selectSection) return; // Si no existe el input, salimos de la función
  if (!selectNivel) return; // Si no existe el div, salimos de la función
  if (!selectMateria) return; // Si no existe el div, salimos de la función
  if (!btnAsignar) return; // Si no existe el div, salimos de la función

  selectSection.addEventListener("change", (even) => {
    sectionValue = even.target.value;
  });

  selectNivel.addEventListener("change", (even) => {
    gradeValue = even.target.value;
  });

  selectMateria.addEventListener("change", (even) => {
    materiaValue = even.target.value;
  });

  btnAsignar.addEventListener("click", (even) => {
    even.preventDefault(); // Evitar el envío del formulario
    if (sectionValue != "" && gradeValue != "" && materiaValue != "") {
      selectClassroom(materiaValue, sectionValue, gradeValue);
    } else {
      alert("Por favor, selecciona una sección, nivel y materia.");
    }
  });

  const selectClassroom = (materiaValue, sectionValue, gradeValue) => {
    fetch("filtrar_ratings", {
      method: "POST",
      body: JSON.stringify({
        materia: materiaValue,
        section: sectionValue,
        grade: gradeValue,
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
        agregarEstudianteATabla(data);
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const agregarEstudianteATabla = (registros) => {
    const tableBody = document.getElementById("results-body-desktop");
    if (!tableBody) return;
    if (!registros || registros.length === 0) return;

    // Limpiar la tabla
    tableBody.innerHTML = "";

    // Agrupar por estudiante
    const estudiantesMap = new Map();

    registros.forEach((registro) => {
      const idEstudiante = registro.student;
      let idRegistro = registro.id;
      if (!estudiantesMap.has(idEstudiante)) {
        estudiantesMap.set(idEstudiante, {
          idRegistro: idRegistro,
          id: idEstudiante,
          nombre: `${registro.p_nombre} ${registro.p_apellido}`,
          notas: [],
        });
      }
      estudiantesMap
        .get(idEstudiante)
        .notas.push({ id: registro.id, value: registro.ratings });
    });

    // Crear fila por estudiante
    estudiantesMap.forEach((estudiante, idEstudiante) => {
      const row = document.createElement("tr");
      row.setAttribute("data-id", idEstudiante);

      // Nombre del estudiante
      const nombreTd = document.createElement("td");
      nombreTd.classList.add("text-center");
      nombreTd.textContent = estudiante.nombre;

      // Celda de notas
      const notasTd = document.createElement("td");
      notasTd.classList.add("text-center");

      const contenedorNotas = document.createElement("div");
      contenedorNotas.classList.add(
        "d-flex",
        "flex-row",
        "justify-content-around",
        "gap-2",
        "desktop-to-mobile"
      );

      // Agregar inputs con notas existentes
      estudiante.notas.forEach((nota) => {
        console.log(nota);
        const inputNota = document.createElement("input");
        inputNota.type = "number";
        inputNota.name = `notas[${idEstudiante}][]`;
        inputNota.classList.add("form-control", "mb-1");
        inputNota.placeholder = "Nota";
        inputNota.value = nota.value; // nota ya registrada

        const inputId = document.createElement("input");
        inputId.type = "hidden";
        inputId.name = `notas_id[${idEstudiante}][]`;
        inputId.value = nota.id; // id de la nota en la db

        contenedorNotas.appendChild(inputNota);
        contenedorNotas.appendChild(inputId);
      });

      notasTd.appendChild(contenedorNotas);

      // Botones de agregar y quitar
      const btnAdd = document.createElement("button");
      btnAdd.type = "button";
      btnAdd.textContent = "+";
      btnAdd.classList.add("btn", "btn-success", "btn-sm", "me-1");

      btnAdd.addEventListener("click", () => {
        const newInput = document.createElement("input");
        newInput.type = "number";
        newInput.name = `notas[${idEstudiante}][]`;
        newInput.classList.add("form-control", "mb-1");
        newInput.placeholder = "Nota";
        contenedorNotas.appendChild(newInput);
      });

      const btnRemove = document.createElement("button");
      btnRemove.type = "button";
      btnRemove.textContent = "-";
      btnRemove.classList.add("btn", "btn-danger", "btn-sm");

      btnRemove.addEventListener("click", () => {
        const numberInputs = contenedorNotas.querySelectorAll(
          "input[type='number']"
        );
        const hiddenInputs = contenedorNotas.querySelectorAll(
          "input[type='hidden']"
        );

        if (numberInputs.length > 0) {
          const lastIndex = numberInputs.length - 1;
          const lastInput = numberInputs[lastIndex];

          // Buscar si hay un input hidden asociado
          const inputHidden = hiddenInputs[lastIndex];
          const notaId = inputHidden?.value || null;

          if (notaId) {
            // Enviar al backend para marcar como eliminado
            console.log("Enviando al servidor:", { id: notaId, deleted: 1 });

            fetch("delete_rating", {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({ id: notaId, deleted: 1 }),
            })
              .then((response) => {
                if (!response.ok) throw new Error("Error HTTP");
                return response.json();
              })
              .then((data) => {
                if (data.success) {
                  contenedorNotas.removeChild(lastInput);
                  contenedorNotas.removeChild(inputHidden);
                } else {
                  alert("Error al eliminar la nota");
                }
              })
              .catch((error) => {
                console.error("Error en fetch:", error);
              });
          } else {
            // Si no hay ID asociado, solo eliminar el input número
            contenedorNotas.removeChild(lastInput);
          }
        }
      });

      const botonesTd = document.createElement("td");
      botonesTd.classList.add("text-center", "desktop-to-mobile");
      botonesTd.appendChild(btnAdd);
      botonesTd.appendChild(btnRemove);

      // Agregar celdas a la fila
      row.appendChild(nombreTd);
      row.appendChild(notasTd);
      row.appendChild(botonesTd);

      tableBody.appendChild(row);
    });
  };
})();

const consultingSections = (() => {
  const selectGrade = document.getElementById("select-grade");
  const selectSection = document.getElementById("select-section");
  const selectMention = document.getElementById("select-mention");

  if (!selectGrade || !selectSection || !selectMention) return;

  const handlerChanges = () => {
    const gradeValue = selectGrade.value;
    const sectionValue = selectSection.value;
    const mentionValue = selectMention.value;
    if (gradeValue != 0 && sectionValue != 0 && mentionValue != 0) {
      selectClassroom(gradeValue, sectionValue, mentionValue);
    }
  };

  const selectClassroom = (gradeValue, sectionValue, mentionValue) => {
    fetch("consulting_classroom", {
      method: "POST",
      body: JSON.stringify({
        grade: gradeValue,
        section: sectionValue,
        mention: mentionValue,
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
        fillTable(data);
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const fillTable = (data) => {
    const tableBody = document.querySelector("#results-body-desktop");
    tableBody.innerHTML = "";
    data.forEach((estudiante) => {
      const row = document.createElement("tr");

      const nombreTd = document.createElement("td");
      nombreTd.textContent = estudiante.p_nombre + " " + estudiante.p_apellido;
      nombreTd.classList.add("text-center");

      const cedulaTd = document.createElement("td");
      cedulaTd.textContent = estudiante.cedula;
      cedulaTd.classList.add("text-center");

      tableBody.appendChild(row);
      row.appendChild(nombreTd);
      row.appendChild(cedulaTd);
    });
  };

  selectGrade.addEventListener("change", handlerChanges);

  selectSection.addEventListener("change", handlerChanges);

  selectMention.addEventListener("change", handlerChanges);
})();

const dolarReferenceInstitution = (() => {
  let bcv = 0;
  const matriculaSpan = document.querySelector(".matricula-dolar");
  const mensualidadSpan = document.querySelector(".mensualidad-dolar");
  const matriculaAmount = document.querySelector("#matricula_amount");
  const mensualidadAmount = document.querySelector("#mensualidad_amount");

  if (
    !matriculaSpan ||
    !mensualidadSpan ||
    !matriculaAmount ||
    !mensualidadAmount
  )
    return; // Si no existe el input, salimos de la función

  const updateDolar = () => {
    let matriculaAmountValue = matriculaAmount.value;
    let mensualidadAmountValue = mensualidadAmount.value;

    const matriculaDolar = matriculaAmountValue * bcv;
    const mensualidadDolar = mensualidadAmountValue * bcv;

    matriculaSpan.textContent = "Bs " + matriculaDolar.toFixed(2);
    mensualidadSpan.textContent = "Bs " + mensualidadDolar.toFixed(2);
  };

  // Obtener la tasa del dólar y actualizar la variable bcv
  consultarDolar().then((tasa) => {
    if (tasa) {
      bcv = tasa;
      updateDolar();
    }
  });

  matriculaAmount.addEventListener("input", updateDolar);
  mensualidadAmount.addEventListener("input", updateDolar);
})();

const dolarReferenceAccountingDashboard = (() => {
  let bcv = 0;
  const acountingDashboardReceive = document.querySelector(
    ".acounting-dashboard-receive"
  );
  const acountingDashboardReceiveUSD = document.querySelector(
    ".acounting-dashboard-receive-usd"
  );
  const acountingDashboardSend = document.querySelector(
    ".acounting-dashboard-send"
  );
  const acountingDashboardSendUSD = document.querySelector(
    ".acounting-dashboard-send-usd"
  );
  const acountingDashboardBenefit = document.querySelector(
    ".acounting-dashboard-benefit"
  );
  const acountingDashboardBenefitUSD = document.querySelector(
    ".acounting-dashboard-benefit-usd"
  );

  if (
    !acountingDashboardReceive ||
    !acountingDashboardSend ||
    !acountingDashboardReceiveUSD ||
    !acountingDashboardSendUSD ||
    !acountingDashboardBenefit ||
    !acountingDashboardBenefitUSD
  )
    return; // Si no existe el input, salimos de la función

  const updateDolar = () => {
    let matriculaAmountValue = parseFloat(
      acountingDashboardReceive.textContent.replace(/[^0-9.-]+/g, "")
    );
    let mensualidadAmountValue = parseFloat(
      acountingDashboardSend.textContent.replace(/[^0-9.-]+/g, "")
    );

    let benefitAmountValue = parseFloat(
      acountingDashboardBenefit.textContent.replace(/[^0-9.-]+/g, "")
    );

    const matriculaDolar = matriculaAmountValue / bcv;
    const mensualidadDolar = mensualidadAmountValue / bcv;
    const benefitDolar = benefitAmountValue / bcv;

    acountingDashboardReceiveUSD.textContent = "$ " + matriculaDolar.toFixed(2);
    acountingDashboardSendUSD.textContent = "$ " + mensualidadDolar.toFixed(2);
    acountingDashboardBenefitUSD.textContent = "$ " + benefitDolar.toFixed(2);
  };

  // Obtener la tasa del dólar y actualizar la variable bcv
  consultarDolar().then((tasa) => {
    if (tasa) {
      bcv = tasa;
      updateDolar();
    }
  });
})();

const dinamicChart = (() => {
  const tipoSelect = document.getElementById("tipo");
  const categoryContainer = document.querySelector(".d-category");
  const expenses = document.getElementById("expenses_category");
  const income = document.getElementById("income_source");
  const intiDate = document.getElementById("fecha_inicio");
  const endDate = document.getElementById("fecha_fin");
  let valueCategory = "";
  let valueTipo = "";
  let valueIntiDate = "";
  let valueEndDate = "";
  let myChart = null; // Aquí guardamos la instancia del gráfico

  if (
    !tipoSelect ||
    !categoryContainer ||
    !expenses ||
    !income ||
    !intiDate ||
    !endDate
  )
    return;

  tipoSelect.addEventListener("change", (event) => {
    const tipo = event.target.value;
    valueCategory = ""; // Reiniciar selección anterior

    if (tipo === "ingresos") {
      categoryContainer.classList.remove("d-none");
      expenses.classList.add("d-none");
      income.classList.remove("d-none");
      valueTipo = "receive_payment";
    } else if (tipo === "gastos") {
      categoryContainer.classList.remove("d-none");
      expenses.classList.remove("d-none");
      income.classList.add("d-none");
      valueTipo = "send_payment";
    } else {
      categoryContainer.classList.add("d-none");
      valueTipo = "";
    }
  });

  expenses.addEventListener("change", (event) => {
    handlerCategory(event.target.value);
  });

  income.addEventListener("change", (event) => {
    handlerCategory(event.target.value);
  });

  const handlerCategory = (value) => {
    if (valueTipo === "" || value === "0") return;

    valueCategory = value;
    chartFilter();
  };

  intiDate.addEventListener("change", () => {
    if (valueTipo && valueCategory) {
      chartFilter();
    }
  });

  endDate.addEventListener("change", () => {
    if (valueTipo && valueCategory) {
      chartFilter();
    }
  });

  const chartFilter = async () => {
    valueIntiDate = intiDate.value;
    valueEndDate = endDate.value;

    const body = {
      tipo: valueTipo,
      categoria: valueCategory,
    };

    if (valueIntiDate) body.fecha_inicio = valueIntiDate;
    if (valueEndDate) body.fecha_fin = valueEndDate;

    try {
      const [response, tasaDolar] = await Promise.all([
        fetch("filtrar_grafica", {
          method: "POST",
          body: JSON.stringify(body),
          headers: { "Content-Type": "application/json" },
        }),
        consultarDolar(),
      ]);

      if (!response.ok || !tasaDolar) {
        throw new Error("No se pudo obtener datos o tasa de dólar");
      }

      const data = await response.json();

      // Convertir a dólar
      const dataWithUSD = data.map((item) => ({
        ...item,
        amount_usd: (item.amount / tasaDolar).toFixed(2),
      }));

      createChart(dataWithUSD);
    } catch (error) {
      console.error("Error al filtrar:", error);
    }
  };

  const createChart = (data) => {
    const ctx = document.getElementById("dinamic-chart").getContext("2d");

    if (myChart) {
      myChart.destroy();
    }

    myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: data.map((item) => item.date_payment),
        datasets: [
          {
            label: "Monto (Bs)",
            data: data.map((item) => item.amount),
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 0,
            fill: true,
          },
          {
            label: "Monto (USD)",
            data: data.map((item) => item.amount_usd),
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 2,
            tension: 0.4,
            pointRadius: 0,
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
          },
        },
        interaction: {
          intersect: false,
          mode: "index",
        },
        scales: {
          y: {
            ticks: {
              callback: function (value) {
                return Number(value).toLocaleString("es-VE", {
                  style: "currency",
                  currency: "VES",
                });
              },
            },
          },
        },
      },
    });
  };
})();

const avatarInstitucion = (() => {
  const imageUpload = document.getElementById("imageUpload");
  const imagePreview = document.getElementById("imagePreview");

  if (!imageUpload || !imagePreview) return; // Si no existe el input o la vista previa, salimos de la función

  imageUpload.addEventListener("change", function () {
    const file = this.files[0]; // Obtenemos el primer archivo seleccionado

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        imagePreview.style.backgroundImage = `url(${e.target.result})`;
      };

      reader.readAsDataURL(file); // Lee el archivo como una URL de datos
    } else {
      // Si no se selecciona ningún archivo, puedes restablecer la vista previa
      imagePreview.style.backgroundImage = ""; // O podrías mostrar una imagen por defecto
    }
  });
})();

const mentionsHandler = (() => {
  const listaMenciones = document.getElementById("lista-menciones");
  const nuevaMencionInput = document.getElementById("nueva-mencion");
  const agregarMencionBtn = document.getElementById("agregar-mencion");
  const mencionesOcultoInput = document.getElementById("menciones-oculto");

  if (
    !listaMenciones ||
    !nuevaMencionInput ||
    !agregarMencionBtn ||
    !mencionesOcultoInput
  )
    return; // Si no existe el input, salimos de la función
  function actualizarMencionesOculto() {
    const menciones = Array.from(
      listaMenciones.querySelectorAll("span.badge")
    ).map((badge) => badge.textContent.trim().slice(0, -1)); // Elimina el "x" visual
    mencionesOcultoInput.value = menciones.join(",");
  }

  function agregarMencion() {
    const nuevaMencionTexto = nuevaMencionInput.value.trim();
    if (nuevaMencionTexto) {
      const nuevaSpan = document.createElement("span");
      nuevaSpan.classList.add(
        "badge",
        "bg-primary",
        "text-white",
        "rounded-pill",
        "d-inline-flex",
        "align-items-center",
        "pe-2"
      );
      nuevaSpan.textContent = nuevaMencionTexto;

      const eliminarBtn = document.createElement("button");
      eliminarBtn.type = "button";
      eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
      eliminarBtn.setAttribute("aria-label", "Eliminar");
      eliminarBtn.addEventListener("click", () => {
        nuevaSpan.remove();
        actualizarMencionesOculto();
      });

      nuevaSpan.appendChild(eliminarBtn);
      listaMenciones.appendChild(nuevaSpan);
      nuevaMencionInput.value = "";
      actualizarMencionesOculto();
    }
  }

  // Agregar botón de eliminar a las menciones iniciales
  const listaBadgesIniciales = listaMenciones.querySelectorAll("span.badge");
  listaBadgesIniciales.forEach((badge) => {
    const eliminarBtn = document.createElement("button");
    eliminarBtn.type = "button";
    eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
    eliminarBtn.setAttribute("aria-label", "Eliminar");
    eliminarBtn.addEventListener("click", () => {
      let id = badge.querySelector('input[type="hidden"]').value;
      deletedMention(id);
      badge.remove();
      actualizarMencionesOculto();
    });
    badge.appendChild(eliminarBtn);
  });

  agregarMencionBtn.addEventListener("click", () => {
    let name = nuevaMencionInput.value;
    insertMention(name);
    agregarMencion();
  });
  nuevaMencionInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      let name = nuevaMencionInput.value;
      insertMention(name);
      agregarMencion();
    }
  });

  actualizarMencionesOculto();

  const deletedMention = (id) => {
    fetch("delete_mention", {
      method: "POST",
      body: JSON.stringify({
        id: id,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const insertMention = (name) => {
    fetch("insert_mention", {
      method: "POST",
      body: JSON.stringify({
        name: name,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };
})();

const expensesHandler = (() => {
  const listaExpenses = document.getElementById("lista-expenses");
  const nuevaExpenseInput = document.getElementById("nueva-expense");
  const agregarExpenseBtn = document.getElementById("agregar-expense");
  const expensesOcultoInput = document.getElementById("expenses-oculto");

  if (
    !listaExpenses ||
    !nuevaExpenseInput ||
    !agregarExpenseBtn ||
    !expensesOcultoInput
  )
    return; // Si no existe el input, salimos de la función

  function actualizarExpensesOculto() {
    const expenses = Array.from(
      listaExpenses.querySelectorAll("span.badge")
    ).map((badge) => badge.textContent.trim().slice(0, -1)); // Elimina el "x" visual
    expensesOcultoInput.value = expenses.join(",");
  }

  function agregarExpense() {
    const nuevaExpenseTexto = nuevaExpenseInput.value.trim();
    if (nuevaExpenseTexto) {
      const nuevaSpan = document.createElement("span");
      nuevaSpan.classList.add(
        "badge",
        "bg-danger",
        "text-white",
        "rounded-pill",
        "d-inline-flex",
        "align-items-center",
        "pe-2"
      );
      nuevaSpan.textContent = nuevaExpenseTexto;

      const eliminarBtn = document.createElement("button");
      eliminarBtn.type = "button";
      eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
      eliminarBtn.setAttribute("aria-label", "Eliminar");
      eliminarBtn.addEventListener("click", () => {
        nuevaSpan.remove();
        actualizarExpensesOculto();
      });

      nuevaSpan.appendChild(eliminarBtn);
      listaExpenses.appendChild(nuevaSpan);
      nuevaExpenseInput.value = "";
      actualizarExpensesOculto();
    }
  }

  // Agregar botón de eliminar a las menciones iniciales
  const listaBadgesIniciales = listaExpenses.querySelectorAll("span.badge");
  listaBadgesIniciales.forEach((badge) => {
    const eliminarBtn = document.createElement("button");
    eliminarBtn.type = "button";
    eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
    eliminarBtn.setAttribute("aria-label", "Eliminar");
    eliminarBtn.addEventListener("click", () => {
      let id = badge.querySelector('input[type="hidden"]').value;
      deletedExpense(id);
      badge.remove();
      actualizarExpensesOculto();
    });
    badge.appendChild(eliminarBtn);
  });

  agregarExpenseBtn.addEventListener("click", () => {
    let name = nuevaExpenseInput.value;
    insertExpense(name);
    agregarExpense();
  });
  nuevaExpenseInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      let name = nuevaExpenseInput.value;
      insertExpense(name);
      agregarExpense();
    }
  });

  actualizarExpensesOculto();

  const deletedExpense = (id) => {
    fetch("delete_expense", {
      method: "POST",
      body: JSON.stringify({
        id: id,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const insertExpense = (name) => {
    fetch("insert_expense", {
      method: "POST",
      body: JSON.stringify({
        name: name,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };
})();

const incomeHandler = (() => {
  const listaIncome = document.getElementById("lista-income");
  const nuevaIncomeInput = document.getElementById("nueva-income");
  const agregarIncomeBtn = document.getElementById("agregar-income");
  const incomeOcultoInput = document.getElementById("income-oculto");

  if (
    !listaIncome ||
    !nuevaIncomeInput ||
    !agregarIncomeBtn ||
    !incomeOcultoInput
  )
    return; // Si no existe el input, salimos de la función

  function actualizarIncomeOculto() {
    const income = Array.from(listaIncome.querySelectorAll("span.badge")).map(
      (badge) => badge.textContent.trim().slice(0, -1)
    ); // Elimina el "x" visual
    incomeOcultoInput.value = income.join(",");
  }

  function agregarIncome() {
    const nuevaIncomeTexto = nuevaIncomeInput.value.trim();
    if (nuevaIncomeTexto) {
      const nuevaSpan = document.createElement("span");
      nuevaSpan.classList.add(
        "badge",
        "bg-success",
        "text-white",
        "rounded-pill",
        "d-inline-flex",
        "align-items-center",
        "pe-2"
      );
      nuevaSpan.textContent = nuevaIncomeTexto;

      const eliminarBtn = document.createElement("button");
      eliminarBtn.type = "button";
      eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
      eliminarBtn.setAttribute("aria-label", "Eliminar");
      eliminarBtn.addEventListener("click", () => {
        nuevaSpan.remove();
        actualizarIncomeOculto();
      });

      nuevaSpan.appendChild(eliminarBtn);
      listaIncome.appendChild(nuevaSpan);
      nuevaIncomeInput.value = "";
      actualizarIncomeOculto();
    }
  }

  // Agregar botón de eliminar a las menciones iniciales
  const listaBadgesIniciales = listaIncome.querySelectorAll("span.badge");
  listaBadgesIniciales.forEach((badge) => {
    const eliminarBtn = document.createElement("button");
    eliminarBtn.type = "button";
    eliminarBtn.classList.add("btn-close", "btn-close-white", "ms-2");
    eliminarBtn.setAttribute("aria-label", "Eliminar");
    eliminarBtn.addEventListener("click", () => {
      let id = badge.querySelector('input[type="hidden"]').value;
      deletedIncome(id);
      badge.remove();
      actualizarIncomeOculto();
    });
    badge.appendChild(eliminarBtn);
  });

  agregarIncomeBtn.addEventListener("click", () => {
    let name = nuevaIncomeInput.value;
    insertIncome(name);
    agregarIncome();
  });
  nuevaIncomeInput.addEventListener("keypress", (event) => {
    if (event.key === "Enter") {
      let name = nuevaIncomeInput.value;
      insertIncome(name);
      agregarIncome();
    }
  });

  actualizarIncomeOculto();

  const deletedIncome = (id) => {
    fetch("delete_income", {
      method: "POST",
      body: JSON.stringify({
        id: id,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };

  const insertIncome = (name) => {
    fetch("insert_income", {
      method: "POST",
      body: JSON.stringify({
        name: name,
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
        if (data == true) {
          return true;
        } else {
          return false;
        }
      })
      .catch((error) => {
        console.error("Error al filtrar estudiantes:", error);
      });
  };
})();

async function consultarDolar() {
  try {
    const response = await fetch(
      "https://pydolarve.org/api/v2/dollar?page=alcambio&format_date=default&rounded_price=true"
    );

    if (!response.ok) {
      throw new Error("Error de red");
    }

    const data = await response.json();
    // Usa BCV o enparalelovzla según prefieras
    return parseFloat(data.monitors.bcv["price"]);
  } catch (error) {
    console.error("Error al obtener la tasa del dólar:", error);
    return null; // Manejar errores devolviendo null
  }
}