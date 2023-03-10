<style>
    .DocumentListItensVendas {
        overflow-x: hidden;
        overflow-y: scroll;
        height: 400px;
    }
</style>

<form class="form-horizontal" method="POST" action="{{ url('/usuarios/usuario-tem-grupos/salvar') }}"
      autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario_id }}">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Grupo(s) do Usuário</h3>

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
            <span class="text-danger">{{ $errors->first('role_ids') }}</span>
            <div class="DocumentListItensVendas">
                @if (count($roles) > 0)
                    <div class="box-body table-responsive no-padding">
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
                            <th>Grupo</th>
                            <th>Permissões</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            @php
                                $checked = "";
                                if (in_array($role->id, $perfis_usuario)) {
                                    $checked = "checked";
                                }
                            @endphp
                            <tr>
                                <td align="center">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary{{ $role->id }}" name="role_ids[]"
                                               value="{{ $role->id }}" {{ $checked }}>
                                        <label for="checkboxPrimary{{ $role->id }}">
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="#" onclick="abrirModalViewPermissions('{{ $role->id }}')">
                                        <i class="fa fa-search"></i> Visualizar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Grupo</th>
                            <th>Permissões</th>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" onclick="validar()">
                        Salvar
                    </button>
                    <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</form>
