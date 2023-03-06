function validarFormUsuario() {
    $("#email_usuario").prop('disabled', false);
    return true;
}

function carregaValorCampoHiddenCongregacao() {
    $('#congregacao_usuario_id').val($('#congregacao_id').val());
    return true;
}

$(document).ready(function () {
    $("#itemMenuUsuarios").addClass('active');
    $("#uf_congregacao").change(function () {
        carregarInputCongregacoes("congregacao_id", "uf_congregacao");
    });
    $("#congregacao_id").change(function () {
        carregaValorCampoHiddenCongregacao();
    });
});
