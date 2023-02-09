function validarFormLancamento() {
    $("#uf_lancamento").prop('disabled', false);
    $("#congregacao_id").prop('disabled', false);
    $("#tipo_lancamento").prop('disabled', false);
    $("#titulo_lancamento").prop('disabled', false);
    $("#status_lancamento").prop('disabled', false);
    $("#categoria_lancamento_id").prop('disabled', false);
    return true;
}

function quitar() {
    validarFormLancamento();
    $('#formCadastroLancamento').attr('action', top.urlQuitarLancamento);
    $("#formCadastroLancamento").submit();
}

$(document).ready(function () {
    $("#itemMenuFinanceiro").addClass('menu-open');
    $("#itemMenuLancamentos").addClass('active');

    $("#data_lancamento").mask("99/99/9999");
    $('#data_lancamento').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighLight: true,
        orientation: 'bottom'
    });

    $('#valor_lancamento').bind('input', function () {
        guiMoneyMask('valor_lancamento');
    });

    $("#btnQuitarLancamento").click(function () {
        quitar();
    });

    $("#uf_lancamento").prop('disabled', true);
    $("#congregacao_id").prop('disabled', true);
});
