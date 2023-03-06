@php
    $usuario = isset($usuario) ? $usuario : null;
    $usuario_id = isset($usuario->id) ? $usuario->id : null;
    $nome_usuario = isset($usuario->name) ? $usuario->name : null;
    $email_usuario = isset($usuario->email) ? $usuario->email : null;
    $senha_usuario = null;
    $confirm_senha_usuario = null;

    $congregacao_uf = isset($congregacao_usuario->uf) ? $congregacao_usuario->uf : null;
    $congregacao_id = isset($congregacao_usuario->id) ? $congregacao_usuario->id : null;

    $usuario_id = retornaValorAntigo($usuario_id, 'usuario_id');
    $nome_usuario = retornaValorAntigo($nome_usuario, 'nome_usuario');
    $email_usuario = retornaValorAntigo($email_usuario, 'email_usuario');
    $senha_usuario = retornaValorAntigo($senha_usuario, 'senha_usuario');
    $confirm_senha_usuario = retornaValorAntigo($confirm_senha_usuario, 'confirm_senha_usuario');

    $congregacao_uf = retornaValorAntigo($congregacao_uf, 'congregacao_usuario_uf');
    $congregacao_id = retornaValorAntigo($congregacao_id, 'congregacao_usuario_id');

    $breadcrumb = 'Adicionar';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $urlAdicionar = url('/usuarios/adicionar');
    $urlVoltar = url('/usuarios');
    $url = url('/usuarios/inserir');
    $urlSalvarCongregacao = url('/acl/congregacoes-tem-usuarios/salvar-congregacao-usuario');

    if ($usuario_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar';
        $url = url('/usuarios/atualizar');
        if ($usuario_id == 1) {
            $disabled = "disabled";
        }
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Usuários')

<x-app-layout>
    <x-slot name="javascript">
        <script type="text/javascript">
            top.urlCarregarCongregacoes = '{{ url('/acl/congregacoes') }}';
        </script>
        <script src="{{ asset('/js/usuarios/cad-usuario.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                @if ($usuario_id != "")
                $("#email_usuario").prop('disabled', true);
                @endif

                $("#checkTodos").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
            })
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Usuário</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">Usuários</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Usuário</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <form id="formCadastroUsuario" class="form-horizontal" method="POST" action="{{ $url }}"
                          autocomplete="off">
                    @csrf

                    <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cadastro de Usuário</h3>

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

                                @if (Session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                        </button>
                                        <h5><i class="icon fas fa-check"></i> Sucesso!</h5>
                                        {!! Session('success') !!}
                                    </div>
                                @endif

                                <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario_id }}">
                                <input type="hidden" id="congregacao_usuario_uf" name="congregacao_usuario_uf" value="{{ $congregacao_uf }}">
                                <input type="hidden" id="congregacao_usuario_id" name="congregacao_usuario_id" value="{{ $congregacao_id }}">

                                <div class="form-group">
                                    <label for="nome_usuario" class="control-label">Nome <span class="text-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="text" id="nome_usuario" name="nome_usuario"
                                               class="form-control {{ $errors->has('nome_usuario') ? 'is-invalid' : '' }}"
                                               placeholder="Nome do Usuário" value="{{ $nome_usuario }}" autofocus>
                                        <span class="error invalid-feedback">{{ $errors->first('nome_usuario') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email_usuario" class="control-label">E-mail <span
                                            class="text-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" id="email_usuario" name="email_usuario"
                                               class="form-control {{ $errors->has('email_usuario') ? 'is-invalid' : '' }}"
                                               placeholder="E-mail do Usuário" value="{{ $email_usuario }}">
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('email_usuario') }}</span>
                                    </div>
                                </div>

                                @if ($usuario_id == "")
                                    <div class="form-group">
                                        <label for="senha_usuario">Senha <span class="text-red">*</span></label>
                                        <input type="password"
                                               class="form-control {{ $errors->has('senha_usuario') ? 'is-invalid' : '' }}"
                                               id="senha_usuario" name="senha_usuario" placeholder="Senha de Acesso">
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('senha_usuario') }}</span>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_senha_usuario">Repetir Senha <span class="text-red">*</span></label>
                                        <input type="password"
                                               class="form-control {{ $errors->has('confirm_senha_usuario') ? 'is-invalid' : '' }}"
                                               id="confirm_senha_usuario" name="confirm_senha_usuario"
                                               placeholder="Repetir Senha de Acesso">
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('confirm_senha_usuario') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Salvar" class="btn btn-primary"
                                       {{ $disabled }} onclick="return validarFormUsuario();">
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </form>
                    @if ($usuario_id != "")
                        <form id="formCongregacaoUsuario" class="form-horizontal" method="POST" action="{{ $urlSalvarCongregacao }}"
                              autocomplete="off">
                        @csrf
                            <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario_id }}">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Congregação do Usuário</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                                title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="uf_congregacao">Estado (UF) <span
                                                class="text-red">*</span></label>
                                        <select id="uf_congregacao" name="uf_congregacao"
                                                class="form-control custom-select {{ $errors->has('uf_congregacao') ? 'is-invalid' : '' }}">
                                            <option value=""> - - SELECIONE - - </option>
                                            @foreach($array_estados_congregacoes as $key => $value)
                                                @php
                                                    $selected = "";
                                                    if ($congregacao_uf == $key) {
                                                        $selected = "selected";
                                                    }
                                                @endphp
                                                <option value="{{ $key }}" {{ $selected }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('uf_congregacao') }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="congregacao_id">Congregação <span class="text-red">*</span></label>
                                        <select id="congregacao_id" name="congregacao_id"
                                                class="form-control custom-select {{ $errors->has('congregacao_id') || $errors->has('congregacao_usuario_id') ? 'is-invalid' : '' }}">
                                            <option value=""> - - SELECIONE UM ESTADO (UF) - - </option>
                                            @foreach ($congregacoes as $congregacao)
                                                @php
                                                    $selected = "";
                                                    if ($congregacao_id == $congregacao->id) {
                                                        $selected = "selected";
                                                    }
                                                @endphp
                                                <option
                                                    value="{{ $congregacao->id }}" {{ $selected }}>{{ $congregacao->nome }}</option>
                                            @endforeach
                                        </select>
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('congregacao_id') }}</span>
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('congregacao_usuario_id') }}</span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit" value="Salvar" class="btn btn-primary"
                                           {{ $disabled }} onclick="return validarFormUsuario();">
                                    <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                                </div>
                            </div>
                        </form>

                    @endif
                </div>

                @if ($usuario_id != "")
                    <div class="col-md-9">
                        @include('usuarios.cad-usuario-tem-grupos')
                    </div>
                @endif

            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
