
function addFaltas(uri) {

    let xhr = new XMLHttpRequest();
    xhr.open('GET', uri);
    xhr.send(null);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {

        }
    };

    setInterval(addFaltas, 60000);
}

addFaltas();