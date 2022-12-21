@php
    $permissao = isset($permissao) ? $permissao : null;
    $permissao_id = isset($permissao->id) ? $permissao->id : null;
    $nome_permissao = isset($permissao->name) ? $permissao->name : null;
    $email_permissao = isset($permissao->email) ? $permissao->email : null;
    $senha_permissao = null;
    $confirm_senha_permissao = null;

    $permissao_id = retornaValorAntigo($permissao_id, 'permissao_id');
    $nome_permissao = retornaValorAntigo($nome_permissao, 'nome_permissao');
    $email_permissao = retornaValorAntigo($email_permissao, 'email_permissao');
    $senha_permissao = retornaValorAntigo($senha_permissao, 'senha_permissao');
    $confirm_senha_permissao = retornaValorAntigo($confirm_senha_permissao, 'confirm_senha_permissao');

    $breadcrumb = 'Adicionar Novo';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $urlAdicionar = url('/acl/permissoes/adicionar');
    $urlVoltar = url('/acl/permissoes');
    $url = url('/acl/permissoes/inserir');

    if ($permissao_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar Novo';
        $url = url('/acl/permissoes/atualizar');
        if ($permissao_id == 1) {
            $disabled = "disabled";
        }
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Permissões')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/acl/permissoes/cad-permissao.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
            })
        </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Permissão</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">ACL</li>
                            <li class="breadcrumb-item">Permissões</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Permissão</li>
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
                                <h3 class="card-title">Cadastro de Permissão</h3>

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

                                <input type="hidden" id="permissao_id" name="permissao_id" value="{{ $permissao_id }}">

                                <div class="form-group">
                                    <label for="nome_permissao" class="control-label">Nome <span class="text-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">@</span>
                                        </div>
                                        <input type="text" id="nome_permissao" name="nome_permissao"
                                               class="form-control {{ $errors->has('nome_permissao') ? 'is-invalid' : '' }}"
                                               placeholder="Nome do Permissão" value="{{ $nome_permissao }}" autofocus>
                                        <span class="error invalid-feedback">{{ $errors->first('nome_permissao') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email_permissao" class="control-label">E-mail <span
                                            class="text-red">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" id="email_permissao" name="email_permissao"
                                               class="form-control {{ $errors->has('email_permissao') ? 'is-invalid' : '' }}"
                                               placeholder="E-mail do Permissão" value="{{ $email_permissao }}">
                                        <span
                                            class="error invalid-feedback">{{ $errors->first('email_permissao') }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <input type="submit" value="Salvar" class="btn btn-primary" {{ $disabled }}>
                                <input type="button" value="{{ $btnAdicionar }}" class="btn btn-warning"
                                       onclick="location.href='{{ $urlAdicionar }}'">
                                <a href="{{ $urlVoltar }}" class="btn btn-secondary">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
