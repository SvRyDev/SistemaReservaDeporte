    // Escuchar el evento de scroll en la ventana
    window.addEventListener("scroll", function() {
        // Obtener la posición actual del scroll
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
  
        // Altura del primer navbar
        var navbar1Height = document.getElementById("navbar1").offsetHeight;
  
        // Navbar 1: Ocultar cuando se hace scroll hacia abajo
        if (scrollPosition > navbar1Height) {
          document.getElementById("navbar1").classList.add("navbar-hide");
        } else {
          document.getElementById("navbar1").classList.remove("navbar-hide");
        }
  
        // Navbar 2: Ajustar según necesidad
        var navbar2 = document.getElementById("navbar2");
        var navbar2Top = navbar1Height;
  
        if (scrollPosition > navbar2Top) {
          navbar2.style.top = "0";
        } else {
          navbar2.style.top = navbar2Top - scrollPosition + "px";
        }
      });