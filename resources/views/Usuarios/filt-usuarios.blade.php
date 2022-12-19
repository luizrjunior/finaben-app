@section('title', 'FINABEN')
@section('sub-title', 'Usuários')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/usuario/filt-usuarios.js') }}"></script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Usuários</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Usuários</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <form class="form-horizontal" role="form" method="POST"
                  action="{{ url('/usuarios') }}" autocomplete="off">
                @csrf

            <div class="row">
                <div class="col-md-3">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filtro de Usuários</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nome_usuario_psq" class="control-label">Nome</label>
                                <input type="text" id="nome_usuario_psq" name="nome_usuario_psq"
                                       class="form-control" value="{{ $data['nome_usuario_psq'] }}" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email_usuario_psq" class="control-label">E-mail</label>
                                <input type="text" id="email_usuario_psq" name="email_usuario_psq"
                                       class="form-control" value="{{ $data['email_usuario_psq'] }}">
                            </div>
                            <div class="form-group">
                                <label for="totalPage" class="control-label">Qtde. Itens por Página</label>
                                <select class="form-control custom-select" id="totalPage" name="totalPage">
                                    <option value="5" @if ($data['totalPage'] == 5) selected @endif>05</option>
                                    <option value="10" @if ($data['totalPage'] == 10) selected @endif>10
                                    </option>
                                    <option value="15" @if ($data['totalPage'] == 15) selected @endif>15
                                    </option>
                                    <option value="20" @if ($data['totalPage'] == 20) selected @endif>20
                                    </option>
                                    <option value="25" @if ($data['totalPage'] == 25) selected @endif>25
                                    </option>
                                    <option value="30" @if ($data['totalPage'] == 30) selected @endif>30
                                    </option>
                                    <option value="35" @if ($data['totalPage'] == 35) selected @endif>35
                                    </option>
                                    <option value="40" @if ($data['totalPage'] == 40) selected @endif>40
                                    </option>
                                    <option value="45" @if ($data['totalPage'] == 45) selected @endif>45
                                    </option>
                                    <option value="50" @if ($data['totalPage'] == 50) selected @endif>50
                                    </option>
                                    <option value="100" @if ($data['totalPage'] == 100) selected @endif>100
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Filtrar" class="btn btn-success">
                            <input type="button" value="Adicionar Novo Usuário" class="btn btn-warning"
                                   onclick="location.href='{{ url('/usuarios/usuario/adicionar') }}'">
                            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Fechar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabela de Usuários</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cadastrado em</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Grupo(s)</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($usuarios) > 0)
                                    @foreach ($usuarios as $usuario)
                                        @php
                                            $user_has_roles = $usuario->roles->where('system_id', Session::get('session_sistema_id'));
                                        @endphp
                                        <tr>
                                            <td>#</td>
                                            <td>{{ date('d/m/Y H:i:s', strtotime($usuario->created_at)) }}</td>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td align="center">
                                                @if(count($user_has_roles) > 0)
                                                    @foreach($user_has_roles as $role)
                                                        <span class="right badge badge-warning">{{ $role->name }}</span>
                                                    @endforeach
                                                @else
                                                    @if ($usuario->id != 1)
                                                        <span class="right badge badge-danger">Sem_Perfil</span>
                                                    @else
                                                        <span class="right badge badge-primary">Administrador_Master</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if ($usuario->id != 1)
                                                    <a class="btn btn-info btn-sm" href="{{ url("/usuarios/usuario/{$usuario->id}/edit") }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Editar
                                                    </a>
                                                @else
                                                    <button class="btn btn-info btn-sm" disabled>
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                        Editar
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Nenhum registro
                                            encontrado!
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <td>
                                        @if (isset($data))
                                            {{ $usuarios->appends($data)->links() }}
                                        @else
                                            {{ $usuarios->links() }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>


            </form>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
