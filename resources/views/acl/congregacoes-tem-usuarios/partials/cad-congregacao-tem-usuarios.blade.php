@php
    $disabled = '';
    //$roleHasusuarios_role = [];
@endphp

<style>
    .DocumentListItensVendas {
        overflow-x: hidden;
        overflow-y: scroll;
        height: 425px;
    }
</style>

<form class="form-horizontal" method="POST" action="{{ url('/acl/congregacoes-tem-usuarios/salvar') }}"
      autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" id="congregacao_id" name="congregacao_id" value="{{ $congregacao_id }}">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastro do(s) Usuários da Congregação</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <span class="text-danger">{{ $errors->first('usuario_ids') }}</span>
            <div class="DocumentListItensVendas">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td align="center">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="checkTodos" name="checkTodos" class="minimal">
                                <label for="checkTodos">
                                </label>
                            </div>
                        </td>
                        <th>Usuário</th>
                        <th>E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($usuarios) > 0)
                        @foreach ($usuarios as $usuario)
                            @php
                                $checked = "";
                                if (in_array($usuario->id, $usuarios_congregacao)) {
                                    $checked = "checked";
                                }
                            @endphp
                            <tr>
                                <td align="center">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary{{ $usuario->id }}" name="usuario_ids[]"
                                               value="{{ $usuario->id }}" {{ $checked }}>
                                        <label for="checkboxPrimary{{ $usuario->id }}"></label>
                                    </div>
                                </td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Nenhum registro encontrado!</td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Usuário</th>
                        <th>E-mail</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" onclick="validar()" {{ $disabled }}>
                    Salvar
                </button>
                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
</form>
