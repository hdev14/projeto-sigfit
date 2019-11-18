const URI = 'http://localhost:8080/?r=pessoa/verificar-checkouts';

function verificarCheckouts(resolve, reject)
{
    let xhr = new XMLHttpRequest();
    xhr.open('GET', URI);
    xhr.send(null);

    xhr.onreadystatechange = function() {
        if (xhr.status === 200 && xhr.readyState === 4)
            resolve(JSON.parse(xhr.responseText));
        else if (xhr.status >= 400 && xhr.readyState === 4)
            reject(xhr.status);
    }
}

let promise_verificar_checkouts = new Promise(verificarCheckouts);

promise_verificar_checkouts
    .then((response) => {
        console.log(response);
    })
    .catch((statusCode) => {
        console.error(`Error ${statusCode}`);
    });