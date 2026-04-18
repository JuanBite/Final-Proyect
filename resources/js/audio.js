const AudioMod = (() => {
    const estado = { activo: false, velocidad: 1 };
    let elementoActual = null;
    let timeout = null;

    function soporte() {
        return 'speechSynthesis' in window;
    }

    function leerTexto(texto) {
        if (!soporte() || !texto?.trim()) return;
        window.speechSynthesis.cancel();

        const u = new SpeechSynthesisUtterance(texto.trim());
        u.lang   = 'es-ES';
        u.rate   = estado.velocidad;
        u.pitch  = 1;
        u.volume = 1;

        window.speechSynthesis.speak(u);
    }

    function obtenerTextoDesdeCursor(e) {
        if (!estado.activo) return;

        const el = document.elementFromPoint(e.clientX, e.clientY);
        if (!el || el === elementoActual) return;

        let texto = '';

        // INPUT o TEXTAREA: leer el valor escrito
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
            texto = el.value?.trim() || el.placeholder?.trim() || '';
            if (!texto || el === elementoActual) return;
            elementoActual = el;
            clearTimeout(timeout);
            timeout = setTimeout(() => leerTexto(texto), 300);
            return;
        }

        // SELECT: leer solo la opción actualmente seleccionada
        if (el.tagName === 'SELECT') {
            const opcion = el.options[el.selectedIndex];
            texto = opcion?.text?.trim() || '';
            if (!texto || el === elementoActual) return;
            elementoActual = el;
            clearTimeout(timeout);
            timeout = setTimeout(() => leerTexto(texto), 300);
            return;
        }

        // OPTION dentro de un select abierto: leer solo esa opción
        if (el.tagName === 'OPTION') {
            texto = el.text?.trim() || '';
            if (!texto || el === elementoActual) return;
            elementoActual = el;
            clearTimeout(timeout);
            timeout = setTimeout(() => leerTexto(texto), 300);
            return;
        }

        // Resto de elementos: subir por el DOM buscando texto puntual
        let objetivo = el;
        while (objetivo && objetivo !== document.body) {
            // Saltar contenedores con muchos hijos de texto (evita leer bloques enteros)
            const hijosTexto = objetivo.querySelectorAll('p, h1, h2, h3, h4, span, a, li, button, label, td, th');
            if (hijosTexto.length > 3) {
                objetivo = objetivo.parentElement;
                continue;
            }

            const t = objetivo.innerText?.trim();
            if (t && t.length > 1) {
                texto = t;
                break;
            }
            objetivo = objetivo.parentElement;
        }

        if (!texto || objetivo === elementoActual) return;

        elementoActual = objetivo;
        clearTimeout(timeout);
        timeout = setTimeout(() => leerTexto(texto), 300);
    }

    // Leer mientras el usuario escribe en un input/textarea
    function onInput(e) {
        if (!estado.activo) return;
        const el = e.target;
        if (el.tagName !== 'INPUT' && el.tagName !== 'TEXTAREA') return;

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const texto = el.value?.trim();
            if (texto) leerTexto(texto);
        }, 500); // espera 500ms después de que deje de escribir
    }

    // Leer la opción cuando cambia un select
    function onChange(e) {
    if (!estado.activo) return;
    const el = e.target;
    if (el.tagName !== 'SELECT') return;

    const opcion = el.options[el.selectedIndex];
    const texto  = opcion?.text?.trim();
    if (texto) leerTexto(texto);
}
function onKeyup(e) {
    if (!estado.activo) return;
    if (!['ArrowUp', 'ArrowDown'].includes(e.key)) return;

    const el = document.activeElement;
    if (el?.tagName !== 'SELECT') return;

    const opcion = el.options[el.selectedIndex];
    const texto  = opcion?.text?.trim();
    if (texto) leerTexto(texto);
}

    function activar() {
        if (!soporte()) {
            alert('Tu navegador no soporta síntesis de voz.');
            return;
        }
        estado.activo = true;
        document.addEventListener('mousemove', obtenerTextoDesdeCursor);
        document.addEventListener('input', onInput);
        document.addEventListener('change', onChange);
        document.getElementById('btn-audio')?.classList.add('activo');
document.addEventListener('keyup', onKeyup);    }

    function desactivar() {
        estado.activo = false;
        elementoActual = null;
        clearTimeout(timeout);
        window.speechSynthesis.cancel();
        document.removeEventListener('mousemove', obtenerTextoDesdeCursor);
        document.removeEventListener('input', onInput);
        document.removeEventListener('change', onChange);
        document.getElementById('btn-audio')?.classList.remove('activo');
document.removeEventListener('keyup', onKeyup);    }

    function toggle() {
        estado.activo ? desactivar() : activar();
    }

    function setVelocidad(vel) {
        estado.velocidad = vel;
    }

    document.addEventListener('keydown', e => {
        if (e.altKey && e.key === 'a') { e.preventDefault(); toggle(); }
        if (e.key === 'Escape') desactivar();
    });

    return { toggle, activar, desactivar, setVelocidad };
})();

window.AudioMod = AudioMod;