const alert_checkout = document.querySelector("#alert-checkout");
const URI = 'http://localhost:8080/?r=pessoa/verificar-checkouts';
const horario_de_final_de_treino = [
    '07:58',
    '08:58',
    '09:58',
    '10:01',
    '13:58',
    '14:58',
    '15:58',
    '16:58',
    '17:58',
    '18:58'
];

function verificarCheckouts()
{
    if (verificarHorario()) {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', URI);
        xhr.send(null);

        xhr.onreadystatechange = function() {
            if (xhr.status === 200 && xhr.readyState === 4)
                mostrarAlerta(JSON.parse(xhr.responseText));
            else if (xhr.status >= 400 && xhr.readyState === 4)
                console.error(xhr.status);
        }
    }

    setInterval(verificarCheckouts, 60000);
}

verificarCheckouts();

function verificarHorario() {
    let horario = (new Date()).toLocaleTimeString()
        , hora_minuto = horario.slice(0, 5);
    return horario_de_final_de_treino.find(value => value === hora_minuto);
}

function mostrarAlerta(obj) {
    console.log(obj);
    if (obj.checkouts) {
        alert_checkout.style.display = "block";
    }
}


