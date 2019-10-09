let img_usuario = document.querySelector('#img-usuario');
let upload_img = document.querySelector('#upload-img');

upload_img.addEventListener('change', function (event) {
    let reader = new FileReader();
    reader.onload = function(event) {
        img_usuario.setAttribute('src', event.target.result);
    };
    reader.readAsDataURL(event.target.files[0]);
}, false);