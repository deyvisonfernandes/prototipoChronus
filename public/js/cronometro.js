let timers = {}; // Objeto para armazenar timers por ID
let tempos = {}; // Armazenar h/m/s por ID

function cronometro(id) {
    let tempo = tempos[id];
    tempo.segundos++;

    if (tempo.segundos == 60) {
        tempo.segundos = 0;
        tempo.minutos++;
        if (tempo.minutos == 60) {
            tempo.minutos = 0;
            tempo.horas++;
        }
    }

    let h = tempo.horas < 10 ? "0" + tempo.horas : tempo.horas;
    let m = tempo.minutos < 10 ? "0" + tempo.minutos : tempo.minutos;
    let s = tempo.segundos < 10 ? "0" + tempo.segundos : tempo.segundos;

    document.getElementById("cronometroPopup" + id).innerHTML = h + ":" + m + ":" + s;
}

function inicializador(id) {
    // Captura o tempo atual da div correspondente
    let displayTempo = document.getElementById("cronometroPopup" + id);
    let tempo = displayTempo.innerText.trim(); // Ex: "00:05:32"
    const partes = tempo.split(":");

    tempos[id] = {
        horas: parseInt(partes[0], 10),
        minutos: parseInt(partes[1], 10),
        segundos: parseInt(partes[2], 10)
    };

    // Evita múltiplas contagens para o mesmo ID
    if (timers[id]) {
        clearInterval(timers[id]);
    }

    timers[id] = setInterval(() => cronometro(id), 1000);
}

function pausa(id) {
    clearInterval(timers[id]);
    timers[id] = null;
}

function salvarTempo(idAssunto) {
    const tempo = document.getElementById('cronometroPopup' + idAssunto).innerText;

    fetch('/salvar-tempo', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${idAssunto}&tempo=${encodeURIComponent(tempo)}`
    });
}
