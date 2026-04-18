const LupaMod = (() => {
    let lupa, visor, raf;
    let mouseX = 0, mouseY = 0;
    const estado = { activa: false, zoom: 2.5, tamano: 180 };

    function crearLupa() {
        // Contenedor circular (la "lupa")
        lupa = document.createElement('div');
        lupa.id = 'lupa-overlay';
        Object.assign(lupa.style, {
            position:     'fixed',
            width:        estado.tamano + 'px',
            height:       estado.tamano + 'px',
            borderRadius: '50%',
            overflow:     'hidden',
            border:       '4px solid #00C853',
            boxShadow:    '0 0 0 2px rgba(0,200,83,0.2), 0 8px 32px rgba(0,0,0,0.6)',
            pointerEvents:'none',
            zIndex:       '99999',
            display:      'none',
            cursor:       'none',
        });

        // Clon del body que se escala dentro de la lupa
        visor = document.createElement('div');
        visor.id = 'lupa-visor';
        Object.assign(visor.style, {
            position:         'absolute',
            top:              '0',
            left:             '0',
            width:            '100vw',
            height:           '100vh',
            transformOrigin:  '0 0',
            pointerEvents:    'none',
        });

        lupa.appendChild(visor);
        document.body.appendChild(lupa);
    }

    function actualizarPosicion() {
        if (!estado.activa) return;
        raf = requestAnimationFrame(actualizarPosicion);

        const radio = estado.tamano / 2;
        const zoom  = estado.zoom;

        // Posición de la lupa en pantalla
        lupa.style.left = (mouseX - radio) + 'px';
        lupa.style.top  = (mouseY - radio) + 'px';

        // El visor escala la página y desplaza para centrar en el cursor
        const offsetX = -(mouseX * zoom) + radio;
        const offsetY = -(mouseY * zoom) + radio;

        visor.style.transform = `translate(${offsetX}px, ${offsetY}px) scale(${zoom})`;

        // Crosshair central (canvas pequeño encima)
        dibujarCrosshair();
    }

    // Canvas solo para el crosshair (liviano)
    let crossCanvas, crossCtx;
    function crearCrosshair() {
        crossCanvas = document.createElement('canvas');
        crossCanvas.setAttribute('data-html2canvas-ignore', 'true');
        Object.assign(crossCanvas.style, {
            position:     'absolute',
            top:          '0',
            left:         '0',
            width:        '100%',
            height:       '100%',
            pointerEvents:'none',
            zIndex:       '1',
        });
        crossCanvas.width  = estado.tamano;
        crossCanvas.height = estado.tamano;
        crossCtx = crossCanvas.getContext('2d');
        lupa.appendChild(crossCanvas);
    }

    function dibujarCrosshair() {
        const radio = estado.tamano / 2;
        crossCtx.clearRect(0, 0, estado.tamano, estado.tamano);
        crossCtx.strokeStyle = 'rgba(0,200,83,0.6)';
        crossCtx.lineWidth   = 1;
        crossCtx.beginPath();
        crossCtx.moveTo(radio - 12, radio); crossCtx.lineTo(radio + 12, radio);
        crossCtx.moveTo(radio, radio - 12); crossCtx.lineTo(radio, radio + 12);
        crossCtx.stroke();
    }

    function onMouseMove(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;

        // El visor debe reflejar el DOM real en tiempo real
        sincronizarVisor();
    }

    // Sincroniza el visor con el scroll actual de la página
    function sincronizarVisor() {
        visor.style.marginTop  = -window.scrollY + 'px';
        visor.style.marginLeft = -window.scrollX + 'px';
    }

    function onWheel(e) {
        if (!estado.activa) return;
        e.preventDefault();
        estado.zoom = Math.min(6, Math.max(1.5, estado.zoom - e.deltaY * 0.005));
    }

    function clonarBody() {
        // Limpia visor anterior
        visor.innerHTML = '';

        // Clona los estilos de la página
        const estilos = document.querySelectorAll('link[rel="stylesheet"], style');
        estilos.forEach(s => visor.appendChild(s.cloneNode(true)));

        // Clona el body
        const clon = document.body.cloneNode(true);
        clon.id = 'lupa-body-clon';
        clon.style.cssText = `
            position: absolute;
            top: 0; left: 0;
            width: ${window.innerWidth}px;
            margin: 0; padding: 0;
            pointer-events: none;
        `;

        // Quitar el overlay de la lupa del clon para evitar recursión
        const lupaEnClon = clon.querySelector('#lupa-overlay');
        if (lupaEnClon) lupaEnClon.remove();

        visor.appendChild(clon);
    }

    function activar() {
        estado.activa = true;
        document.body.style.cursor = 'none';
        lupa.style.display = 'block';

        clonarBody();
        sincronizarVisor();
        actualizarPosicion();

        // Re-clonar si la página cambia (navegación SPA, modales, etc.)
        observarCambios();

        document.getElementById('btn-lupa')?.classList.add('activo');
    }

    function desactivar() {
        estado.activa = false;
        cancelAnimationFrame(raf);
        document.body.style.cursor = '';
        lupa.style.display = 'none';
        if (observer) observer.disconnect();
        document.getElementById('btn-lupa')?.classList.remove('activo');
    }

    function toggle() {
        estado.activa ? desactivar() : activar();
    }

    // MutationObserver para re-clonar si el DOM cambia
    let observer = null;
    function observarCambios() {
        if (observer) observer.disconnect();
        observer = new MutationObserver(() => {
            if (estado.activa) clonarBody();
        });
        observer.observe(document.body, { childList: true, subtree: false });
    }

    function init() {
        crearLupa();
        crearCrosshair();
        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('wheel', onWheel, { passive: false });
        document.addEventListener('keydown', e => {
            if (e.altKey && e.key === 'l') { e.preventDefault(); toggle(); }
            if (e.key === 'Escape') desactivar();
        });
    }

    return { init, toggle, activar, desactivar };
})();

document.addEventListener('DOMContentLoaded', () => LupaMod.init());
window.LupaMod = LupaMod;