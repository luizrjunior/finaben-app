function validar() {
    $("#uf_lancamento").prop('disabled', false);
    $("#congregacao_id").prop('disabled', false);
    return true;
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
    $("#uf_lancamento").prop('disabled', true);
    $("#congregacao_id").prop('disabled', true);
});
