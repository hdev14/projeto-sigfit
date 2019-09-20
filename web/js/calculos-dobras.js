
function calcularPdgTresDobras(dobra_1, dobra_2, dobra_3, idade) {
    let soma_dobras = dobra_1 + dobra_2 + dobra_3
        , quadrado_da_soma = Math.pow(soma_dobras, 2)
        , pdg = (0.41563 * soma_dobras) - (0.00112 * quadrado_da_soma) + (0.03661 * idade) + 4.03653;
    return pdg;
}

function calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, sexo, idade) {

    let soma_dobras = dobra_1 + dobra_2 + dobra_3 + dobra_4
        , quadrado_da_soma = Math.pow(soma_dobras, 2)
        , pdg = 0;

    if (sexo === 'masculino') {
        pdg = (0.29288 * soma_dobras) - (0.0005 * quadrado_da_soma) + (0.15845 * idade) - 5.76377;
    } else if (sexo === 'feminino') {
        pdg = (0.29669 * quadrado_da_soma) - (0.00043 * quadrado_da_soma) + (0.02963 * idade) + 1.4072;
    }

    return pdg;
}