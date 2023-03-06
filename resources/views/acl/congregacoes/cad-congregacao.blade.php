@php
    $congregacao = isset($congregacao) ? $congregacao : null;
    $congregacao_id = isset($congregacao->id) ? $congregacao->id : null;
    $nome_congregacao = isset($congregacao->nome) ? $congregacao->nome : null;
    $uf_congregacao = isset($congregacao->uf) ? $congregacao->uf : null;

    $congregacao_id = retornaValorAntigo($congregacao_id, 'congregacao_id');
    $nome_congregacao = retornaValorAntigo($nome_congregacao, 'nome_congregacao');
    $uf_congregacao = retornaValorAntigo($uf_congregacao, 'uf_congregacao');

    $breadcrumb = 'Adicionar';
    $btnAdicionar = 'Limpar';
    $disabled = "";

    $urlAdicionar = url('/acl/congregacoes/adicionar');
    $urlVoltar = url('/acl/congregacoes');
    $url = url('/acl/congregacoes/inserir');

    if ($congregacao_id != null) {
        $breadcrumb = 'Editar';
        $btnAdicionar = 'Adicionar';
        $url = url('/acl/congregacoes/atualizar');
    }
@endphp

@section('title', 'FINABEN')
@section('sub-title', 'Congregações')

<x-app-layout>
    <x-slot name="javascript">
        <script src="{{ asset('/js/acl/congregacoes/cad-congregacao.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#checkTodos").click(function(){
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
                        <h1 class="m-0">{!! $breadcrumb !!} <small>Congregação</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item">ACL</li>
                            <li class="breadcrumb-item">Congregações</li>
                            <li class="breadcrumb-item active">{!! $breadcrumb !!} Congregação</li>
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
                                <h3 class="card-title">Cadastro de Congregação</h3>

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

                                <input type="hidden" id="congregacao_id" name="congregacao_id" value="{{ $congregacao_id }}">

                                <div class="form-group">
                                    <label for="nome_congregacao" class="control-label">Nome <span class="text-red">*</span></label>
                                    <input type="text" id="nome_congregacao" name="nome_congregacao"
                                           class="form-control {{ $errors->has('nome_congregacao') ? 'is-invalid' : '' }}"
                                           placeholder="Nome do Congregação" value="{{ $nome_congregacao }}" autofocus>
                                    <span class="error invalid-feedback">{{ $errors->first('nome_congregacao') }}</span>
                                </div>

                                <div class="form-group">
                                    <label for="uf_congregacao">UF <span class="text-red">*</span></label>
                                    <select id="uf_congregacao" name="uf_congregacao" class="form-control custom-select {{ $errors->has('uf_congregacao') ? 'is-invalid' : '' }}">
                                        <option value="" selected> -- SELECIONE -- </option>
                                        @foreach($array_estados_congregacoes as $key => $value)
                                            <option value="{{ $key }}" @if ($uf_congregacao == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error invalid-feedback">{{ $errors->first('uf_congregacao') }}</span>
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
                @if ($congregacao_id != null)
                <div class="col-md-9">
                    @include('acl.congregacoes-tem-usuarios.partials.cad-congregacao-tem-usuarios')
                </div>
                @endif
            </div>
        </div><!-- /.container-fluid -->
    </section>

</x-app-layout>
