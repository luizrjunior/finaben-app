function validarFormUsuario() {
    $("#email_usuario").prop('disabled', false);
    return true;
}

$(document).ready(function () {
    $("#itemMenuUsuarios").addClass('active');
    $("#uf_congregacao").change(function () {
        carregarInputCongregacoes("congregacao_id", "uf_congregacao");
    });
});
