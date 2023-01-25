function validar() {
    return true;
}

$(document).ready(function () {
    $("#itemMenuDashboard").addClass('active');
    $("#uf_congregacao").change(function () {
        carregarInputCongregacoes("congregacao_id", "uf_congregacao");
    });
});
