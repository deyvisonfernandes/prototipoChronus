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


let tempoSemana = { horas: 0, minutos: 0, segundos: 0 };
let timerSemana = null;

function cronometroSemana(idUsuario) {
    tempoSemana.segundos++;

    if (tempoSemana.segundos === 60) {
        tempoSemana.segundos = 0;
        tempoSemana.minutos++;
        if (tempoSemana.minutos === 60) {
            tempoSemana.minutos = 0;
            tempoSemana.horas++;
        }
    }

    let h = tempoSemana.horas < 10 ? "0" + tempoSemana.horas : tempoSemana.horas;
    let m = tempoSemana.minutos < 10 ? "0" + tempoSemana.minutos : tempoSemana.minutos;
    let s = tempoSemana.segundos < 10 ? "0" + tempoSemana.segundos : tempoSemana.segundos;

    document.getElementById("cronometroPopup" + idUsuario).innerText = `${h}:${m}:${s}`;
}

function inicializadorSemana(idUsuario) {
    if (!timerSemana) {
        const tempoTexto = document.getElementById("cronometroPopup" + idUsuario)?.innerText.trim() || "00:00:00";
        const partes = tempoTexto.split(":");

        let horas = parseInt(partes[0], 10);
        let minutos = parseInt(partes[1], 10);
        let segundos = parseInt(partes[2], 10);

        // Verificação extra: se algum for NaN, forçamos para zero
        horas = isNaN(horas) ? 0 : horas;
        minutos = isNaN(minutos) ? 0 : minutos;
        segundos = isNaN(segundos) ? 0 : segundos;

        tempoSemana = { horas, minutos, segundos };

        timerSemana = setInterval(() => cronometroSemana(idUsuario), 1000);
    }
}

function pausaSemana() {
    clearInterval(timerSemana);
    timerSemana = null;
}

function salvarTempoSemana(idUsuario) {
    const tempo = document.getElementById('cronometroPopup' + idUsuario).innerText;

    fetch('salvar-tempo-semanal', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `tempo=${encodeURIComponent(tempo)}`
    })
    .then(res => res.text())
    .then(resposta => {
        console.log(resposta);
    });
}
