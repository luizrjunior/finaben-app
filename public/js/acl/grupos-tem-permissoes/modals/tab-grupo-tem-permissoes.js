function abrirModalViewPermissions(role_id) {
    carregarPermissoesPorPapel(role_id);
    $('#modalViewPermissions').modal('show');
}

function fecharModalViewPermissions() {
    $('#modalViewPermissions').modal('hide');
}

function carregarPermissoesPorPapel(role_id) {
    var formURL = top.urlSearchPermissionsForRole;
    $.ajax({
        type: "POST",
        url: formURL,
        data: {
            _token: $("input[name='_token']").val(),
            role_id: role_id
        },
        success: function (data) {
            $("#listPermissionsForRole tr").remove();
            var count = 0;
            $.each(data, function (index, item) {
                var linha = '<tr>' +
                    '<td>' + item.role_name + '</td>' +
                    '<td align="right">' + item.permission_order + '</td>' +
                    '<td>' + item.name + '</td>' +
                    '<td>' + item.description + '</td>' +
                    '<td>' + item.system_initials + '</td>' +
                    '</tr>';
                $("#listPermissionsForRole").append(linha);
                count = 1;
            });
            if (count == 0) {
                var linha = '<tr style="text-align: center;">' +
                    '<td colspan="3" class="callout callout-warning">Não existem registros para a pesquisa realizada!</td>' +
                    '</tr>';
                $("#listPermissionsForRole").append(linha);
            }
        }
    });
}
