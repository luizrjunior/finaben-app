function validar() {
    $("#congregacao_uf_psq").prop('disabled', false);
    $("#congregacao_id_psq").prop('disabled', false);
    return true;
}

function lancarSaldoPendenteParaSede() {
    validar();
    $("#formAdicionarPercentualSede").submit();
}

$(document).ready(function () {
    $("#itemMenuFinanceiro").addClass('menu-open');
    $("#itemMenuLancamentos").addClass('active');

    $("#data_inicio_psq").mask("99/99/9999");
    $('#data_inicio_psq').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighLight: true,
        orientation: 'bottom'
    });

    //Date picker
    $("#data_final_psq").mask("99/99/9999");
    $('#data_final_psq').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighLight: true,
        orientation: 'bottom'
    });

    $("#tipo_psq").change(function () {
        carregarInputCategoriasPsq();
    });

    $("#congregacao_uf_psq").change(function () {
        carregarInputCongregacoes("congregacao_id_psq", "congregacao_uf_psq");
    });

    $("#btnLancarSaldoPendenteSede").click(function () {
        lancarSaldoPendenteParaSede();
    });
});
