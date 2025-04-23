// Inicializamos el módulo cuando el DOM esté cargado
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

const AlumnosModule = (() => {
  // Elementos del DOM que vamos a manipular
  const nivelSelect = document.getElementById("nivel");
  const seccionSelect = document.getElementById("seccion");
  const mencionSelect = document.getElementById("mencion");
  const resultsBodyDesktop = document.getElementById("results-body-desktop");
  const resultsBodyMobile = document.getElementById("results-body-mobile");

  // Función para realizar la consulta al backend
  const fetchData = async () => {
      const selectedNivel = nivelSelect ? nivelSelect.value : '';
      const selectedSeccion = seccionSelect ? seccionSelect.value : '';
      const selectedMencion = mencionSelect ? mencionSelect.value : '';

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
          if (resultsBodyDesktop) resultsBodyDesktop.innerHTML = '<tr><td colspan="3">Error al cargar los alumnos.</td></tr>';
          if (resultsBodyMobile) resultsBodyMobile.innerHTML = '<tr><td colspan="3">Error al cargar los alumnos.</td></tr>';
      }
  };

  // Función para actualizar la tabla de resultados
  const updateResults = (data) => {
      if (resultsBodyDesktop) resultsBodyDesktop.innerHTML = "";
      if (resultsBodyMobile) resultsBodyMobile.innerHTML = "";

      if (data && data.length > 0) {
          data.forEach((item) => {
              const genderImg = item.sexo == 1 ? "../public/img/1.png" : "../public/img/0.png";
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
          if (resultsBodyDesktop) resultsBodyDesktop.innerHTML = '<tr><td colspan="3">No hay datos disponibles</td></tr>';
          if (resultsBodyMobile) resultsBodyMobile.innerHTML = '<tr><td colspan="3">No hay datos disponibles</td></tr>';
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
      init: initializeListeners
  };
})();

const CalcularEdad = (() =>{
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
})();

// Inicializamos el módulo cuando el DOM esté cargado
document.addEventListener("DOMContentLoaded", () => {
  AlumnosModule.init();
  CalcularEdad.init(); 
});