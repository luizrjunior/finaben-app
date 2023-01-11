function carregarInputCategoriasPsq() {
    $("#categoria_lancamento_id_psq").html('<option value="">CARREGANDO...</option>');
    var formURL = top.urlCarregarCategorias + '/carregar';
    var postData = {
        _token: $("input[name='_token']").val(),
        tipo_psq: $("#tipo_psq").val()
    };
    $.ajax({
        type: "POST",
        url: formURL,
        data: postData,
        dataType: "json",
        success: function (data) {
            console.log(data);
            var count = 0;
            $("#categoria_lancamento_id_psq").html('<option value=""> - - SELECIONE - - </option>');
            $.each(data, function (index, item) {
                $("#categoria_lancamento_id_psq").append('<option value="' + index + '">' + item + '</option>');
                count = 1;
            });
        }
    });
}

function carregarInputCongregacoesPsq() {
    $("#congregacao_id_psq").html('<option value="">CARREGANDO...</option>');
    var formURL = top.urlCarregarCongregacoes + '/carregar';
    var postData = {
        _token: $("input[name='_token']").val(),
        uf_psq: $("#uf_psq").val()
    };
    $.ajax({
        type: "POST",
        url: formURL,
        data: postData,
        dataType: "json",
        success: function (data) {
            console.log(data);
            var count = 0;
            $("#congregacao_id_psq").html('<option value=""> - - SELECIONE - - </option>');
            $.each(data, function (index, item) {
                $("#congregacao_id_psq").append('<option value="' + index + '">' + item + '</option>');
                count = 1;
            });
        }
    });
}
