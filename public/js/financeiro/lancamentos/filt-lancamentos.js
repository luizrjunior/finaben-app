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
    $("#uf_psq").change(function () {
        carregarInputCongregacoesPsq();
    });
});
