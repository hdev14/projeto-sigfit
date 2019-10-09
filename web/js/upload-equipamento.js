let img_equipamento = document.querySelector('#img-equipamento');
let upload_img = document.querySelector('#upload-img');

upload_img.addEventListener('change', function (event) {
    let reader = new FileReader();
    reader.onload = function(event) {
        img_equipamento.setAttribute('src', event.target.result);
    }
    reader.readAsDataURL(event.target.files[0]);
}, false);