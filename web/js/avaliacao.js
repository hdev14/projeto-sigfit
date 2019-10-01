
const form1 = document.querySelector('#form1')
    , form2 = document.querySelector('#form2')
    , form3 = document.querySelector('#form3')
    , alertar = document.querySelector('#alertar');

const btn_proximo1 = document.querySelector('#btn-proximo1')
    , btn_proximo2 = document.querySelector('#btn-proximo2')
    , btn_volta1 = document.querySelector('#btn-volta1')
    , btn_volta2 = document.querySelector('#btn-volta2');

const calculo_pg = document.querySelector('#calculo-pg')
    , pdg_tres = document.querySelector('#pdg-tres')
    , pdg_quatro = document.querySelector('#pdg-quatro');

btn_proximo1.onclick = function() {

    const avaliacao_titulo = document.querySelector('#avaliacao-titulo')
        , avaliacao_idade = document.querySelector('#avaliacao-idade')
        , avaliacao_altura = document.querySelector('#avaliacao-altura')
        , peso_valor = document.querySelector('#peso-valor');

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
        let altura = avaliacao_altura.value
            , peso = peso_valor.value
            , imc = ((peso / Math.pow(altura, 2)) * 10000).toFixed(2);

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

        let dobra_tres_1 = document.querySelector('#dobra-tres-1')
            , dobra_tres_2 = document.querySelector('#dobra-tres-2')
            , dobra_tres_3 = document.querySelector('#dobra-tres-3')
            , resultado = validarCampos(dobra_tres_1.value, dobra_tres_2.value, dobra_tres_3.value);

        if (!resultado) {
            alertar.innerHTML = 'Por fovar, preencha os dados.'
            alertar.style.display = 'block';
            return;
        } else {
            let idade = parseInt(document.querySelector('#avaliacao-idade').value)
                , dobra_1 = parseFloat(dobra_tres_1.value)
                , dobra_2 = parseFloat(dobra_tres_2.value)
                , dobra_3 = parseFloat(dobra_tres_3.value)
                , pdg = calcularPdgTresDobras(dobra_1, dobra_2, dobra_3, idade);

            percentualgordura_valor.value = pdg.toFixed(2);
            alertar.style.display = 'none';
        }

    } else if (pdg_quatro.style.display === 'block') {
        let dobra_quatro_1 = document.querySelector('#dobra-quatro-1')
            , dobra_quatro_2 = document.querySelector('#dobra-quatro-2')
            , dobra_quatro_3 = document.querySelector('#dobra-quatro-3')
            , dobra_quatro_4 = document.querySelector('#dobra-quatro-4')
            , resultado = validarCampos(
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
            let sexo = document.querySelector('#sexo').innerHTML
                , idade = parseInt(document.querySelector('#avaliacao-idade').value)
                , dobra_1 = parseFloat(dobra_quatro_1.value)
                , dobra_2 = parseFloat(dobra_quatro_2.value)
                , dobra_3 = parseFloat(dobra_quatro_3.value)
                , dobra_4 = parseFloat(dobra_quatro_4.value)
                , pdg = calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, sexo, idade);

            percentualgordura_valor.value = pdg.toFixed(2);
            alertar.style.display = 'none';
        }
    }

    if (form2.style.display === 'block') {
        form2.style.display = 'none';
        form3.style.display = 'block';
    }
};

btn_volta2.onclick = function() {
    if (form3.style.display === 'block') {
        form3.style.display = 'none';
        form2.style.display = 'block';
    }
};

calculo_pg.onchange = function(event) {
    if (event.target.value === 'calculo3') {
        pdg_tres.style.display = 'block';
        pdg_quatro.style.display = 'none';
    } else {
        pdg_quatro.style.display = 'block';
        pdg_tres.style.display = 'none';
    }
};

console.log(calcularPdgQuatroDobras(12,12,12,12, 'feminino', 22));

function validarCampos(/* agrs */) {
    for (let i = 0; i < arguments.length; i++) {
        if (arguments[i] === '') return false;
    }
    return true;
}