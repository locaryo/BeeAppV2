// Obtener la URL base del sistema
const baseUrl =
  document.querySelector("base")?.getAttribute("href") ||
  window.location.origin + "/beeapp/";

// Función principal del SPA
const initSPA = () => {
  const appMain = document.getElementById("main-content");
  if (!appMain) {
    console.log("Error: No se encontró el elemento main-content");
    return;
  }

  // Función para normalizar URLs
  const normalizeUrl = (url) => {
    if (url.startsWith(window.location.origin)) {
      url = url.substring(window.location.origin.length);
    }
    if (url.startsWith(baseUrl)) {
      url = url.substring(baseUrl.length - 1);
    }
    return url;
  };

  // Función para reinicializar scripts personalizados
  const reinitializeCustomScripts = async () => {
    const vista = document.querySelector("#main-content [data-vista]")?.dataset
      .vista;
    console.log("app", vista);
    if (typeof Custom !== "undefined" && typeof Custom.init === "function")
      Custom.init();
    
    // Carga por vista
    if (
      vista === "accountingDashboard" &&
      typeof Custom.accountingDashboard === "function"
    ) {
      Custom.accountingDashboard();
    }

    if (
      vista === "horario" &&
      typeof Custom.horario === "function"
    ) {
      Custom.horario();
    }

    if (
      vista === "dashboardAdmin" &&
      typeof Custom.ingresoEgreso === "function" &&
      typeof Custom.ingresosRelevantes === "function" &&
      typeof Custom.menciones === "function"
    ) {
      Custom.ingresoEgreso();
      Custom.ingresosRelevantes();
      Custom.menciones();
    }
  };

  // Función para cargar contenido vía AJAX
  const loadContent = async (url) => {
    const normalizedUrl = normalizeUrl(url);

    // Aplica la animación de salida
    appMain.classList.add("fade-out");

    setTimeout(async () => {
      try {
        const response = await fetch(normalizedUrl, {
          headers: { "X-Requested-With": "XMLHttpRequest" },
        });

        if (!response.ok) throw new Error(`Error: ${response.status}`);

        const html = await response.text();

        if (html.includes("<!doctype html>")) {
          window.location = url;
          return;
        }

        // Cargar el nuevo contenido
        appMain.innerHTML = html;
        history.pushState({ path: normalizedUrl }, "", normalizedUrl);

        // Reanimar
        appMain.classList.remove("fade-out");

        // Reiniciar scripts
        reinitializeCustomScripts();
      } catch (err) {
        console.error("Error al cargar la vista:", err);
        // window.location = url;
      }
    }, 250); // tiempo de transición
  };

  // Manejador de clicks en enlaces
  document.addEventListener("click", (e) => {
    const link = e.target.closest("a");
    if (!link) return;

    // Ignorar enlaces específicos
    if (
      !link.href ||
      link.target === "_blank" ||
      (link.href.startsWith("http") &&
        !link.href.includes(window.location.host)) ||
      link.href.startsWith("#") ||
      link.hasAttribute("data-no-ajax") ||
      link.hasAttribute("data-bs-toggle")
    ) {
      return;
    }

    e.preventDefault();
    loadContent(link.href);
  });

  // Manejador de envío de formularios
  //   document.addEventListener("submit", function (e) {
  //     const form = e.target.closest("form"); // ✅ asegura que obtienes el <form>
  //     if (!form) return;
  //     console.log(form)
  //     if (form.getAttribute("data-no-ajax") === "true") return;

  //     e.preventDefault();

  //     const formData = new FormData(form);
  //     const hasFiles = form.querySelector('input[type="file"]') !== null;

  //     const fetchOptions = {
  //       method: form.method.toUpperCase(),
  //       headers: {
  //         "X-Requested-With": "XMLHttpRequest",
  //       },
  //       body: hasFiles ? formData : new URLSearchParams(formData),
  //     };

  //     if (!hasFiles) {
  //       fetchOptions.headers["Content-Type"] =
  //         "application/x-www-form-urlencoded";
  //     }

  //     // ✅ Verifica que form.action sea válido
  //     const actionUrl = form.action;
  //     if (!actionUrl || actionUrl.includes("[object")) {
  //       console.error("La URL del formulario no es válida:", actionUrl);
  //       return;
  //     }

  //     fetch(actionUrl, fetchOptions)
  //       .then((response) => response.text())
  //       .then((html) => {
  //         if (html.includes("<script>window.location")) {
  //           const match = html.match(/window\.location\s*=\s*['"]([^'"]+)['"]/);
  //           if (match) {
  //             window.location = match[1];
  //             return;
  //           }
  //         }

  //         if (
  //           html.toLowerCase().includes("<!doctype html>") ||
  //           html.toLowerCase().includes("<html")
  //         ) {
  //           window.location = actionUrl;
  //           return;
  //         }

  //         document.getElementById("main-content").innerHTML = html;
  //         history.pushState(null, "", actionUrl);
  //         reinitializeCustomScripts();
  //       })
  //       .catch((error) => {
  //         console.error("Error en envío de formulario:", error);
  //         form.submit();
  //       });
  //   });

  // Manejador de navegación con botones del navegador
  window.addEventListener("popstate", (e) => {
    if (e.state?.path) {
      loadContent(e.state.path);
    } else {
      loadContent(location.pathname);
    }
  });
};

// Inicializar SPA cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", initSPA);
