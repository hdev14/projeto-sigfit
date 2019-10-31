let abonar_falta = document.querySelector('#abonar-falta');

abonar_falta.addEventListener('click', function(event) {
    let id_modal = event.target.dataset.modal;
    $('#'+id_modal).modal('show');
}, false);