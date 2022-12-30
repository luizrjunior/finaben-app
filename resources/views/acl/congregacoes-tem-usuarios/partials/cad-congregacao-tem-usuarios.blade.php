@php
    $disabled = '';
    //$roleHaspermissions_role = [];
@endphp

<style>
    .DocumentListItensVendas {
        overflow-x: hidden;
        overflow-y: scroll;
        height: 425px;
    }
</style>

<form class="form-horizontal" method="POST" action="{{ url('/acl/grupos-tem-permissoes/salvar') }}"
      autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" id="grupo_id" name="grupo_id" value="{{ $grupo_id }}">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastro do(s) Grupo(s) do Usuário</h3>

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
            <span class="text-danger">{{ $errors->first('permission_ids') }}</span>
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
                        <th>Nº Ordem</th>
                        <th>Permissão</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            @php
                                $checked = "";
                                if (in_array($permission->id, $permissions_role)) {
                                    $checked = "checked";
                                }
                            @endphp
                            <tr>
                                <td align="center">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary{{ $permission->id }}" name="permission_ids[]"
                                               value="{{ $permission->id }}" {{ $checked }}>
                                        <label for="checkboxPrimary{{ $permission->id }}"></label>
                                    </div>
                                </td>
                                <td align="right">{{$permission->permission_order}}</td>
                                <td>{{$permission->name}}</td>
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
                        <th>Nº Ordem</th>
                        <th>Permissão</th>
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
            </div>
        </div>
    </div>
</form>
