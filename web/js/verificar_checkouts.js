const URI = 'http://localhost:8080/?r=pessoa/verificar-checkouts';
const horario_de_final_de_treino = [
  '07:53',
  '08:56',
  '09:31',
  '10:53',
  '13:53',
  '14:53',
  '15:53',
  '16:53',
  '17:53',
  '18:53'
];

function verificarCheckouts()
{
    if (verificarHorario()) {
       let xhr = new XMLHttpRequest();
        xhr.open('GET', URI);
        xhr.send(null);

        xhr.onreadystatechange = function() {
            if (xhr.status === 200 && xhr.readyState === 4)
                console.log(JSON.parse(xhr.responseText), "OBJETO");
            else if (xhr.status >= 400 && xhr.readyState === 4)
                console.error(xhr.status);
        }
    }

    setInterval(verificarCheckouts, 60000);
}

function verificarHorario() {
    let horario = (new Date()).toLocaleTimeString()
        , hora_minuto = horario.slice(0, 5);
    console.log(hora_minuto, "HORA");
    return horario_de_final_de_treino.find(value => value === hora_minuto);
}

verificarCheckouts();


