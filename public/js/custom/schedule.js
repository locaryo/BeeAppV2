document.addEventListener("DOMContentLoaded", function () {
  const tabla = document
    .getElementById("tabla-horario")
    .getElementsByTagName("tbody")[0];
  const horasInicio = "13:00";
  const horasFin = "17:00";
  const intervaloMin = 15; // bloques de 30 minutos
  const dias = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes"];

  generarTablaHorario(horasInicio, horasFin, intervaloMin);

  const btnAsignar = document.getElementById("btn-asignar");
  btnAsignar.addEventListener("click", asignarMateria);

  tabla.addEventListener("click", function (event) {
    if (event.target.classList.contains("btn-danger")) {
      eliminarMateria(event.target);
    }
  });

  function generarTablaHorario(inicio, fin, intervalo) {
    const inicioMin = convertirAHora(inicio);
    const finMin = convertirAHora(fin);

    for (let i = inicioMin; i < finMin; i += intervalo) {
      const fila = tabla.insertRow();
      fila.style.borderWidth = "1px";

      const celdaHora = fila.insertCell();
      celdaHora.style.borderWidth = "1px";
      celdaHora.innerText = `${formatearHora(i)} - ${formatearHora(
        i + intervalo
      )}`;

      for (let j = 0; j < dias.length; j++) {
        fila.insertCell();
      }
    }
  }

  function asignarMateria() {
    // Obtener valores del formulario
    const dia = document.getElementById("dia-asignar").value;
    const horaInicio = document.getElementById("hora-inicio-asignar").value;
    const horaFin = document.getElementById("hora-fin-asignar").value;
    const docente = document.getElementById("docente-asignar").value;
    const selectDocente = document.getElementById("docente-asignar");
    const textoDocente = selectDocente.options[selectDocente.selectedIndex].text;
    const materia = document.getElementById("materia-asignar").value;

    // console.log("=== VALORES DEL FORMULARIO ===");
    // console.log("Día seleccionado:", dia);
    // console.log("Hora inicio:", horaInicio, "Hora fin:", horaFin);
    // console.log("Docente:", docente, "Materia:", materia);

    // Validaciones básicas
    if (!dia || !horaInicio || !horaFin || !docente || !materia) {
      alert("Por favor, complete todos los campos.");
      return;
    }

    const diaIndex = dias.indexOf(dia);
    if (diaIndex === -1) {
      alert("Día inválido.");
      return;
    }

    const columnaDia = diaIndex + 1;
    // console.log(
    //   "Índice del día:",
    //   diaIndex,
    //   "Columna en la tabla:",
    //   columnaDia
    // );

    const inicioMin = convertirAHora(horaInicio);
    const finMin = convertirAHora(horaFin);
    // console.log(
    //   "Hora inicio (minutos):",
    //   inicioMin,
    //   "Hora fin (minutos):",
    //   finMin
    // );

    if (inicioMin >= finMin) {
      alert("La hora de inicio debe ser menor que la de fin.");
      return;
    }

    // Encontrar filas afectadas
    const bloques = [];
    for (let i = 0; i < tabla.rows.length; i++) {
      const fila = tabla.rows[i];
      if (!fila || !fila.cells[0]) continue;

      const [desde, hasta] = fila.cells[0].innerText
        .split(" - ")
        .map(convertirAHora);
      const cumpleRango = inicioMin < hasta && finMin > desde;

      // console.log(
      //   `Fila ${i}: Hora ${fila.cells[0].innerText} | ¿Cumple rango? ${cumpleRango}`
      // );

      if (cumpleRango) {
        bloques.push(i);
      }
    }

    if (bloques.length === 0) {
      alert("El rango de horas no coincide con la tabla.");
      return;
    }

    // console.log("=== ESTADO DE CELDAS ANTES DE ASIGNAR ===");
    bloques.forEach((filaIndex) => {
      const celda = tabla.rows[filaIndex].cells[columnaDia];
      // console.log(`Fila ${filaIndex}:`, {
      //   contenido: celda.innerHTML,
      //   ocupado: celda.getAttribute("data-ocupado"),
      //   rowspan: celda.getAttribute("rowspan"),
      // });
    });

    // Verificar disponibilidad
    for (const filaIndex of bloques) {
      const fila = tabla.rows[filaIndex];
      if (fila.cells.length <= columnaDia) {
        console.error(`Fila ${filaIndex} no tiene columna ${columnaDia}`);
        alert("Error en la estructura de la tabla.");
        return;
      }

      const celda = fila.cells[columnaDia];
      if (
        celda.hasAttribute("data-ocupado") ||
        (celda.innerHTML.trim() !== "" && !celda.hasAttribute("data-fusionada"))
      ) {
        alert(`Ya hay una materia asignada en ${dia} en este horario.`);
        return;
      }
    }

    const coloresMaterias = {
      "MATEMÁTICAS": "bg-primary",
      "SALUD": "bg-primary",
      "LENGUA": "bg-info",
      "CIENCIAS": "bg-success",
      "HISTORIA": "bg-warning",
      "GEOGRAFIA": "bg-info",
      "EDUCACION FISICA": "bg-secondary",
      "ARTE": "bg-light",
      "MUSICA": "bg-dark",
      "INGLES": "bg-primary",
      "TECNOLOGIA": "bg-success",
    };

    // Asignar la materia
    const primeraFila = tabla.rows[bloques[0]];
    const celdaAsignar = primeraFila.cells[columnaDia];
    const colorClase = coloresMaterias[materia] || "bg-default";

    celdaAsignar.innerHTML = `
        <div><strong>${materia}</strong><br>${textoDocente}</div>
        <div style="width: 100%;height: 100px;display: flex;align-items: flex-end;justify-content:flex-end;"><div class="btn btn-danger"><i class="ni ni-fat-remove"></i></div></div>
        <input type="hidden" name="horario_dia[]" value="${dia}">
        <input type="hidden" name="horario_hora_inicio[]" value="${horaInicio}">
        <input type="hidden" name="horario_hora_fin[]" value="${horaFin}">
        <input type="hidden" name="horario_docente[]" value="${docente}">
        <input type="hidden" name="horario_materia[]" value="${materia}">
    `;
    celdaAsignar.className = `${colorClase} text-white`;
    celdaAsignar.setAttribute("data-ocupado", "1");
    celdaAsignar.setAttribute("rowspan", bloques.length);

    for (let i = 1; i < bloques.length; i++) {
      const celda = tabla.rows[bloques[i]].cells[columnaDia];
      celda.style.display = "none"; // Ocultar en lugar de eliminar
      celda.setAttribute("data-fusionada", "1");
    }

    // console.log("=== ESTADO POST-ASIGNACIÓN ===");
    // console.log("Celda asignada:", {
    //   fila: bloques[0],
    //   columna: columnaDia,
    //   contenido: primeraFila.cells[columnaDia].innerHTML,
    // });
  }

  function convertirAHora(horaStr) {
    const [h, m] = horaStr.split(":").map(Number);
    return h * 60 + m;
  }

  function formatearHora(minutos) {
    const h = Math.floor(minutos / 60);
    const m = minutos % 60;
    return `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}`;
  }

  function eliminarMateria(botonEliminar) {
    const celda = botonEliminar.closest("td");
    const filaIndex = celda.parentElement.rowIndex;
    const columnaIndex = celda.cellIndex;

    // Obtener información de la materia eliminada
    const dia = celda.querySelector('input[name="horario_dia[]"]').value;
    const horaInicio = celda.querySelector(
      'input[name="horario_hora_inicio[]"]'
    ).value;
    const horaFin = celda.querySelector('input[name="horario_hora_fin[]"]').value;
    const docente = celda.querySelector('input[name="horario_docente[]"]').value;
    const materia = celda.querySelector('input[name="horario_materia[]"]').value;
  
    // Restablecer la celda principal
    celda.innerHTML = "";
    celda.removeAttribute("data-ocupado");
    celda.removeAttribute("rowspan");
    celda.className = "";

    // Mostrar celdas fusionadas y eliminar el atributo de fusión
    const bloques = [];
    for (let i = 0; i < tabla.rows.length; i++) {
      const [desde, hasta] = tabla.rows[i].cells[0].innerText
        .split(" - ")
        .map(convertirAHora);
      const cumpleRango =
        convertirAHora(horaInicio) < hasta && convertirAHora(horaFin) > desde;
      if (cumpleRango) {
        bloques.push(i);
      }
    }

    bloques.slice(1).forEach((filaIndex) => {
      const celdaFusionada = tabla.rows[filaIndex].cells[columnaIndex];
      celdaFusionada.style.display = "";
      celdaFusionada.removeAttribute("data-fusionada");
    });

    console.log(
      `Materia "${materia}" de ${docente} eliminada en ${dia} (${horaInicio} - ${horaFin}).`
    );
  }
});
