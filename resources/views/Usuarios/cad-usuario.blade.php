@php
    $usuario = isset($usuario) ? $usuario : null;
    $usuario_id = isset($usuario->id) ? $usuario->id : null;
    $nome_usuario = isset($usuario->name) ? $usuario->name : null;
    $email_usuario = isset($usuario->email) ? $usuario->email : null;
    $senha_usuario = null;
    $confirm_senha_usuario = null;

    $breadcrumb = '<i class="fa fa-plus"></i> Adicionar Novo';
    $btnAdicionar = '<i class="fa fa-eraser"></i> Limpar';
    $url = url('/usuarios/usuario/inserir');

    if ($usuario_id != null) {
        $breadcrumb = '<i class="fa fa-pencil"></i> Editar';
        $btnAdicionar = '<i class="fa fa-plus"></i> Adicionar Novo';
        $url = url('/usuarios/usuario/atualizar');
        if ($usuario_id == 1) {
            $disabled = "disabled";
        }
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Usuários')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/usuario/cad-usuario.js') }}"></script>
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
                <div class="col-md-6">
                    <form id="formCadastroUsuario" class="form-horizontal" method="POST" action="{{ $url }}"
                          autocomplete="off">
                    @csrf

                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cadastro de Usuário</h3>

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

                            <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario_id }}">

                            <div class="form-group">
                                <label for="nome_usuario" class="control-label">Nome <span class="text-red">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">@</span>
                                    </div>
                                    <input type="text" id="nome_usuario" name="nome_usuario" class="form-control" placeholder="Nome do Usuário" value="{{ $nome_usuario }}" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email_usuario" class="control-label">E-mail <span class="text-red">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" id="email_usuario" name="email_usuario" class="form-control" placeholder="E-mail do Usuário" value="{{ $email_usuario }}">
                                </div>
                            </div>

                            @if ($usuario_id == "")
                            <div class="form-group">
                                <label for="senha_usuario">Senha <span class="text-red">*</span></label>
                                <input type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Senha de Acesso">
                            </div>

                            <div class="form-group">
                                <label for="confirm_senha_usuario">Repetir Senha <span class="text-red">*</span></label>
                                <input type="password" class="form-control" id="confirm_senha_usuario" name="confirm_senha_usuario" placeholder="Repetir Senha de Acesso">
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Salvar" class="btn btn-success">
                            <input type="button" value="Limpar" class="btn btn-warning"
                                   onclick="location.href='{{ url('/usuarios/adicionar') }}'">
                            <a href="{{ url('/usuarios') }}" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
