@php
    $permissao = isset($permissao) ? $permissao : null;
    $permissao_id = isset($permissao->id) ? $permissao->id : null;
    $nome_permissao = isset($permissao->name) ? $permissao->name : null;
    $ordem_permissao = isset($permissao->permission_order) ? $permissao->permission_order : null;
    $descrissao_permissao = isset($permissao->description) ? $permissao->description : null;
    $url_permissao = isset($permissao->permission_url) ? $permissao->permission_url : null;

    $permissao_id = retornaValorAntigo($permissao_id, 'permissao_id');
    $nome_permissao = retornaValorAntigo($nome_permissao, 'nome_permissao');
    $ordem_permissao = retornaValorAntigo($ordem_permissao, 'ordem_permissao');
    $descrissao_permissao = retornaValorAntigo($descrissao_permissao, 'descrissao_permissao');
    $url_permissao = retornaValorAntigo($url_permissao, 'url_permissao');

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
                    <form id="formCadastroPermissao" class="form-horizontal" method="POST" action="{{ $url }}"
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
                                    <input type="text" id="nome_permissao" name="nome_permissao"
                                           class="form-control {{ $errors->has('nome_permissao') ? 'is-invalid' : '' }}"
                                           placeholder="Nome do Permissão" value="{{ $nome_permissao }}" autofocus>
                                    <span class="error invalid-feedback">{{ $errors->first('nome_permissao') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="ordem_permissao" class="control-label">Nº Ordem <span
                                            class="text-red">*</span></label>
                                    <input type="text" id="ordem_permissao" name="ordem_permissao"
                                           class="form-control {{ $errors->has('ordem_permissao') ? 'is-invalid' : '' }}"
                                           placeholder="Nº Ordem da Permissão" value="{{ $ordem_permissao }}">
                                    <span class="error invalid-feedback">{{ $errors->first('ordem_permissao') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="descrissao_permissao" class="control-label">Descrição</label>
                                    <textarea id="descrissao_permissao" name="descrissao_permissao"
                                              class="form-control {{ $errors->has('descrissao_permissao') ? 'is-invalid' : '' }}"
                                              rows="3" placeholder="Descrição...">{{ $descrissao_permissao }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="url_permissao" class="control-label">Url</label>
                                    <input type="text" id="url_permissao" name="url_permissao"
                                           class="form-control {{ $errors->has('url_permissao') ? 'is-invalid' : '' }}"
                                           placeholder="Url da Permissão" value="{{ $url_permissao }}">
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
