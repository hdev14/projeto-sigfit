
const form1 = document.querySelector('#form1');
const form2 = document.querySelector('#form2');
const form3 = document.querySelector('#form3');
const alertar = document.querySelector('#alertar');

const btn_proximo1 = document.querySelector('#btn-proximo1');
const btn_proximo2 = document.querySelector('#btn-proximo2');
const btn_volta1 = document.querySelector('#btn-volta1');
const btn_volta2 = document.querySelector('#btn-volta2');

const calculo_pg = document.querySelector('#calculo-pg');
const pdg_tres = document.querySelector('#pdg-tres');
const pdg_quatro = document.querySelector('#pdg-quatro');

btn_proximo1.onclick = function() {

    const avaliacao_titulo = document.querySelector('#avaliacao-titulo');
    const avaliacao_idade = document.querySelector('#avaliacao-idade');
    const avaliacao_altura = document.querySelector('#avaliacao-altura');
    const peso_valor = document.querySelector('#peso-valor');

    let resultado = validarCampos(
        avaliacao_titulo.value,
        avaliacao_idade.value,
        avaliacao_altura.value,
        peso_valor.value
    );

    if (!resultado) {
        alertar.innerHTML = 'Por fovar, preencha os dados.';
        alertar.style.display = 'block';
        return;
    } else {
        let altura = avaliacao_altura.value;
        let peso = peso_valor.value;
        let imc = ((peso / Math.pow(altura, 2)) * 10000).toFixed(2);
        document.querySelector('#imc-valor').value = imc;
        document.querySelector('#altura-final').value = altura;
        document.querySelector('#peso-final').value = peso;
        alertar.style.display = 'none';
    }

    if (form1.style.display === 'block') {
        form1.style.display = 'none';
        form2.style.display = 'block';
    }
}

btn_volta1.onclick = function() {
    if (form2.style.display === 'block') {
        form2.style.display = 'none';
        form1.style.display = 'block';
    }
}

btn_proximo2.onclick = function() {

    let percentualgordura_valor = document.querySelector('#percentualgordura-valor');

    if (pdg_tres.style.display === 'block') {

        let dobra_tres_1 = document.querySelector('#dobra-tres-1');
        let dobra_tres_2 = document.querySelector('#dobra-tres-2');
        let dobra_tres_3 = document.querySelector('#dobra-tres-3');

        let resultado = validarCampos(dobra_tres_1.value, dobra_tres_2.value, dobra_tres_3.value);

        if (!resultado) {
            alertar.innerHTML = 'Por fovar, preencha os dados.'
            alertar.style.display = 'block';
            return;
        } else {
            let dobra_1 = parseFloat(dobra_tres_1.value);
            let dobra_2 = parseFloat(dobra_tres_2.value);
            let dobra_3 = parseFloat(dobra_tres_3.value);
            let pdg = calcularPdgTresDobras(dobra_1, dobra_2, dobra_3);
            percentualgordura_valor.value = pdg.toFixed(2);
            alertar.style.display = 'none';
        }

    } else if (pdg_quatro.style.display === 'block') {
        let dobra_quatro_1 = document.querySelector('#dobra-quatro-1');
        let dobra_quatro_2 = document.querySelector('#dobra-quatro-2');
        let dobra_quatro_3 = document.querySelector('#dobra-quatro-3');
        let dobra_quatro_4 = document.querySelector('#dobra-quatro-4');

        let resultado = validarCampos(
            dobra_quatro_1.value,
            dobra_quatro_2.value,
            dobra_quatro_3.value,
            dobra_quatro_4.value
        );

        if (!resultado) {
            alertar.innerHTML = 'Por fovar, preencha os dados.';
            alertar.style.display = 'block';
            return;
        } else {
            let sexo = document.querySelector('#sexo').innerHTML;
            let dobra_1 = parseFloat(dobra_quatro_1.value);
            let dobra_2 = parseFloat(dobra_quatro_2.value);
            let dobra_3 = parseFloat(dobra_quatro_3.value);
            let dobra_4 = parseFloat(dobra_quatro_4.value);
            let pdg = calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, sexo);
            percentualgordura_valor.value = pdg.toFixed(2);
            alertar.style.display = 'none';
        }
    }

    if (form2.style.display === 'block') {
        form2.style.display = 'none';
        form3.style.display = 'block';
    }
}

btn_volta2.onclick = function() {
    if (form3.style.display === 'block') {
        form3.style.display = 'none';
        form2.style.display = 'block';
    }
}

calculo_pg.onchange = function(event) {
    if (event.target.value === 'calculo3') {
        pdg_tres.style.display = 'block';
        pdg_quatro.style.display = 'none';
    } else {
        pdg_quatro.style.display = 'block';
        pdg_tres.style.display = 'none';
    }
}

function calcularPdgTresDobras(dobra_1, dobra_2, dobra_3) {
    let soma_dobras = dobra_1 + dobra_2 + dobra_3;
    let quadrado_da_soma = Math.pow(soma_dobras, 2);
    let idade = document.querySelector('#avaliacao-idade').value;
    let pdg = (0.41563 * soma_dobras) - (0.00112 * quadrado_da_soma) + (0.03661 * idade) + 4.03653;
    return pdg;
}

function calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, sexo) {

    let soma_dobras = dobra_1 + dobra_2 + dobra_3 + dobra_4;
    let quadrado_da_soma = Math.pow(soma_dobras, 2);
    let idade = document.querySelector('#avaliacao-idade').value;
    let pdg = 0;

    if (sexo === 'masculino') {
        pdg = (0.29288 * soma_dobras) - (0.0005 * quadrado_da_soma) + (0.15845 * idade) - 5.76377;
    } else if (sexo === 'feminino') {
        pdg = (0.29669 * quadrado_da_soma) - (0.00043 * quadrado_da_soma) + (0.02963 * idade) + 1.4072;
    }

    return pdg;
}

function validarCampos(/* agrs */) {
    for (let i = 0; i < arguments.length; i++) {
        if (arguments[i] === '') return false;
    }
    return true;
}