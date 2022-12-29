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
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="panel panel-default">
            <div class="panel-heading">Cadastro de Permissão(ões) do Grupo</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-12">
                        <span class="text-danger">{{ $errors->first('permission_ids') }}</span>
                        <div class="DocumentListItensVendas">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td align="center">
                                        <input type="checkbox" class="minimal" id="checkTodos" name="checkTodos">
                                    </td>
                                    <th>Permissão</th>
                                    <th>Nº Ordem</th>
                                    <th>Sistema</th>
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
                                                <input type="checkbox" name="permission_ids[]"
                                                       value="{{ $permission->id }}" class="minimal" {{ $checked }}>
                                            </td>
                                            <td>{{$permission->name}}</td>
                                            <td align="right">{{$permission->permission_order}}</td>
                                            <td>{{!empty($permission->system->initials) ? $permission->system->initials : "--"}}</td>
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
                                    <th>Permissão</th>
                                    <th>Nº Ordem</th>
                                    <th>Sistema</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" onclick="validar()" {{ $disabled }}>
                            <i class="fa fa-btn fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
